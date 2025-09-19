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
        Schema::table('interventions', function (Blueprint $table) {
            $table->datetime('date_fin_reelle')->nullable()->after('date_fin_prevue');
            $table->integer('progression')->default(0)->after('pieces_necessaires');
            $table->text('notes_avancement')->nullable()->after('progression');
            $table->integer('delai_supplementaire')->default(0)->after('notes_avancement'); // en heures
            $table->text('raison_delai')->nullable()->after('delai_supplementaire');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->dropColumn([
                'date_fin_reelle',
                'progression',
                'notes_avancement',
                'delai_supplementaire',
                'raison_delai'
            ]);
        });
    }
};
