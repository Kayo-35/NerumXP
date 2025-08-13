<?php
namespace Database\Seeders;
use Database\Seeders\AmostraInicial;
use Database\Seeders\Base;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AmostraInicial::class);
        $this->call(Base::class);
    }
}
