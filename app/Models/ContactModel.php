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
            'whatsapp_number' => '6285719663154',
            'whatsapp_display' => '+62 857-1966-3154',
            'website_url' => 'www.solveta.asia',
            'email' => 'halo@solveta.asia',
        ];
    }
}
