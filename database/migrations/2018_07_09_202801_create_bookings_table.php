<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('customer_id')->unsigned()->nullable()->comment('customer id, customer dont need login to book');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->integer('bus_id')->unsigned()->comment('bus id');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');

            $table->tinyInteger('payment_status')->default(0)->comment('Status of payment');
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
        Schema::dropIfExists('bookings');
    }
}
