<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('codeno');
            $table->text('photo');
            $table->string('model');
            $table->string('seats');
            $table->integer('doors');
            $table->integer('bags');
            $table->integer('aircon')->default('1');
            $table->integer('status')->default('1');

            $table->BigInteger('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->BigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');

            $table->BigInteger('company_id')->unsigned();
            
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->string('priceperday');
            $table->string('discount');
            $table->integer('qty');
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
        Schema::dropIfExists('cars');
    }
}
