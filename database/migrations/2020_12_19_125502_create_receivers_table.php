<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiversTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('age');
            $table->integer('created_by')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('created_by')->references('')->on('users');
            $table->foreign('user_id')->references('')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('receivers');
    }
}
