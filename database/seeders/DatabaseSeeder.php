<?php
namespace Database\Seeders;
use Database\Seeders\AmostraInicial;
use Database\Seeders\Base;
use Database\Seeders\RegistroFixoPivotSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\NamesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AmostraInicial::class);
        $this->call(Base::class);
        $this->call(RegistroFixoPivotSeeder::class);
        $this->call(NamesSeeder::class);
    }
}
