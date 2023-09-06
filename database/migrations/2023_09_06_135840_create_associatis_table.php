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
        Schema::create('associatis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anagrafica_id'); 
            $table->foreign('anagrafica_id')->references('id')->on('anagraficas'); 
            $table->string('nome');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('associatis');
    }
};
