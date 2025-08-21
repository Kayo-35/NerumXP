<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmostraInicial extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("assinatura")->insert([
            ["nm_assinatura" => "Bronze"],
            ["nm_assinatura" => "Prata"],
            ["nm_assinatura" => "Ouro"],
        ]);

        DB::table("nivel_imp")->insert([
            ["sg_nivel_imp" => "N1"],
            ["sg_nivel_imp" => "N2"],
            ["sg_nivel_imp" => "N3"],
            ["sg_nivel_imp" => "N4"],
            ["sg_nivel_imp" => "N5"],
        ]);

        DB::table("categoria")->insert([
            ["nm_categoria" => "Alimentação"],
            ["nm_categoria" => "Transporte"],
            ["nm_categoria" => "Moradia"],
            ["nm_categoria" => "Saúde"],
            ["nm_categoria" => "Educação"],
            ["nm_categoria" => "Lazer"],
            ["nm_categoria" => "Salário"],
            ["nm_categoria" => "Investimetnos"],
            ["nm_categoria" => "Outros"],
        ]);

        DB::table("forma_pagamento")->insert([
            ["nm_tipo_metodos" => "Parcelado"],
            ["nm_tipo_metodos" => "A vista"],
        ]);

        DB::table("localizacao")->insert([
            ["nm_localizacao" => "Casa"],
            ["nm_localizacao" => "Supermercado"],
            ["nm_localizacao" => "Trabalho"],
            ["nm_localizacao" => "Restaurante"],
            ["nm_localizacao" => "Online"],
            ["nm_localizacao" => "Academia"],
            ["nm_localizacao" => "Viagem"],
        ]);

        DB::table("metodo_pagamento")->insert([
            ["nm_tipo_metodo" => "Cartão de Crédito"],
            ["nm_tipo_metodo" => "Cartão de Débito"],
            ["nm_tipo_metodo" => "Dinheiro em Espécie"],
            ["nm_tipo_metodo" => "Transferência Bancária"],
            ["nm_tipo_metodo" => "Pix"],
        ]);

        DB::table("realizador_transacao")->insert([
            [
                "nm_realizador" => "João Silva",
                "ds_realizador" => "Meu primo, ajudando",
            ],
            [
                "nm_realizador" => "Carla Gonçaves",
                "ds_realizador" => "Minha tia, ajudando",
            ],
            [
                "nm_realizador" => "Gerônimo Borges",
                "ds_realizador" => "Meu avô, ajudando",
            ],
        ]);

        DB::table("registro_tipo_juros")->insert([
            ["nm_tipo_juro" => "Simples"],
            ["nm_tipo_juro" => "Composto"],
        ]);

        DB::table("tipo_historico")->insert([
            ["nm_tipo_hist" => "Receita"],
            ["nm_tipo_hist" => "Despesa"],
            ["nm_tipo_hist" => "Tranferência"],
        ]);

        DB::table("tipo_registro")->insert([
            ["nm_tipo" => "Renda"],
            ["nm_tipo" => "Despesa"],
        ]);
    }
}
