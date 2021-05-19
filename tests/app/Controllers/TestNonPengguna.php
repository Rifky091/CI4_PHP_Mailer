<?php

namespace App;

use CodeIgniter\Test\FeatureTestCase;

class TestNonPengguna extends FeatureTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testIndex()
    {
        $result = $this->get('/');
        $result->assertOK();
    }

    public function testAuthenticate()
    {
        $result = $this->get('/login');
        $result->assertOK();
    }

    public function testLoginPengguna()
    {
        $data = [
            'username' => 'aldisaeps',
            'password' => 'aldisaep'
        ];
        $result = $this->post('/login-auth', $data);
        $result->assertSessionHas('username', $data['username']);
    }

    public function testLoginAdmin()
    {
        $data = [
            'username' => 'admin',
            'password' => 'admin1234'
        ];
        $result = $this->post('/login-auth', $data);
        $result->assertSessionHas('priviledge', 'admin');
    }

    public function testRegister()
    {
        $data = [
            'username_reg' => 'rifky',
            'email' => 'rifkymr@upi.edu',
            'password_reg' => 'rifky123'
        ];
        $result = $this->post('/register', $data);
        $result->assertOK();
    }

    public function testLogout()
    {
        $result = $this->get('/logout');
        $result->assertSessionHas('status', 'login');
    }
}