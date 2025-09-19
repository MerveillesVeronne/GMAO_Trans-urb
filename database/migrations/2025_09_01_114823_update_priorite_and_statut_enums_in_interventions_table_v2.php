<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Étape 1: Ajouter des colonnes temporaires
        Schema::table('interventions', function (Blueprint $table) {
            $table->enum('priorite_new', ['Normal', 'À prévoir', 'Urgent'])->nullable()->after('priorite');
            $table->enum('statut_new', ['En Attente', 'En Cours', 'Terminee', 'Annulee', 'Livré'])->nullable()->after('statut');
        });

        // Étape 2: Migrer les données existantes
        DB::table('interventions')->update([
            'priorite_new' => DB::raw("CASE 
                WHEN priorite = 'Basse' THEN 'Normal'
                WHEN priorite = 'Normale' THEN 'Normal'
                WHEN priorite = 'Haute' THEN 'Urgent'
                WHEN priorite = 'Urgente' THEN 'Urgent'
                ELSE 'Normal'
            END")
        ]);

        // Étape 3: Supprimer les anciennes colonnes
        Schema::table('interventions', function (Blueprint $table) {
            $table->dropColumn('priorite');
            $table->dropColumn('statut');
        });

        // Étape 4: Renommer les nouvelles colonnes
        Schema::table('interventions', function (Blueprint $table) {
            $table->renameColumn('priorite_new', 'priorite');
            $table->renameColumn('statut_new', 'statut');
        });

        // Étape 5: Définir les valeurs par défaut
        DB::table('interventions')->whereNull('priorite')->update(['priorite' => 'Normal']);
        DB::table('interventions')->whereNull('statut')->update(['statut' => 'En Attente']);
    }

    public function down(): void
    {
        // Étape 1: Ajouter des colonnes temporaires pour l'ancien format
        Schema::table('interventions', function (Blueprint $table) {
            $table->enum('priorite_old', ['Basse', 'Normale', 'Haute', 'Urgente'])->nullable()->after('priorite');
            $table->enum('statut_old', ['En Attente', 'En Cours', 'Terminee', 'Annulee'])->nullable()->after('statut');
        });

        // Étape 2: Migrer les données vers l'ancien format
        DB::table('interventions')->update([
            'priorite_old' => DB::raw("CASE 
                WHEN priorite = 'Normal' THEN 'Normale'
                WHEN priorite = 'À prévoir' THEN 'Normale'
                WHEN priorite = 'Urgent' THEN 'Urgente'
                ELSE 'Normale'
            END")
        ]);

        // Étape 3: Supprimer les nouvelles colonnes
        Schema::table('interventions', function (Blueprint $table) {
            $table->dropColumn('priorite');
            $table->dropColumn('statut');
        });

        // Étape 4: Renommer les anciennes colonnes
        Schema::table('interventions', function (Blueprint $table) {
            $table->renameColumn('priorite_old', 'priorite');
            $table->renameColumn('statut_old', 'statut');
        });

        // Étape 5: Définir les valeurs par défaut
        DB::table('interventions')->whereNull('priorite')->update(['priorite' => 'Normale']);
        DB::table('interventions')->whereNull('statut')->update(['statut' => 'En Attente']);
    }
};
