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
        Schema::create('param_bollettinis', function (Blueprint $table) {
            $table->id();
            $table->string('causale')->default('ISCRIZIONE ASSOCIAZIONE PROGETTO 10 Righe APS 2023 piu 2 riviste ');
            $table->string('prezzo')->default('20');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('param_bollettinis');
    }
};
