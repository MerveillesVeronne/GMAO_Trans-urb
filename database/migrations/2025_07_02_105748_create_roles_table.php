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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nom_role');
            $table->string('code_role', 20)->unique();
            $table->text('description')->nullable();
            $table->json('permissions'); // Stockage des permissions en JSON
            $table->integer('niveau_hierarchique')->default(0); // 0=le plus bas, plus élevé=plus de permissions
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
