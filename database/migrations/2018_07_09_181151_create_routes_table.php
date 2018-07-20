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
            $table->integer('bus_id')->unsigned()->comment('bus id');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->float('price')->default(0)->comment('price on a seat');
            $table->string('from_place', 255)->comment('start place');
            $table->string('arrived_place', 255)->comment('stop place');
            $table->integer('start_time')->default(0)->comment('start time');
            $table->integer('arrived_time')->default(0)->comment('arrived time');

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
