<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();
            $table->BigInteger('car_id')->unsigned()->nullable();
            $table->BigInteger('company_hotel_id')->unsigned()->nullable();

            $table->BigInteger('type_id')->unsigned();
            $table->integer('rate')->default(0);

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('car_id')
                    ->references('id')
                    ->on('cars')
                    ->onDelete('cascade');

            $table->foreign('company_hotel_id')
                    ->references('id')
                    ->on('companies')
                    ->onDelete('cascade');

            $table->foreign('type_id')
                    ->references('id')
                    ->on('types')
                    ->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('ratings');
    }
}
