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
        Schema::create('paiement_contrats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contrat_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('montant', 15, 2);
            $table->enum('mode_paiement', ['especes', 'cheque', 'virement', 'carte']);
            $table->string('reference_paiement')->nullable();
            $table->text('commentaire')->nullable();
            $table->date('date_paiement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiement_contrats');
    }
};
