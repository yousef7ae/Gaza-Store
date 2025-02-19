<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialMediaToStores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->longText('url_facebook')->nullable();
            $table->longText('url_instagram')->nullable();
            $table->longText('url_whatsapp')->nullable();
            $table->longText('url_twitter')->nullable();
            $table->longText('url_telegram')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('url_facebook');
            $table->dropColumn('url_instagram');
            $table->dropColumn('url_whatsapp');
            $table->dropColumn('url_twitter');
            $table->dropColumn('url_telegram');
        });
    }
}
