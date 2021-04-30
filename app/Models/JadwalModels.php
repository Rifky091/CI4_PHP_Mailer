<?php
namespace App\Models;
use CodeIgniter\Model;

class JadwalModels extends Model
{
    protected $table = 'jadwal';
    protected $allowedFields = ['id_jadwal', 'id_pengguna', 'nama_jadwal', 'jam', 'hari'];
    
    public function getJadwal($id_pengguna, $id_jadwal = NULL)
    {
        if ($id_jadwal != NULL) {
            return $this->getWhere(['id_jadwal' => $id_jadwal])->getRowArray();
        }
        else{
            return $this->getWhere(['id_pengguna' => $id_pengguna])->getResultArray();
        }
    }

    public function insertJadwal($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    public function updateJadwal($data, $id_jadwal)
    {
        return $this->db->table($this->table)->update($data, ['id_jadwal' => $id_jadwal]);
    }

    public function deleteJadwal($id_jadwal)
    {
        return $this->db->table($this->table)->delete(['id_jadwal' => $id_jadwal]);
    }
}
