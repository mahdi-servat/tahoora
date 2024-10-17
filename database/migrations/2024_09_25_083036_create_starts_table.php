<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('starts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('vote')->default(0)->index();
            $table->string('model_type')->index();
            $table->unsignedBigInteger('model_id')->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('starts');
    }
};
