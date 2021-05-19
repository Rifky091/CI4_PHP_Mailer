<?php

namespace App\Controllers;

use App\Controllers\Email;
use App\Models\AdminModels;
use App\Models\PenggunaModels;
use App\Models\JadwalModels;
use App\Models\TugasModels;

class Pengguna extends BaseController
{
    protected $helper = ['form','url'];

    protected $hari = [
		'Monday'  => 'Senin',
		'Tuesday'  => 'Selasa',
		'Wednesday' => 'Rabu',
		'Thursday' => 'Kamis',
		'Friday' => 'Jumat',
		'Saturday' => 'Sabtu',
		'Sunday' => 'Minggu'
	];

    private $pengguna;
    private $jadwal;
    private $tugas;
    private $email;
    private $id;

    public function __construct()
    {
        $this->session = session();
        $this->pengguna = new PenggunaModels();
        $this->jadwal = new JadwalModels();
        $this->tugas = new TugasModels();
        $this->email = new Email();
        $this->id = $this->session->get('id_pengguna');
    }

    public function index()
    {
        if ($this->session->get('status') == NULL) {
            return redirect()->to(base_url().'/login');
        }
        else{
            if ($this->session->get('priviledge') == "admin") {
                return redirect()->to(base_url().'/admin');
            }
        }
        $data['title'] = "Dashboard - Schedular";
        return view('pengguna/index', $data);
    }

    public function listTugas()
    {
        $data = [
            'title' => "Tugas - Schedular",
            'tugas' => $this->tugas->getTugas($this->id)
        ];

        return view('pengguna/task_page', $data);
    }

    public function addTugas()
    {
        $data = [
			'title' => "Input Tugas Baru - Schedular",
			'method' => 1,
            'profil' => $this->pengguna->getProfil($this->id)
		];

		return view('pengguna/form_tugas', $data);
    }

    public function editTugas($id)
    {
        $task = $this->tugas->getTugas($this->id, $id);
        $data = [
			'title' => "Edit Tugas - Schedular",
			'method' => 2,
            'id_tugas' => $id,
            'deadline' => date('Y-m-d\TH:i:s', strtotime($task['deadline'])),
            'data' => $task,
            'profil' => $this->pengguna->getProfil($this->id)
		];

		return view('pengguna/form_tugas', $data);
    }

    public function insertTugas()
    {
        $valid = [
			'nama_tugas' => 'required',
			'tipe_tugas' => 'required',
            'deadline' => 'required'
		];

        if ($this->validate($valid)) {
            $nama = $this->request->getPost('nama_tugas');
            $deadline = $this->request->getPost('deadline');
            $tipe_tugas = $this->request->getPost('tipe_tugas');

            $task = $this->tugas->getTugas($this->id);

            $found = false;

            foreach ($task as $data) {
                if ($nama == $data['nama_tugas'] && $deadline == $data['deadline'] && $tipe_tugas == $data['tipe_tugas']) {
                    $found = true;
                    break;
                }
            }

            if ($found == false) {
                $data = [
                    'id_pengguna' => $this->id,
                    'nama_tugas' => $nama,
                    'deadline' => $deadline,
                    'tipe_tugas' => $tipe_tugas,
                ];

                $id = $this->tugas->insertTugas($data);
                if ($id) {
                    $time = date_create($deadline);
                    $jam = date_format($time, "H:i");
                    if ($tipe_tugas == "Individu") {
                        $count = $this->generateEmailTugas($id, $time, $nama, $jam, 5);

                        if ($count == 5) {
                            $this->session->setFlashData('success', "Insert Tugas Sukses!");
					        return redirect()->to(base_url().'/pengguna/listTugas');
                        }
                        else{
                            $this->session->setFlashData('success', "Insert Jadwal Sukses, Namun Email Tidak Dapat Digenerate!");
					        return redirect()->to(base_url().'/pengguna/listTugas');
                        }
                    }
                    else if ($tipe_tugas == "Kelompok") {
                        $count = $this->generateEmailTugas($id, $time, $nama, $jam, 7);

                        if ($count == 7) {
                            $this->session->setFlashData('success', "Insert Tugas Sukses!");
					        return redirect()->to(base_url().'/pengguna/listTugas');
                        }
                        else{
                            $this->session->setFlashData('success', "Insert Tugas Sukses, Namun Email Tidak Dapat Digenerate!");
					        return redirect()->to(base_url().'/pengguna/listTugas');
                        }
                    }
                }
                else{
                    $this->session->setFlashData('danger', "Insert Tugas Gagal, Kesalahan Pada Server!");
					return redirect()->to(base_url().'/pengguna/addTugas');
                }
            }
            else{
                $this->session->setFlashData('danger', "Insert Tugas Gagal, Tugas Sudah Ada!");
				return redirect()->to(base_url().'/pengguna/addTugas');
            }
        }
        else{
            $this->session->setFlashData('danger', "Insert Tugas Gagal, Pastikan Semua Data terisi dengan benar!");
			return redirect()->to(base_url().'/pengguna/addTugas');
        }
    }

