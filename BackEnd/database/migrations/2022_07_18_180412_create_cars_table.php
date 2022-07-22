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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->foreignId('user_id')->constrained();
            $table->integer('year');
            $table->integer('price');
            $table->integer('currentFipePrice')->nullable();
            $table->string('carFuel');
            $table->string('licensePlate');
            $table->string('image');
            $table->boolean('hasAirBag');
            $table->boolean('hasInsurance');
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
        Schema::dropIfExists('cars');
    }
};
