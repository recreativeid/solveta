<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfitModel extends Model
{
    protected $table = 'service_profit_analyses';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'id',
        'service_name',
        'tier_id',
        'selling_price',
        'labor_fee',
        'estimated_monthly_orders',
        'costs_json',
        'notes',
    ];
    protected $useTimestamps = true;
    protected $updatedField  = 'updated_at';

    public function getAnalyses(): array
    {
        try {
            $rows = $this->findAll();
            if (!empty($rows)) {
                $results = [];
                foreach ($rows as $row) {
                    $item = (array) $row;
                    $item['costs'] = !empty($item['costs_json']) ? json_decode($item['costs_json'], true) : [];
                    $results[] = $item;
                }
                return $results;
            }
        } catch (\Throwable $e) {
            log_message('error', 'ProfitModel error: ' . $e->getMessage());
        }

        return [
            [
                'id' => 'spa-basic',
                'service_name' => 'Paket Basic — 299K',
                'tier_id' => 'basic',
                'selling_price' => 299000,
                'labor_fee' => 100000,
                'estimated_monthly_orders' => 5,
                'costs' => [
                    ['id' => 'c1', 'name' => 'Domain .my.id (1 Tahun)', 'amount' => 15000, 'category' => 'infrastruktur'],
                    ['id' => 'c2', 'name' => 'Cloud Hosting SSD Allocation', 'amount' => 25000, 'category' => 'infrastruktur']
                ],
                'notes' => 'Margin laba tinggi dengan waktu eksekusi singkat 1-2 hari.'
            ],
            [
                'id' => 'spa-standard',
                'service_name' => 'Paket Standard — 549K',
                'tier_id' => 'standard',
                'selling_price' => 549000,
                'labor_fee' => 200000,
                'estimated_monthly_orders' => 8,
                'costs' => [
                    ['id' => 'c1', 'name' => 'Domain .com (1 Tahun)', 'amount' => 135000, 'category' => 'infrastruktur'],
                    ['id' => 'c2', 'name' => 'Cloud Hosting NVMe Allocation', 'amount' => 35000, 'category' => 'infrastruktur'],
                    ['id' => 'c3', 'name' => 'Template License & Assets', 'amount' => 20000, 'category' => 'lisensi_tools']
                ],
                'notes' => 'Paket terlaris dengan omset stabil dan profil klien kredibel.'
            ],
            [
                'id' => 'spa-premium',
                'service_name' => 'Paket Premium — 749K',
                'tier_id' => 'premium',
                'selling_price' => 749000,
                'labor_fee' => 300000,
                'estimated_monthly_orders' => 4,
                'costs' => [
                    ['id' => 'c1', 'name' => 'Domain .com (1 Tahun)', 'amount' => 135000, 'category' => 'infrastruktur'],
                    ['id' => 'c2', 'name' => 'Cloud Hosting NVMe High RAM', 'amount' => 50000, 'category' => 'infrastruktur'],
                    ['id' => 'c3', 'name' => 'Email Server Setup', 'amount' => 25000, 'category' => 'operasional']
                ],
                'notes' => 'Paket katalog produk toko online.'
            ]
        ];
    }
}
