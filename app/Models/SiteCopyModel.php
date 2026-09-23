<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteCopyModel extends Model
{
    protected $table = 'site_copy';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'hero_eyebrow',
        'hero_headline',
        'hero_subtitle',
        'hero_cta_primary',
        'hero_cta_secondary',
        'portfolio_title',
        'portfolio_subtitle',
        'pricing_title',
        'pricing_subtitle',
        'consultation_title',
        'consultation_desc',
        'consultation_button',
        'custom_package_title',
        'custom_package_headline',
        'custom_package_desc',
        'custom_package_button',
        'philosophy_quote_1',
        'philosophy_quote_2',
        'marquee_title',
        'marquee_speed',
        'marquee_logo_height',
        'marquee_logo_spacing',
        'marquee_logo_scale',
        'marquee_logo_max_width',
        'site_logo',
        'profile_video',
    ];
    protected $useTimestamps = true;
    protected $updatedField  = 'updated_at';

    public function getCopy(): array
    {
        if (! is_mysql_alive()) {
            return $this->getDefaultCopy();
        }

        try {
            $row = $this->first();
            if ($row) {
                return (array) $row;
            }
        } catch (\Throwable $e) {
            log_message('error', 'SiteCopyModel error: ' . $e->getMessage());
        }

        return $this->getDefaultCopy();
    }

    public function getDefaultCopy(): array
    {
        return [
            'id' => 1,
            'hero_eyebrow' => 'SOLVE TECHNOLOGY AGENCY',
            'hero_headline' => 'Mengubah Tantangan Bisnis Menjadi Solusi Digital.',
            'hero_subtitle' => 'Banyak bisnis terhambat oleh proses manual, informasi yang tidak terstruktur, dan kurangnya integrasi. SOLVETA hadir untuk menyederhanakan masalah kompleks melalui solusi digital dan otomasi yang efisien.',
            'hero_cta_primary' => 'Pesan Sekarang',
            'hero_cta_secondary' => 'Pelajari Selengkapnya',
            'portfolio_title' => 'Portofolio Proyek Website Yang Telah Kami Bangun',
            'portfolio_subtitle' => 'Koleksi karya digital terbaik yang memadukan desain visual kelas dunia dengan performa teknologi tanpa kompromi.',
            'pricing_title' => 'PILIHAN PAKET LAYANAN WEBSITE',
            'pricing_subtitle' => 'Solusi website lengkap dari profil pribadi hingga platform enterprise, transparan tanpa biaya tersembunyi.',
            'consultation_title' => 'TIDAK TAHU HARUS MULAI DARI MANA?',
            'consultation_desc' => 'Konsultasikan masalah bisnis Anda secara gratis. Kami akan merekomendasikan langkah paling efisien untuk memulainya.',
            'consultation_button' => 'Konsultasikan Kebutuhan Anda',
            'custom_package_title' => 'LAYANAN KHUSUS & ENTERPRISE',
            'custom_package_headline' => 'Menerima Layanan Paket Custom Website',
            'custom_package_desc' => 'Solusi website tanpa batasan halaman dengan kustomisasi fitur penuh, integrasi sistem, dan penyesuaian khusus. Biaya investasi fleksibel dan transparan mengikuti konsep dan spesifikasi website yang ingin Anda bangun.',
            'custom_package_button' => 'Konsultasikan Paket Custom',
            'philosophy_quote_1' => 'Bukan sekadar membangun teknologi.',
            'philosophy_quote_2' => 'Kami membangun solusi.',
            'marquee_title' => 'DIPERCAYA OLEH BERBAGAI BISNIS & INSTITUSI BERKEMBANG',
            'marquee_speed' => 35,
            'marquee_logo_height' => 46,
            'marquee_logo_spacing' => 36,
            'marquee_logo_scale' => 100,
            'marquee_logo_max_width' => 240,
            'site_logo' => '/solveta-logo.png',
            'profile_video' => '/videos/profile.mp4',
        ];
    }
}
