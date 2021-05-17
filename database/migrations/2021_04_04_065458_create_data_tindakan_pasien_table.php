<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTindakanPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_tindakan_pasien', function (Blueprint $table) {
            $table->bigIncrements('id_data_tindakan_pasien');

            $table->unsignedBigInteger('id_transaksi');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi')->onDelete('cascade');
            
            $table->string('nama_dokter_perawat')->nullable();

            $table->unsignedBigInteger('id_deskripsi_tindakan')->nullable();
            $table->foreign('id_deskripsi_tindakan')->references('id_deskripsi_tindakan')->on('deskripsi_tindakan')->onDelete('cascade');

            $table->integer('jp')->nullable();
            
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
        Schema::dropIfExists('data_tindakan_pasien');
    }
}
