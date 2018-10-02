<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SettingCancelBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_cancel_bookings', function(Blueprint $table){
            $table->increments('id');
            $table->integer('bus_id')->unsigned()->nullable();
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->integer('cancel_time')->nullable();
            $table->float('percentage')->nullable();
            $table->float('flat')->nullable();
            $table->tinyInteger('cancel_type')->default(0);

            $table->integer('user_id')->unsigned()->comment('user create')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('setting_cancel_bookings');
    }
}
