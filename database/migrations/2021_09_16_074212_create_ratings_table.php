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
            $table->BigInteger('item_id')->unsigned();
            $table->BigInteger('type_id')->unsigned();
            $table->integer('rate')->default(0);

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('type_id')
                    ->references('id')
                    ->on('types')
                    ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();

           
        });

         Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();
            $table->text('message')->nullable();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();

           
        });

         Schema::create('emailcontacts', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->string('email')->nullable();
            $table->text('message')->nullable();
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
