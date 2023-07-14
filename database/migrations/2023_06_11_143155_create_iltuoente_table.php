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
        Schema::create('iltuoentes', function (Blueprint $table) {
            $table->id();
            $table->string('permalink',300);
            $table->string('tipologia')->nullable();
            $table->string('settore')->nullable();
            $table->string('acronimo')->nullable();
            $table->string('denominazione')->nullable();
            $table->string('nome_breve')->nullable();
            $table->string('partita_iva')->nullable();
            $table->string('email')->nullable();
            $table->string('pec')->nullable();
            $table->string('telefono')->nullable();
            $table->string('cellulare')->nullable();
            $table->string('webesocial')->nullable();
            $table->string('settore_istat')->nullable();
            $table->string('attivita_istat')->nullable();
            $table->string('destinatari')->nullable();
            $table->string('presentazione')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iltuoente');
    }
};
