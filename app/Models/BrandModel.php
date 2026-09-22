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
        if (! is_mysql_alive()) {
            return $this->getDefaultBrands();
        }

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

        return $this->getDefaultBrands();
    }

    public function getDefaultBrands(): array
    {
        return [
            ['id' => 'brand-1788254260324', 'name' => '', 'label' => '', 'logo_image' => '/uploads/brands/brand-1788254260324.png', 'scale' => 1.0, 'sort_order' => 1],
            ['id' => 'brand-1788254350483', 'name' => '', 'label' => '', 'logo_image' => '/uploads/brands/brand-1788254350483.png', 'scale' => 1.0, 'sort_order' => 2],
            ['id' => 'brand-1788254406941', 'name' => '', 'label' => '', 'logo_image' => '/uploads/brands/brand-1788254406941.png', 'scale' => 1.0, 'sort_order' => 3],
            ['id' => 'brand-1788254482294', 'name' => '', 'label' => '', 'logo_image' => '/uploads/brands/brand-1788254482294.png', 'scale' => 1.0, 'sort_order' => 4],
            ['id' => 'brand-1788254508761', 'name' => '', 'label' => '', 'logo_image' => '/uploads/brands/brand-1788254508761.png', 'scale' => 1.0, 'sort_order' => 5],
            ['id' => 'brand-1788258571491', 'name' => '', 'label' => '', 'logo_image' => '/uploads/brands/brand-1788258571491.png', 'scale' => 1.0, 'sort_order' => 6],
            ['id' => 'brand-1790081984303', 'name' => '', 'label' => '', 'logo_image' => '/uploads/brands/brand-1790081984303.png', 'scale' => 1.0, 'sort_order' => 7],
            ['id' => 'brand-1790082015511', 'name' => '', 'label' => '', 'logo_image' => '/uploads/brands/brand-1790082015511.png', 'scale' => 1.0, 'sort_order' => 8],
            ['id' => 'brand-1790082034279', 'name' => '', 'label' => '', 'logo_image' => '/uploads/brands/brand-1790082034279.png', 'scale' => 1.0, 'sort_order' => 9],
            ['id' => 'brand-1790082051828', 'name' => '', 'label' => '', 'logo_image' => '/uploads/brands/brand-1790082051828.png', 'scale' => 1.0, 'sort_order' => 10],
        ];
    }
}
