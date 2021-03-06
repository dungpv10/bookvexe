<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentTable extends Migration
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
            $table->string('agent_name');
            $table->string('agent_address')->nullable();
            $table->string('agent_license')->nullable();
            $table->string('agent_fax')->nullable();
            $table->string('agent_mobile')->nullable();
            $table->string('agent_email')->nullable();
            $table->string('agent_website')->nullable();
            $table->string('agent_representation')->nullable();
            $table->string('agent_representation_mobile')->nullable();
            $table->string('agent_business_license_number')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('status', array_rand([AGENT_ACTIVE, AGENT_INACTIVE]));
            $table->integer('user_id')->unsigned()->comment('User create')->nullable();
            $table->integer('modify_user_id')->unsigned()->comment('User update')->nullable();
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
        Schema::dropIfExists('agents');
    }
}
