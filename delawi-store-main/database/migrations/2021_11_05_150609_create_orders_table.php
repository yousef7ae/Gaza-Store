<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('order_number')->nullable();
            $table->string('note')->nullable();
            $table->string('discount')->nullable();
            $table->string('total')->nullable();
            $table->string('coupon')->nullable();
            $table->bigInteger('buyer_id')->nullable();
            $table->bigInteger('driver_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('status')->nullable();
            $table->bigInteger('store_id')->nullable();
            $table->bigInteger('payment_gateway_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
