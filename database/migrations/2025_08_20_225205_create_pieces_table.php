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
        Schema::create('pieces', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('designation');
            $table->enum('categorie', ['Moteur', 'Transmission', 'Freinage', 'Suspension', 'Electricite', 'Carrosserie', 'Interieur', 'Climatisation', 'Autres']);
            $table->string('marque_compatible')->nullable();
            $table->integer('quantite_stock')->default(0);
            $table->integer('seuil_alerte')->default(5);
            $table->decimal('prix_unitaire', 10, 2);
            $table->string('fournisseur')->nullable();
            $table->string('numero_fournisseur')->nullable();
            $table->string('localisation')->nullable();
            $table->text('description')->nullable();
            $table->text('specifications')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pieces');
    }
};
