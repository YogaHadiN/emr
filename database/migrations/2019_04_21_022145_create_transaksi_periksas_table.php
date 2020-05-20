<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiPeriksasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_periksas', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('periksa_id');
			$table->string('tarif_id');
			$table->integer('biaya')->nullable();
			$table->string('asisten_tindakan_id')->nullable();
			$table->longText('keterangan_pemeriksaan')->nullable();
			$table->string('user_id');
			$table->string('nurse_station_id');
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
        Schema::dropIfExists('transaksi_periksas');
    }
}
