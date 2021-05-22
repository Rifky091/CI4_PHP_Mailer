<?php

namespace App\Controllers;

use App\Models\EmailJadwalModels;
use App\Models\EmailTugasModels;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email extends BaseController
{
    private $email_tugas;
    private $email_jadwal;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->session = session();
        $this->email_jadwal = new EmailJadwalModels();
        $this->email_tugas = new EmailTugasModels();
    }

    public function index()
    {
        $now = date("Y-m-d");
        $dataemail = $this->email_jadwal->getEmailJadwal($now);
        foreach ($dataemail as $email) {
            $status = $this->send($email['subject'], $email['pesan'], $email['email']);
            if($status){
                if($now == date('Y-m-d', strtotime($email['hari']))){
                    $data['waktu_kirim'] = date("Y-m-d", strtotime($email['waktu_kirim']."+7 days"));
                    $this->email_jadwal->updateEmailJadwal($data, $email['kode_email_jadwal']);
                }
            }
        }
        $dataemail = NULL;
        $dataemail = $this->email_tugas->getEmailTugas($now);
        foreach ($dataemail as $email) {
            $status = $this->send($email['subject'], $email['pesan'], $email['email']);
            if($status){
                $data['status'] = true;
                $this->email_tugas->updateEmailTugas($data, $email['kode_email_tugas']);
            }
        }
    }

    public function insertEmail($data, $type, $email, $hari = NULL)
    {
        if ($type == "jadwal") {
            if ($data['waktu_kirim'] == date("Y-m-d")) {
                $status = $this->send($data['subject'], $data['pesan'], $email);
                if ($status) {
                    if ($hari != NULL && $hari == date('l')) {
                        $data['waktu_kirim'] = date("Y-m-d", strtotime($data['waktu_kirim']."+7 days"));
                    }
                    else{
                        $data['status'] = true;
                    }
                }
            }
            return $this->email_jadwal->insertEmailJadwal($data);
        }
        else if ($type == "tugas") {
            if ($data['waktu_kirim'] == date("Y-m-d")) {
                $status = $this->send($data['subject'], $data['pesan'], $email);
                if ($status) {
                    $data['status'] = true;
                }
            }
            return $this->email_tugas->insertEmailTugas($data);
        }
    }

    public function deleteEmail($id, $type)
    {
        if ($type == "jadwal") {
            $email = $this->email_jadwal->getEmailJadwalById($id);
            $status = false;
            foreach ($email as $data) {
                $status = $this->email_jadwal->deleteEmailJadwal($data['kode_email_jadwal']);
            }
            return $status;
        }
        else if ($type == "tugas") {
            $email = $this->email_tugas->getEmailTugasById($id);
            $status = false;
            foreach ($email as $data) {
                $status = $this->email_tugas->deleteEmailTugas($data['kode_email_tugas']);
            }
            return $status;
        }
    }

    private function send($subject, $message, $email)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'aldisaep@upi.edu'; // silahkan ganti dengan alamat email Anda
            $mail->Password   = 'uJmvA1d1sA3p'; // silahkan ganti dengan password email Anda
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('aldisaep@upi.edu', 'Schedular'); // silahkan ganti dengan alamat email Anda
            $mail->addAddress($email);
            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
