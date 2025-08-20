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
            $table->boolean('valide_globalement')->default(false)->after('statut');
            $table->foreignId('valide_par')->nullable()->constrained('users')->after('valide_globalement');
            $table->timestamp('valide_le')->nullable()->after('valide_par');
            $table->decimal('montant_final_valide', 12, 2)->nullable()->after('valide_le');
            $table->text('commentaires_validation')->nullable()->after('montant_final_valide');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bons_commande', function (Blueprint $table) {
            $table->dropForeign(['valide_par']);
            $table->dropColumn([
                'valide_globalement',
                'valide_par', 
                'valide_le',
                'montant_final_valide',
                'commentaires_validation'
            ]);
        });
    }
};
