<?php
namespace App\Models;
use CodeIgniter\Model;

class EmailJadwalModels extends Model
{
    protected $table = 'email_jadwal';
    protected $allowedFields = ['kode_email_jadwal', 'id_jadwal', 'subject', 'pesan', 'waktu_kirim', 'status'];
    
    public function getEmailJadwal($waktu_kirim)
    {
        return $this->db->table($this->table)->select('pengguna.email,
        email_jadwal.subject, jadwal.hari, email_jadwal.pesan, email_jadwal.waktu_kirim,
        email_jadwal.kode_email_jadwal')
        ->join('jadwal', 'email_jadwal.id_jadwal = jadwal.id_jadwal')
        ->join('pengguna', 'jadwal.id_pengguna = pengguna.id_pengguna')
        ->where(['waktu_kirim' => $waktu_kirim, 'status' => 0])->get()
        ->getResultArray();
    }

    public function getEmailJadwalById($id_jadwal)
    {
        return $this->getWhere(['id_jadwal' => $id_jadwal])->getResultArray();
    }

    public function insertEmailJadwal($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateEmailJadwal($data, $kode_email_jadwal)
    {
        return $this->db->table($this->table)->update($data, ['kode_email_jadwal' => $kode_email_jadwal]);
    }

    public function deleteEmailJadwal($kode_email_jadwal)
    {
        return $this->db->table($this->table)->delete(['kode_email_jadwal' => $kode_email_jadwal]);
    }
}
