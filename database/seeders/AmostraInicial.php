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
        DB::table("modalidade")->insert([
            ["nm_modalidade" => "Fixo"],
            ["nm_modalidade" => "Flutuante"],
        ]);
        DB::table("assinatura")->insert([
            ["nm_assinatura" => "Bronze"],
            ["nm_assinatura" => "Prata"],
            ["nm_assinatura" => "Ouro"],
        ]);

        DB::table("nivel_imp")->insert([
            ["sg_nivel_imp" => "Mínima"],
            ["sg_nivel_imp" => "Baixa"],
            ["sg_nivel_imp" => "Média"],
            ["sg_nivel_imp" => "Alta"],
            ["sg_nivel_imp" => "Urgente"],
        ]);

        DB::table("categoria")->insert([
            ["nm_categoria" => "Alimentação"],
            ["nm_categoria" => "Transporte"],
            ["nm_categoria" => "Moradia"],
            ["nm_categoria" => "Saúde"],
            ["nm_categoria" => "Educação"],
            ["nm_categoria" => "Lazer"],
            ["nm_categoria" => "Salário"],
            ["nm_categoria" => "Investimentos"],
            ["nm_categoria" => "Outros"],
        ]);

        DB::table("forma_pagamento")->insert([
            ["nm_forma" => "Parcelado"],
            ["nm_forma" => "A vista"],
            ["nm_forma" => "Recorrente"],
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
            ["nm_metodo" => "Cartão de Crédito"],
            ["nm_metodo" => "Cartão de Débito"],
            ["nm_metodo" => "Dinheiro em Espécie"],
            ["nm_metodo" => "Transferência Bancária"],
            ["nm_metodo" => "Pix"],
            ["nm_metodo" => "Vale Alimentação"],
            ["nm_metodo" => "Vale Refeição"],
        ]);

        DB::table("realizador_transacao")->insert([
            [
                "nm_realizador" => "Pais",
                "ds_realizador" => "Pai, ajudando",
            ],
            [
                "nm_realizador" => "Filhos",
                "ds_realizador" => "Meus filhos, ajudando",
            ],
            [
                "nm_realizador" => "Avós",
                "ds_realizador" => "Meu avô, ajudando",
            ],
            [
                "nm_realizador" => "Irmãos",
                "ds_realizador" => "Irmãos, ajudando",
            ],
        ]);

        DB::table("registro_tipo_juros")->insert([
            ["nm_tipo_juro" => "Simples"],
            ["nm_tipo_juro" => "Composto"],
        ]);

        DB::table("tipo_historico")->insert([
            ["nm_tipo_historico" => "Receita"],
            ["nm_tipo_historico" => "Despesa"],
            ["nm_tipo_historico" => "Tranferência"],
        ]);

        DB::table("tipo_registro")->insert([
            ["nm_tipo" => "Renda"],
            ["nm_tipo" => "Despesa"],
        ]);

        DB::table("tipo_metas")->insert([
            [
                "cd_tipo_registro" => 1,
                "nm_meta" => 'Alcançar',
                "ic_percentual" => false
            ],
            [
                "cd_tipo_registro" => 1,
                "nm_meta" => 'Poupar',
                "ic_percentual" => false
            ],
            [
                "cd_tipo_registro" => 2,
                "nm_meta" => 'Limitar gastos geral',
                "ic_percentual" => false
            ],
            [
                "cd_tipo_registro" => 2,
                "nm_meta" => 'Limitar gastos categoria',
                "ic_percentual" => false
            ],
            [
                "cd_tipo_registro" => 2,
                "nm_meta" => 'Limitar %gastos geral',
                "ic_percentual" => true
            ],
            [
                "cd_tipo_registro" => 2,
                "nm_meta" => 'Limitar %gastos categoria',
                "ic_percentual" => true
            ],
        ]);
    }
}
