<?php

namespace App\Controllers;

use App\Models\AdminModels;
use App\Models\PenggunaModels;

class NonPengguna extends BaseController
{
    protected $helper = ['form','url'];

    private $admin;
    private $pengguna;

    public function __construct()
    {
        $this->session = session();
        $this->admin = new AdminModels();
        $this->pengguna = new PenggunaModels();
    }

    public function index()
    {
        if ($this->session->get('status')) {
            if ($this->session->get('priviledge') == "admin") {
                return redirect()->to(base_url().'/admin');
            }
            else if ($this->session->get('priviledge') == "pengguna") {
                return redirect()->to(base_url().'/pengguna');
            }
        }
        $data['title'] = "Welcome To Schedular";
        return view('pengguna/landing_page', $data);
    }

    public function authenticate()
    {
        if ($this->session->get('status')) {
            if ($this->session->get('priviledge') == "admin") {
                return redirect()->to(base_url().'/admin');
            }
            else if ($this->session->get('priviledge') == "pengguna") {
                return redirect()->to(base_url().'/pengguna');
            }
        }
        $data['title'] = "Authenticate - Schedular";
        return view('pengguna/login_register', $data);
    }

    public function login()
    {
        $valid = [
			'username' => 'required',
			'password' => 'required'
		];

        if ($this->validate($valid)) {
            $username = $this->request->getPost('username');
            $password = md5($this->request->getPost('password'));

            $data = $this->pengguna->getPenggunaAccount($username, $password);
            if ($data) {
                $dataSession = [
                    'id_pengguna' => $data['id_pengguna'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'priviledge' => "pengguna",
                    'status' => "login"
                ];

                $this->session->set($dataSession);
                $this->session->setFlashData('success', "Login Sukses!");
                return redirect()->to(base_url().'/pengguna');
            }
            else {
                $data = $this->admin->getAdminAccount($username, $password);
                if ($data) {
                    $dataSession = [
                        'id_admin' => $data['id_admin'],
                        'username' => $data['username'],
                        'priviledge' => "admin",
                        'status' => "login"
                    ];
    
                    $this->session->set($dataSession);
                    $this->session->setFlashData('success', "Login Sukses!");
                    return redirect()->to(base_url().'/admin');
                }
                else {
                    $this->session->setFlashData('danger', "Login Gagal, Akun Tidak Ditemukan!");
					return redirect()->to(base_url().'/login');
                }
            }
        }
        else {
            $this->session->setFlashData('danger', "Login Gagal, Pastikan Semua Data Login Terisi Dengan Benar!");
            return redirect()->to(base_url().'/login');
        }
    }

    public function register()
    {
        $valid = [
			'username_reg' => 'required',
            'email' => 'required',
			'password_reg' => 'required'
		];

        if ($this->validate($valid)) {
            $username = $this->request->getPost('username_reg');
            $email = $this->request->getPost('email');

            if (!$this->pengguna->getPenggunaByEmailOrUsername($username, $email)) {
                $data = [
                    'username' => $username,
                    'email' => $email,
                    'password' => md5($this->request->getPost('password_reg'))
                ];
                if ($this->pengguna->insertPengguna($data)) {
                    $this->session->setFlashData('success', "Register Sukses!");
					return redirect()->to(base_url().'/login');
                }
                else{
                    $this->session->setFlashData('danger', "Registrasi Gagal, Kesalahan Pada Server!");
					return redirect()->to(base_url().'/login');
                }
            }
            else{
                $this->session->setFlashData('danger', "Registrasi Gagal, Email dan Username yang diinput sudah digunakan!");
				return redirect()->to(base_url().'/login');
            }
        }
        else{
            $this->session->setFlashData('danger', "Registrasi Gagal, Pastikan Semua Data Login Terisi Dengan Benar!");
            return redirect()->to(base_url().'/login');
        }
    }

    public function logout()
	{
		$this->session->destroy();

        return redirect()->to(base_url().'/');
	}
}
