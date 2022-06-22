<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use App\Models\Farmacia;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FarmaciaAPITest extends TestCase
{

    //use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_create_pharmacy_successful()
    {
        $formData = [
            'nombre' => "Farmacia default 1",
            'dirección' =>  "Sct 1 Gp 23 Mz F Lt 22",
            'latitud' => 45.121233,
            'longitud' => -45123.3012
        ];
        $this->withoutExceptionHandling();
        $this->json('POST',route('farmacias.store'),$formData)
             ->assertStatus(200)
             ->assertJson(['data' => $formData]);

             
             
    }

    public function test_can_create_pharmacy_failed()
    {
        $formData = [
            'nombre' => 'Farmacia fallida',
            'direcciónes' =>  'Sct 1 Gp 23 Mz F Lt 22',
            'latitud' => 45.121233,
            'longitud' => -45123.3012
        ];
        $this->withoutExceptionHandling();
        $this->json('POST',route('farmacias.store'),$formData)
             ->assertStatus(202)
             ->assertJson(['datas' => $formData]);
    }



    public function test_can_get_nearest_pharmacies()
    {

        /*$user = User::factory()->create();

        $this->actingAs($user, 'api');*/

        $farmacia = Farmacia::factory()->create();

        $parametros = [
            'lat' => $farmacia->latitud,
            'lon' => $farmacia->longitud
        ];

        $this->get(route('farmacia.nearest',$parametros))
        ->assertStatus(200);

    }



    
}
