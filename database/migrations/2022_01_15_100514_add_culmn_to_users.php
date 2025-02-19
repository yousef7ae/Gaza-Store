<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCulmnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('country_id')->nullable();
            $table->bigInteger('city_id')->nullable();
            $table->string('address')->nullable();
            $table->bigInteger('postal_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('country_id');
            $table->dropColumn('city_id');
            $table->dropColumn('address');
            $table->dropColumn('postal_code');
        });
    }
}
