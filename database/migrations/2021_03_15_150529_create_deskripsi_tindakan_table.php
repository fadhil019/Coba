<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeskripsiTindakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deskripsi_tindakan', function (Blueprint $table) {
            $table->bigIncrements('id_deskripsi_tindakan');
            $table->string('deskripsi_tindakan')->nullable();

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
        Schema::dropIfExists('deskripsi_tindakan');
    }
}
