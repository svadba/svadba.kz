<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComboCitCategorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_cit_categors', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('combo_cit_id')->unsigned();
            $table->integer('advert_categor_id')->unsigned();
            $table->timestamps();

            //$table->foreign('combo_cit_id')->references('id')->on('combo_cits')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('advert_categor_id')->references('id')->on('advert_categors')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('combo_cit_categors');
    }
}
