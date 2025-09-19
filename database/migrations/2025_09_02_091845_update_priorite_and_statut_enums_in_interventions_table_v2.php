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
            $table->string('priorite_temp')->nullable()->after('priorite');
            $table->string('statut_temp')->nullable()->after('statut');
        });

        // Étape 2: Mettre à jour les données existantes vers les nouvelles valeurs
        DB::table('interventions')->update([
            'priorite_temp' => DB::raw("
                CASE 
                    WHEN priorite = 'Basse' THEN 'Normal'
                    WHEN priorite = 'Normale' THEN 'Normal'
                    WHEN priorite = 'Haute' THEN 'Urgent'
                    WHEN priorite = 'Urgente' THEN 'Urgent'
                    ELSE priorite
                END
            "),
            'statut_temp' => DB::raw("statut")
        ]);

        // Étape 3: Supprimer les anciennes colonnes enum
        Schema::table('interventions', function (Blueprint $table) {
            $table->dropColumn(['priorite', 'statut']);
        });

        // Étape 4: Recréer les colonnes avec les nouveaux enums
        Schema::table('interventions', function (Blueprint $table) {
            $table->enum('priorite', ['Normal', 'À prévoir', 'Urgent'])->default('Normal')->after('nature_intervention');
            $table->enum('statut', ['En Attente', 'En Cours', 'Terminee', 'Annulee', 'Livré'])->default('En Attente')->after('priorite');
        });

        // Étape 5: Copier les données des colonnes temporaires
        DB::table('interventions')->update([
            'priorite' => DB::raw('priorite_temp'),
            'statut' => DB::raw('statut_temp')
        ]);

        // Étape 6: Supprimer les colonnes temporaires
        Schema::table('interventions', function (Blueprint $table) {
            $table->dropColumn(['priorite_temp', 'statut_temp']);
        });
    }

    public function down(): void
    {
        // Étape 1: Ajouter des colonnes temporaires
        Schema::table('interventions', function (Blueprint $table) {
            $table->string('priorite_temp')->nullable()->after('priorite');
            $table->string('statut_temp')->nullable()->after('statut');
        });

        // Étape 2: Mettre à jour les données vers les anciennes valeurs
        DB::table('interventions')->update([
            'priorite_temp' => DB::raw("
                CASE 
                    WHEN priorite = 'Normal' THEN 'Normale'
                    WHEN priorite = 'À prévoir' THEN 'Normale'
                    WHEN priorite = 'Urgent' THEN 'Urgente'
                    ELSE priorite
                END
            "),
            'statut_temp' => DB::raw("
                CASE 
                    WHEN statut = 'Livré' THEN 'Terminee'
                    ELSE statut
                END
            ")
        ]);

        // Étape 3: Supprimer les nouvelles colonnes enum
        Schema::table('interventions', function (Blueprint $table) {
            $table->dropColumn(['priorite', 'statut']);
        });

        // Étape 4: Recréer les anciennes colonnes enum
        Schema::table('interventions', function (Blueprint $table) {
            $table->enum('priorite', ['Basse', 'Normale', 'Haute', 'Urgente'])->default('Normale')->after('nature_intervention');
            $table->enum('statut', ['En Attente', 'En Cours', 'Terminee', 'Annulee'])->default('En Attente')->after('priorite');
        });

        // Étape 5: Copier les données des colonnes temporaires
        DB::table('interventions')->update([
            'priorite' => DB::raw('priorite_temp'),
            'statut' => DB::raw('statut_temp')
        ]);

        // Étape 6: Supprimer les colonnes temporaires
        Schema::table('interventions', function (Blueprint $table) {
            $table->dropColumn(['priorite_temp', 'statut_temp']);
        });
    }
};
