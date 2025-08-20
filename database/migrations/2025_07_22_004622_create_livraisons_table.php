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
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained('commandes')->onDelete('cascade'); // Commande associée
            $table->foreignId('ligne_commande_id')->constrained('ligne_commandes')->onDelete('cascade'); // Ligne de commande
            $table->date('date_livraison'); // Date de livraison effective
            $table->integer('quantite_livree'); // Quantité réellement livrée
            $table->integer('quantite_commandee'); // Quantité qui était commandée
            $table->text('commentaires')->nullable(); // Commentaires sur la livraison
            $table->enum('statut', ['partielle', 'complete', 'retard'])->default('complete'); // Statut de la livraison
            $table->foreignId('valide_par')->nullable()->constrained('users')->onDelete('set null'); // Agent qui a validé
            $table->timestamp('valide_le')->nullable(); // Date de validation
            $table->timestamps();
            
            // Index pour optimiser les recherches
            $table->index('date_livraison');
            $table->index('statut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
