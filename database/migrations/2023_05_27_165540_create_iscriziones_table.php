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
            $table->unsignedBigInteger('socio_id');
            $table->integer('anno');
            $table->string('description')->nullable();
            $table->timestamps();
           // $table->foreign('socio_id')->references('id')->on('socis')->onDelete('cascade');
            $table->foreign('socio_id')->references('id')->on('socis')->onUpdate('cascade')->onDelete('cascade');
            //->onUpdate('cascade') ->onDelete('cascade');
           // $table->foreign('socio_id')->references('id')->on('iscriziones')->onDelete('cascade');
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
