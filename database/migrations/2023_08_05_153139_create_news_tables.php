<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statues', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title2');
            $table->string('top_title')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->date('date');
            $table->string('thump');
            $table->text('description');
            $table->text('content');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('views')->default(0);

            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('statues');

            $table->timestamps();
        });

        Schema::create('meta_tags', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title2');

            $table->timestamps();
        });

        Schema::create('model_meta_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meta_tag_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');

            $table->foreign('meta_tag_id')->references('id')->on('meta_tags');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_meta_tags');
        Schema::dropIfExists('meta_tags');
        Schema::dropIfExists('news');
    }
};
