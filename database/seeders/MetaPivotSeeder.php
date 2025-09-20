<?php

namespace Database\Seeders;

use App\Models\Categorizadores\Gerais\Categoria;
use App\Models\Personas\User;
use App\Models\Recursos\Metas;
use App\Models\Recursos\Registro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetaPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metas = Metas::all();
        $categorias = Categoria::all();
        $registros = Registro::all();

        //Associando metas a categorias usando a tabela pivot(associativa)
        $metas->each(function ($meta) use ($categorias) {
            $meta->categoria()->attach(
                $categorias->random(rand(1, 3))
                    ->pluck('cd_categoria')
                    ->toArray()
            );
        });
        //Mesmo principio, mas registros tem de ser os das categorias selecionadas :)
        $metas->each(function ($meta) use ($registros) {
            $tiposRenda = [1, 2];
            $categoriaRegistro = $meta->categoria()->pluck('categoria.cd_categoria')->toArray();

            $cd_tipo_registro = in_array($meta->cd_tipo_meta, $tiposRenda) ? 1 : 2;

            //Obtendo a quantidade máxima de registros por categoria e demais constraints
            $registrosPorCategoria = Registro::select('cd_categoria', DB::raw('COUNT(cd_categoria) as max'))
                ->where('cd_usuario','=',$meta->cd_usuario)
                ->where('cd_tipo_registro',$cd_tipo_registro)
                ->groupBy('cd_categoria')
                ->get()
                ->toArray();

            //Associa de 0 até o maximo de registros existentes na categoria
            foreach ($registrosPorCategoria as $data) {
                $meta->registro()->attach(
                    $registros
                        ->where('cd_usuario', '=', $meta->cd_usuario)
                        ->where('cd_tipo_registro', '=', $cd_tipo_registro)
                        ->where('cd_categoria', '=', $data['cd_categoria'])
                        ->random(rand(0, $data['max']))
                        ->pluck('cd_registro')
                        ->toArray()
                );
            }
        });

        //Atribuir valor para renda
        $metas->each(function ($meta) {
            $tipo_meta = $meta->tipo()->first()->cd_tipo_meta;
            switch ($tipo_meta) {
                case 1: //Metas de Alcançar valor fixo(renda)
                case 2: //Metas de Poupar
                case 3: //Metas de Limitar valor fixo(despesa)
                    $meta->update([
                        'vl_valor_meta' => fake()->randomFloat(2, 200, 10000),
                        'vl_valor_progresso' => fake()->randomFloat(2, 0, 10000)
                    ]);
                    break;
                case 4: //Limitar valor por categoria
                    $meta->update([
                        'vl_valor_meta' => fake()->randomFloat(2, 50, 4000),
                        'vl_valor_progresso' => fake()->randomFloat(2, 0, 4000)
                    ]);
                    break;
                case 5: //Limitar valor por percentagem geral
                    $meta->update([
                        'pc_meta' => fake()->randomFloat(3, 10, 90),
                        'pc_progresso' => fake()->randomFloat(3, 10, 75),
                    ]);
                    break;
                case 6: //Limitar valor por percentagem de categoria
                    $meta->update([
                        'pc_meta' => fake()->randomFloat(3, 10, 40),
                        'pc_progresso' => fake()->randomFloat(3, 10, 30),
                    ]);
                    break;
            }
        });
    }
}
