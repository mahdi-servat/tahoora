<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comment_status', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');

            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->text('description');
            $table->date('date');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('comment_status');
            $table->foreign('language_id')->references('id')->on('languages');

            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('comment_status');
        Schema::dropIfExists('comments');
    }
};
