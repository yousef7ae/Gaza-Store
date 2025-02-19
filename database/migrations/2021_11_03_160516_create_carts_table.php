<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->float('price')->nullable();
            $table->bigInteger('qty')->nullable();
            $table->float('total')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->string('product_name')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('device_id')->nullable();
            $table->string('store_id')->nullable();
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
        Schema::dropIfExists('carts');
    }
}
