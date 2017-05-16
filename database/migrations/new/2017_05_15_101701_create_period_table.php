<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('period', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 50);
            $table->integer('tahun');
            $table->smallInteger('semester');
            $table->date('mulai');
            $table->date('selesai');
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
        Schema::dropIfExists('period');
    }
}
