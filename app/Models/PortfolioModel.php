<?php

namespace App\Models;

use CodeIgniter\Model;

class PortfolioModel extends Model
{
    protected $table = 'portfolio_items';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'id',
        'title',
        'category',
        'image_url',
        'description',
        'tags_json',
        'live_url',
        'sort_order',
    ];
    protected $useTimestamps = false;

    public function getItems(): array
    {
        if (! is_mysql_alive()) {
            return $this->getDefaultItems();
        }

        try {
            $rows = $this->orderBy('sort_order', 'ASC')->findAll();
            if (!empty($rows)) {
                $results = [];
                foreach ($rows as $row) {
                    $item = (array) $row;
                    $item['tags'] = !empty($item['tags_json']) ? json_decode($item['tags_json'], true) : [];
                    $results[] = $item;
                }
                return $results;
            }
        } catch (\Throwable $e) {
            log_message('error', 'PortfolioModel error: ' . $e->getMessage());
        }

        return $this->getDefaultItems();
    }

    public function getDefaultItems(): array
    {
        return [
            [
                'id' => 'port-1',
                'title' => 'Cuango — Premium Fashion & Apparel Showcase',
                'category' => 'E-Commerce',
                'image_url' => '/images/portfolio/cuango.jpg',
                'description' => 'Platform showcase brand fashion modern dengan katalog interaktif, filter varian ukuran & warna, serta integrasi tombol direct checkout ke WhatsApp.',
                'tags' => ['Fashion', 'Catalog', 'WhatsApp Checkout'],
                'live_url' => 'https://www.solveta.asia',
                'sort_order' => 1
            ],
            [
                'id' => 'port-2',
                'title' => 'Haltea — Healthy Herbal Tea & Lifestyle Brand',
                'category' => 'Website & Presence',
                'image_url' => '/images/portfolio/haltea.jpg',
                'description' => 'Landing page estetis dan responsif untuk produk teh herbal premium dengan visual storytelling, testimoni pelanggan, dan kalkulator estimasi pembelian.',
                'tags' => ['Branding', 'Landing Page', 'Health & Wellness'],
                'live_url' => 'https://www.solveta.asia',
                'sort_order' => 2
            ],
            [
                'id' => 'port-3',
                'title' => 'Konservasi Akuatik — Portal Edukasi & Donasi Lingkungan',
                'category' => 'Corporate Profile',
                'image_url' => '/images/portfolio/konservasi-akuatik.jpg',
                'description' => 'Website resmi lembaga konservasi kelautan dengan sistem peta zona terumbu karang, publikasi riset berkala, dan formulir pendaftaran relawan terpadu.',
                'tags' => ['NGO', 'Conservation', 'Interactive Maps'],
                'live_url' => 'https://www.solveta.asia',
                'sort_order' => 3
            ],
            [
                'id' => 'port-4',
                'title' => 'Squabumin — Suplemen Kesehatan & Farmasi Herbal',
                'category' => 'Website & Presence',
                'image_url' => '/images/portfolio/squabumin.jpg',
                'description' => 'Company profile dan product landing page farmasi herbal berstandar BPOM dengan fitur verifikasi keaslian produk dan integrasi distribusi klinik.',
                'tags' => ['Healthcare', 'Pharma', 'Product Verification'],
                'live_url' => 'https://www.solveta.asia',
                'sort_order' => 4
            ],
            [
                'id' => 'port-5',
                'title' => 'Tidur Nyenyak — Bedding & Home Living Commerce',
                'category' => 'E-Commerce',
                'image_url' => '/images/portfolio/tidurnyenyak.jpg',
                'description' => 'E-commerce perlengkapan tidur mewah dengan navigasi multi-kategori, sistem ulasan bintang pelanggan, dan perhitungan ongkir otomatis.',
                'tags' => ['Home Living', 'E-Commerce', 'Customer Reviews'],
                'live_url' => 'https://www.solveta.asia',
                'sort_order' => 5
            ],
            [
                'id' => 'port-6',
                'title' => 'VisualGenix — Digital Creative Studio & Media Agency',
                'category' => 'Corporate Profile',
                'image_url' => '/images/portfolio/visualgenix.jpg',
                'description' => 'Portofolio agensi multimedia modern dengan transisi sinematik, video hero showcase, dan portal penerimaan brief proyek kreatif otomatis.',
                'tags' => ['Creative Agency', 'Portfolio Showcase', 'Dark Modern'],
                'live_url' => 'https://www.solveta.asia',
                'sort_order' => 6
            ],
        ];
    }
}
