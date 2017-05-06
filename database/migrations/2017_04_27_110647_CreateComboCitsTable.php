<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComboCitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_cits', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('combo_id')->unsigned();
            $table->integer('cit_id')->unsigned();
            $table->timestamps();

            //$table->foreign('combo_id')->references('id')->on('combos')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('cit_id')->references('id')->on('cits')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('combo_cits');
    }
}
