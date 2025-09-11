<?php

namespace Database\Seeders;

use Database\Seeders\AmostraInicial;
use Database\Seeders\Base;
use Database\Seeders\RegistroPivotSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\NamesSeeder;
use Database\Seeders\MetaPivotSeeder;
use Database\Seeders\MetasNamesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AmostraInicial::class);
        $this->call(Base::class);
        $this->call(RegistroPivotSeeder::class);
        $this->call(NamesSeeder::class);
        $this->call(MetaPivotSeeder::class);
        $this->call(MetasNamesSeeder::class);
    }
}
