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
        'country',
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

    public function getTiers(string $country = 'id'): array
    {
        if (! is_mysql_alive()) {
            return $this->getDefaultTiers($country);
        }

        try {
            $hasCountryCol = false;
            try {
                $cols = $this->db->getFieldNames($this->table);
                $hasCountryCol = in_array('country', $cols);
            } catch (\Throwable $e) {}

            if ($hasCountryCol) {
                $rows = $this->where('country', $country)
                             ->whereNotIn('id', ['premium'])
                             ->orderBy('sort_order', 'ASC')
                             ->findAll();
            } else {
                if ($country === 'my') {
                    $rows = $this->like('id', '_my')->orderBy('sort_order', 'ASC')->findAll();
                } else {
                    $rows = $this->notLike('id', '_my')
                                 ->whereNotIn('id', ['premium'])
                                 ->orderBy('sort_order', 'ASC')
                                 ->findAll();
                }
            }

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
        return $this->getDefaultTiers($country);
    }

    public function moveTier(string $id, string $direction): bool
    {
        $tier = $this->find($id);
        $country = 'id';
        if ($tier) {
            $country = !empty($tier['country']) ? $tier['country'] : (strpos($id, '_my') !== false ? 'my' : 'id');
        }

        $all = $this->getTiers($country);
        $targetIndex = null;

        foreach ($all as $i => $item) {
            if ($item['id'] === $id) {
                $targetIndex = $i;
                break;
            }
        }

        if ($targetIndex === null) {
            return false;
        }

        $swapIndex = ($direction === 'left' || $direction === 'up') ? $targetIndex - 1 : $targetIndex + 1;

        if ($swapIndex < 0 || $swapIndex >= count($all)) {
            return false;
        }

        // Normalize sequential sort_order
        foreach ($all as $idx => $t) {
            $this->update($t['id'], ['sort_order' => $idx + 1]);
            $all[$idx]['sort_order'] = $idx + 1;
        }

        $current = $all[$targetIndex];
        $neighbor = $all[$swapIndex];

        $this->update($current['id'], ['sort_order' => $neighbor['sort_order']]);
        $this->update($neighbor['id'], ['sort_order' => $current['sort_order']]);

        return true;
    }

    public function getDefaultTiers(string $country = 'id'): array
    {
        if ($country === 'my') {
            return [
                [
                    'id' => 'basic_my',
                    'country' => 'my',
                    'name' => 'STARTER',
                    'price_prefix' => null,
                    'price' => 'RM199',
                    'price_badge' => 'RM199',
                    'renewal_price' => 'RM149/tahun*',
                    'active_period' => '1 Tahun',
                    'delivery_time' => '1–2 hari bekerja',
                    'popular' => false,
                    'popular_label' => '',
                    'features' => [
                        'Maksimum 1 halaman',
                        'Tambahan halaman RM50/halaman',
                        '2× semakan ringan (tidak mengubah brief asal)',
                        'Domain percuma — pilihan .my, .site, .store, .xyz, .space, .fund, .shop dan lain-lain',
                        'Hosting percuma',
                        'Akses dashboard',
                        'Website mesra telefon bimbit',
                        'SSL Security',
                        'SEO Friendly',
                        'Penulisan kandungan website percuma',
                        'Konsultasi percuma',
                        'Akses & harga khas untuk ahli',
                        'Kemudahan khas untuk rakan reseller',
                        'Siap dalam 1–2 hari bekerja'
                    ],
                    'checklist' => [
                        ['text' => 'Maksimum 1 halaman', 'included' => true],
                        ['text' => 'Tambahan halaman RM50/halaman', 'included' => true],
                        ['text' => '2× semakan ringan (tidak mengubah brief asal)', 'included' => true],
                        ['text' => 'Domain percuma (.my, .site, .store, .xyz, .space, .fund, .shop dll)', 'included' => true],
                        ['text' => 'Hosting percuma & Akses dashboard', 'included' => true],
                        ['text' => 'Website mesra telefon bimbit', 'included' => true],
                        ['text' => 'SSL Security', 'included' => true],
                        ['text' => 'SEO Friendly', 'included' => true],
                        ['text' => 'Penulisan kandungan website percuma', 'included' => true],
                        ['text' => 'Konsultasi percuma', 'included' => true],
                        ['text' => 'Akses & harga khas untuk ahli', 'included' => true],
                        ['text' => 'Kemudahan khas untuk rakan reseller', 'included' => true],
                        ['text' => 'Integrasi API / aplikasi', 'included' => false],
                    ],
                    'domain_addons' => [],
                    'email_addons' => [['name' => '1 Akaun Emel Bisnes', 'price' => 'RM30'], ['name' => '5 Akaun Emel Bisnes', 'price' => 'RM90']],
                    'revision_rules' => ['light' => '2× semakan ringan (tidak mengubah brief asal)', 'heavy' => 'Perubahan struktur berbayar', 'extraPage' => 'RM50 / halaman'],
                    'custom_note' => 'Sesuai untuk perniagaan kecil, personal brand & individu.',
                    'suitability' => 'Sesuai untuk perniagaan kecil, personal brand & individu.',
                    'button_label' => 'TEMPAH PAKEJ STARTER (RM199)',
                    'button_variant' => 'outline',
                    'wa_message' => 'Salam SOLVETA, saya berminat untuk menempah Pakej STARTER RM199.',
                    'sort_order' => 1
                ],
                [
                    'id' => 'business_my',
                    'country' => 'my',
                    'name' => 'BUSINESS',
                    'price_prefix' => null,
                    'price' => 'RM399',
                    'price_badge' => 'RM399',
                    'renewal_price' => 'RM249/tahun*',
                    'active_period' => '1 Tahun',
                    'delivery_time' => '3–5 hari bekerja',
                    'popular' => false,
                    'popular_label' => 'Pilihan Terbaik',
                    'features' => [
                        'Maksimum 4 halaman (3 halaman utama, 1 halaman dashboard)',
                        '2× semakan ringan (tidak mengubah brief asal)',
                        'Domain percuma — .com, .my, .id, .site, .cloud, .online, .shop, .blog, .store, .org, .digital dan lain-lain',
                        'Hosting percuma',
                        'Akses dashboard',
                        'Website mesra telefon bimbit',
                        'SSL Security',
                        'SEO Basic',
                        'Jaminan penuh',
                        'Penulisan kandungan website percuma',
                        'Konsultasi percuma',
                        'Akses & harga khas untuk ahli',
                        'Kemudahan khas untuk rakan reseller',
                        'Siap dalam 3–5 hari bekerja'
                    ],
                    'checklist' => [
                        ['text' => 'Maksimum 4 halaman (3 utama + 1 dashboard)', 'included' => true],
                        ['text' => '2× semakan ringan (tidak mengubah brief asal)', 'included' => true],
                        ['text' => 'Domain percuma (.com, .my, .id, .site, .cloud, .online dll)', 'included' => true],
                        ['text' => 'Hosting percuma & Akses dashboard', 'included' => true],
                        ['text' => 'Website mesra telefon bimbit', 'included' => true],
                        ['text' => 'SSL Security', 'included' => true],
                        ['text' => 'SEO Basic', 'included' => true],
                        ['text' => 'Jaminan penuh', 'included' => true],
                        ['text' => 'Penulisan kandungan website percuma', 'included' => true],
                        ['text' => 'Konsultasi percuma', 'included' => true],
                        ['text' => 'Akses & harga khas untuk ahli', 'included' => true],
                        ['text' => 'Kemudahan khas untuk rakan reseller', 'included' => true],
                        ['text' => 'Integrasi API / aplikasi', 'included' => false],
                    ],
                    'domain_addons' => [],
                    'email_addons' => [['name' => '1 Akaun Emel Bisnes Rasmi', 'price' => 'Termasuk'], ['name' => 'Tambahan Emel Bisnes', 'price' => 'RM25/akaun']],
                    'revision_rules' => ['light' => '2× semakan ringan (tidak mengubah brief asal)', 'heavy' => 'Perubahan struktur berbayar', 'extraPage' => 'RM50 / halaman'],
                    'custom_note' => 'Pilihan terbaik untuk perniagaan yang mahu tampil lebih profesional.',
                    'suitability' => 'Pilihan terbaik untuk perniagaan yang mahu tampil lebih profesional.',
                    'button_label' => 'TEMPAH PAKEJ BUSINESS (RM399)',
                    'button_variant' => 'outline',
                    'wa_message' => 'Salam SOLVETA, saya berminat untuk menempah Pakej BUSINESS RM399.',
                    'sort_order' => 2
                ],
                [
                    'id' => 'premium_my',
                    'country' => 'my',
                    'name' => 'PREMIUM',
                    'price_prefix' => null,
                    'price' => 'RM699',
                    'price_badge' => 'RM699',
                    'renewal_price' => 'RM349/tahun*',
                    'active_period' => '1 Tahun',
                    'delivery_time' => '5–7 hari bekerja',
                    'popular' => false,
                    'popular_label' => 'Paling Lengkap',
                    'features' => [
                        'Maksimum 7 halaman (6 halaman utama, 1 halaman dashboard)',
                        '2× semakan ringan (tidak mengubah brief asal)',
                        'Domain premium percuma — .store, .org, .net, .digital, .it, .com, .media, .agency, .company dan lain-lain',
                        'Hosting percuma',
                        'Akses dashboard',
                        'Website mesra telefon bimbit',
                        'SEO Friendly',
                        'Jaminan penuh',
                        'Penulisan kandungan website percuma',
                        'Konsultasi percuma',
                        'Akses & harga khas untuk ahli',
                        'Kemudahan khas untuk rakan reseller',
                        'Siap dalam 5–7 hari bekerja'
                    ],
                    'checklist' => [
                        ['text' => 'Maksimum 7 halaman (6 utama + 1 dashboard)', 'included' => true],
                        ['text' => '2× semakan ringan (tidak mengubah brief asal)', 'included' => true],
                        ['text' => 'Domain premium percuma (.store, .org, .net, .com dll)', 'included' => true],
                        ['text' => 'Hosting percuma & Akses dashboard', 'included' => true],
                        ['text' => 'Website mesra telefon bimbit', 'included' => true],
                        ['text' => 'SEO Friendly', 'included' => true],
                        ['text' => 'Jaminan penuh', 'included' => true],
                        ['text' => 'Penulisan kandungan website percuma', 'included' => true],
                        ['text' => 'Konsultasi percuma', 'included' => true],
                        ['text' => 'Akses & harga khas untuk ahli', 'included' => true],
                        ['text' => 'Kemudahan khas untuk rakan reseller', 'included' => true],
                        ['text' => 'Integrasi API / aplikasi', 'included' => false],
                    ],
                    'domain_addons' => [],
                    'email_addons' => [['name' => '2 Akaun Emel Bisnes Rasmi', 'price' => 'Termasuk'], ['name' => 'Tambahan Emel Bisnes', 'price' => 'RM25/akaun']],
                    'revision_rules' => ['light' => '2× semakan ringan (tidak mengubah brief asal)', 'heavy' => 'Perubahan struktur berbayar', 'extraPage' => 'RM50 / halaman'],
                    'custom_note' => 'Untuk perniagaan yang memerlukan website lebih lengkap & profesional.',
                    'suitability' => 'Untuk perniagaan yang memerlukan website lebih lengkap & profesional.',
                    'button_label' => 'TEMPAH PAKEJ PREMIUM (RM699)',
                    'button_variant' => 'outline',
                    'wa_message' => 'Salam SOLVETA, saya berminat untuk menempah Pakej PREMIUM RM699.',
                    'sort_order' => 3
                ],
                [
                    'id' => 'platinum_my',
                    'country' => 'my',
                    'name' => 'PLATINUM',
                    'price_prefix' => null,
                    'price' => 'RM1,499',
                    'price_badge' => 'RM1,499',
                    'renewal_price' => 'Mengikut pakej server',
                    'active_period' => '1 Tahun',
                    'delivery_time' => '7–9 hari bekerja',
                    'popular' => true,
                    'popular_label' => 'Pakej Lengkap',
                    'features' => [
                        'Domain percuma — .my, .com, .co, .dev, dan lain-lain',
                        'Hosting percuma & Perkhidmatan hosting percuma',
                        'Akses dashboard',
                        'Website mesra telefon bimbit',
                        'SEO Friendly',
                        'Jaminan penuh',
                        'Integrasi API / aplikasi',
                        'Penulisan kandungan website percuma',
                        'Perkhidmatan hosting percuma',
                        'SSL Security percuma',
                        'Konsultasi percuma',
                        'Akses & harga khas untuk ahli',
                        'Kemudahan khas untuk rakan reseller',
                        'Siap dalam 7–9 hari bekerja'
                    ],
                    'checklist' => [
                        ['text' => 'Pakej lengkap organisasi & projek profesional', 'included' => true],
                        ['text' => 'Domain percuma (.my, .com, .co, .dev, dan lain-lain)', 'included' => true],
                        ['text' => 'Hosting percuma & Perkhidmatan hosting percuma', 'included' => true],
                        ['text' => 'Akses dashboard', 'included' => true],
                        ['text' => 'Website mesra telefon bimbit', 'included' => true],
                        ['text' => 'SEO Friendly', 'included' => true],
                        ['text' => 'Jaminan penuh', 'included' => true],
                        ['text' => 'Integrasi API / aplikasi', 'included' => true],
                        ['text' => 'Penulisan kandungan website percuma', 'included' => true],
                        ['text' => 'SSL Security percuma', 'included' => true],
                        ['text' => 'Konsultasi percuma', 'included' => true],
                        ['text' => 'Akses & harga khas untuk ahli', 'included' => true],
                        ['text' => 'Kemudahan khas untuk rakan reseller', 'included' => true],
                    ],
                    'domain_addons' => [],
                    'email_addons' => [['name' => 'Emel Bisnes Tanpa Had (Unlimited)', 'price' => 'Termasuk']],
                    'revision_rules' => ['light' => 'Semakan fleksibel semasa pembangunan', 'heavy' => 'Fitur baru modul tambahan dihitung add-on', 'extraPage' => 'Termasuk'],
                    'custom_note' => 'Pakej lengkap untuk perniagaan, organisasi & projek profesional.',
                    'suitability' => 'Pakej lengkap untuk perniagaan, organisasi & projek profesional.',
                    'button_label' => 'TEMPAH PAKEJ PLATINUM (RM1,499)',
                    'button_variant' => 'red',
                    'wa_message' => 'Salam SOLVETA, saya berminat untuk menempah Pakej PLATINUM RM1,499.',
                    'sort_order' => 4
                ]
            ];
        }

        // Indonesian Default Tiers (Versi Sekarang: 3 Paket Resmi)
        return [
            [
                'id' => 'basic',
                'country' => 'id',
                'name' => 'STARTER',
                'price_prefix' => null,
                'price' => 'Rp 249K',
                'price_badge' => '249K',
                'renewal_price' => '199k/tahun*',
                'active_period' => '1 Tahun',
                'delivery_time' => '1-2 Hari',
                'popular' => false,
                'popular_label' => '',
                'features' => ['Maksimal 1 Halaman (tambah Rp 50k/Halaman)', 'Revisi ringan 2x (Tidak berubah dari brief awal)', 'Optimasi Speed (High Perform)', 'Free Domain (.my.id, .site, .store, .xyz, .space, .fund, .shop)', 'Free Hosting (Akses Dashboard, Tanpa login cPanel)', 'Responsive Web (mobile friendly)', 'SSL Security', 'Full Garansi*'],
                'checklist' => [
                    ['text' => 'Maksimal 1 Halaman (tambah Rp 50k/Halaman)', 'included' => true],
                    ['text' => 'Revisi ringan 2x (Tidak berubah dari brief awal)', 'included' => true],
                    ['text' => 'Optimasi Speed (High Perform)', 'included' => true],
                    ['text' => 'Free Domain (my.id .site .cloud .online .shop .blog)', 'included' => true],
                    ['text' => 'Free Hosting (Akses Dashboard, Tanpa login cPanel)', 'included' => true],
                    ['text' => 'Email Bisnis (nama@domain.com)', 'included' => false],
                    ['text' => 'Responsive Web (mobile friendly)', 'included' => true],
                    ['text' => 'SSL Security', 'included' => true],
                    ['text' => 'SEO Basic', 'included' => false],
                    ['text' => 'Google Analytics', 'included' => false],
                    ['text' => 'Full Garansi*', 'included' => true],
                    ['text' => 'Akses API (Integrasi Aplikasi)', 'included' => false],
                ],
                'domain_addons' => [],
                'email_addons' => [['name' => '1 Akun Email Bisnis', 'price' => 'Rp 50.000'], ['name' => '5 Akun Email Bisnis', 'price' => 'Rp 150.000']],
                'revision_rules' => ['light' => 'Rp 30.000 (ganti logo, icon, warna, teks kecil, dsb)', 'heavy' => 'Rp 50.000 (merubah halaman, menambah halaman, atau struktur)', 'extraPage' => 'Rp 50.000 / halaman'],
                'custom_note' => null,
                'suitability' => 'kebutuhan pribadi: landing page, portofolio online, blog pribadi, CV digital, dan halaman profil rintisan.',
                'button_label' => 'PESAN PAKET STARTER (RP 249K)',
                'button_variant' => 'outline',
                'wa_message' => 'Halo CS Zahra & Tim SOLVETA, saya ingin memesan Paket Layanan Website STARTER (Rp 249K).',
                'sort_order' => 1
            ],
            [
                'id' => 'standard',
                'country' => 'id',
                'name' => 'BISNIS',
                'price_prefix' => null,
                'price' => 'Rp 599K',
                'price_badge' => '599K',
                'renewal_price' => '349k/tahun*',
                'active_period' => '1 Tahun',
                'delivery_time' => '3-5 Hari',
                'popular' => false,
                'popular_label' => 'Populer',
                'features' => ['Maksimal 4 Halaman, 3 Halaman Utama 1 Dashboard (tambah Rp 50k/Halaman)', 'Revisi ringan 2x (Tidak berubah dari brief awal)', 'Optimasi Speed (2x lebih cepat)', 'Free Domain (my.id .site .cloud .online .shop .blog .store .org .digital)', 'Free Hosting (Akses Dashboard, Tanpa login cPanel)', '1 Akun Email Bisnis (nama@domain.com) Webmail & SMTP', 'Responsive Web (mobile friendly)', 'SSL Security', 'SEO Basic', 'Full Garansi'],
                'checklist' => [
                    ['text' => 'Maksimal 4 Halaman, 3 Halaman Utama 1 Dashboard (tambah Rp 50k/Halaman)', 'included' => true],
                    ['text' => 'Revisi ringan 2x (Tidak berubah dari brief awal)', 'included' => true],
                    ['text' => 'Optimasi Speed (2x lebih cepat)', 'included' => true],
                    ['text' => 'Free Domain (my.id .site .cloud .online .shop .blog .store .org .digital)', 'included' => true],
                    ['text' => 'Free Hosting (Akses Dashboard, Tanpa login cPanel)', 'included' => true],
                    ['text' => '1 Akun Email Bisnis (nama@domain.com)', 'included' => true],
                    ['text' => 'Responsive Web (mobile friendly)', 'included' => true],
                    ['text' => 'SSL Security', 'included' => true],
                    ['text' => 'SEO Basic', 'included' => true],
                    ['text' => 'Full Garansi', 'included' => true],
                    ['text' => 'Akses API (Integrasi Aplikasi)', 'included' => false],
                ],
                'domain_addons' => [],
                'email_addons' => [],
                'revision_rules' => ['light' => 'Rp 30.000 (ganti logo, icon, warna, teks kecil, dsb)', 'heavy' => 'Rp 50.000 (merubah halaman, menambah halaman, atau struktur)', 'extraPage' => 'Rp 50.000 / halaman'],
                'custom_note' => null,
                'suitability' => 'kebutuhan bisnis berkembang, UKM, CV, PT, kantor profesional, dan profil usaha resmi.',
                'button_label' => 'PESAN PAKET BISNIS (RP 599K)',
                'button_variant' => 'outline',
                'wa_message' => 'Halo CS Zahra & Tim SOLVETA, saya ingin memesan Paket Layanan Website BISNIS (Rp 599K).',
                'sort_order' => 2
            ],
            [
                'id' => 'custom',
                'country' => 'id',
                'name' => 'CUSTOM',
                'price_prefix' => null,
                'price' => 'Menyesuaikan Kebutuhan',
                'price_badge' => 'Sesuai Scope',
                'renewal_price' => 'Mengikuti kompleksitas konsep & permintaan website yang dibutuhkan',
                'active_period' => '1 Tahun',
                'delivery_time' => '7-14 Hari (Fleksibel)',
                'popular' => true,
                'popular_label' => 'Rekomendasi',
                'features' => ['Arsitektur Database & Modul Kustom (Bebas Request)', 'Optimasi Speed (Super Cepat)', 'Free Desain Mockup', 'Free Domain (.id .co.id .tech .dev .com)', 'Free Hosting Cloud Performa Tinggi', 'Unlimited Email Bisnis (nama@domain.com)', 'Responsive Web (mobile friendly)', 'SSL Security', 'SEO Friendly', 'Google Analytics', 'Full Garansi SLA', 'Akses API & Payment Gateway'],
                'checklist' => [
                    ['text' => 'Arsitektur Database & Modul Kustom', 'included' => true],
                    ['text' => 'Optimasi Speed (Super Cepat)', 'included' => true],
                    ['text' => 'Free Desain Mockup', 'included' => true],
                    ['text' => 'Free Domain (.id .co.id .tech .dev .com)', 'included' => true],
                    ['text' => 'Free Hosting Cloud Performa Tinggi', 'included' => true],
                    ['text' => 'Unlimited Email Bisnis (nama@domain.com)', 'included' => true],
                    ['text' => 'Responsive Web (mobile friendly)', 'included' => true],
                    ['text' => 'SSL Security', 'included' => true],
                    ['text' => 'SEO Friendly', 'included' => true],
                    ['text' => 'Google Analytics', 'included' => true],
                    ['text' => 'Full Garansi SLA', 'included' => true],
                    ['text' => 'Akses API (Integrasi aplikasi)', 'included' => true],
                ],
                'domain_addons' => [],
                'email_addons' => [],
                'revision_rules' => ['light' => 'Revisi fleksibel selama development', 'heavy' => 'Fitur baru modul tambahan dihitung add-on', 'extraPage' => 'Fleksibel'],
                'custom_note' => null,
                'suitability' => 'Startup, Bisnis Skala Menengah, CV, PT, Organisasi & Profesional yang membutuhkan modul kompleks, arsitektur database relasional, akses API, serta integrasi sistem tingkat lanjut.',
                'button_label' => 'KONSULTASI PAKET CUSTOM',
                'button_variant' => 'red',
                'wa_message' => 'Halo Lead Engineer & CS Zahra SOLVETA, saya ingin berkonsultasi mengenai Paket Layanan CUSTOM / Kebutuhan Khusus & Enterprise.',
                'sort_order' => 3
            ]
        ];
    }
}
