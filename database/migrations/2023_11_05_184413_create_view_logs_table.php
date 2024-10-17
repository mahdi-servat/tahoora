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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index();
            $table->string('title')->index();
            $table->timestamps();
        });

        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('view_logs', function (Blueprint $table) {
            $table->id();
            $table->string('agent')->nullable();
            $table->string('browser')->nullable();
            $table->unsignedBigInteger('device_id')->nullable();
            $table->string('ip')->index();
            $table->date('date');
            $table->unsignedBigInteger('country_id')->nullable();

            $table->timestamps();
            $table->foreign('device_id')->references('id')->on('devices');
            $table->foreign('country_id')->references('id')->on('countries');
        });

        Schema::create('view_path_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('view_log_id');
            $table->string('path')->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
        Schema::dropIfExists('devices');
        Schema::dropIfExists('view_logs');
        Schema::dropIfExists('view_path_logs');
    }
};
