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
            $table->id();
            $table->foreignId('commande_id')->constrained('commandes')->onDelete('cascade'); // Commande parente
            $table->string('produit'); // Nom du produit
            $table->text('description')->nullable(); // Description détaillée
            $table->integer('quantite'); // Quantité commandée
            $table->decimal('cout_unitaire', 15, 2)->nullable(); // Coût unitaire
            $table->decimal('total_ligne', 15, 2)->default(0); // Total de la ligne (quantité * coût unitaire)
            $table->text('incidents')->nullable(); // Incidents liés à cette ligne
            $table->text('commentaires')->nullable(); // Commentaires spécifiques à cette ligne
            $table->enum('statut_ligne', ['en_attente', 'approuvee', 'livree', 'annulee'])->default('en_attente'); // Statut de cette ligne
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
