<?php

namespace App;

use CodeIgniter\Test\FeatureTestCase;

class TestAdmin extends FeatureTestCase
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
        $result = $this->get('/admin');
        $result->assertOK();
    }

    public function testDelete()
    {
        $result = $this->delete('/admin/delete/3');
        $result->assertOK();
    }
}