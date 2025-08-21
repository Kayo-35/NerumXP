<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Personas\User;
use App\Models\Recursos\RegistroFixo;
use App\Models\Recursos\RegistroFlutuante;

class Base extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(5)->create();
        RegistroFixo::factory(100)->create();
        RegistroFlutuante::factory(30)->create();
    }
}
