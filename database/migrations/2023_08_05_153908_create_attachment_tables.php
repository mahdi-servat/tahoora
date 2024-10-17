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
        Schema::create('attachment_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('path');
        });
        Schema::create('attachments', function(Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('title2')->nullable()->index();
            $table->string('path');
            $table->string('mime_type')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort')->nullable();
            $table->unsignedBigInteger('attachment_type_id');

            $table->foreign('attachment_type_id')->references('id')->on('attachment_types');
            $table->timestamps();
        });

        Schema::create('model_attachments' ,function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('attachment_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');

            $table->foreign('attachment_id')->references('id')->on('attachments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
        Schema::dropIfExists('model_attachments');
    }
};
