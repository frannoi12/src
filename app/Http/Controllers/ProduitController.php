<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input("search");
        $pagination_number = 10;
        if($search){
            $produits = Produit::where("libelle","like", "%".$search."%")
                        ->orWhere("prix","like", "%".$search."%")
                        ->orWhere("quantite","like", "%".$search."%")
                        ->paginate($pagination_number);
        }else{
            $produits = Produit::paginate($pagination_number);
        }

        return view('produits.index',compact('produits',"search"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("produits.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|string|max:255',
            'prix' => 'required|integer',
            'quantite' => 'required|integer',
        ]);

        // dd($request->input("image"));


        $produit = new Produit();
        $produit->libelle = $request->libelle;
        $produit->prix = $request->prix;
        $produit->quantite = $request->quantite;
        $path = $request->file('image'); // 'public/images' est le répertoire de stockage
        $produit->image = str_replace('public/', '', $path); // Mettez à jour le chemin de stockage dans la base de données
        $produit->save();
        return redirect()->route('produits.index');
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
        return view('produits.edit', compact('produit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'prix' => 'required|integer',
            'quantite' => 'required|integer',
        ]);

        $produit = Produit::findOrFail($produit->id);
        $produit->libelle = $request->libelle;
        $produit->prix = $request->prix;
        $produit->quantite = $request->quantite;
        $produit->save();

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
