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
            // $table->increments('id');
            $table->id();
            $table->string('car_name');
            $table->integer('founded');
            $table->longtext('description');
            $table->integer('price');
            $table->string('image_path');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
            ->references('id')->on('users')->onDelete('cascade');
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
