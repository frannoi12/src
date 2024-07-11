<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Commande;
use App\Models\LigneCommande;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Seeder de commande

        User::create([
            'name' => 'toyi francois',
            'email' => 'toyifrancois1@gmail.com',
            'password' =>Hash::make("93516499k"),
        ]);
        $vendeur = User::create([
            'name' => 'vendeur',
            'email' => 'vendeurUn@gmail.com',
            'password' =>Hash::make("vendeur93"),
        ]);

        $commande_un = Commande::create([
            "client" => "client 1",
            "vendeur_id" => $vendeur->id ,
        ]);

        LigneCommande::create([
            "produit_id" => 1,
            "commande_id" => $commande_un->id,
            "quantite" => 6
        ]);

        LigneCommande::create([
            "produit_id" => 2,
            "commande_id" => $commande_un->id,
            "quantite" => 2
        ]);

        LigneCommande::create([
            "produit_id" => 3,
            "commande_id" => $commande_un->id,
            "quantite" => 4
        ]);



        Commande::create([
            "vendeur_id" => $vendeur->id ,
            "client" => "client 2",
        ]);
    }
}
