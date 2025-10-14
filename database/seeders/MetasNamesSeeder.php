<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetasNamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $nomesRenda = [
            1 => [
                "Vender produtos caseiros",
                "Abrir um negocio de delivery",
                "Monetizar receitas online",
                "Trabalhar em eventos gastronomicos",
                "Oferecer consultoria nutricional"
            ],
            2 => [
                "Oferecer servico de carona",
                "Alugar veiculo proprio",
                "Trabalhar como motorista de aplicativo",
                "Vender acessorios automotivos",
                "Prestar servico de transporte escolar"
            ],
            3 => [
                "Alugar quarto ou imovel",
                "Hospedar viajantes",
                "Oferecer espaco para coworking",
                "Realizar reformas para valorizacao",
                "Investir em imoveis para renda"
            ],
            4 => [
                "Prestar servicos de saude",
                "Vender produtos naturais",
                "Oferecer aulas de atividade fisica",
                "Trabalhar em clinicas ou consultorios",
                "Desenvolver aplicativos de saude"
            ],
            5 => [
                "Dar aulas particulares",
                "Produzir conteudo educacional",
                "Oferecer cursos online",
                "Trabalhar em escolas",
                "Escrever livros ou apostilas"
            ],
            6 => [
                "Organizar eventos culturais",
                "Vender ingressos de shows",
                "Alugar equipamentos de lazer",
                "Oferecer passeios turisticos",
                "Criar conteudo para redes sociais"
            ],
            7 => [
                "Buscar promocao no trabalho",
                "Negociar aumento salarial",
                "Mudar para emprego melhor remunerado",
                "Receber bonus por desempenho",
                "Realizar trabalhos extras"
            ],
            8 => [
                "Investir em acoes",
                "Aplicar em renda fixa",
                "Receber dividendos",
                "Investir em fundos imobiliarios",
                "Participar de startups"
            ],
            9 => [
                "Receber heranca",
                "Ganhar premios",
                "Vender objetos usados",
                "Realizar trabalhos temporarios",
                "Obter renda de direitos autorais"
            ]
        ];

        $nomesDespesa = [
            1 => [
                "Reduzir gastos com restaurantes",
                "Planejar compras mensais",
                "Evitar desperdicio de alimentos",
                "Comprar em atacado",
                "Preparar refeicoes em casa"
            ],
            2 => [
                "Economizar combustivel",
                "Utilizar transporte publico",
                "Compartilhar caronas",
                "Manter manutencao preventiva",
                "Evitar deslocamentos desnecessarios"
            ],
            3 => [
                "Reduzir consumo de energia",
                "Negociar aluguel",
                "Evitar reformas supérfluas",
                "Controlar gastos com agua",
                "Planejar compras de moveis"
            ],
            4 => [
                "Evitar consultas desnecessarias",
                "Buscar descontos em medicamentos",
                "Utilizar plano de saude",
                "Praticar prevencao",
                "Controlar gastos com academia"
            ],
            5 => [
                "Buscar bolsas de estudo",
                "Utilizar materiais gratuitos",
                "Evitar cursos desnecessarios",
                "Planejar gastos com livros",
                "Aproveitar descontos em mensalidades"
            ],
            6 => [
                "Reduzir saidas para entretenimento",
                "Aproveitar eventos gratuitos",
                "Planejar viagens com antecedencia",
                "Controlar gastos com hobbies",
                "Buscar opcoes de lazer economicas"
            ],
            7 => [
                "Evitar antecipacao de salario",
                "Controlar gastos mensais",
                "Planejar uso do decimo terceiro",
                "Evitar emprestimos",
                "Reservar parte do salario para poupanca"
            ],
            8 => [
                "Reduzir taxas de corretagem",
                "Evitar investimentos de alto risco",
                "Planejar aportes mensais",
                "Diversificar carteira",
                "Controlar gastos com consultorias"
            ],
            9 => [
                "Evitar compras por impulso",
                "Planejar presentes",
                "Controlar gastos com festas",
                "Reduzir despesas inesperadas",
                "Revisar assinaturas e servicos"
            ]
        ];

        function setNomeMeta(array $nomesRenda, int $codigo_tipo): void
        {
            foreach (array_keys($nomesRenda) as $key) {
                DB::table('metas')
                    ->join('metas_categoria', 'metas.cd_meta', '=', 'metas_categoria.cd_meta')
                    ->join('tipo_metas','metas.cd_tipo_meta','=','tipo_metas.cd_tipo_meta')
                    ->where('metas_categoria.cd_categoria', '=', $key)
                    ->where('tipo_metas.cd_tipo_registro', '=', $codigo_tipo)
                    ->update(
                        [
                            'metas.nm_meta' => $nomesRenda[$key][array_rand($nomesRenda[$key])]
                        ]
                    );
            }
        }
        setNomeMeta($nomesRenda, 1); //1 Para renda
        setNomeMeta($nomesDespesa, 2); //Para Despesas
    }
}
