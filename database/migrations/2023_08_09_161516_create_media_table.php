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
        Schema::create('media', function(Blueprint $table) {
            $table->id();
            $table->string('thump');
            $table->string('title');
            $table->string('title2')->index();
            $table->date('date')->index();
            $table->text('description');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('status_id')->default(1);

            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('status_id')->references('id')->on('statues');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
