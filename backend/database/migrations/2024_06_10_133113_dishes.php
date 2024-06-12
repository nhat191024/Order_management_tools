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
            $table->unsignedBigInteger('cooking_method_id');
            $table->integer('price');
            $table->integer('additional_price');
            $table->timestamps();

            $table->foreign('food_id')->references('id')->on('foods');
            $table->foreign('cooking_method_id')->references('id')->on('cooking_methods');
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
