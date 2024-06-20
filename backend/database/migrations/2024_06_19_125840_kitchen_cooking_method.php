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
        Schema::create('kitchen_cooking_method', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kitchen_id');
            $table->unsignedBigInteger('cooking_method_id');
            $table->timestamps();
            
            $table->foreign('kitchen_id')->references('id')->on('kitchens');
            $table->foreign('cooking_method_id')->references('id')->on('cooking_methods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kitchen_cooking_method');
    }
};
