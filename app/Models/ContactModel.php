<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table = 'contact_info';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'whatsapp_number',
        'whatsapp_display',
        'website_url',
        'email',
        'instagram',
    ];
    protected $useTimestamps = true;
    protected $updatedField  = 'updated_at';

    public function getContact(): array
    {
        if (! is_mysql_alive()) {
            return $this->getDefaultContact();
        }

        try {
            $row = $this->first();
            if ($row) {
                return (array) $row;
            }
        } catch (\Throwable $e) {
            log_message('error', 'ContactModel error: ' . $e->getMessage());
        }

        return $this->getDefaultContact();
    }

    public function getDefaultContact(): array
    {
        return [
            'id' => 1,
            'whatsapp_number' => '6285876603826',
            'whatsapp_display' => '+6285876603826',
            'website_url' => 'www.solveta.asia',
            'email' => 'halo@solveta.asia',
            'instagram' => 'solveta.asia',
        ];
    }
}
