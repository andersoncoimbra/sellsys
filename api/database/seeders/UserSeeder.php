<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email',  'admin@teste.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' =>  'admin@teste.com',
                'password' => Hash::make('senha123'),
            ]);
        }
    }
}
