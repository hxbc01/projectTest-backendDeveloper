<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->char('NIP')->primary();
            $table->string('nama');
            $table->string('password');
            $table->string('OPD');
            $table->char('id_jabatan');
            $table->char('id_status');
            $table->foreign('id_status')->references('id_status')->on('status_kepegawaian');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatan');
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};
