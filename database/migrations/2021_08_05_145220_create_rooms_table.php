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
            $table->integer('single')->nullable();
            $table->integer('double')->nullable();
            $table->integer('king')->nullable();
            $table->integer('queen')->nullable();
            $table->integer('ppl')->nullable();
            $table->integer('pricepernight')->nullable();
            $table->BigInteger('company_id')->unsigned();
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

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
