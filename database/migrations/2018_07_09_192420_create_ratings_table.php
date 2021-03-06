<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->tinyInteger('rating_number')->default(0)->comment('rating number');
            $table->integer('bus_id')->unsigned()->comment('bus id');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->nullable()->comment('Customer vote');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->string('comment')->comment('Comment of customer');

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
        Schema::dropIfExists('ratings');
    }
}
