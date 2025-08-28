<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nomes = [
            [
                "Comprar mantimentos",
                "Jantar fora",
                "Preparar refeições em casa",
                "Pedir delivery",
                "Fazer compras no mercado orgânico",
                "Experimentar nova culinária",
                "Fazer um piquenique",
            ],
            [
                "Abastecer o carro",
                "Usar transporte público",
                "Manutenção do veículo",
                "Comprar passagens aéreas",
                "Pagar estacionamento",
                "Alugar um carro",
                "Usar aplicativo de transporte",
            ],
            [
                "Pagar aluguel/prestação da casa",
                "Contas de água e luz",
                "Manutenção da casa",
                "Comprar móveis",
                "Impostos da propriedade",
                "Reforma/Decoração",
                "Seguro residencial",
            ],
            [
                "Consulta médica",
                "Comprar medicamentos",
                "Plano de saúde",
                "Academia",
                "Exames de rotina",
                "Sessões de fisioterapia",
                "Tratamento odontológico",
            ],
            [
                "Mensalidade escolar/universidade",
                "Comprar livros",
                "Cursos online",
                "Material didático",
                "Pós-graduação",
                "Aulas particulares",
                "Workshops",
            ],
            [
                "Ir ao cinema",
                "Viajar",
                "Sair com amigos",
                "Hobbies",
                "Eventos culturais",
                "Praticar esportes",
                "Visitar museus",
            ],
            [
                "Receber salário",
                "Bônus",
                "Renda extra",
                "Comissão",
                "Férias remuneradas",
                "Aumento de salário",
                "Dividendos",
            ],
            [
                "Aplicar em ações",
                "Poupança",
                "Fundos de investimento",
                "Previdência privada",
                "Criptomoedas",
                "Imóveis",
                "Tesouro Direto",
            ],
            [
                "Compras diversas",
                "Doações",
                "Presentes",
                "Despesas inesperadas",
                "Multas",
                "Serviços de beleza",
                "Assinaturas de streaming",
            ],
        ];
        DB::table("registro")
            ->where("cd_categoria", "=", 1)
            ->update(["nm_registro" => $nomes[0][array_rand($nomes[0])]]);

        DB::table("registro")
            ->where("cd_categoria", "=", 2)
            ->update(["nm_registro" => $nomes[1][array_rand($nomes[1])]]);

        DB::table("registro")
            ->where("cd_categoria", "=", 3)
            ->update(["nm_registro" => $nomes[2][array_rand($nomes[2])]]);

        DB::table("registro")
            ->where("cd_categoria", "=", 4)
            ->update(["nm_registro" => $nomes[3][array_rand($nomes[3])]]);

        DB::table("registro")
            ->where("cd_categoria", "=", 5)
            ->update(["nm_registro" => $nomes[4][array_rand($nomes[4])]]);

        DB::table("registro")
            ->where("cd_categoria", "=", 6)
            ->update(["nm_registro" => $nomes[5][array_rand($nomes[5])]]);

        DB::table("registro")
            ->where("cd_categoria", "=", 7)
            ->update(["nm_registro" => $nomes[6][array_rand($nomes[6])]]);

        DB::table("registro")
            ->where("cd_categoria", "=", 8)
            ->update(["nm_registro" => $nomes[7][array_rand($nomes[7])]]);

        DB::table("registro")
            ->where("cd_categoria", "=", 9)
            ->update(["nm_registro" => $nomes[8][array_rand($nomes[8])]]);
    }
}
