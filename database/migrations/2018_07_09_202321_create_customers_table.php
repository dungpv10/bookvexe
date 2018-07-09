<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name', 255)->comment('customer name');
            $table->string('email', 255)->comment('customer email');
            $table->string('number_phone', 255)->comment('customer number phone');

            $table->integer('bus_id')->unsigned()->comment('customer of a bus');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->integer('assistant_user_id')->unsigned()->default(0)->comment('customer of a bus');

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
        Schema::dropIfExists('customers');
    }
}
