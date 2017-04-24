<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basket_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('cit_id')->unsigned();
            $table->foreign('cit_id')->references('id')->on('cits')->onDelete('cascade')->onUpdate('cascade');
            $table->string('phone');
            $table->string('email');
            $table->string('adverts');
            $table->timestamp('tusa_at')->nullable();
            $table->integer('ended')->nullable();
            $table->timestamp('ended_at')->nullable();
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
        Schema::drop('basket_requests');
    }
}
