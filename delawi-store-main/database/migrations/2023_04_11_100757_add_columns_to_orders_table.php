<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('delivery_method_id')->nullable();
            $table->bigInteger('status_id')->nullable();
            $table->float('redeem_price')->nullable();
            $table->string('discount_price')->nullable();
            $table->tinyInteger('delivery_status')->nullable();
            $table->float('status_points')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('delivery_method_id');
            $table->dropColumn('status_id');
            $table->dropColumn('redeem_price');
            $table->dropColumn('discount_price');
            $table->dropColumn('delivery_status');
            $table->dropColumn('status_points');
        });
    }
}
