<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('artists', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('status_id');
            $table->string('title');
            $table->string('thump');
            $table->text('summary')->nullable();
            $table->text('content');
            $table->string('website_address')->nullable();

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
		Schema::dropIfExists('artists');
	}
};
