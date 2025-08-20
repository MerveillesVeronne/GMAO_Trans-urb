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
        Schema::table('bons_commande', function (Blueprint $table) {
            // Ajouter les champs pour les quantités totales souhaitées
            $table->string('produit_principal')->nullable()->after('description');
            $table->text('description_produit')->nullable()->after('produit_principal');
            $table->integer('quantite_totale_souhaitee')->default(0)->after('description_produit');
            $table->string('unite_produit')->nullable()->after('quantite_totale_souhaitee');
            $table->decimal('cout_unitaire_estime', 12, 2)->nullable()->after('unite_produit');
            $table->decimal('cout_total_estime', 12, 2)->nullable()->after('cout_unitaire_estime');
            $table->integer('quantite_satisfaite')->default(0)->after('cout_total_estime');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bons_commande', function (Blueprint $table) {
            $table->dropColumn([
                'produit_principal',
                'description_produit', 
                'quantite_totale_souhaitee',
                'unite_produit',
                'cout_unitaire_estime',
                'cout_total_estime',
                'quantite_satisfaite'
            ]);
        });
    }
};
