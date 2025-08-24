<?php

namespace Database\Factories\Recursos;
use App\Models\Personas\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categorizadores\Pagamento\FormaPagamento;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recursos\RegistroFlutuante>
 */
class RegistroFlutuanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bool = [true,false];
        return [
            "cd_usuario" => fake()->numberBetween(1,User::max('cd_usuario')),
            "cd_forma_pagamento" => fake()->numberBetween(
                1,
                FormaPagamento::max("cd_tipo_forma"),
            ),
            "cd_tipo_registro" => fake()->numberBetween(1,2),
            "cd_tipo_juro" => fake()->numberBetween(1,2),
            "cd_nivel_imp" => fake()->numberBetween(1,5),
            "cd_categoria" => fake()->numberBetween(1,9),
            "cd_localizacao" => fake()->numberBetween(1,7),
            "cd_realizador" => fake()->numberBetween(1,3),
            "nm_registro" => fake()->word(),
            "vl_valor_registro" => fake()->numberBetween(50,3000),
            "ic_pago" => $bool[array_rand([$bool])],
            "ic_status" => $bool[array_rand([$bool])],
            "pc_taxa_juros" => fake()->randomFloat(2,1,99),
            "dt_pagamento" => fake()->date(),
            "dt_vencimento" => fake()->date(),
            "ds_descricao" => fake()->text(255)
        ];
    }
}
