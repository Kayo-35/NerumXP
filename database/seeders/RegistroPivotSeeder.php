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
    }
}
