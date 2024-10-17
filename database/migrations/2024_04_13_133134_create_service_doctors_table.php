<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('museum_doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('museum_id')->index();
            $table->unsignedBigInteger('artist_id')->index();


            $table->foreign('artist_id')->references('id')->on('artists')->onDelete('cascade');
            $table->foreign('museum_id')->references('id')->on('museums')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('museum_doctors');
    }
};
