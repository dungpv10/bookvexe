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
            $table->date('booking_date')->default(date('Y-m-d'));
            $table->tinyInteger('payment_status')->default(NOT_PAYMENT)->comment('Status of payment');
            $table->string('pickup_point')->comment('Place pickup customer');
            $table->string('drop_point')->comment('Place drop customer');
            $table->string('seat_number')->comment('Number of customer seat');
            $table->float('amount')->comment('Price of seat')->default(0);
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
        Schema::dropIfExists('bookings');
    }
}
