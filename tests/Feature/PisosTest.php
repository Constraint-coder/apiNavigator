<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Piso;
use Illuminate\Support\Str;

class PisosTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }



    public function test_crear_piso()
    {
        $data = [
            'nombres' => 'Primer piso'
        ];

        $response = $this->postJson('/api/pisos', $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['nombres' => 'Primer piso']);

        $this->assertDatabaseHas('pisos', $data);
    }

  

}
