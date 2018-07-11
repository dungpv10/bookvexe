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
            $table->string('code')->comment('code promotion');
            $table->float('amount')->comment('price promotion');
            $table->tinyInteger('status')->default(1)->comment('0 : Inactive / 1 : Active');
            $table->date('expiry_date')->nullable()->comment('Expired date');
            $table->integer('agent_id')->comment('agent id');
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
        Schema::dropIfExists('promotions');
    }
}
