<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description', 10000);
            $table->string('rating');
            $table->integer('views');
            $table->integer('allow_type_id')->unsigned();
            $table->foreign('allow_type_id')->references('id')->on('allow_types')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('advert_categor_id')->unsigned();
            $table->foreign('advert_categor_id')->references('id')->on('advert_categors')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('advert_stat_id')->unsigned();
            $table->foreign('advert_stat_id')->references('id')->on('advert_stats')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('contractor_id')->unsigned();
            $table->foreign('contractor_id')->references('id')->on('contractors')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->timestamp('published_at')->nullable();
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
        Schema::drop('adverts');
    }
}
