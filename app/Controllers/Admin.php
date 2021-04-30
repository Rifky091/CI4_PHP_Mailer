<?php

namespace App\Controllers;

use App\Models\PenggunaModels;

class Admin extends BaseController
{
    protected $helper = ['form','url'];

    private $pengguna;

    public function __construct()
    {
        $this->session = session();
        $this->pengguna = new PenggunaModels();
    }

    public function index()
    {
        if ($this->session->get('status') == NULL) {
            return redirect()->to(base_url().'/login');
        }
        else{
            if ($this->session->get('priviledge') == "pengguna") {
                return redirect()->to(base_url().'/pengguna');
            }
        }
        $data = [
            'title' => "Admin Schedular",
            'pengguna' => $this->pengguna->getAllPengguna()
        ];
        return view('admin/index', $data);
    }

    public function delete($id)
    {
        if ($this->pengguna->deletePengguna($id)) {
            $this->session->setFlashData('success', "Data Sukses Dihapus!");
        }
        else{
            $this->session->setFlashData('danger', "Data Gagal Dihapus!");
        }

        return redirect()->to(base_url().'/admin');
    }
}
