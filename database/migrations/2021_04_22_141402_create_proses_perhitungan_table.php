<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsesPerhitunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proses_perhitungan', function (Blueprint $table) {
            $table->bigIncrements('id_proses_perhitungan');
            $table->string('ket_kategori')->nullable();
            $table->enum('proses',['Ke 1', 'Ke 2', 'Ke 3', 'Ke 4'])->nullable();
            $table->double('jumlah_jp')->nullable();

            $table->unsignedBigInteger('id_data_pasien');
            $table->foreign('id_data_pasien')->references('id_data_pasien')->on('data_pasien')->onDelete('cascade');

            $table->unsignedBigInteger('id_transaksi');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi')->onDelete('cascade');

            $table->unsignedBigInteger('id_kategori_tindakan')->nullable();
            $table->foreign('id_kategori_tindakan')->references('id_kategori_tindakan')->on('kategori_tindakan')->onDelete('cascade');

            $table->unsignedBigInteger('id_dokter')->nullable();
            $table->foreign('id_dokter')->references('id_dokter')->on('dokter')->onDelete('cascade');

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
        Schema::dropIfExists('proses_perhitungan');
    }
}
