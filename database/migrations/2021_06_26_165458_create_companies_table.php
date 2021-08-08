<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('logo')->nullable();
            $table->string('ceo_name')->nullable();
            $table->text('photo')->nullable();
            $table->string('phone')->nullable();
            $table->string('addresss')->nullable();
            $table->string('incharge_name')->nullable();
            $table->string('incharge_phone')->nullable();
            $table->string('incharge_position')->nullable();
            $table->integer('status')->default(1);
            $table->text('info')->nullable();
            $table->string('service_label_one')->nullable();
            $table->string('service_label_two')->nullable();
            $table->string('service_label_three')->nullable();
            $table->text('service_desc_one')->nullable();
            $table->text('service_desc_two')->nullable();
            $table->text('service_desc_three')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('companies');
    }
}
