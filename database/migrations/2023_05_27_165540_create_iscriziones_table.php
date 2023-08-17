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
        Schema::create('iscriziones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('socio_id')->nullable();;
            //$table->string('nome')->nullable();
           // $table->string('cognome')->nullable();
            //$table->integer('anno')->nullable();;
            //$table->string('description')->nullable();
            $table->timestamps();
            $table->foreign('socio_id')->references('id')->on('socis')->onUpdate('cascade')->onDelete('cascade');
    
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iscriziones');
    }
};
