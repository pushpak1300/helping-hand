<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('reciever_id');
            $table->unsignedBigInteger('user_or_merchant_id');
            $table->integer('amount');
            $table->enum('type', ['donation','order']);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_or_merchant_id')->references('id')->on('users');
            $table->foreign('reciever_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}
