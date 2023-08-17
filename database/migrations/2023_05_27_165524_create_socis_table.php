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
        Schema::create('socis', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->nullable();
            $table->string('alias',300)->nullable();
            $table->string('nome',155)->nullable();
            $table->string('cognome',155)->nullable();
            $table->string('indirizzo',300)->nullable();
            $table->string('consegna',25)->nullable();
            $table->string('cap',25)->nullable();
            $table->string('localita',255)->nullable();
            $table->string('comune',255)->nullable();
            $table->string('sigla_provincia',25)->nullable();
           // $table->string('ultimo',55)->nullable();
           // $table->string('penultimo',55)->nullable();
            $table->string('email',255)->nullable();
            $table->string('pec',55)->nullable();
            $table->string('codice_fiscale',55)->nullable();
            $table->string('partita_iva',55)->nullable();
            $table->string('telefono',55)->nullable();
            $table->string('cellulare',55)->nullable();
            $table->enum('tipo_socio', ['Ordinario','Famigliare','Societa'])->default('Ordinario')->nullable();
            $table->enum('published',['Abilitato','Sospeso'])->default('Abilitato')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

           // $table->integer('socio_id')->unsigned();
           // $table->foreign('socio_id')->references('id')->on('iscriziones')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('socis');
    }
};
