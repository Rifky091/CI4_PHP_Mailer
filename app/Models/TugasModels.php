<?php
namespace App\Models;
use CodeIgniter\Model;

class TugasModels extends Model
{
    protected $table = 'tugas';
    protected $allowedFields = ['id_tugas', 'id_pengguna', 'nama_tugas', 'deadline', 'tipe_tugas'];
    
    public function getTugas($id_pengguna, $id_tugas = NULL)
    {
        if ($id_tugas != NULL) {
            return $this->getWhere(['id_tugas' => $id_tugas])->getRowArray();
        }
        else{
            return $this->getWhere(['id_pengguna' => $id_pengguna])->getResultArray();
        }
    }

    public function insertTugas($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    public function updateTugas($data, $id_tugas)
    {
        return $this->db->table($this->table)->update($data, ['id_tugas' => $id_tugas]);
    }

    public function deleteTugas($id_tugas)
    {
        return $this->db->table($this->table)->delete(['id_tugas' => $id_tugas]);
    }
}
