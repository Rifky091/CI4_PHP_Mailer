<?php

namespace App\Controllers;

class Pengguna extends BaseController
{
    protected $helper = ['form','url'];

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        $data['title'] = "Welcome To Schedular";
        return view('pengguna/landing_page', $data);
    }

    public function authenticate()
    {
        $data['title'] = "Authenticate - Schedular";
        return view('pengguna/login_register', $data);
    }

    public function dashboard()
    {
        $data['title'] = "Dashboard - Schedular";
        return view('pengguna/index', $data);
    }
}
