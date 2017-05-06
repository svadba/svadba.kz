<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComboCitCategorAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_cit_categor_adverts', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('combo_cit_categor_id')->unsigned();
            $table->integer('advert_id')->unsigned();
            $table->timestamps();

            //$table->foreign('combo_cit_categor_id')->references('id')->on('combo_cit_categors')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('advert_id')->references('id')->on('adverts')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('combo_cit_categor_adverts');
    }
}
