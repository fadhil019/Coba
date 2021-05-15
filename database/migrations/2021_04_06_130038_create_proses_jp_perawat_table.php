<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsesJpPerawatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proses_jp_perawat', function (Blueprint $table) {
            $table->bigIncrements('id_proses_jp_perawat');
            $table->enum('tahapan',['Tahap 1', 'Tahap 2'])->nullable();
            $table->double('iku')->nullable();
            $table->double('iki')->nullable();
            $table->double('pm')->nullable();

            $table->unsignedBigInteger('id_periode')->unsigned();
            $table->foreign('id_periode')->references('id_periode')->on('periode')->onDelete('cascade');

            $table->unsignedBigInteger('id_ruangan')->unsigned();
            $table->foreign('id_ruangan')->references('id_ruangan')->on('ruangan')->onDelete('cascade');
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
        Schema::dropIfExists('proses_jp_perawat');
    }
}
