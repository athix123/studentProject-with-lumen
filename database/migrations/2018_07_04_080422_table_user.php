<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namaPengguna')->nullable();
            $table->string('namaLengkap')->nullable();
            $table->string('jenisKelamin')->nullable();
            $table->string('tanggalLahir')->nullable();
            $table->string('email')->nullable();
            $table->string('sandi')->nullable();
            $table->string('noHp')->nullable();
            $table->string('token')->nullable();
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
        Schema::dropIfExists('user');
    }
}
