<?php

namespace Database\Seeders;

use App\Models\Produit;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'toyi frannois',
            'email' => 'toyifrancois@gmail.com',
            'password' =>Hash::make("93516499"),
        ]);

        Produit::factory()->count(20)->create();
    }
}
