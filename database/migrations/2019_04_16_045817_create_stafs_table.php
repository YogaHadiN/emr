<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStafsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stafs', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('nama');
			$table->string('alamat')->nullable();
			$table->string('no_telp')->nullable();
			$table->string('role_id');
			$table->string('user_id');
			$table->string('password')->default( bcrypt('123456') );
			/* $table->string('image')->nullable(); */
			/* $table->string('ktp_image')->nullable(); */
			/* $table->string('str_image')->nullable(); */
			/* $table->string('sip_image')->nullable(); */
			/* $table->string('menikah')->nullable(); */
			/* $table->string('npwp')->nullable(); */
			/* $table->string('jumlah_anak')->nullable(); */
			/* $table->string('gambar_npwp')->nullable(); */
			/* $table->string('sip')->nullable(); */
			/* $table->string('sex')->nullable(); */
			/* $table->string('ada_penghasilan_lain')->nullable(); */
			/* $table->string('surat_nikah')->nullable(); */
			/* $table->string('kartu_keluarga')->nullable(); */
			/* $table->string('suami_bekerja')->nullable(); */
			/* $table->string('nomor_rekening')->nullable(); */
			/* $table->string('bank')->nullable(); */
			/* $table->string('gaji_tetap')->nullable(); */
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
        Schema::dropIfExists('stafs');
    }
}
