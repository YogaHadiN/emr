<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNurseStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurse_stations', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('asuransi_id');
			$table->string('poli_id');
			$table->string('pasien_id');
			$table->string('staf_id');
			$table->dateTime('waktu');
			$table->tinyInteger('hamil')->nullable();
			$table->integer('tinggi_badan')->nullable();
			$table->integer('berat_badan')->nullable();
			$table->integer('suhu')->nullable();
			$table->string('asisten_id')->nullable();
			$table->tinyInteger('kecelakaan_kerja')->default(0);
			$table->string('sistolik')->nullable();
			$table->string('diastolik')->nullable();
			$table->string('random_string')->nullable();
			$table->string('periksa_id')->nullable();
			$table->string('diagnosa_id')->nullable();
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
        Schema::dropIfExists('nurse_stations');
    }
}
