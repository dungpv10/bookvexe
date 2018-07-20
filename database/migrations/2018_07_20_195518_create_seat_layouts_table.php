<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seat_layouts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bus_id')->unsigned()->comment('Bus id');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->integer('seat_type_id')->comment('seat type id');
            $table->integer('total_seat');
            $table->integer('layout_id');
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
        Schema::dropIfExists('seat_layouts');
    }
}
