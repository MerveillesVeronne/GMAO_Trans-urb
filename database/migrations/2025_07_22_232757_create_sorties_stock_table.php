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
        Schema::create('sorties_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_id')->constrained('stocks')->onDelete('cascade');
            $table->string('reference_produit'); // Référence unique du produit
            $table->integer('quantite_sortie');
            $table->string('unite');
            $table->decimal('cout_unitaire', 12, 2);
            $table->decimal('cout_total', 12, 2);
            
            // Traçabilité complète
            $table->string('service_destinataire'); // Service qui reçoit
            $table->string('personne_destinataire'); // Nom de la personne
            $table->string('poste_destinataire'); // Poste/grade de la personne
            $table->string('motif_sortie'); // Raison de la sortie
            
            // Informations de validation
            $table->foreignId('valide_par')->constrained('users');
            $table->timestamp('valide_le')->useCurrent();
            $table->text('commentaires')->nullable();
            
            // Statut de la sortie
            $table->enum('statut', ['validee', 'annulee'])->default('validee');
            
            $table->timestamps();
            
            // Index pour optimiser les recherches
            $table->index(['stock_id', 'created_at']);
            $table->index('service_destinataire');
            $table->index('personne_destinataire');
            $table->index('reference_produit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sorties_stock');
    }
};
