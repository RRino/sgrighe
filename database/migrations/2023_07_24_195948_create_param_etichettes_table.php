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
        Schema::create('param_etichettes', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->integer('spazio_sopra')->nullable();
            $table->integer('larghezza')->nullable();
            $table->integer('altezza')->nullable();
            $table->integer('numero_verticale')->nullable();
            $table->integer('numero_orrizontale')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('param_etichette');
    }
};
