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
            $table->enum('nature_intervention', ['Mecanique', 'Electrique', 'Vulcanique', 'Tolerie', 'Peinture', 'Carrosserie', 'Chauffage', 'Climatisation', 'Freinage', 'Suspension', 'Transmission', 'Autre'])->nullable()->after('type_intervention');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->dropColumn('nature_intervention');
        });
    }
};
