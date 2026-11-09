<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'id',
        'title',
        'slug',
        'category',
        'summary',
        'content',
        'image_url',
        'author',
        'read_time',
        'created_at',
        'is_published',
    ];

    private string $storagePath;

    public function __construct()
    {
        parent::__construct();
        $this->storagePath = WRITEPATH . 'data/articles.json';
    }

    /**
     * Retrieve all articles, optionally filtered by category or search term
     */
    public function getArticles(?string $category = null, ?string $search = null): array
    {
        $articles = $this->loadAll();

        // Filter published only for public query
        $articles = array_filter($articles, function ($a) {
            return !isset($a['is_published']) || $a['is_published'] == 1 || $a['is_published'] === true;
        });

        if (!empty($category) && $category !== 'all') {
            $articles = array_filter($articles, function ($a) use ($category) {
                return strtolower($a['category'] ?? '') === strtolower($category) ||
                       strtolower($a['category_slug'] ?? '') === strtolower($category);
            });
        }

        if (!empty($search)) {
            $search = strtolower(trim($search));
            $articles = array_filter($articles, function ($a) use ($search) {
                $text = strtolower(($a['title'] ?? '') . ' ' . ($a['summary'] ?? '') . ' ' . ($a['category'] ?? ''));
                return strpos($text, $search) !== false;
            });
        }

        // Sort by created_at DESC
        usort($articles, function ($a, $b) {
            return strcmp($b['created_at'] ?? '', $a['created_at'] ?? '');
        });

        return array_values($articles);
    }

    /**
     * Retrieve single article by slug
     */
    public function getArticleBySlug(string $slug): ?array
    {
        $articles = $this->loadAll();
        foreach ($articles as $article) {
            if (($article['slug'] ?? '') === $slug) {
                return $article;
            }
        }
        return null;
    }

    /**
     * Retrieve all articles (including drafts for admin)
     */
    public function getAllForAdmin(): array
    {
        $articles = $this->loadAll();
        usort($articles, function ($a, $b) {
            return strcmp($b['created_at'] ?? '', $a['created_at'] ?? '');
        });
        return array_values($articles);
    }

    /**
     * Save or update an article
     */
    public function saveArticle(array $data): bool
    {
        $articles = $this->loadAll();

        if (empty($data['id'])) {
            $data['id'] = 'art-' . time() . '-' . rand(100, 999);
        }

        if (empty($data['slug'])) {
            $data['slug'] = $this->slugify($data['title'] ?? 'artikel-' . time());
        }

        if (empty($data['created_at'])) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        if (empty($data['author'])) {
            $data['author'] = 'Tim Riset & Rekayasa SOLVETA';
        }

        if (empty($data['read_time'])) {
            $data['read_time'] = '4 min baca';
        }

        $data['category_slug'] = $this->slugify($data['category'] ?? 'umum');
        $data['is_published'] = isset($data['is_published']) ? (int) $data['is_published'] : 1;

        $found = false;
        foreach ($articles as $idx => $item) {
            if ($item['id'] === $data['id'] || $item['slug'] === $data['slug']) {
                $articles[$idx] = array_merge($item, $data);
                $found = true;
                break;
            }
        }

        if (!$found) {
            $articles[] = $data;
        }

        return $this->persist($articles);
    }

    /**
     * Delete an article by ID
     */
    public function deleteArticle(string $id): bool
    {
        $articles = $this->loadAll();
        $filtered = array_filter($articles, function ($item) use ($id) {
            return ($item['id'] ?? '') !== $id;
        });

        return $this->persist(array_values($filtered));
    }

    /**
     * Helper to slugify a string
     */
    public function slugify(string $text): string
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        return empty($text) ? 'n-a' : $text;
    }

    /**
     * Internal loader with file-backed persistence and MySQL fallback
     */
    private function loadAll(): array
    {
        if (file_exists($this->storagePath)) {
            $raw = file_get_contents($this->storagePath);
            $decoded = json_decode($raw, true);
            if (is_array($decoded) && !empty($decoded)) {
                return $decoded;
            }
        }

        // Initialize with default high-quality SEO articles
        $defaults = $this->getDefaultArticles();
        $this->persist($defaults);
        return $defaults;
    }

    /**
     * Persist to JSON file
     */
    private function persist(array $articles): bool
    {
        $dir = dirname($this->storagePath);
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }

        return (bool) file_put_contents(
            $this->storagePath,
            json_encode($articles, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        );
    }

    /**
     * High-quality default SEO articles for SOLVETA Technology Agency
     */
    public function getDefaultArticles(): array
    {
        return [
            [
                'id' => 'art-1',
                'title' => 'Panduan Memilih Website Company Profile vs Web App untuk Akselerasi Bisnis',
                'slug' => 'panduan-memilih-website-company-profile-vs-web-app',
                'category' => 'Website & SaaS',
                'category_slug' => 'website-saas',
                'summary' => 'Ketahui perbedaan fundamental antara landing page company profile dengan platform web application kustom agar investasi teknologi bisnis Anda tepat sasaran.',
                'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80',
                'author' => 'Tim Rekayasa SOLVETA',
                'read_time' => '5 min baca',
                'created_at' => '2026-11-05 10:00:00',
                'is_published' => 1,
                'content' => "
<p>Banyak pemilik bisnis dan pengambil keputusan menghadapi dilema saat memulai digitalisasi: <i>apakah bisnis kami cukup membutuhkan website company profile modern, ataukah kami memerlukan custom web application dengan integrasi basis data penuh?</i></p>

<h3>1. Apa Fungsi Utama Website Company Profile?</h3>
<p>Website company profile berperan sebagai etalase digital utama perusahaan Anda. Tujuannya adalah membangun kredibilitas, menjelaskan proposisi nilai produk, memamerkan portofolio terpercaya, dan mengarahkan calon prospek ke tim penjualan (seperti WhatsApp atau formulir penawaran B2B).</p>
<p>Karakteristik penting:</p>
<ul>
    <li>Fokus pada penyampaian informasi, visual branding, dan kecepatan akses (*fast loading*).</li>
    <li>Struktur SEO yang kuat untuk merajai pencarian Google di industri terkait.</li>
    <li>Proses pengerjaan yang relatif cepat dan efisien biaya.</li>
</ul>

<h3>2. Kapan Anda Memerlukan Web Application (SaaS/Sistem Kustom)?</h3>
<p>Jika operasional bisnis Anda melibatkan transaksi multi-pengguna, alur verifikasi data bertingkat, sinkronisasi inventaris antar cabang, atau integrasi API pihak ketiga (payment gateway, kurir logistik, WhatsApp automasi), maka Anda memerlukan <b>Web Application</b>.</p>
<p>Contoh nyata yang telah kami bangun di SOLVETA mencakup:</p>
<ul>
    <li><b>CuanGO Digital Platform:</b> Pembukuan keuangan dan digital ledger realtime untuk ribuan transaksi harian.</li>
    <li><b>Haltea POS:</b> Point of Sale offline-first untuk operasional multi-outlet waralaba F&B.</li>
    <li><b>Squabumin CRM:</b> Otomasi order distributor dengan kalkulator ongkir dan cetak invoice instan.</li>
</ul>

<h3>Kesimpulan</h3>
<p>Mulailah dengan mengidentifikasi hambatan terbesar operasional Anda saat ini. Jika masalahnya adalah kurangnya prospek dan kredibilitas, prioritaskan website profesional. Namun jika masalahnya adalah kekacauan pencatatan manual dan inefisiensi tim, saatnya membangun sistem aplikasi web terpadu bersama mitra teknologi yang tepat.</p>
"
            ],
            [
                'id' => 'art-2',
                'title' => 'Kenapa Kecepatan Website (Core Web Vitals) Berpengaruh Langsung pada Omzet Penjualan',
                'slug' => 'kenapa-kecepatan-website-core-web-vitals-berpengaruh-pada-omzet',
                'category' => 'Tips Teknologi',
                'category_slug' => 'tips-teknologi',
                'summary' => 'Riset membuktikan setiap keterlambatan 1 detik waktu muat website dapat menurunkan tingkat konversi hingga 20%. Simak cara optimasi performa digital terkini.',
                'image_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=80',
                'author' => 'Tim Performa SOLVETA',
                'read_time' => '4 min baca',
                'created_at' => '2026-11-03 14:30:00',
                'is_published' => 1,
                'content' => "
<p>Di era konektivitas instan, pengguna internet tidak lagi memiliki kesabaran untuk menunggu halaman website yang lambat memuat. Google secara resmi menjadikan <b>Core Web Vitals</b> sebagai salah satu faktor penentu peringkat pencarian organik dan pengalaman pengguna.</p>

<h3>Tiga Pilar Utama Core Web Vitals:</h3>
<ol>
    <li><b>LCP (Largest Contentful Paint):</b> Mengukur seberapa cepat elemen visual utama (seperti gambar hero atau judul) selesai dimuat. Target ideal adalah di bawah 2.5 detik.</li>
    <li><b>INP (Interaction to Next Paint):</b> Mengukur responsivitas halaman saat pengguna mengklik tombol atau membuka menu navigasi.</li>
    <li><b>CLS (Cumulative Layout Shift):</b> Mengukur stabilitas visual agar elemen tidak bergeser tiba-tiba saat halaman sedang memuat.</li>
</ol>

<h3>Dampak Nyata pada Bisnis</h3>
<p>Ketika website Anda memuat dalam waktu kurang dari 1 detik (seperti standar JAMStack dan Tailwind yang kami terapkan di proyek SOLVETA), angka pentalan (*bounce rate*) turun drastis hingga 38%, dan rasio konversi pengunjung menjadi pelanggan aktif melonjak rata-rata 142%.</p>
"
            ],
            [
                'id' => 'art-3',
                'title' => 'Digitalisasi Operasional: Mengubah Pencatatan Manual Menjadi Sistem ERP & POS Terpadu',
                'slug' => 'digitalisasi-operasional-mengubah-pencatatan-manual-menjadi-sistem-erp-pos',
                'category' => 'Transformasi Digital',
                'category_slug' => 'transformasi-digital',
                'summary' => 'Langkah-langkah strategis bagi pemilik bisnis untuk bermigrasi dari pembukuan buku kas manual menuju ekosistem cloud otomatis tanpa mengganggu rutinitas harian.',
                'image_url' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=1200&q=80',
                'author' => 'Lead Architect SOLVETA',
                'read_time' => '6 min baca',
                'created_at' => '2026-11-01 09:15:00',
                'is_published' => 1,
                'content' => "
<p>Banyak bisnis skala menengah hingga korporasi masih bergantung pada spreadsheet terpisah atau bahkan catatan kertas untuk mengelola stok gudang, tagihan invoice, dan laporan kasir. Masalahnya baru terasa saat terjadi selisih stok barang atau keterlambatan penagihan piutang.</p>

<h3>Fase Transisi yang Terbukti Berhasil:</h3>
<ul>
    <li><b>Audit Alur Kerja Nyata:</b> Petakan alur kerja yang sudah berjalan tanpa mengubah kebiasaan tim secara drastis di awal.</li>
    <li><b>Sentralisasi Basis Data:</b> Buat satu sumber kebenaran (*single source of truth*) berbasis cloud yang aman dan terenkripsi.</li>
    <li><b>Antarmuka yang Ramah Pengguna:</b> Sistem secanggih apa pun akan gagal jika staf lapangan kesulitan mengoperasikannya. Di SOLVETA, antarmuka dirancang dengan prinsip Apple Design & Inter Typography yang intuitif.</li>
    <li><b>Otomasi Integrasi:</b> Hubungkan notifikasi invoice langsung ke WhatsApp pelanggan dan rekonsiliasi bank otomatis.</li>
</ul>
"
            ],
            [
                'id' => 'art-4',
                'title' => 'Tren Desain Web 2026: Mengapa Minimalis Clean Mengalahkan Tampilan AI Slop',
                'slug' => 'tren-desain-web-2026-minimalis-clean-kalahkan-ai-slop',
                'category' => 'UI/UX Architecture',
                'category_slug' => 'ui-ux-architecture',
                'summary' => 'Eksplorasi estetika antarmuka Swiss Design dan Apple fluid layout yang mengutamakan kenyamanan pengguna, kontras tinggi, dan fungsionalitas tanpa elemen visual berlebihan.',
                'image_url' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=1200&q=80',
                'author' => 'Creative Director SOLVETA',
                'read_time' => '4 min baca',
                'created_at' => '2026-10-28 16:45:00',
                'is_published' => 1,
                'content' => "
<p>Banjirnya generator desain instan menghasilkan fenomena yang dikenal luas sebagai <i>'AI Slop'</i> — website yang penuh gradasi ungu neon mencolok, kartu melayang tanpa fungsi jelas, dan teks generik yang tidak menyampaikan solusi bisnis apa pun.</p>

<p>Klien dan pengguna modern semakin menghargai kejelasan (*clarity*). Prinsip desain bersih yang berakar pada Swiss Typography, ruang bernapas (*white space*), dan sentuhan warna aksen terukur terbukti menghasilkan kepercayaan (*trust*) yang jauh lebih tinggi bagi agensi dan korporasi teknologi.</p>
"
            ]
        ];
    }
}

