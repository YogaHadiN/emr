<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('merek');
            $table->longtext('formula');
            $table->string('kode_rak')->nullable();
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->date('exp_date');
			$table->tinyInteger('fornas')->default(1);
			$table->integer('stok_minimal');
			$table->integer('stok')->nullable();
			$table->tinyInteger('dijual_bebas');
			$table->string('sediaan');
			$table->string('aturan_minum_id');
			$table->mediumText('peringatan')->nullable();
			$table->string('tidak_dipuyer');
			$table->tinyInteger('verified');
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
        Schema::dropIfExists('obats');
    }
}
