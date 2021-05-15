<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpahJpPerawatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upah_jp_perawat', function (Blueprint $table) {
            $table->bigIncrements('id_upah_jp_perawat');
            $table->double('jp_pertama')->nullable();
            $table->double('jp_kedua')->nullable();
            $table->double('total_upah_jp')->nullable();

            $table->unsignedBigInteger('id_periode')->unsigned();
            $table->foreign('id_periode')->references('id_periode')->on('periode')->onDelete('cascade');

            $table->unsignedBigInteger('id_karyawan_perawat')->unsigned();
            $table->foreign('id_karyawan_perawat')->references('id_karyawan_perawat')->on('karyawan_perawat')->onDelete('cascade');
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
        Schema::dropIfExists('upah_jp_perawat');
    }
}
