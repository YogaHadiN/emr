<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFakturBelanjaObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faktur_belanja_obats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor_nota');
            $table->string('staf_id');
            $table->date('tanggal');
            $table->integer('diskon');
            $table->string('user_id');
            $table->string('supplier_id');
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
        Schema::dropIfExists('faktur_belanja_obats');
    }
}
