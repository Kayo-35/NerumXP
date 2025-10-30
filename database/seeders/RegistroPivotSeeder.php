<?php

namespace Database\Seeders;

use App\Models\Categorizadores\Pagamento\MetodoPagamento;
use App\Models\Recursos\Registro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistroPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = Registro::all();
        $metodos = MetodoPagamento::all();

        //Criando associações de registrosFixos a métodos de pagamento
        $registros->each(function ($registro) use ($metodos) {
            $registro->metodo_pagamento()->attach(
                $metodos
                    ->random(rand(1, count($metodos)))
                    ->pluck("cd_metodo")
                    ->toArray(),
            );
        });
        // Responsável por atribuir categorias condizentes com os tipos de registro
        // Renda provenientes apenas de salários, investimentos, outros e alimentação(vales)
        // Despesa as demais categorias, incluindo outros
        $registros->each(function ($registro) {
            $fontesRenda = [1,7,8,9];
            $fontesDespesa = [2,3,4,5,6,9];
            $registro->update([
                'cd_categoria' => in_array($registro->cd_tipo_registro, $fontesRenda)
                    ? $fontesRenda[array_rand($fontesRenda)]
                    : $fontesDespesa[array_rand($fontesDespesa)],
            ]);
        });
    }
}
