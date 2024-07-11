<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input("search");
        $pagination_number = 5;
        if ($search) {
            $produits = Produit::where("libelle", "like", "%" . $search . "%")
                ->orWhere("prix", "like", "%" . $search . "%")
                ->orWhere("quantite", "like", "%" . $search . "%")
                ->paginate($pagination_number);
        } else {
            $produits = Produit::paginate($pagination_number);
        }

        return view('produits.index', compact('produits', "search"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("produits.create_or_edit");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Définir les règles de validation
        $validatedData = $request->validate([
            'libelle' => 'required|unique:produits,libelle|string|max:255',
            'prix' => 'required|integer',
            'quantite' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Règles pour l'image
        ]);

        // Manipulation des données
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // dd($validatedData);

        // Créer un nouveau produit
        $produit = new Produit();
        $produit->libelle = $validatedData['libelle'];
        $produit->prix = $validatedData['prix'];
        $produit->quantite = $validatedData['quantite'];
        if (isset($validatedData['image'])) {
            $produit->image = $validatedData['image'];
        }

        $produit->save();

        return redirect()->route('produits.index')->with('success', 'Produit créé avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        $produit = Produit::findOrFail($produit->id);
        return view('produits.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        $produit = Produit::findOrFail($produit->id);
        return view('produits.create_or_edit', compact('produit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        // Définir les règles de validation
        $validatedData = $request->validate([
            'libelle' => 'required|string|max:255|unique:produits,libelle,' . $produit->id,
            'prix' => 'required|integer',
            'quantite' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Règles pour l'image
        ]);

        // Recherche du produit par son ID
        $produit = Produit::findOrFail($produit->id);

        // Mise à jour des champs du produit
        $produit->libelle = $validatedData['libelle'];
        $produit->prix = $validatedData['prix'];
        $produit->quantite = $validatedData['quantite'];

        // Vérification et stockage de la nouvelle image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($produit->image) {
                Storage::disk('public')->delete($produit->image);
            }

            // Stocker la nouvelle image
            $imagePath = $request->file('image')->store('images', 'public');
            $produit->image = $imagePath;
        }

        // Enregistrer les modifications
        $produit->save();

        // Rediriger avec un message de succès
        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        // dd($produit);
        $produit = Produit::findOrFail($produit->id);
        $produit->delete();
        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès');
    }
}
