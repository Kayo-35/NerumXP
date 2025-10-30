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
            "cd_localizacao" => fake()->numberBetween(1, 7),
            "cd_realizador" => fake()->numberBetween(1, 3),
            "vl_valor" => fake()->randomFloat(2, 20, 3000),
            "nm_registro" => "Indefinido",
            "ic_pago" => $bool[array_rand($bool)],
            "ic_status" => $bool[array_rand(($bool))],
            "dt_pagamento" => fake()
                ->dateTimeBetween("-2 years", "now")
                ->format("Y-m-d"),
            "ds_descricao" => fake()->text(255),
            //Para testes geração de datas aleatórias é melhor
            "created_at" => fake()->dateTimeBetween("-2 years", "now"),
            "updated_at" => fake()->dateTimeBetween("-2 years", "now"),
        ];
    }
    public function flutuante()
    {
        return $this->state(function (array $attributes) {
            $capitalizacao = [1, 1, 1, 1, 6, 12];
            $user = User::find($attributes["cd_usuario"]);
            if ($user && $user->cd_assinatura > 1) {
                return [
                    "cd_categoria" => fake()->numberBetween(1, 9),
                    "cd_modalidade" => 2,
                    "cd_tipo_juro" => fake()->numberBetween(1, 2),
                    "pc_taxa_juros" => fake()->randomFloat(3, 0.1, 30),
                    "qt_meses_incidencia" =>
                        $capitalizacao[array_rand($capitalizacao)],
                    "dt_vencimento" => fake()
                        ->dateTimeBetween("-2 years", "5 years")
                        ->format("Y-m-d"),
                ];
            }
            return [];
        });
    }
    public function renda()
    {
        return $this->state(function () {
            $fontesRenda = [1,7,8];
            return [
                'cd_categoria' => $fontesRenda[array_rand($fontesRenda)]
            ];
        });
    }
    public function despesa()
    {
        return $this->state(function () {
            $fontesDespesa = [2,3,4,5,6];
            return [
                'cd_categoria' => $fontesDespesa[array_rand($fontesDespesa)]
            ];
        });
    }
}
