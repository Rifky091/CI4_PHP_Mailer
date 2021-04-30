<?php
namespace App\Models;
use CodeIgniter\Model;

class EmailTugasModels extends Model
{
    protected $table = 'email_tugas';
    protected $allowedFields = ['kode_email_tugas', 'id_tugas', 'subject', 'pesan', 'waktu_kirim', 'status'];
    
    public function getEmailTugas($waktu_kirim)
    {
        return $this->db->table($this->table)->select('pengguna.email,
        email_tugas.subject, email_tugas.pesan,email_tugas.status,
        email_tugas.kode_email_tugas')
        ->join('tugas', 'email_tugas.id_tugas = tugas.id_tugas')
        ->join('pengguna', 'tugas.id_pengguna = pengguna.id_pengguna')
        ->where(['waktu_kirim' => $waktu_kirim, 'status' => 0])->get()
        ->getResultArray();
    }

    public function getEmailTugasById($id_tugas)
    {
        return $this->getWhere(['id_Tugas' => $id_tugas])->getResultArray();
    }

    public function insertEmailTugas($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateEmailTugas($data, $kode_email_tugas)
    {
        return $this->db->table($this->table)->update($data, ['kode_email_tugas' => $kode_email_tugas]);
    }

    public function deleteEmailTugas($kode_email_tugas)
    {
        return $this->db->table($this->table)->delete(['kode_email_tugas' => $kode_email_tugas]);
    }
}
