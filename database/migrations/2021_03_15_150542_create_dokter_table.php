<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->bigIncrements('id_dokter');
            $table->string('nama_dokter')->nullable();
            $table->enum('bagian',['Umum', 'Spesialis'])->nullable();
            // $table->string('tindakan_khusus')->nullable();

            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('id_ruangan');
            $table->foreign('id_ruangan')->references('id_ruangan')->on('ruangan')->onDelete('cascade');

            $table->unsignedBigInteger('id_kategori_tindakan')->nullable();
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
        Schema::dropIfExists('dokter');
    }
}
