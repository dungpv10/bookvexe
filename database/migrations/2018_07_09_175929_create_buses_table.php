<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('bus_name', 255)->comment('bus name');
            $table->string('bus_reg_number')->nullable()->comment('registration bus number');
            $table->integer('bus_type_id')->comment('post type id');
            $table->integer('number_seats')->default(0)->comment('total seat on the bus');
            $table->string('start_point', 100)->comment('Place bus start');
            $table->string('end_point', 100)->comment('Place bus stop');
            $table->string('start_time', 50)->comment('Time bus start');
            $table->string('end_time', 50)->comment('Time bus stop');
            $table->string('amenities')->nullable()->comment('all services of the bus');
            $table->tinyInteger('status')->default(BUS_INACTIVE)->comment('status of bus');
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
        Schema::dropIfExists('buses');
    }
}
