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
        Schema::dropIfExists('reserve_artist_dates');
        Schema::dropIfExists('reserves');
        Schema::dropIfExists('reserve_types');


        Schema::create('reserve_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        });
        //add reserve Types [نازایی - ارولوژی - ژنتیک - روانشناسی - آزمایش اسپرم]

        Schema::create('reserves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('artist_id')->nullable()->index();
            $table->unsignedBigInteger('reserve_type_id')->nullable()->index();
            $table->string('date');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->text('description')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('artist_id')->references('id')->on('artists');
            $table->foreign('reserve_types')->references('id')->on('artists');

            $table->foreign('status_id')->references('id')->on('statues');
            $table->timestamps();
        });
        //add status on StatusTable [ثبت رزرو - انجام پذیرش ]


        Schema::create('reserve_artist_dates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reserve_type_id')->nullable()->index();
            $table->unsignedBigInteger('artist_id')->nullable()->index();
            $table->string('date');

            $table->foreign('artist_id')->references('id')->on('artists');
            $table->foreign('reserve_types')->references('id')->on('artists');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reserve_artist_dates');
        Schema::dropIfExists('reserves');
        Schema::dropIfExists('reserve_types');
    }
};
