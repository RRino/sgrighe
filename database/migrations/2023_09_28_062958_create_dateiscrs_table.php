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
        Schema::create('dateiscrs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('associati_id')->constrained('associatis');
            $table->string('nome');
            $table->string('enumdateiscr_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dateiscrs');
    }
};
