<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_media', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('icon');
            $table->string('key');
            $table->string('default')->nullable();
            $table->timestamps();
        });
        Schema::create('model_social_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('social_media_id');
            $table->string('model_type')->index();
            $table->unsignedBigInteger('model_id')->index();
            $table->text('value')->nullable();


            $table->foreign('social_media_id')->references('id')->on('social_media');
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
        Schema::dropIfExists('social_media');
        Schema::dropIfExists('model_social_media');
    }
};
