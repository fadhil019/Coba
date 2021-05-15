<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriTindakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_tindakan', function (Blueprint $table) {
            $table->bigIncrements('id_kategori_tindakan');
            $table->string('nama')->nullable();
            $table->enum('kategori_data',['Penunjang', 'Tindakan khusus dokter'])->nullable();
            $table->enum('tahapan_proses',['Semua', 'Proses 3', 'Proses 4'])->nullable();

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
        Schema::dropIfExists('kategori_tindakan');
    }
}
