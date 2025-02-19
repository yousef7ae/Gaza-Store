<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStoreTypeIdColumnToStoreCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_categories', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('store_type_id')->nullable();

            $table->foreign('store_type_id')
                  ->references('id')
                  ->on('store_types')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('store_categories', function (Blueprint $table) {
            //
            $table->dropForeign('store_categories_store_type_id_foreign');
            $table->dropColumn('store_type_id');
        });
    }
}
