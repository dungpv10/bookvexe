<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bus_id')->unsigned()->comment('bus id');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->string('image_path', 255)->comment('path of image');
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
        Schema::dropIfExists('bus_images');
    }
}
