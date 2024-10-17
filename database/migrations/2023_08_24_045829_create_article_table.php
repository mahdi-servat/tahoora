<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');
            $table->string('title');
            $table->string('title2')->index();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->unsignedBigInteger('user_id');

            $table->string('author')->nullable()->index();
            $table->string('second_title')->nullable();
            $table->string('second_title2')->index()->nullable();
            $table->string('thump');
            $table->text('summary')->nullable();
            $table->text('content')->nullable();

            $table->foreign('status_id')->references('id')->on('statues');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
