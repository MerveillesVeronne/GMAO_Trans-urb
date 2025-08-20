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
        Schema::table('ligne_commandes', function (Blueprint $table) {
            $table->integer('quantite_livree')->default(0)->after('quantite'); // Quantité déjà livrée
            $table->date('date_derniere_livraison')->nullable()->after('quantite_livree'); // Date de la dernière livraison
            $table->boolean('livraison_complete')->default(false)->after('date_derniere_livraison'); // Si la livraison est complète
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ligne_commandes', function (Blueprint $table) {
            $table->dropColumn(['quantite_livree', 'date_derniere_livraison', 'livraison_complete']);
        });
    }
};
