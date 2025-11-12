<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class pasillosTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function puede_listar_pasillos()
    {
        Piso::factory()->create();
        Pasillo::factory()->count(3)->create();

        $response = $this->getJson('/api/pasillos');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    //
    public function puede_crear_un_pasillo()
    {
        $piso = Piso::factory()->create();

        $data = [
            'nombres' => 'Pasillo Central',
            'coordenadas' => ['x' => 13.7001, 'y' => -89.2002],
            'id_pisos' => $piso->id,
        ];

        $response = $this->postJson('/api/pasillos', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['nombres' => 'Pasillo Central']);

        $this->assertDatabaseHas('pasillos', [
            'nombres' => 'Pasillo Central',
            'id_pisos' => $piso->id,
        ]);
    }


}
