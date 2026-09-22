<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table = 'client_brands';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'id',
        'name',
        'label',
        'logo_image',
        'scale',
        'sort_order',
    ];
    protected $useTimestamps = false;

    public function getBrands(): array
    {
        try {
            $rows = $this->orderBy('sort_order', 'ASC')->findAll();
            if (!empty($rows)) {
                return array_map(function ($row) {
                    return (array) $row;
                }, $rows);
            }
        } catch (\Throwable $e) {
            log_message('error', 'BrandModel error: ' . $e->getMessage());
        }

        return [
            ['id' => 'brand-1', 'name' => 'Cuango Official', 'label' => 'Fashion & Apparel', 'logo_image' => null, 'scale' => 1.0, 'sort_order' => 1],
            ['id' => 'brand-2', 'name' => 'Haltea Herbal', 'label' => 'Food & Beverage', 'logo_image' => null, 'scale' => 1.0, 'sort_order' => 2],
            ['id' => 'brand-3', 'name' => 'Yayasan Konservasi Akuatik', 'label' => 'Environmental NGO', 'logo_image' => null, 'scale' => 1.0, 'sort_order' => 3],
            ['id' => 'brand-4', 'name' => 'Squabumin Indonesia', 'label' => 'Pharmaceuticals', 'logo_image' => null, 'scale' => 1.0, 'sort_order' => 4],
            ['id' => 'brand-5', 'name' => 'Tidur Nyenyak Bedding', 'label' => 'Home & Living', 'logo_image' => null, 'scale' => 1.0, 'sort_order' => 5],
            ['id' => 'brand-6', 'name' => 'VisualGenix Studio', 'label' => 'Creative & Media', 'logo_image' => null, 'scale' => 1.0, 'sort_order' => 6],
            ['id' => 'brand-7', 'name' => 'MedikaCare Group', 'label' => 'Healthcare System', 'logo_image' => null, 'scale' => 1.0, 'sort_order' => 7],
            ['id' => 'brand-8', 'name' => 'Nusantara Logistics', 'label' => 'Supply Chain', 'logo_image' => null, 'scale' => 1.0, 'sort_order' => 8],
            ['id' => 'brand-9', 'name' => 'UrbanVibe Properties', 'label' => 'Real Estate', 'logo_image' => null, 'scale' => 1.0, 'sort_order' => 9],
            ['id' => 'brand-10', 'name' => 'Apex Global Industri', 'label' => 'Manufacturing', 'logo_image' => null, 'scale' => 1.0, 'sort_order' => 10],
        ];
    }
}
