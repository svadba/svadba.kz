<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertCitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_cits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cit_id')->unsigned();
            $table->foreign('cit_id')->references('id')->on('cits')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('price');
            $table->integer('advert_id')->unsigned();
            $table->foreign('advert_id')->references('id')->on('adverts')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('advert_cits');
    }
}
