<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanPenunjangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan_penunjang', function (Blueprint $table) {
            $table->bigIncrements('id_karyawan_penunjang');
            $table->string('nama')->nullable();
            $table->enum('jabatan',['Kepala', 'Wakil', 'Karyawan'])->nullable();

            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('bagian')->nullable();
            $table->foreign('bagian')->references('id_kategori_tindakan')->on('kategori_tindakan')->onDelete('cascade');
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
        Schema::dropIfExists('karyawan_penunjang');
    }
}
