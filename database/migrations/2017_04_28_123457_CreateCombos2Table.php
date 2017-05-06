<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombos2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('combos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('name_eng', 100);
            $table->string('description', 2000);
            $table->integer('price');
            $table->string('photo_path');
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
        Schema::drop('combos');
    }
}
