<?php

namespace App;

use CodeIgniter\Test\FeatureTestCase;

class TestPengguna extends FeatureTestCase
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
        $result = $this->get('/pengguna');
        $result->assertOK();
    }

    public function testListTugas()
    {
        $result = $this->get('/pengguna/listTugas');
        $result->assertOK();
    }

    public function testAddTugas()
    {
        $result = $this->get('/pengguna/addTugas');
        $result->assertOK();
    }
    
    public function testInsertTugas()
    {
        $data = [
            'nama_tugas' => 'TMD PBO',
			'tipe_tugas' => 'Individu',
            'deadline' => '2021-06-07\T23:59:00'
        ];
        $result = $this->post('/pengguna/insertTugas', $data);
        $result->assertOK();
    }

    public function testUpdateTugas()
    {
        $data = [
            'nama_tugas' => 'TMD PBO',
			'tipe_tugas' => 'Individu',
            'deadline' => '2021-06-08\T23:59:00'
        ];
        $result = $this->put('/pengguna/updateTugas/2', $data);
        $result->assertOK();
    }

    public function testDeleteTugas()
    {
        $result = $this->delete('/pengguna/deleteTugas/3');
        $result->assertOK();
    }

    public function testListJadwal()
    {
        $result = $this->get('/pengguna/listJadwal');
        $result->assertOK();
    }

    public function testAddJadwal()
    {
        $result = $this->get('/pengguna/addJadwal');
        $result->assertOK();
    }

    public function testInsertJadwal()
    {
        $data = [
            'nama' => 'PBO',
			'hari' => 'Thursday',
            'jam' => '07:00:00'
        ];
        $result = $this->post('/pengguna/insertJadwal', $data);
        $result->assertOK();
    }

    public function testUpdateJadwal()
    {
        $data = [
            'nama' => 'PBO',
			'hari' => 'Thursday',
            'jam' => '08:00:00'
        ];
        $result = $this->put('/pengguna/updateJadwal/3', $data);
        $result->assertOK();
    }

    public function testDeleteJadwal()
    {
        $result = $this->delete('/pengguna/deleteJadwal/3');
        $result->assertOK();
    }

    public function testProfile()
    {
        $result = $this->get('/pengguna/profile');
        $result->assertOK();
    }

    public function testUpdateProfile()
    {
        $data = [
            'username' => 'aldisaepss',
            'email' => 'aldisaepurahman@gmail.com'
        ];
        $result = $this->put('/pengguna/updateProfile/2', $data);
        $result->assertOK();
    }
}