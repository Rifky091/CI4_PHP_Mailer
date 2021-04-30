<?php
namespace App\Models;
use CodeIgniter\Model;

class PenggunaModels extends Model
{
    protected $table = 'pengguna';
    protected $allowedFields = ['id_pengguna', 'username', 'email', 'password'];
    
    public function getAllPengguna()
    {
        return $this->findAll();
    }

    public function getProfil($id)
    {
        return $this->getWhere(['id_pengguna' => $id])->getRowArray();
    }
    
    public function getPenggunaAccount($username, $pass)
    {
        return $this->getWhere(['username' => $username, 'password' => $pass])
        ->getRowArray();
    }

    public function getPenggunaByEmailOrUsername($username, $email)
    {
        return $this->table($this->table)->select("*")
        ->where('username', $username)->orWhere('email', $email)
        ->get()->getRowArray();
    }

    public function insertPengguna($data)
    {
        return $this->db->table($this->table)->insert($data);;
    }

    public function updatePengguna($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_pengguna' => $id]);
    }

    public function deletePengguna($id)
    {
        return $this->db->table($this->table)->delete(['id_pengguna' => $id]);
    }
}
