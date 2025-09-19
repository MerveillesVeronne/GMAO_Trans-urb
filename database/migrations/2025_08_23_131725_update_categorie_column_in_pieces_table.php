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
        Schema::table('pieces', function (Blueprint $table) {
            // Supprimer l'ancienne contrainte enum
            $table->dropColumn('categorie');
        });

        Schema::table('pieces', function (Blueprint $table) {
            // Ajouter la nouvelle colonne avec les nouvelles catégories
            $table->enum('categorie', [
                'Pièces mécaniques',
                'Pièces électriques', 
                'Huiles et lubrifiants',
                'Filtres',
                'Outillage',
                'Consommables'
            ])->after('designation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pieces', function (Blueprint $table) {
            // Supprimer la nouvelle colonne
            $table->dropColumn('categorie');
        });

        Schema::table('pieces', function (Blueprint $table) {
            // Restaurer l'ancienne colonne
            $table->enum('categorie', [
                'Moteur', 
                'Transmission', 
                'Freinage', 
                'Suspension', 
                'Electricite', 
                'Carrosserie', 
                'Interieur', 
                'Climatisation', 
                'Autres'
            ])->after('designation');
        });
    }
};
