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
            $table->foreignId('bon_commande_id')->nullable()->constrained('bons_commande')->after('user_id');
            $table->index('bon_commande_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropIndex(['bon_commande_id']);
            $table->dropForeign(['bon_commande_id']);
            $table->dropColumn('bon_commande_id');
        });
    }
};