    public function updateTugas($id)
    {
        $valid = [
			'nama_tugas' => 'required',
			'tipe_tugas' => 'required',
            'deadline' => 'required'
		];

        if ($this->validate($valid)) {
            $nama = $this->request->getPost('nama_tugas');
            $deadline = $this->request->getPost('deadline');
            $tipe_tugas = $this->request->getPost('tipe_tugas');
            $deadline = date_create($deadline);
            $deadline = date_format($deadline, 'Y-m-d H:i:s');

            $task = $this->tugas->getTugas($this->id);

            $found = false;

            foreach ($task as $data) {
                if ($nama == $data['nama_tugas'] && $deadline == $data['deadline'] && $tipe_tugas == $data['tipe_tugas']) {
                    $found = true;
                    break;
                }
            }

            if ($found == false) {
                $data = [
                    'nama_tugas' => $nama,
                    'deadline' => $deadline,
                    'tipe_tugas' => $tipe_tugas,
                ];

                $statusupdate = $this->tugas->updateTugas($data, $id);
                if ($statusupdate) {
                    $deleteEmail = $this->email->deleteEmail($id, 'tugas');
                    $time = date_create($deadline);
                    $jam = date_format($time, "H:i");
                    if ($tipe_tugas == "Individu") {
                        $count = $this->generateEmailTugas($id, $time, $nama, $jam, 5);

                        if ($count == 5) {
                            $this->session->setFlashData('success', "Update Tugas Sukses!");
					        return redirect()->to(base_url().'/pengguna/listTugas');
                        }
                        else{
                            $this->session->setFlashData('success', "Update Jadwal Sukses, Namun Email Tidak Dapat Digenerate!");
					        return redirect()->to(base_url().'/pengguna/listTugas');
                        }
                    }
                    else if ($tipe_tugas == "Kelompok") {
                        $count = $this->generateEmailTugas($id, $time, $nama, $jam, 7);

                        if ($count == 7) {
                            $this->session->setFlashData('success', "Update Tugas Sukses!");
					        return redirect()->to(base_url().'/pengguna/listTugas');
                        }
                        else{
                            $this->session->setFlashData('success', "Update Tugas Sukses, Namun Email Tidak Dapat Digenerate!");
					        return redirect()->to(base_url().'/pengguna/listTugas');
                        }
                    }
                }
                else{
                    $this->session->setFlashData('danger', "Update Tugas Gagal, Kesalahan Pada Server!");
					return redirect()->to(base_url().'/pengguna/editTugas/'.$id);
                }
            }
            else{
                $this->session->setFlashData('danger', "Update Tugas Gagal, Tugas Sudah Ada!");
				return redirect()->to(base_url().'/pengguna/editTugas/'.$id);
            }
        }
        else{
            $this->session->setFlashData('danger', "Update Tugas Gagal, Pastikan Semua Data terisi dengan benar!");
			return redirect()->to(base_url().'/pengguna/editTugas/'.$id);
        }
    }

