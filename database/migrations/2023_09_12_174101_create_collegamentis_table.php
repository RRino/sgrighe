<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collegamentis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('associati_id');
            $table->foreign('associati_id')->references('id')->on('associatis'); 
            $table->unsignedBigInteger('ruoli_id'); 
            $table->foreign('ruoli_id')->references('id')->on('ruolis'); 
            $table->unsignedBigInteger('ruoli_spec_id'); 
            $table->foreign('ruoli_spec_id')->references('id')->on('ruoli_specs'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
