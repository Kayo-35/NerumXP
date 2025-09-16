<?php

namespace Database\Factories\Recursos;

use App\Models\Categorizadores\Gerais\Nivel_imp;
use App\Models\Categorizadores\Metas\Tipo_Meta;
use App\Models\Personas\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recursos\Metas>
 */
class MetasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::select('cd_usuario')
                ->where('cd_assinatura', '>', 1)
                ->get()
                ->pluck('cd_usuario')
                ->toArray();
        return [
            "cd_usuario" => ($users[array_rand($users)]),
            "cd_nivel_imp" => fake()->numberBetween(1, Nivel_imp::max('cd_nivel_imp')),
            "cd_modalidade" => fake()->numberBetween(1, 2),
            "cd_tipo_meta" => fake()->numberBetween(1, Tipo_Meta::max('cd_tipo_meta')),
            "ic_recorrente" => fake()->boolean(30),
            "ic_finalizada" => fake()->boolean(40),
            "nm_meta" => 'Indefinido',
            "ds_descricao" => fake()->text(2000),
            "ic_status" => fake()->boolean(80)
        ];
    }
}
