<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('city_id')->unsigned();
            $table->text('photo')->nullable();
            $table->string('title')->nullable();
            $table->text('desc')->nullable();
            $table->softDeletes();
             $table->timestamps();
            $table->foreign('city_id')
                    ->references('id')
                    ->on('cities')
                    ->onDelete('cascade');
        });
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')
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
         Schema::dropIfExists('tours');
        Schema::dropIfExists('packages');
    }
}
