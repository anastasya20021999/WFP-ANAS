<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubmasters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submasters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('pembayaran')->nullable();
            $table->integer('master_id')->unsigned();
            $table->foreign('master_id')->references('id')->on('masters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submasters');
    }
}
