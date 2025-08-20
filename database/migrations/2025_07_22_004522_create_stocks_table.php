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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('produit'); // Nom du produit
            $table->text('description')->nullable(); // Description du produit
            $table->integer('quantite_disponible')->default(0); // Quantité en stock
            $table->integer('quantite_minimale')->default(0); // Seuil d'alerte
            $table->string('unite')->default('unité'); // Unité de mesure
            $table->string('emplacement')->nullable(); // Emplacement dans l'entrepôt
            $table->decimal('cout_unitaire', 15, 2)->nullable(); // Coût unitaire moyen
            $table->string('categorie')->nullable(); // Catégorie du produit
            $table->boolean('actif')->default(true); // Si le produit est toujours utilisé
            $table->timestamps();
            
            // Index pour optimiser les recherches
            $table->index('produit');
            $table->index('categorie');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
