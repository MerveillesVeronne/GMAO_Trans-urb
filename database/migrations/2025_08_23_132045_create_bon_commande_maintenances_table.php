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
        Schema::create('bon_commande_maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('intervention_id')->constrained('interventions')->onDelete('cascade');
            $table->foreignId('vehicule_id')->constrained('vehicules')->onDelete('cascade');
            $table->string('chauffeur')->nullable();
            $table->text('motif_intervention');
            $table->text('pieces_necessaires');
            $table->enum('statut', ['En Attente', 'Signé', 'Approuvé', 'En Cours', 'Terminé', 'Annulé'])->default('En Attente');
            $table->datetime('date_creation');
            $table->datetime('date_besoin');
            $table->datetime('date_debut_prevue')->nullable();
            $table->datetime('date_fin_prevue')->nullable();
            $table->text('notes')->nullable();
            
            // Signatures
            $table->foreignId('signataire_1_id')->nullable()->constrained('users')->onDelete('set null');
            $table->datetime('signature_1_date')->nullable();
            $table->string('signature_1_fonction')->nullable();
            
            $table->foreignId('signataire_2_id')->nullable()->constrained('users')->onDelete('set null');
            $table->datetime('signature_2_date')->nullable();
            $table->string('signature_2_fonction')->nullable();
            
            // Validation
            $table->boolean('valide')->default(false);
            $table->foreignId('valide_par_id')->nullable()->constrained('users')->onDelete('set null');
            $table->datetime('valide_le')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bon_commande_maintenances');
    }
};
