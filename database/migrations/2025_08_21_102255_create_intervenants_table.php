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
        Schema::create('intervenants', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('fonction_technique');
            $table->string('specialite')->nullable();
            $table->string('niveau_competence'); // Débutant, Intermédiaire, Expert
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->string('atelier')->nullable();
            $table->date('date_embauche');
            $table->enum('statut', ['Actif', 'Inactif', 'En Formation', 'En Congé'])->default('Actif');
            $table->text('competences')->nullable(); // JSON ou texte pour les compétences
            $table->text('formations_suivies')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intervenants');
    }
};
