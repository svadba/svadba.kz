<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComboRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('basket_request_id')->unsigned();
            $table->integer('combo_id')->unsigned();
            $table->integer('combo_cit_id')->unsigned();
            $table->string('adverts', 500);
            $table->timestamps();
            $table->foreign('basket_request_id')->references('id')->on('basket_requests')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('combo_id')->references('id')->on('combos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('combo_cit_id')->references('id')->on('combo_cits')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('combo_requests');
    }
}
