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
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->unsignedBigInteger('fournisseur_id');
            $table->string('intitule');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->decimal('montant', 15, 2);
            $table->enum('statut', ['actif', 'suspendu', 'renouvele', 'resilie', 'expire'])->default('actif');
            $table->text('description')->nullable();
            $table->enum('type', ['assurance', 'fourniture', 'service', 'maintenance'])->nullable();
            
            // Champs pour la traçabilité
            $table->date('date_debut_initiale'); // Date de début originale (jamais modifiée)
            $table->date('date_fin_initiale');   // Date de fin originale
            $table->decimal('montant_initial', 15, 2); // Montant initial
            $table->integer('jours_suspension')->default(0);
            $table->integer('nombre_renouvellements')->default(0);
            $table->date('date_resiliation')->nullable();
            $table->text('raison_resiliation')->nullable();
            
            $table->timestamps();
            
            // Clé étrangère vers la table fournisseurs
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrats');
    }
};
