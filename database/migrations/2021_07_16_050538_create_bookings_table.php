<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code');
            $table->string('booking_date');
            $table->BigInteger('user_id')->unsigned();
            $table->BigInteger('car_id')->unsigned();
            $table->BigInteger('from_city_id')->unsigned()->nullable();
            $table->BigInteger('to_city_id')->unsigned()->nullable();
            $table->string('day');
            $table->string('total');
            $table->BigInteger('pickup_id')->unsigned()->nullable();
            $table->text('custom_pickup');
            $table->string('departure_date');
            $table->text('arrival_date');
            $table->string('pickup_time');
            $table->string('status');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->foreign('from_city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('to_city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('pickup_id')->references('id')->on('cities')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
