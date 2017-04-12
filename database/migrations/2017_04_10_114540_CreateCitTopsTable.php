<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitTopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cit_tops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('advert_id')->unsigned();
            $table->foreign('advert_id')->references('id')->on('adverts')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('cit_id')->unsigned();
            $table->foreign('cit_id')->references('id')->on('cits')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('top_type');
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
        Schema::drop('cit_tops');
    }
}
