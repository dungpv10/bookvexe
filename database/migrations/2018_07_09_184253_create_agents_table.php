<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 255)->comment('username to login');
            $table->string('password', 100);
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('email', 100);
            $table->string('address', 255)->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('user_id')->unsigned()->nullable()->comment('id of admin has created agent');
            $table->string('logo_path')->nullable()->comment('logo thumbnail path');

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
        Schema::dropIfExists('agents');
    }
}
