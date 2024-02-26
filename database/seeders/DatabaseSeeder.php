<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(KonsultasiSeeder::class);
        $this->call(DisiSeeder::class);
        $this->call(EmotalSeeder::class);
        $this->call(NutrisiSeeder::class);
        $this->call(PengasuhanSeeder::class);
        $this->call(ArtikelSeeder::class);
    }
}