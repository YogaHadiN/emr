<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('nama_peserta')->nullable();
            $table->string('asuransi_id')->default('1');
            $table->string('nomor_asuransi')->nullable();
            $table->string('jenis_peserta_id')->nullable();
            $table->string('alamat')->nullable();
            $table->tinyInteger('sex');
            $table->date('tanggal_lahir')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
			$table->string('riwayat_alergi_obat')->nullable();
			$table->string('riwayat_penyakit_dahulu')->nullable();
			$table->string('image')->nullable();
			$table->string('ktp_image')->nullable();
			$table->string('email')->nullable();
			$table->string('bpjs_image')->nullable();
			$table->string('nomor_asuransi_bpjs')->nullable();
			$table->string('nomor_ktp')->nullable();
			$table->tinyInteger('jangan_disms')->default(1);
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
        Schema::dropIfExists('pasiens');
    }
}
