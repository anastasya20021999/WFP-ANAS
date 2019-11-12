<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransaksis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->double('jumlah');
            $table->text('keterangan');
            $table->string('nama_gambar');
            $table->integer('master_id')->unsigned()->nullable();
            $table->foreign('master_id')->references('id')->on('masters');
            $table->integer('submaster_id')->unsigned()->nullable();
            $table->foreign('submaster_id')->references('id')->on('submasters');
            $table->integer('saldo_id')->unsigned();
            $table->foreign('saldo_id')->references('id')->on('saldos');
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
        Schema::dropIfExists('transaksis');
    }
}
