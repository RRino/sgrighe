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
        Schema::create('enumruolispecs', function (Blueprint $table) {
            $table->id();
            $table->enum('nome', ['Ordinario', 'Famigliare', 'Direttivo','Presidente','Vice_presidente']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enumruolispec');
    }
};