    public function deleteTugas($id)
    {
        $emailstatus = $this->email->deleteEmail($id, 'tugas');
        if ($emailstatus) {
            if ($this->tugas->deleteTugas($id)) {
                $this->session->setFlashData('success', "Hore! Tugasmu Sudah Selesai!");
                return redirect()->to(base_url().'/pengguna/listTugas');
            }
            else{
                $this->session->setFlashData('success', "Oops, Maaf Kesalahan Pada Server!");
                return redirect()->to(base_url().'/pengguna/listTugas');
            }
        }
        else{
            $this->session->setFlashData('success', "Maaf Terjadi Kegagalan Menghapus Email Reminder!");
            return redirect()->to(base_url().'/pengguna/listTugas');
        }
    }

    public function listJadwal()
    {
        $detail = $this->jadwal->getJadwal($this->id);

        $datajadwal = [];
        foreach ($detail as $details) {
            $sch = [];
            $sch['id_jadwal'] = $details['id_jadwal'];
            $sch['nama_jadwal'] = $details['nama_jadwal'];
            $sch['jam'] = date('H:i', strtotime($details['jam']));
            $sch['hari'] = $this->hari[$details['hari']];
            array_push($datajadwal, $sch);
        }

        $data = [
            'title' => "Jadwal - Schedular",
            'jadwal' => $datajadwal
        ];

        return view('pengguna/schedule_page', $data);
    }

    public function addJadwal()
    {
        $data = [
			'title' => "Input Jadwal Baru - Schedular",
			'method' => 1,
            'profil' => $this->pengguna->getProfil($this->id)
		];

		return view('pengguna/form_jadwal', $data);
    }

    public function editJadwal($id)
    {
        $data = [
			'title' => "Edit Jadwal - Schedular",
			'method' => 2,
            'id_jadwal' => $id,
            'data' => $this->jadwal->getJadwal($this->id, $id),
            'profil' => $this->pengguna->getProfil($this->id)
		];

		return view('pengguna/form_jadwal', $data);
    }

    public function insertJadwal()
    {
        $valid = [
			'nama_jadwal' => 'required',
			'hari' => 'required',
            'jam' => 'required'
		];

        if ($this->validate($valid)) {
            $nama = $this->request->getPost('nama_jadwal');
            $jam = $this->request->getPost('jam');
            $hari = $this->request->getPost('hari');

            $schedule = $this->jadwal->getJadwal($this->id);

            $found = false;

            foreach ($schedule as $data) {
                if ($nama == $data['nama_jadwal'] && $jam == $data['jam'] && $hari == $data['hari']) {
                    $found = true;
                    break;
                }
            }

            if ($found == false) {
                $data = [
                    'id_pengguna' => $this->id,
                    'nama_jadwal' => $nama,
                    'jam' => $jam,
                    'hari' => $hari,
                ];

                $id = $this->jadwal->insertJadwal($data);
                if ($id) {
                    $emailstatus = $this->generateEmailJadwal($id, $nama, $jam, $hari);

                    if ($emailstatus) {
                        $this->session->setFlashData('success', "Insert Jadwal Sukses!");
					    return redirect()->to(base_url().'/pengguna/listJadwal');
                    }
                    else{
                        $this->session->setFlashData('success', "Insert Jadwal Sukses, Namun Email Tidak Dapat Digenerate!");
					    return redirect()->to(base_url().'/pengguna/listJadwal');
                    }
                }
                else{
                    $this->session->setFlashData('danger', "Insert Jadwal Gagal, Kesalahan Pada Server!");
					return redirect()->to(base_url().'/pengguna/addJadwal');
                }
            }
            else{
                $this->session->setFlashData('danger', "Insert Jadwal Gagal, Jadwal Sudah Ada!");
				return redirect()->to(base_url().'/pengguna/addJadwal');
            }
        }
        else{
            $this->session->setFlashData('danger', "Insert Jadwal Gagal, Pastikan Semua Data terisi dengan benar!");
			return redirect()->to(base_url().'/pengguna/addJadwal');
        }
    }

