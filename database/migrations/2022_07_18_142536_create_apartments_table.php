<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title');
            $table->tinyInteger('rooms_number')->nullable();
            $table->tinyInteger('beds_number')->nullable();
            $table->tinyInteger('bathrooms_number')->nullable();
            $table->tinyInteger('square_meters')->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->tinyInteger('street_number');
            $table->string('zip_code');
            $table->string('img');
            $table->tinyInteger('visibility');
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
        Schema::dropIfExists('apartments');
    }
}
