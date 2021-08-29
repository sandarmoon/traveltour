<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_bookings', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();
            $table->string('codeno');
            $table->string('booking_date');
            $table->string('check_in');
            $table->string('check_out');
            $table->BigInteger('room_id')->unsigned();
            $table->integer('days')->nullable();
            $table->integer('total')->nulllable();
            $table->integer('taxfee')->nulllable();
            $table->integer('adult')->nullable();
            $table->integer('child')->nullable();
            $table->integer('status')->default('1');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('msg')->nullable();
            
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('room_id')
                    ->references('id')
                    ->on('rooms')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('hotel_bookings');
    }
}
