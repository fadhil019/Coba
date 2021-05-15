<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan_admin', function (Blueprint $table) {
            $table->bigIncrements('id_karyawan_admin');
            $table->string('nama')->nullable();
            $table->enum('jabatan',['Kepala', 'Wakil', 'Karyawan'])->nullable();
            $table->enum('bagian',['Admin rekam medis', 'Admin umum', 'Struktural'])->nullable();

            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('karyawan_admin');
    }
}
