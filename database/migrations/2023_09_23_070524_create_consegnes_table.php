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
        Schema::create('consegnes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('associati_id'); 
            $table->string('nome')->nullable();
            $table->string('sigla')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consegnes');
    }
};
