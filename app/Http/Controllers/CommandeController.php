<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Http\Request;
use Ismaelw\LaraTeX\LaraTeX;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input("search");
        $pagination_number = 10;

        // Recherche des commandes par client, montant ou vendeur_id
        if ($search) {
            $commandes = Commande::where("client", "like", "%" . $search . "%")
                ->orWhere("montant", "like", "%" . $search . "%")
                ->orWhere("vendeur_id", "like", "%" . $search . "%")
                ->paginate($pagination_number);
        } else {
            $commandes = Commande::paginate($pagination_number);
        }

        return view('commandes.index', compact('commandes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupération des utilisateurs pour le champ vendeur_id
        $vendeurs = User::pluck('name', 'id');

        return view('commandes.create', compact('vendeurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'client' => 'required|string|max:255',
            'montant' => 'required|integer',
            'vendeur_id' => 'required|exists:users,id',
        ]);

        // Création de la commande
        $commande = new Commande();
        $commande->client = $request->client;
        $commande->date = now(); // Date du jour
        $commande->montant = $request->montant;
        $commande->vendeur_id = $request->vendeur_id;
        $commande->save();

        return redirect()->route('commandes.index')->with('success', 'Commande créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        // Récupération des données nécessaires pour la vue show
        $vendeur = $commande->vendeur()->first();

        return view('commandes.show', compact('commande', 'vendeur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)
    {
        // Récupération des utilisateurs pour le champ vendeur_id
        $vendeurs = User::pluck('name', 'id');

        return view('commandes.edit', compact('commande', 'vendeurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commande $commande)
    {
        // Validation des données
        $request->validate([
            'client' => 'required|string|max:255',
            'montant' => 'required|integer',
            'vendeur_id' => 'required|exists:users,id',
        ]);

        // Mise à jour de la commande
        $commande->client = $request->client;
        $commande->montant = $request->montant;
        $commande->vendeur_id = $request->vendeur_id;
        $commande->save();

        return redirect()->route('commandes.index')->with('success', 'Commande mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        // Suppression de la commande
        $commande->delete();

        return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès');
    }

    public function generer_facture(Commande $commande){
        // dd($commande->lignecommandes[0]->produit);
        // dd($prod);
        return (new LaraTeX("latex.facture"))->with(["commande"=>$commande,'ligneCommandes' => $commande->lignecommandes,])->download("Facture.pdf");
    }
}
