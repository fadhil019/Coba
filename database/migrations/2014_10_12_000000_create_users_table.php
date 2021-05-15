<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_users');
            $table->string('username')->unique()->nullable();
            $table->string('nama_user')->nullable();
            $table->enum('bagian',['Admin sistem','Admin remunerasi','Admin ruangan', 'Kolektif data', 'Manajemen remunerasi', 'Penunjang remunerasi' , 'Perawat remunerasi'])->nullable();
            $table->string('password')->nullable();
            
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
