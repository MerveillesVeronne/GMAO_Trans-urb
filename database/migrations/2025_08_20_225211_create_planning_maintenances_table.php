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
        Schema::create('planning_maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicule_id')->constrained()->onDelete('cascade');
            $table->enum('type_maintenance', ['Preventive', 'Corrective', 'Revision', 'Inspection', 'Reparation']);
            $table->date('date_planifiee');
            $table->time('heure_debut');
            $table->decimal('duree_estimee', 4, 1); // en heures
            $table->enum('priorite', ['Basse', 'Normale', 'Haute', 'Urgente'])->default('Normale');
            $table->string('technicien');
            $table->string('atelier');
            $table->text('description_travaux');
            $table->text('pieces_necessaires')->nullable();
            $table->text('notes')->nullable();
            $table->enum('statut', ['Planifiee', 'En Cours', 'Terminee', 'Annulee'])->default('Planifiee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planning_maintenances');
    }
};
