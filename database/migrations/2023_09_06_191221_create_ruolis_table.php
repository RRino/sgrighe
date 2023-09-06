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
        Schema::create('ruolis', function (Blueprint $table) {
            $table->id();
            $table->string('ruolo');
            $table->string('nome_ente')->nullable();
            $table->date('da_data');
            $table->date('a_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruolis');
    }
};
