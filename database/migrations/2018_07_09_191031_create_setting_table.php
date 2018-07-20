<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->comment('title of website');
            $table->string('logo_path', 255)->comment('logo path');
            $table->string('favicon_path', 255)->comment('favicon path');
            $table->string('smtp_host', 255)->nullable();
            $table->string('smtp_username', 255)->comment('smtp username');
            $table->string('smtp_password', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->text('description')->nullable()->comment('description of website');
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
        Schema::dropIfExists('setting');
    }
}
