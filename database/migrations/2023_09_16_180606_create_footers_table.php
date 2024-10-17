<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('footers', function(Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url')->nullable();
            $table->integer('sort')->nullable();

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('status_id')->default(1);

            $table->foreign('status_id')->references('id')->on('statues');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('footers');
	}
};
