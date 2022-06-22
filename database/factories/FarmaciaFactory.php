<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Farmacia>
 */
class FarmaciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        // https://docs.mapbox.com/help/glossary/lat-lon/
        return [
            'nombre' => $this->faker->name(),
            'dirección' => $this->faker->name(),
            'latitud' => $this->faker->randomFloat(9, -90, 90),
            'longitud' => $this->faker->randomFloat(9, -180, 180),
        ];
    }
}
