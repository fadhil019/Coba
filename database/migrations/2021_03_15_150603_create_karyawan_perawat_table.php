<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanPerawatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan_perawat', function (Blueprint $table) {
            $table->bigIncrements('id_karyawan_perawat');
            $table->string('nama')->nullable();
            $table->enum('jabatan',['Kepala', 'Wakil', 'Karyawan'])->nullable();

            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('id_ruangan')->nullable();
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
        Schema::dropIfExists('karyawan_perawat');
    }
}
