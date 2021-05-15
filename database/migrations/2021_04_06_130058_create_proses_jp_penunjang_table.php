<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsesJpPenunjangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proses_jp_penunjang', function (Blueprint $table) {
            $table->bigIncrements('id_proses_jp_penunjang');
            $table->double('iku')->nullable();
            $table->double('iki')->nullable();
            $table->double('pm')->nullable();

            $table->unsignedBigInteger('id_periode')->unsigned();
            $table->foreign('id_periode')->references('id_periode')->on('periode')->onDelete('cascade');

            $table->unsignedBigInteger('id_kategori_tindakan')->unsigned();
            $table->foreign('id_kategori_tindakan')->references('id_kategori_tindakan')->on('kategori_tindakan')->onDelete('cascade');
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
        Schema::dropIfExists('proses_jp_penunjang');
    }
}
