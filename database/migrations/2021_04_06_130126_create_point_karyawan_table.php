<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_karyawan', function (Blueprint $table) {
            $table->bigIncrements('id_point_karyawan');
            $table->double('kredential')->nullable();
            $table->double('unit')->nullable();
            $table->double('posisi')->nullable();
            $table->double('performa')->nullable();
            $table->double('disiplin')->nullable();
            $table->double('komplain')->nullable();
            $table->double('pm')->nullable();

            $table->unsignedBigInteger('id_periode')->unsigned();
            $table->foreign('id_periode')->references('id_periode')->on('periode')->onDelete('cascade');

            $table->unsignedBigInteger('id_karyawan_penunjang')->nullable();
            $table->foreign('id_karyawan_penunjang')->references('id_karyawan_penunjang')->on('karyawan_penunjang')->onDelete('cascade');

            $table->unsignedBigInteger('id_karyawan_perawat')->nullable();
            $table->foreign('id_karyawan_perawat')->references('id_karyawan_perawat')->on('karyawan_perawat')->onDelete('cascade');

            $table->unsignedBigInteger('id_karyawan_admin')->nullable();
            $table->foreign('id_karyawan_admin')->references('id_karyawan_admin')->on('karyawan_admin')->onDelete('cascade');
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
        Schema::dropIfExists('point_karyawan');
    }
}
