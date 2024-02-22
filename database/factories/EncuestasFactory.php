<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\encuestas>
 */
class EncuestasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'num_pregunta' => $this->faker->randomNumber(),
            'pregunta' => $this->faker->text(255),
            'respuesta' => $this->faker->randomElement(['MALO', 'REGULAR', 'BUENO']),
        ];
    }
}
