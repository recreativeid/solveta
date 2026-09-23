<?php

namespace App\Models;

use CodeIgniter\Model;

class AddonModel extends Model
{
    protected $table = 'addon_services';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'id',
        'name',
        'category',
        'base_price',
        'third_party_cost',
        'price_description',
        'description',
        'sort_order',
    ];

    public function getAddons(): array
    {
        if (! is_mysql_alive()) {
            return $this->getDefaultAddons();
        }

        try {
            $rows = $this->orderBy('sort_order', 'ASC')->findAll();
            if (!empty($rows)) {
                return $rows;
            }
        } catch (\Throwable $e) {
            log_message('error', 'AddonModel error: ' . $e->getMessage());
        }

        return $this->getDefaultAddons();
    }

    public function saveAddon(array $data): bool
    {
        if (empty($data['id'])) {
            $data['id'] = 'addon-' . time() . '-' . rand(100, 999);
        }

        if (!isset($data['sort_order']) || $data['sort_order'] === '') {
            $max = $this->selectMax('sort_order')->first();
            $data['sort_order'] = ($max['sort_order'] ?? 0) + 1;
        }

        return (bool) $this->save($data);
    }

    public function moveAddon(string $id, string $direction): bool
    {
        $all = $this->orderBy('sort_order', 'ASC')->findAll();
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

        $current = $all[$targetIndex];
        $neighbor = $all[$swapIndex];

        $currentSort = $current['sort_order'];
        $neighborSort = $neighbor['sort_order'];

        if ($currentSort == $neighborSort) {
            $currentSort = $targetIndex + 1;
            $neighborSort = $swapIndex + 1;
        }

        $this->update($current['id'], ['sort_order' => $neighborSort]);
        $this->update($neighbor['id'], ['sort_order' => $currentSort]);

        return true;
    }

    public function getDefaultAddons(): array
    {
        return [
            [
                'id' => 'addon-1',
                'name' => 'Tambah 1 Halaman',
                'category' => 'page',
                'base_price' => 50000,
                'price_description' => 'Rp 50.000 / halaman',
                'description' => 'Penambahan halaman ekstra jika kebutuhan halaman melebihi kuota paket standar.',
                'sort_order' => 1
            ],
            [
                'id' => 'addon-2',
                'name' => 'Biaya Revisi Ringan (di luar brief awal)',
                'category' => 'revision',
                'base_price' => 30000,
                'price_description' => 'Rp 30.000 / revisi',
                'description' => 'Perubahan minor seperti ganti logo, icon, warna, teks, gambar, atau tata letak kecil.',
                'sort_order' => 2
            ],
            [
                'id' => 'addon-3',
                'name' => 'Biaya Revisi Berat (di luar brief awal)',
                'category' => 'revision',
                'base_price' => 50000,
                'price_description' => 'Rp 50.000 / revisi',
                'description' => 'Perubahan besar seperti merombak tata letak halaman, menambah halaman baru, atau merubah alur website.',
                'sort_order' => 3
            ],
            [
                'id' => 'addon-4',
                'name' => 'Biaya Custom Domain',
                'category' => 'domain',
                'base_price' => 0,
                'price_description' => 'Mengikuti domain yg dibutuhkan',
                'description' => 'Pendaftaran ekstensi domain kustom (.com, .id, .co.id, .sch.id, dsb.) sesuai harga registrar resmi.',
                'sort_order' => 4
            ],
            [
                'id' => 'addon-5',
                'name' => 'Akun Email Bisnis',
                'category' => 'email',
                'base_price' => 50000,
                'price_description' => 'Rp 50.000 / akun',
                'description' => 'Setup akun email profesional dengan nama domain sendiri (contoh: nama@domain.com).',
                'sort_order' => 5
            ],
            [
                'id' => 'addon-6',
                'name' => 'Integrasi WhatsApp API / Payment Gateway',
                'category' => 'api',
                'base_price' => 150000,
                'price_description' => 'Mulai Rp 150.000',
                'description' => 'Integrasi sistem pembayaran otomatis, WhatsApp Business API, atau API pihak ketiga.',
                'sort_order' => 6
            ]
        ];
    }
}
