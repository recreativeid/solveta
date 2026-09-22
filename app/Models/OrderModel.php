<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'customer_orders';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'full_name',
        'whatsapp_number',
        'brand_name',
        'business_description',
        'selected_package',
        'website_type',
        'pages_needed',
        'design_color_theme',
        'has_domain',
        'has_logo',
        'product_photos',
        'example_websites',
        'special_notes',
        'website_and_domain_name',
        'business_profile',
        'status',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    public function getOrders(): array
    {
        try {
            $rows = $this->orderBy('id', 'DESC')->findAll();
            return !empty($rows) ? array_map(function($r){ return (array)$r; }, $rows) : [];
        } catch (\Throwable $e) {
            log_message('error', 'OrderModel error: ' . $e->getMessage());
            return [];
        }
    }
}
