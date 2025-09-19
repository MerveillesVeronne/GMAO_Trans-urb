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
        Schema::create('carburations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicule_id')->constrained('vehicules')->onDelete('cascade');
            $table->foreignId('chauffeur_id')->constrained('users')->onDelete('cascade');
            $table->date('date_carburation');
            $table->time('heure_carburation');
            $table->decimal('quantite_litres', 8, 2);
            $table->decimal('prix_litre', 8, 2);
            $table->decimal('cout_total', 10, 2);
            $table->enum('etat', ['Planifiée', 'Effectuée', 'Annulée'])->default('Planifiée');
            $table->enum('type_carburation', ['Essence', 'Diesel', 'GPL', 'Électrique'])->default('Diesel');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carburations');
    }
};
