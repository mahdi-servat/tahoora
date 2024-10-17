<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_uses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('category')->nullable();
            $table->text('description')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('contact_uses');
    }
};
