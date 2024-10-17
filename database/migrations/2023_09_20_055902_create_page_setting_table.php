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
        Schema::create('page_setting_type', function(Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('page_setting_type_id');
            $table->string('key')->unique()->index();
            $table->text('default');

            $table->foreign('page_setting_type_id')->references('id')->on('page_setting_type');
            $table->timestamps();
        });

        Schema::create('page_setting_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_setting_id');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('page_setting_type_id');
            $table->text('content');
            $table->foreign('page_setting_id')->references('id')->on('page_settings');
            $table->foreign('page_setting_type_id')->references('id')->on('page_setting_type');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_setting_type');
        Schema::dropIfExists('page_setting');
        Schema::dropIfExists('page_setting_data');
    }
};
