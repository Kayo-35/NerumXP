<?php

namespace Database\Seeders;

use App\Models\Categorizadores\Pagamento\FormaPagamento;
use App\Models\Categorizadores\Pagamento\MetodoPagamento;
use App\Models\Recursos\RegistroFixo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistroFixoPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = RegistroFixo::all();
        $metodos = MetodoPagamento::all();
        $formas = FormaPagamento::all();

        //Criando associações de registrosFixos a métodos de pagamento
        $registros->each(function ($registro) use ($metodos) {
            $registro->metodo_pagamento()->attach(
                $metodos->random(rand(1,count($metodos)))
                    ->pluck("cd_tipo_metodo")
                    ->toArray()
            );
        });
    }
}
