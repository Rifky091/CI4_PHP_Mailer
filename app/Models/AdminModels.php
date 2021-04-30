<?php
namespace App\Models;
use CodeIgniter\Model;

class AdminModels extends Model
{
    protected $table = 'admin';
    protected $allowedFields = ['id_admin', 'username', 'password'];
    
    public function getAdminAccount($username, $pass)
    {
        return $this->getWhere(['username' => $username, 'password' => $pass])
        ->getRowArray();
    }
}
