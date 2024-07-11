<?php

namespace App\Http\Controllers;

use App\Models\LigneCommande;
use Illuminate\Http\Request;

class LigneCommandeController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index( Request $request ) {
        $search = $request->input( 'search' );
        $pagination_number = 10;

        if ( $search ) {
            $ligneCommandes = LigneCommande::where( 'quantite', 'like', '%' . $search . '%' )
            ->orWhere( 'produit_id', 'like', '%' . $search . '%' )
            ->orWhere( 'commande_id', 'like', '%' . $search . '%' )
            ->paginate( $pagination_number );
        } else {
            $ligneCommandes = LigneCommande::paginate( $pagination_number );
        }

        return view( 'ligneCommandes.index', compact( 'ligneCommandes', 'search' ) );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        return view( 'ligneCommandes.create' );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {
        $validatedData = $request->validate( [
            'quantite' => 'required|integer',
            'produit_id' => 'required|exists:produits,id',
            'commande_id' => 'required|exists:commandes,id',
        ] );

        LigneCommande::create( $validatedData );

        return redirect()->route( 'ligneCommandes.index' )->with( 'success', 'Ligne de commande ajoutée avec succès.' );
    }

    /**
    * Display the specified resource.
    */

    public function show( LigneCommande $ligneCommande ) {
        //
        return view( 'ligneCommandes.show', compact( 'ligneCommande' ) );
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( LigneCommande $ligneCommande ) {
        //
        return view( 'ligneCommandes.edit', compact( 'ligneCommande' ) );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, LigneCommande $ligneCommande ) {
        //
        $validatedData = $request->validate( [
            'quantite' => 'required|integer',
            'produit_id' => 'required|exists:produits,id',
            'commande_id' => 'required|exists:commandes,id',
        ] );

        $ligneCommande->update( $validatedData );

        return redirect()->route( 'ligneCommandes.index' )->with( 'success', 'Ligne de commande mise à jour avec succès.' );
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( LigneCommande $ligneCommande ) {
        //
        $ligneCommande->delete();

        return redirect()->route( 'ligneCommandes.index' )->with( 'success', 'Ligne de commande supprimée avec succès.' );
    }
}
