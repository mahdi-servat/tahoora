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
        Schema::create('category_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title2');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('category_type_id');
            $table->foreign('category_type_id')->references('id')->on('category_types');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('parent_id')->references('id')->on('categories');
            $table->timestamps();
        });

        Schema::create('model_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_categories');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_types');
    }
};
