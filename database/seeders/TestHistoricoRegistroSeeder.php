<?php

namespace Database\Seeders;

use App\Models\Personas\User;
use App\Models\Recursos\Registro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestHistoricoRegistroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Obtenho uma coleção de registros para os servir como cobaia
        $usuariosValidos = User::pluck('cd_usuario')->toArray();

        $registrosAmostra = Registro::whereIn('cd_usuario', $usuariosValidos)
            ->get()
            ->random(rand(10, 15));


        //Atualizar uma quantia x o registro, gerando entradas de histórico
        $registrosAmostra->each(function ($registro) {
            for ($i = 0; $i <= rand(5, 12); $i++) {
                //Permite a variação
                $aumento = fake()->boolean(60);
                //Recorda a nova data
                $timeStamp = fake()->dateTimeBetween(startDate: $registro->updated_at, endDate: ('+ 1 months'));

                $registro->update([
                    "vl_valor" => $aumento
                        ? $registro->vl_valor + fake()->randomFloat(2, 30, 200)
                        : $registro->vl_valor - fake()->randomFloat(2, 30, 200),
                    "updated_at" => $timeStamp
                ]);
            }
        });
    }
}
