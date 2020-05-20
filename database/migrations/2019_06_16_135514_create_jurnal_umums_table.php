<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJurnalUmumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_umums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('coa_id');
            $table->integer('nilai');
            $table->tinyInteger('debit');
            $table->string('jurnalable_id');
            $table->string('jurnalable_type');
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
        Schema::dropIfExists('jurnal_umums');
    }
}
