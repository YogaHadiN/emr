<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerapisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terapis', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('obat_id');
			$table->string('tipe_resep_id');
			$table->string('signa_id');
			$table->string('aturan_minum_id');
			$table->string('jumlah');
			$table->string('harga_beli_satuan');
			$table->string('harga_jual_satuan');
			$table->string('periksa_id');
			$table->string('nurse_station_id');
			$table->string('user_id');
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
        Schema::dropIfExists('terapis');
    }
}
