<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Personas\User;
use App\Models\Recursos\Metas;
use App\Models\Recursos\Registro;

class Base extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Registro::factory(400)->renda()->create();
        Registro::factory(400)->despesa()->create();
        Registro::factory(200)->flutuante()->create();
        Metas::factory(160)->create();
    }
}
