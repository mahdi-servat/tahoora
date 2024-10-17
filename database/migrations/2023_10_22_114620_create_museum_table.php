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
        Schema::create('museums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('user_id');

            $table->string('title');

            $table->text('summary')->nullable();
            $table->text('content')->nullable();

            $table->string('thump');
            $table->integer('price')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('statues');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('museum');
    }
};
