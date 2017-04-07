<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('middlename');
            $table->string('surname');
            $table->string('birthday');
            $table->string('email');
            $table->string('address');
            $table->string('ava_path');
            $table->integer('constat_id')->unsigned();
            $table->foreign('constat_id')->references('id')->on('constats')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('contype_id')->unsigned();
            $table->foreign('contype_id')->references('id')->on('contypes')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('contractors');
    }
}
