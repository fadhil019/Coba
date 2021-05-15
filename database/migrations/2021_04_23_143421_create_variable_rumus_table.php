<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariableRumusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variable_rumus', function (Blueprint $table) {
            $table->bigIncrements('id_variable_rumus');

            $table->unsignedBigInteger('id_kategori_tindakan')->nullable();
            $table->foreign('id_kategori_tindakan')->references('id_kategori_tindakan')->on('kategori_tindakan')->onDelete('cascade');

            // $table->string('nama_variabel')->nullable();
            // $table->string('rumus')->nullable();
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
        Schema::dropIfExists('variable_rumus');
    }
}
