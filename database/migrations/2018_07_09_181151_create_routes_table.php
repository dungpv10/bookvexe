<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('route_name')->comment('route name');
            $table->integer('bus_id')->unsigned()->comment('bus id');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->float('price')->default(0)->comment('price on a seat');
            $table->string('from_place', 255)->comment('start place');
            $table->string('arrived_place', 255)->comment('stop place');
            $table->time('start_time')->comment('start time');
            $table->time('arrived_time')->comment('arrived time');

            $table->integer('user_id')->unsigned()->comment('user id create');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->integer('modify_user_id')->unsigned()->comment('user update')->nullable();

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
        Schema::dropIfExists('routes');
    }
}