    public function updateJadwal($id)
    {
        $valid = [
			'nama_jadwal' => 'required',
			'hari' => 'required',
            'jam' => 'required'
		];

        if ($this->validate($valid)) {
            $nama = $this->request->getPost('nama_jadwal');
            $jam = $this->request->getPost('jam');
            $hari = $this->request->getPost('hari');

            $schedule = $this->jadwal->getJadwal($this->id);

            $found = false;

            foreach ($schedule as $data) {
                if ($nama == $data['nama_jadwal'] && $jam == $data['jam'] && $hari == $data['hari']) {
                    $found = true;
                    break;
                }
            }

            if ($found == false) {
                $data = [
                    'nama_jadwal' => $nama,
                    'jam' => $jam,
                    'hari' => $hari,
                ];

                $statusupdate = $this->jadwal->updateJadwal($data, $id);
                if ($statusupdate) {
                    $deleteEmail = $this->email->deleteEmail($id, 'jadwal');
                    $emailstatus = $this->generateEmailJadwal($id, $nama, $jam, $hari);

                    if ($emailstatus) {
                        $this->session->setFlashData('success', "Update Jadwal Sukses!");
					    return redirect()->to(base_url().'/pengguna/listJadwal');
                    }
                    else{
                        $this->session->setFlashData('success', "Update Jadwal Sukses, Namun Email Tidak Dapat Digenerate!");
					    return redirect()->to(base_url().'/pengguna/listJadwal');
                    }
                }
                else{
                    $this->session->setFlashData('danger', "Update Jadwal Gagal, Kesalahan Pada Server!");
					return redirect()->to(base_url().'/pengguna/editJadwal/'.$id);
                }
            }
            else{
                $this->session->setFlashData('danger', "Update Jadwal Gagal, Jadwal Sudah Ada!");
				return redirect()->to(base_url().'/pengguna/editJadwal/'.$id);
            }
        }
        else{
            $this->session->setFlashData('danger', "Update Jadwal Gagal, Pastikan Semua Data terisi dengan benar!");
			return redirect()->to(base_url().'/pengguna/editJadwal/'.$id);
        }
    }

    public function deleteJadwal($id)
    {
        $emailstatus = $this->email->deleteEmail($id, 'jadwal');
        if ($emailstatus) {
            if ($this->jadwal->deleteJadwal($id)) {
                $this->session->setFlashData('success', "Delete Jadwal Sukses!");
                return redirect()->to(base_url().'/pengguna/listJadwal');
            }
            else{
                $this->session->setFlashData('success', "Delete Jadwal Gagal, Kesalahan Pada Server!");
                return redirect()->to(base_url().'/pengguna/listJadwal');
            }
        }
        else{
            $this->session->setFlashData('success', "Delete Jadwal Gagal, Kegagalan Menghapus Email Reminder!");
            return redirect()->to(base_url().'/pengguna/listJadwal');
        }
    }

    public function profile()
    {
        $data = [
            'title' => "Profile - Schedular",
            'id_pengguna' => $this->id,
            'data' => $this->pengguna->getProfil($this->id)
        ];

        return view('pengguna/profile_page', $data);
    }

    public function updateProfile($id)
    {
        $valid = [
			'username' => 'required',
			'email' => 'required'
		];

        if ($this->validate($valid)) {
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $data = $this->pengguna->getPenggunaByEmailOrUsername($username, $email);
            if ($data['id_pengguna'] == $id) {
                if ($this->request->getPost('password') != "") {
                    $password = md5($this->request->getPost('password'));
                    $data = [
                        'username' => $username,
                        'email' => $email,
                        'password' => $password
                    ];
                }
                else{
                    $data = [
                        'username' => $username,
                        'email' => $email
                    ];
                }
                if ($this->pengguna->updatePengguna($data, $id)) {
                    $dataSession = [
                        'id_pengguna' => $id,
                        'username' => $username,
                        'email' => $email,
                        'priviledge' => "pengguna",
                        'status' => "login"
                    ];
    
                    $this->session->set($dataSession);
                    $this->session->setFlashData('success', "Update Profil Sukses!");
					return redirect()->to(base_url().'/pengguna/profile');
                }
                else{
                    $this->session->setFlashData('danger', "Update Profil Gagal, Kesalahan Pada Server!");
					return redirect()->to(base_url().'/pengguna/profile');
                }
            }
            else{
                $this->session->setFlashData('danger', "Update Profil Gagal, Email dan Username yang diinput sudah digunakan!");
				return redirect()->to(base_url().'/pengguna/profile');
            }
        }
        else{
            $this->session->setFlashData('danger', "Update Profil Gagal, Pastikan Data Username dan Email Terisi!");
            return redirect()->to(base_url().'/pengguna/profile');
        }
    }

