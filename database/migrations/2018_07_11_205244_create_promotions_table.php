<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('code')->unique()->comment('code promotion');
            $table->float('amount')->comment('price promotion');
            $table->tinyInteger('status')->default(1)->comment('0 : Inactive / 1 : Active');
            $table->date('expiry_date')->nullable()->comment('Expired date');
            $table->integer('agent_id')->comment('agent id')->unsigned();
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');

            $table->integer('user_id')->nullable()->unsigned()->comment('create user');
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('modify_user_id')->nullable()->unsigned()->comment('user update');
            $table->foreign('modify_user_id')->references('id')->on('users');

            $table->integer('promotion_type')->default(PROMOTION_FOR_CUSTOMER)->comment('0 : Both, 1 : new customer, 2 : old customer');
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
        Schema::dropIfExists('promotions');
    }
}
