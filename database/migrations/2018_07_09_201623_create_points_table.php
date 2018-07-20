<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('point_type_id')->unsigned()->comment('point type_id');
            $table->foreign('point_type_id')->references('id')->on('point_types')->onDelete('cascade');
            $table->integer('route_id')->unsigned()->comment('route id');
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');

            $table->integer('drop_time')->comment('time to drop customer'); // 00 -> 23
            $table->string('address', 255)->comment('address of drop point');
            $table->string('landmark')->comment('Address to pick customer');
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
        Schema::dropIfExists('points');
    }
}