    private function generateEmailJadwal($id, $nama, $jam, $hari)
    {
        $status = false;
        if (date("Y-m-d") == date('Y-m-d', strtotime($hari))) {
            $pesan = "Halo ".$this->session->get('username').", jangan lupa jadwalmu hari ini yaitu $nama pada jam $jam";
            $dataemail = [
                'id_jadwal' => $id,
                'subject' => "Jadwal Kegiatan Hari ini : $nama",
                'pesan' => $pesan,
                'waktu_kirim' => date('Y-m-d', strtotime($hari)),
                'status' => false
            ];
            $status = $this->email->insertEmail($dataemail, 'jadwal', $this->session->get('email'), $hari);
        }
        else{
            $pesan = "Halo ".$this->session->get('username').", jangan lupa jadwalmu hari ini yaitu $nama pada jam $jam";
            $dataemail = [
                'id_jadwal' => $id,
                'subject' => "Jadwal Kegiatan Hari ini : $nama",
                'pesan' => $pesan,
                'waktu_kirim' => date('Y-m-d', strtotime($hari)),
                'status' => false
            ];
            $status = $this->email->insertEmail($dataemail, 'jadwal', $this->session->get('email'), $hari);
            $pesan = "Halo ".$this->session->get('username').", jangan lupa jadwalmu hari ".$this->hari[$hari]." yaitu $nama pada jam $jam";
            $dataemail = [
                'id_jadwal' => $id,
                'subject' => "Jadwal Kegiatan Hari ini : $nama",
                'pesan' => $pesan,
                'waktu_kirim' => date('Y-m-d'),
                'status' => false
            ];
            $status = $this->email->insertEmail($dataemail, 'jadwal', $this->session->get('email'), $hari);
        }
        return $status;
    }

    private function generateEmailTugas($id, $time, $nama, $jam, $more)
    {
        $count = 0;
        $now = false;
        for ($i=0; $i < $more; $i++) {
            $tgl = date_format($time, "Y-m-d");
            if ($i == 0) {
                $pesan = "Halo ".$this->session->get('username').", jangan lupa pengumpulan tugasmu hari ini pada pukul $nama pada jam $jam";
                $dataemail = [
                    'id_tugas' => $id,
                    'subject' => "Deadline Tugas Anda : $nama",
                    'pesan' => $pesan,
                    'waktu_kirim' => date('Y-m-d', strtotime($tgl)),
                    'status' => false
                ];
            }
            else if (($i == $more-1) && (!$now)) {
                $pesan = "Halo ".$this->session->get('username').", tugas sudah selesai dibuat, jangan lupa untuk menyelesaikan tugasmu hingga tanggal $tgl!";
                $dataemail = [
                    'id_tugas' => $id,
                    'subject' => "Deadline Tugas Anda : $nama",
                    'pesan' => $pesan,
                    'waktu_kirim' => date('Y-m-d'),
                    'status' => false
                ];
            }
            else{
                $pesan = "Halo ".$this->session->get('username').", jangan lupa pengumpulan tugasmu $i hari lagi pada pukul $nama pada jam $jam";
                $dataemail = [
                    'id_tugas' => $id,
                    'subject' => "Deadline Tugas Anda : $nama",
                    'pesan' => $pesan,
                    'waktu_kirim' => date('Y-m-d', strtotime($tgl."-$i days")),
                    'status' => false
                ];
            }
            if($dataemail['waktu_kirim'] == date("Y-m-d")) $now = true;
            $emailstatus = $this->email->insertEmail($dataemail, 'tugas', $this->session->get('email'));
            if ($emailstatus) $count++;
        }
        return $count;
    }
}
