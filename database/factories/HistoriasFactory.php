<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\historias>
 */
class HistoriasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->unique()->word(),
            'subtitulo' => $this->faker->word(),
            'descripcion' => $this->faker->text(),
            'ruta_imagen' => $this->faker->imageUrl(),
        ];
    }
}
