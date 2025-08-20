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
        Schema::create('bons_commande', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('titre');
            $table->text('description');
            $table->decimal('budget_total', 12, 2);
            $table->date('date_creation');
            $table->date('date_besoin');
            $table->enum('statut', ['en_attente', 'partiellement_satisfait', 'satisfait', 'annule'])->default('en_attente');
            $table->foreignId('user_id')->constrained();
            $table->text('commentaires')->nullable();
            $table->timestamps();

            $table->index(['reference', 'statut']);
            $table->index('date_creation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bons_commande');
    }
};
