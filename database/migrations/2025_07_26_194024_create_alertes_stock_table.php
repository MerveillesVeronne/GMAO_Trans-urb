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
        Schema::create('alertes_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_id')->constrained()->onDelete('cascade');
            $table->string('type_alerte'); // 'seuil_bas', 'rupture', 'expiration'
            $table->text('message');
            $table->enum('statut', ['active', 'resolue', 'ignoree'])->default('active');
            $table->timestamp('date_alerte');
            $table->timestamp('date_resolution')->nullable();
            $table->foreignId('resolu_par')->nullable()->constrained('users');
            $table->timestamps();

            $table->index(['stock_id', 'statut']);
            $table->index('date_alerte');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alertes_stock');
    }
};
