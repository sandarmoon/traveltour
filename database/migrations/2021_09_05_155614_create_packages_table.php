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
            $table->string('name');
            $table->text('desc')->nullable();
            $table->BigInteger('depart_id')->unsigned();
            $table->BigInteger('arrive_id')->unsigned();
            $table->date('start');
            $table->date('end');
            $table->BigInteger('priceperperson');
            $table->BigInteger('discount')->default(0);
            $table->BigInteger('days')->nullable();
            $table->BigInteger('ppl');
            $table->BigInteger('company_hotel_id')->unsigned();
            $table->BigInteger('company_car_id')->unsigned();
            $table->integer('status')->default(1);

            $table->foreign('depart_id')
                    ->references('id')
                    ->on('cities')
                    ->onDelete('cascade');

            $table->foreign('arrive_id')
                    ->references('id')
                    ->on('cities')
                    ->onDelete('cascade');

            $table->foreign('company_hotel_id')
                    ->references('id')
                    ->on('companies')
                    ->onDelete('cascade');

            $table->foreign('company_car_id')
                    ->references('id')
                    ->on('cars')
                    ->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();

        });
        
        Schema::create('tours_packages', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('tour_id')->unsigned();
            $table->foreign('tour_id')
                    ->references('id')
                    ->on('tours')
                    ->onDelete('cascade');
            $table->BigInteger('package_id')->unsigned();
            $table->foreign('package_id')
                    ->references('id')
                    ->on('packages')
                    ->onDelete('cascade');
            $table->integer('status')->default(1);
            $table->softDeletes();
             $table->timestamps();
        });
        

        Schema::create('package_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('codeno');
            $table->BigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->BigInteger('package_id')->unsigned();
            $table->foreign('package_id')
                    ->references('id')
                    ->on('packages')
                    ->onDelete('cascade');
            $table->text('msg')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->integer('ppl')->default(1);
            $table->BigInteger('total');
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
        Schema::dropIfExists('tours');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('tours_packages');
        Schema::dropIfExists('package_bookings');
    }
}
