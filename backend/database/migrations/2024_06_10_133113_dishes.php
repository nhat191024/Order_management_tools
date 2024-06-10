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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('id_cooking_method');
            $table->integer('price');
            $table->string('image');
            $table->timestamps();

            $table->foreign('food_id')->references('id')->on('foods');
            $table->foreign('id_cooking_method')->references('id')->on('cooking_methods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
