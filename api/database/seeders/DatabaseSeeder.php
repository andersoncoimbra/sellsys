<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{
    User,
    Vendedor
};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cria 10 vendedores, cada um com 5 vendas
        Vendedor::factory()
            ->count(10)
            ->hasVendas(5) // relacionamento definido no model Vendedor
            ->create();

    }
}
