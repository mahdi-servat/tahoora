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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('status_id');
            $table->string('title')->index();
            $table->string('thump');
            $table->text('url')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort')->nullable()->index();
            $table->timestamps();

            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('status_id')->references('id')->on('statues');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
