<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FarmaciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nombre' => 'Farmacia COSAV','dirección' => 'Sector 01 Grupo 18 Manzana "E" Lote 05','latitud' => -12.1967453,'longitud' => -76.9515343],
            ['nombre' => 'Farmacia Saco Oliveros','dirección' => 'Av. Revolucion 418, Villa EL Salvador 15829','latitud' => -12.1968712,'longitud' => -76.9505043],
            ['nombre' => 'Farmacia del 23','dirección' => 'Cercado de Lima 15829','latitud' => -12.1967558,'longitud' => -76.9499893],
            ['nombre' => 'Villa Express','dirección' => 'R332+67V, Avenida Pacto Andino, Villa EL Salvador 15829','latitud' => -12.1968817,'longitud' => -76.9507833],
            ['nombre' => 'Farmacia José Olaya','dirección' => 'Av Pacto Andino 1227, Villa EL Salvador 15829','latitud' => -12.1968817,'longitud' => -76.9507833],
            ['nombre' => 'Mi casa','dirección' => 'Villa el Salvador, Sc 1 Gp 23 Mz F Lt 22','latitud' => -12.1968817,'longitud' => -76.9507833],
            ['nombre' => 'Av. Canaval y Moreira 150','dirección' => 'Av. Canaval y Moreira 150','latitud' => -12.1968817,'longitud' => -76.9507833],
            ['nombre' => 'La Burguería','dirección' => 'Av. los Fresnos 1598, La Molina 15024','latitud' => -12.1827891,'longitud' => -76.95237131],
            ['nombre' => 'Farmacia "Zedplan"','dirección' => 'Una Farmacia cercana a Zedplan','latitud' => -34.6160324,'longitud' => -58.4657304],
            ['nombre' => 'Farmacia "OkiDoki KIDS Cafe"','dirección' => 'Av. Gaona 3036, C1416 CABA, Argentina','latitud' => -34.6177237,'longitud' => -58.4684013],
            ['nombre' => 'Farmacia ÚNICA','dirección' => 'Avenida Juan B. Justo 5864, Luis Viale 3041, C1416DKZ Buenos Aires, Argentina','latitud' => -34.620346,'longitud' => -58.4769006],
            ['nombre' => 'Farmacia "Policlínica Bancaria"','dirección' => 'Av. Gaona 2197, C1416DRJ CABA, Argentina','latitud' => -34.6123795,'longitud' => -58.4588271],
            ['nombre' => 'Farmacia "Carrefour"','dirección' => 'Av. los Fresnos 1593, La Molina 15024','latitud' => -34.5232198,'longitud' => -58.3638591],
         ];

         foreach ($data as $value) {
            DB::table('farmacias')->insert(
                [
                    'nombre' => $value['nombre'],
                    'dirección' => $value['dirección'],
                    'latitud' => $value['latitud'],
                    'longitud' => $value['longitud'],
                ]
                );
        }
    }
}
