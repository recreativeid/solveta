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
        'portfolio_title',
        'portfolio_subtitle',
        'consultation_title',
        'consultation_desc',
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
        try {
            $row = $this->first();
            if ($row) {
                return (array) $row;
            }
        } catch (\Throwable $e) {
            log_message('error', 'SiteCopyModel error: ' . $e->getMessage());
        }

        return [
            'id' => 1,
            'hero_eyebrow' => 'SOLVE TECHNOLOGY AGENCY',
            'hero_headline' => 'Mengubah Tantangan Bisnis Menjadi Solusi Digital.',
            'hero_subtitle' => 'Banyak bisnis terhambat oleh proses manual, informasi yang tidak terstruktur, dan kurangnya integrasi. SOLVETA hadir untuk menyederhanakan masalah kompleks melalui solusi digital dan otomasi yang efisien.',
            'portfolio_title' => 'Portofolio Proyek Website Yang Telah Kami Bangun',
            'portfolio_subtitle' => 'Koleksi karya digital terbaik yang memadukan desain visual kelas dunia dengan performa teknologi tanpa kompromi.',
            'consultation_title' => 'TIDAK TAHU HARUS MULAI DARI MANA?',
            'consultation_desc' => 'Konsultasikan masalah bisnis Anda secara gratis. Kami akan merekomendasikan langkah paling efisien untuk memulainya.',
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
