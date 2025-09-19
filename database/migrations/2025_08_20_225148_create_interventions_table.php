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
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicule_id')->constrained()->onDelete('cascade');
            $table->enum('type_intervention', ['Maintenance', 'Reparation', 'Revision', 'Urgence', 'Inspection']);
            $table->enum('priorite', ['Basse', 'Normale', 'Haute', 'Urgente'])->default('Normale');
            $table->enum('statut', ['En Attente', 'En Cours', 'Terminee', 'Annulee'])->default('En Attente');
            $table->datetime('date_debut');
            $table->datetime('date_fin_prevue')->nullable();
            $table->string('technicien');
            $table->text('description');
            $table->text('pieces_necessaires')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
