<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneriksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generiks', function (Blueprint $table) {

            $table->bigIncrements('id');
			$table->string('generik');
			$table->string('pregnancy_safety_index')->nullable();
			$table->string('peroral')->nullable();
			$table->string('parenteral')->nullable();
			$table->string('topical')->nullable();
			$table->string('opthalmic')->nullable();
			$table->string('vaginal')->nullable();
			$table->string('inhalation')->nullable();
			$table->string('lingual')->nullable();
			$table->string('transdermal')->nullable();
			$table->string('nasal')->nullable();
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
        Schema::dropIfExists('generiks');
    }
}
