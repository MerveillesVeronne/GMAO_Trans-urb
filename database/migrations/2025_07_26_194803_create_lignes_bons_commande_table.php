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
        Schema::create('lignes_bons_commande', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bon_commande_id')->constrained('bons_commande')->onDelete('cascade');
            $table->string('produit');
            $table->text('description');
            $table->integer('quantite_demandee');
            $table->integer('quantite_satisfaite')->default(0);
            $table->decimal('cout_unitaire_estime', 12, 2);
            $table->decimal('cout_total_estime', 12, 2);
            $table->string('unite');
            $table->enum('statut', ['en_attente', 'partiellement_satisfait', 'satisfait'])->default('en_attente');
            $table->text('commentaires')->nullable();
            $table->timestamps();

            $table->index(['bon_commande_id', 'statut']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lignes_bons_commande');
    }
};
