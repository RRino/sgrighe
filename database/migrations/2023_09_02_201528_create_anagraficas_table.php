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
        Schema::create('anagraficas', function (Blueprint $table) {
            $table->id();
            $table->enum('per_soc',['Persona','Societa'])->default('Persona')->nullable();
            $table->string('nome',155)->nullable();
            $table->string('cognome',155)->nullable();
            $table->string('indirizzo',300)->nullable();
            $table->string('consegna',25)->nullable();
            $table->string('cap',25)->nullable();
            $table->string('localita',255)->nullable();
            $table->string('comune',255)->nullable();
            $table->string('sigla_provincia',25)->nullable();
            $table->string('email',255)->nullable();
            $table->string('pec',55)->nullable();
            $table->string('codice_fiscale',55)->nullable();
            $table->string('partita_iva',55)->nullable();
            $table->string('telefono',55)->nullable();
            $table->string('cellulare',55)->nullable();
            $table->string('tipos',200)->nullable();
            $table->string('ruolo',200)->nullable();
            $table->enum('published',['Abilitato','Sospeso'])->default('Abilitato')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('tabs_id')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anagraficas');
    }
};
