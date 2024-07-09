<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ligne_commandes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantite');
            $table->bigInteger('produit_id');
            $table->bigInteger('commande_id');
            $table->foreign('produit_id')->references('id')->on('produits')->nullOnDelete();
            $table->foreign('commande_id')->references('id')->on('commandes')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligne_commandes');
    }
};
