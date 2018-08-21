<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInitialize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('initializes', function(Blueprint $table){
            $table->increments('id');
            $table->string('initialize_name');
            $table->integer('number_customer')->default(0);
            $table->dateTime('start_time')->nullable();

            $table->integer('bus_id')->unsigned()->nullable();
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->comment('user create');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('driver_id')->unsigned()->nullable()->comment('driver on user table');
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade')->comment('Driver id');

            $table->integer('car_accessory_id')->unsigned()->nullable()->comment('driver on user table');
            $table->foreign('car_accessory_id')->references('id')->on('users')->onDelete('cascade')->comment('Car accessory id');

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
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('initializes');
    }
}
