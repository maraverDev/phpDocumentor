<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'ID_USER';
    protected $useTimestamps = true;
    protected $allowedFields = ['NAME', 'SURNAME', 'BORN_DATE', 'PHONE_NUMBER', 'EMAIL', 'GENDER',  'PASSWORD', 'created_at', 'deleted_at'];

    /**
     *   @param string $email 
     *   @return array|null
     */

    public function findByEmail(string $email)
    {
        return $this->where('EMAIL', $email)->first();
    }
}
