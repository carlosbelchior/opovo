<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class NoticiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_jornalista' => 1,
            'id_tipo_noticia' => 1,
            'titulo' => fake()->sentence(5, true),
            'descricao' => fake()->sentence(15, true),
            'corpo' => fake()->paragraph(15, true)
        ];
    }
}
