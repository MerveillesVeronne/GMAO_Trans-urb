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
        Schema::table('vehicules', function (Blueprint $table) {
            $table->enum('affectation', ['Location', 'Urbain', 'Inter-urbain'])->nullable()->after('ligne');
            $table->string('entite_location')->nullable()->after('affectation');
            $table->foreignId('ligne_transport_id')->nullable()->constrained('lignes_transports')->onDelete('set null')->after('entite_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicules', function (Blueprint $table) {
            $table->dropForeign(['ligne_transport_id']);
            $table->dropColumn(['affectation', 'entite_location', 'ligne_transport_id']);
        });
    }
};
