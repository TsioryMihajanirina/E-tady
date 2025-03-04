<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model
{
    protected $table = 'utilisateurs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'email', 'telephone', 'image_id'];

    /**
     * verifie si un element exist
     */
    public function isExists($key, $value){
        return $this->where($key, $value)->first() !== null;
    }
}
