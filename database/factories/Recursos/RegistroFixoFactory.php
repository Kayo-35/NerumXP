<?php

namespace Database\Factories\Recursos;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Personas\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recursos\RegistroFixo>
 */
class RegistroFixoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Definitions
            'cd_usuario' => fake()->numberBetween(1,User::max('cd_usuario')),
            'cd_tipo_registro' => fake()->numberBetween(1,2),
            'cd_nivel_imp' => fake()->numberBetween(1,5),
            'cd_categoria' => fake()->numberBetween(1,9),
            'cd_localizacao' => fake()->numberBetween(1,7),
            'cd_realizador' => fake()->numberBetween(1,3),
            'vl_valor' => fake()->randomFloat(2,20,3000),
            'nm_registroFixo' => 'Indefinido',
            'ic_pago' => fake()->numberBetween(1,2),
            'ic_status' => fake()->numberBetween(1,2),
            'dt_pagamento' => fake()->date(),
            'ds_descricao' => fake()->text(255),
        ];
    }
}
