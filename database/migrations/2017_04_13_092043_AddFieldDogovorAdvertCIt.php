<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldDogovorAdvertCIt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advert_cits', function (Blueprint $table) {
            $table->integer('dogovor')->after('price_two');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advert_cits', function (Blueprint $table) {
            $table->dropColumn('dogovor');
        });
    }
}
