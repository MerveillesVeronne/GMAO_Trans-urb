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
        Schema::table('contrats', function (Blueprint $table) {
            $table->decimal('montant_a_payer', 15, 2)->nullable()->after('montant');
            $table->decimal('avance', 15, 2)->default(0)->after('montant_a_payer');
            $table->decimal('reste_a_payer', 15, 2)->nullable()->after('avance');
            $table->enum('statut_paiement', ['en_attente', 'partiel', 'paye'])->default('en_attente')->after('reste_a_payer');
            $table->enum('modalite_paiement', ['unique', 'tranches'])->default('unique')->after('statut_paiement');
            $table->date('date_dernier_paiement')->nullable()->after('modalite_paiement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contrats', function (Blueprint $table) {
            $table->dropColumn([
                'montant_a_payer',
                'avance',
                'reste_a_payer',
                'statut_paiement',
                'modalite_paiement',
                'date_dernier_paiement'
            ]);
        });
    }
};
