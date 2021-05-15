<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariableRumusDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variable_rumus_detail', function (Blueprint $table) {
            $table->bigIncrements('id_variable_rumus_detail');

            $table->unsignedBigInteger('id_kategori_tindakan')->nullable();
            $table->foreign('id_kategori_tindakan')->references('id_kategori_tindakan')->on('kategori_tindakan')->onDelete('cascade');

            $table->unsignedBigInteger('id_variable_rumus')->nullable();
            $table->foreign('id_variable_rumus')->references('id_variable_rumus')->on('variable_rumus')->onDelete('cascade');

            $table->double('nilai')->nullable();
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
        Schema::dropIfExists('variable_rumus_detail');
    }
}
