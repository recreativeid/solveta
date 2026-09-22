<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'admin_users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password_hash', 'display_name'];
    protected $useTimestamps = false;

    public function findByUsername(string $username)
    {
        return $this->where('username', $username)->first();
    }
}
