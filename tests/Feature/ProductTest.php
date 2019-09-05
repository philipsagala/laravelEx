<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    public function testExample()
    {
        $response = $this->get('/product');

        $response->assertStatus(200);
    }

    public function tesProduct()
    {
        $response = $this->post('/product');

        $response->assertStatus(201);
    }
}
