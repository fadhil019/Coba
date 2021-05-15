<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpahJpPenunjangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upah_jp_penunjang', function (Blueprint $table) {
            $table->bigIncrements('id_upah_jp_penunjang');
            $table->double('total_upah_jp')->nullable();

            $table->unsignedBigInteger('id_periode')->unsigned();
            $table->foreign('id_periode')->references('id_periode')->on('periode')->onDelete('cascade');

            $table->unsignedBigInteger('id_karyawan_penunjang')->unsigned();
            $table->foreign('id_karyawan_penunjang')->references('id_karyawan_penunjang')->on('karyawan_penunjang')->onDelete('cascade');
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
        Schema::dropIfExists('upah_jp_penunjang');
    }
}
