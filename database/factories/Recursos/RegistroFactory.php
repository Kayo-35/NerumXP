<?php

namespace Database\Factories\Recursos;

use App\Models\Categorizadores\Pagamento\FormaPagamento;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Personas\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recursos\Registro>
 */
class RegistroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bool = [true, false];
        return [
            //Definitions
            "cd_usuario" => fake()->numberBetween(1, User::max("cd_usuario")),
            "cd_forma_pagamento" => fake()->numberBetween(
                1,
                FormaPagamento::max("cd_forma"),
            ),
            "cd_modalidade" => 1,
            "cd_tipo_registro" => fake()->numberBetween(1, 2),
            "cd_nivel_imp" => fake()->numberBetween(1, 5),
            "cd_categoria" => fake()->numberBetween(1, 9),
            "cd_localizacao" => fake()->numberBetween(1, 7),
            "cd_realizador" => fake()->numberBetween(1, 3),
            "vl_valor" => fake()->randomFloat(2, 20, 3000),
            "nm_registro" => "Indefinido",
            "ic_pago" => $bool[array_rand([$bool])],
            "ic_status" => $bool[array_rand([$bool])],
            "dt_pagamento" => fake()->date(),
            "ds_descricao" => fake()->text(255),
        ];
    }
}
