<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\reportes>
 */
class ReportesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'num_reporte' => $this->faker->unique()->randomNumber(8),
            'nombre' => $this->faker->word(),
            'area' => $this->faker->word(),
            'problema' => $this->faker->word(),
        ];
    }
}
