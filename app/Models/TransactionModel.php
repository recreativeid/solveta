<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'project_transactions';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'id',
        'invoice_number',
        'date',
        'customer_name',
        'phone_number',
        'website_name',
        'website_link',
        'service_price',
        'status',
        'cost_components_json',
        'notes',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getTransactions(): array
    {
        try {
            $rows = $this->orderBy('date', 'DESC')->findAll();
            if (!empty($rows)) {
                $results = [];
                foreach ($rows as $row) {
                    $item = (array) $row;
                    $item['cost_components'] = !empty($item['cost_components_json']) ? json_decode($item['cost_components_json'], true) : [];
                    $results[] = $item;
                }
                return $results;
            }
        } catch (\Throwable $e) {
            log_message('error', 'TransactionModel error: ' . $e->getMessage());
        }

        return [
            [
                'id' => 'tx-1',
                'invoice_number' => 'INV-2026-001',
                'date' => '2026-09-01',
                'customer_name' => 'Bambang Wijaya',
                'phone_number' => '081234567890',
                'website_name' => 'Cuango Fashion Official',
                'website_link' => 'https://cuango.com',
                'service_price' => 749000,
                'status' => 'Terlaksana',
                'cost_components' => [
                    ['id' => 'comp-1', 'name' => 'Pembuatan Website Premium 10 Halaman', 'cost' => 749000, 'note' => 'Termasuk Domain .com & SSL'],
                    ['id' => 'comp-2', 'name' => 'Setup Akun WhatsApp Direct Checkout', 'cost' => 0, 'note' => 'Gratis Bonus']
                ],
                'notes' => 'Pembayaran lunas via transfer BCA.'
            ],
            [
                'id' => 'tx-2',
                'invoice_number' => 'INV-2026-002',
                'date' => '2026-09-15',
                'customer_name' => 'Siti Rahmawati',
                'phone_number' => '085678901234',
                'website_name' => 'Haltea Herbal Wellness',
                'website_link' => 'https://haltea.com',
                'service_price' => 549000,
                'status' => 'Terlaksana',
                'cost_components' => [
                    ['id' => 'comp-1', 'name' => 'Pembuatan Website Standard Multi-Page', 'cost' => 549000, 'note' => 'Termasuk Domain .com']
                ],
                'notes' => 'Proyek selesai tepat waktu 4 hari kerja.'
            ]
        ];
    }
}
