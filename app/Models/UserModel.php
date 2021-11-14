<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $allowedFields    = ['id_user', 'nama', 'username', 'password', 'level'];

    public function getData($username)
    {
        $query = $this->db->table($this->table);
        $row = $query->where('username', $username);
        $log = $row->get()->getRow();
        return $log;
    }
}
