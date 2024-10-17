<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('thump_id')->nullable();
            $table->unsignedBigInteger('museum_id')->index();
            $table->foreign('museum_id')->references('id')->on('museums');
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
        Schema::drop('testimonials');
    }
};
