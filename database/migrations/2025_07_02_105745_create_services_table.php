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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('direction_id')->constrained('directions')->onDelete('cascade');
            $table->string('nom_service');
            $table->string('code_service', 10)->unique();
            $table->string('chef_service')->nullable();
            $table->text('description')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('ordre_affichage')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
