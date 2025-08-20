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
        Schema::table('users', function (Blueprint $table) {
            $table->string('prenom')->after('name');
            $table->string('nom')->after('prenom');
            $table->string('matricule', 20)->unique()->after('nom');
            $table->string('telephone')->nullable()->after('matricule');
            
            // Relations organisationnelles
            $table->foreignId('direction_id')->nullable()->constrained('directions')->onDelete('set null');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            
            // Informations complémentaires
            $table->enum('statut', ['actif', 'inactif', 'suspendu'])->default('actif');
            $table->date('date_embauche')->nullable();
            $table->text('commentaire')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['direction_id']);
            $table->dropForeign(['service_id']);
            $table->dropForeign(['role_id']);
            
            $table->dropColumn([
                'prenom', 'nom', 'matricule', 'telephone', 
                'direction_id', 'service_id', 'role_id', 
                'statut', 'date_embauche', 'commentaire'
            ]);
        });
    }
};
