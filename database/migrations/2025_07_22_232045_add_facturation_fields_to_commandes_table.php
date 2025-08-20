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
        Schema::table('commandes', function (Blueprint $table) {
            $table->decimal('montant_a_payer', 12, 2)->default(0)->after('montant_total');
            $table->decimal('avance', 12, 2)->default(0)->after('montant_a_payer');
            $table->decimal('reste_a_payer', 12, 2)->default(0)->after('avance');
            $table->enum('statut_paiement', ['impaye', 'redevance', 'echu'])->default('impaye')->after('reste_a_payer');
            $table->enum('modalite_paiement', ['mensuelle', 'annuelle', 'unique'])->default('unique')->after('statut_paiement');
            $table->date('date_dernier_paiement')->nullable()->after('modalite_paiement');
            $table->text('commentaires_paiement')->nullable()->after('date_dernier_paiement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropColumn([
                'montant_a_payer',
                'avance', 
                'reste_a_payer',
                'statut_paiement',
                'modalite_paiement',
                'date_dernier_paiement',
                'commentaires_paiement'
            ]);
        });
    }
};
