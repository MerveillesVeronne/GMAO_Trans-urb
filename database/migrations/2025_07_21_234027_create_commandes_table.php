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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique()->nullable(); // Référence unique de la commande
            $table->date('date_commande'); // Date de commande
            $table->date('date_livraison')->nullable(); // Date de livraison prévue/réelle
            $table->integer('delai')->nullable(); // Délai en jours
            $table->foreignId('fournisseur_id')->constrained('fournisseurs')->onDelete('cascade'); // Fournisseur
            $table->enum('statut', ['en_attente', 'approuvee', 'livree', 'annulee'])->default('en_attente'); // Statut de la commande
            $table->text('commentaires')->nullable(); // Commentaires généraux
            $table->decimal('montant_total', 15, 2)->default(0); // Montant total de la commande
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Utilisateur qui a créé la commande
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
