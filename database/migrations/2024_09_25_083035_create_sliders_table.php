<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('slider_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        });

        Artisan::call('db:seed', ['--class' => 'SliderTypeSeeder']);


        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('status_id')->default(2);
            $table->unsignedBigInteger('slider_type_id')->default(1);
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('statues');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('slider_type_id')->references('id')->on('slider_types')->onDelete('cascade');
        });

        Schema::create('slider_slides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slider_id')->nullable();
            $table->unsignedBigInteger('attachment_id')->nullable();
            $table->integer('sort')->default(0);
            $table->string('title');
            $table->string('sub_title');
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->text('description')->nullable();

            $table->foreign('slider_id')->references('id')->on('sliders')->onDelete('cascade');
            $table->foreign('attachment_id')->references('id')->on('attachments')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('slider_slides');
        Schema::drop('sliders');
        Schema::drop('slider_types');
    }
};
