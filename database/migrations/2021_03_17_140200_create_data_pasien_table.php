<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pasien', function (Blueprint $table) {
            $table->bigIncrements('id_data_pasien');
            $table->string('no_sep')->nullable();
            $table->string('user_kasir')->nullable();
            $table->string('tgl_masuk')->nullable();
            $table->string('tgl_keluar')->nullable();
            $table->string('no_rm')->nullable();
            $table->string('nama_pasien')->nullable();
            $table->string('penjamin')->nullable();
            $table->string('reg_type')->nullable();
            $table->string('nama_dokter_perawat')->nullable();
            $table->string('kategori_ruangan')->nullable();
            $table->string('deskripsi_tindakan')->nullable();
            $table->integer('jp')->nullable();

            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('id_periode')->nullable();
            $table->foreign('id_periode')->references('id_periode')->on('periode')->onDelete('cascade');

            $table->unsignedBigInteger('id_ruangan')->nullable();
            $table->foreign('id_ruangan')->references('id_ruangan')->on('ruangan')->onDelete('cascade');

            $table->unsignedBigInteger('id_dpjp')->nullable();
            $table->foreign('id_dpjp')->references('id_dokter')->on('dokter')->onDelete('cascade');

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
        Schema::dropIfExists('data_pasien');
    }
}
