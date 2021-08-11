<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->BigInteger('type_id')->unsigned();
            $table->text('photos')->nullable();
            $table->integer('wide')->nullable();
            $table->integer('single')->nullable();
            $table->integer('double')->nullable();
            $table->integer('king')->nullable();
            $table->integer('queen')->nullable();
            $table->integer('ppl')->nullable();
            $table->integer('pricepernight')->nullable();
            $table->BigInteger('company_id')->unsigned();
            $table->integer('common')->nullable();
            $table->integer('status');
            $table->softDeletes();

            $table->foreign('type_id')->references('id')
                ->on('types')
                ->onDelete('cascade');

            $table->foreign('company_id')->references('id')
                ->on('companies')
                ->onDelete('cascade');
            $table->timestamps();
        });

         Schema::create('facility_room', function (Blueprint $table) {
            $table->id();

            $table->BigInteger('facility_id')->unsigned();
            $table->BigInteger('room_id')->unsigned();

            $table->foreign('facility_id')
                ->references('id')
                ->on('facilities')
                ->onDelete('cascade');

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
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
        Schema::dropIfExists('rooms');
         Schema::dropIfExists('facility_room');
    }
}
