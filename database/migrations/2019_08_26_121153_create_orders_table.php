<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('orders', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->integer('customer_id')->unsigned()->index();
        $table->foreign('customer_id')->references('id')->on('customers');
        $table->integer('shop_id')->unsigned()->index();
        $table->foreign('shop_id')->references('id')->on('shops');
        $table->text('address')->nullable(false);
        $table->string(':pincode')->nullable(false);
        $table->string('landmark');
        $table->string('status')->nullable(false);
        $table->datetime('delivery_at')->nullable(false);

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
        Schema::dropIfExists('orders');
    }
}
