<?php

namespace App\Models;

use CodeIgniter\Model;

class PricingModel extends Model
{
    protected $table = 'pricing_tiers';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'id',
        'name',
        'price_prefix',
        'price',
        'price_badge',
        'renewal_price',
        'active_period',
        'delivery_time',
        'popular',
        'popular_label',
        'features_json',
        'checklist_json',
        'domain_addons_json',
        'email_addons_json',
        'revision_rules_json',
        'custom_note',
        'suitability',
        'button_label',
        'button_variant',
        'wa_message',
        'sort_order',
    ];

    public function getTiers(): array
    {
        try {
            $rows = $this->orderBy('sort_order', 'ASC')->findAll();
            if (!empty($rows)) {
                $results = [];
                foreach ($rows as $row) {
                    $item = (array) $row;
                    $item['features'] = !empty($item['features_json']) ? json_decode($item['features_json'], true) : [];
                    $item['checklist'] = !empty($item['checklist_json']) ? json_decode($item['checklist_json'], true) : [];
                    $item['domain_addons'] = !empty($item['domain_addons_json']) ? json_decode($item['domain_addons_json'], true) : [];
                    $item['email_addons'] = !empty($item['email_addons_json']) ? json_decode($item['email_addons_json'], true) : [];
                    $item['revision_rules'] = !empty($item['revision_rules_json']) ? json_decode($item['revision_rules_json'], true) : [];
                    $results[] = $item;
                }
                return $results;
            }
        } catch (\Throwable $e) {
            log_message('error', 'PricingModel error: ' . $e->getMessage());
        }

        // Default Fallback
        return [
            [
                'id' => 'basic',
                'name' => 'BASIC',
                'price_prefix' => null,
                'price' => 'Rp 299K',
                'price_badge' => 'Paling Hemat',
                'renewal_price' => 'Rp 199.000 / tahun',
                'active_period' => '1 Tahun',
                'delivery_time' => '2-3 Hari Kerja',
                'popular' => false,
                'popular_label' => '',
                'features' => ['Landing Page 1 Halaman (Single-Page)', 'Desain Responsif Mobile & Desktop', 'Tombol WhatsApp Langsung Terhubung', 'Free Domain .my.id (1 Tahun)', 'SSL Security & Cloud Server'],
                'checklist' => [
                    ['text' => 'Landing page 1 halaman panjang', 'included' => true],
                    ['text' => 'Domain .my.id 1 tahun', 'included' => true],
                    ['text' => 'Hosting Cloud SSD 1 tahun', 'included' => true],
                    ['text' => 'Tombol Chat WhatsApp', 'included' => true],
                    ['text' => 'Multi-halaman navigasi', 'included' => false],
                    ['text' => 'Email bisnis nama domain', 'included' => false],
                ],
                'domain_addons' => [['name' => '.com', 'price' => '+Rp 150.000'], ['name' => '.id', 'price' => '+Rp 200.000']],
                'email_addons' => [['name' => 'Email Bisnis 1 Akun', 'price' => '+Rp 50.000/thn']],
                'revision_rules' => ['light' => 'Maksimal 2x revisi teks & foto minor', 'heavy' => 'Revisi layout besar dikenakan biaya tambahan'],
                'custom_note' => 'Cocok bagi pelaku usaha baru yang ingin memiliki identitas digital cepat tanpa modal besar.',
                'suitability' => 'Freelancer, Konsultan, Usaha Jasa Baru yang butuh online cepat.',
                'button_label' => 'Pilih Basic',
                'button_variant' => 'outline',
                'wa_message' => 'Halo SOLVETA, saya tertarik dengan paket Basic Rp299K. Mohon info langkah pengerjaannya.',
                'sort_order' => 1
            ],
            [
                'id' => 'standard',
                'name' => 'STANDARD',
                'price_prefix' => null,
                'price' => 'Rp 549K',
                'price_badge' => 'Best Seller',
                'renewal_price' => 'Rp 299.000 / tahun',
                'active_period' => '1 Tahun',
                'delivery_time' => '3-5 Hari Kerja',
                'popular' => true,
                'popular_label' => 'Paling Populer',
                'features' => ['Website Multi-Halaman (Home, About, Services, Contact)', 'Desain Profesional & Responsif', 'Integrasi Google Maps & Media Sosial', 'Free Domain .com (1 Tahun)', 'SSL Security & Cloud Hosting Cepat'],
                'checklist' => [
                    ['text' => 'Hingga 5 Halaman Konten', 'included' => true],
                    ['text' => 'Free Domain .com (1 Tahun)', 'included' => true],
                    ['text' => 'Hosting Cepat SSD NVMe', 'included' => true],
                    ['text' => 'Integrasi Google Maps & Medsos', 'included' => true],
                    ['text' => 'SEO On-Page Dasar', 'included' => true],
                    ['text' => 'Fitur Katalog Produk Dinamis', 'included' => false],
                ],
                'domain_addons' => [['name' => '.id (Indonesia)', 'price' => '+Rp 100.000']],
                'email_addons' => [['name' => 'Email Bisnis (halo@namabisnis.com)', 'price' => '+Rp 75.000/thn']],
                'revision_rules' => ['light' => 'Maksimal 3x revisi konten & layout', 'heavy' => 'Perubahan struktur total di luar brief dikenakan biaya'],
                'custom_note' => 'Paket paling direkomendasikan untuk membangun kredibilitas dan kepercayaan calon klien di era digital.',
                'suitability' => 'UMKM, Startup, Klinik, atau Agensi yang butuh kredibilitas tinggi.',
                'button_label' => 'Pilih Standard',
                'button_variant' => 'red',
                'wa_message' => 'Halo SOLVETA, saya tertarik dengan paket Standard Rp549K. Mohon bantu konsultasi konsep websitenya.',
                'sort_order' => 2
            ],
            [
                'id' => 'premium',
                'name' => 'PREMIUM',
                'price_prefix' => null,
                'price' => 'Rp 749K',
                'price_badge' => 'Lengkap & Power',
                'renewal_price' => 'Rp 399.000 / tahun',
                'active_period' => '1 Tahun',
                'delivery_time' => '5-7 Hari Kerja',
                'popular' => false,
                'popular_label' => '',
                'features' => ['Katalog Produk / Portofolio Lengkap', 'Fitur Pencarian & Filter Kategori', 'Form Order terhubung ke WhatsApp Otomatis', 'Free Domain .com (1 Tahun)', 'Gratis 1 Akun Email Bisnis Profesional'],
                'checklist' => [
                    ['text' => 'Hingga 10 Halaman / Katalog Produk', 'included' => true],
                    ['text' => 'Pencarian & Filter Interaktif', 'included' => true],
                    ['text' => 'Checkout / Order via WhatsApp Otomatis', 'included' => true],
                    ['text' => 'Free Domain .com & SSL', 'included' => true],
                    ['text' => '1 Akun Email Bisnis Resmi', 'included' => true],
                    ['text' => 'Sistem Database Kompleks', 'included' => false],
                ],
                'domain_addons' => [['name' => '.co.id (Butuh Legalitas)', 'price' => '+Rp 150.000']],
                'email_addons' => [['name' => 'Tambahan Email Bisnis', 'price' => '+Rp 50.000/akun']],
                'revision_rules' => ['light' => 'Maksimal 4x revisi materi', 'heavy' => 'Revisi fitur sistem tambahan dihitung add-on'],
                'custom_note' => 'Solusi terbaik bagi penjual produk fisik, katalog arsitektur, dan bisnis retail online.',
                'suitability' => 'Toko Online (WhatsApp Based), Katalog Properti, Dealer Kendaraan.',
                'button_label' => 'Pilih Premium',
                'button_variant' => 'outline',
                'wa_message' => 'Halo SOLVETA, saya tertarik dengan paket Premium Rp749K. Bagaimana proses pengerjaan katalog produknya?',
                'sort_order' => 3
            ],
            [
                'id' => 'custom',
                'name' => 'CUSTOM',
                'price_prefix' => 'Mulai',
                'price' => 'Rp 1,5 Juta',
                'price_badge' => 'Enterprise Grade',
                'renewal_price' => 'Sesuai Kapasitas Cloud Server',
                'active_period' => 'Fleksibel',
                'delivery_time' => '1-3 Minggu Kerja',
                'popular' => false,
                'popular_label' => '',
                'features' => ['Sistem Database Custom (Gudang, Karyawan, Kasir)', 'Dashboard Admin & Laporan Otomatis', 'Integrasi API Pihak Ketiga & Notifikasi WA Gateway', 'Arsitektur Keamanan Tingkat Lanjut & High Performance'],
                'checklist' => [
                    ['text' => 'Arsitektur Database Terdedikasi', 'included' => true],
                    ['text' => 'Dashboard Manajemen & Laporan', 'included' => true],
                    ['text' => 'Sistem Role & Multi-User Akses', 'included' => true],
                    ['text' => 'Integrasi WhatsApp API Gateway', 'included' => true],
                    ['text' => 'Maintenance & Backup Berkala', 'included' => true],
                    ['text' => 'Support Teknis Prioritas', 'included' => true],
                ],
                'domain_addons' => [['name' => 'Domain Apapun (.com / .id / .co.id)', 'price' => 'Termasuk']],
                'email_addons' => [['name' => 'Email Bisnis Unlimited', 'price' => 'Termasuk']],
                'revision_rules' => ['light' => 'Garansi bug & maintenance selama 3 bulan', 'heavy' => 'Fitur baru modul tambahan dihitung change-request'],
                'custom_note' => 'Sistem dirancang khusus sesuai alur operasional dan tantangan spesifik bisnis Anda.',
                'suitability' => 'Perusahaan dengan kebutuhan operasional spesifik, Manajemen Stok, Sistem Absensi, ERP.',
                'button_label' => 'Hubungi Kami',
                'button_variant' => 'outline',
                'wa_message' => 'Halo SOLVETA, saya ingin mendiskusikan kebutuhan Custom Website & Sistem Khusus untuk bisnis kami.',
                'sort_order' => 4
            ]
        ];
    }
}
