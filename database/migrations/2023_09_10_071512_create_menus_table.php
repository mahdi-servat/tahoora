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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url')->nullable();
            $table->string('parents_id')->nullable();
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->integer('sort')->nullable();

            $table->foreign('status_id')->references('id')->on('statues');
            $table->foreign('parent_id')->references('id')->on('menus');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
