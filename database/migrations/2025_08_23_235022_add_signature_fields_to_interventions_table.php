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
            // Signature maintenance
            $table->boolean('signature_maintenance')->default(false)->after('raison_delai');
            $table->foreignId('signature_maintenance_user_id')->nullable()->constrained('users')->onDelete('set null')->after('signature_maintenance');
            $table->datetime('signature_maintenance_date')->nullable()->after('signature_maintenance_user_id');
            
            // Signature logistique
            $table->boolean('signature_logistique')->default(false)->after('signature_maintenance_date');
            $table->foreignId('signature_logistique_user_id')->nullable()->constrained('users')->onDelete('set null')->after('signature_logistique');
            $table->datetime('signature_logistique_date')->nullable()->after('signature_logistique_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->dropForeign(['signature_maintenance_user_id']);
            $table->dropForeign(['signature_logistique_user_id']);
            $table->dropColumn([
                'signature_maintenance',
                'signature_maintenance_user_id',
                'signature_maintenance_date',
                'signature_logistique',
                'signature_logistique_user_id',
                'signature_logistique_date'
            ]);
        });
    }
};
