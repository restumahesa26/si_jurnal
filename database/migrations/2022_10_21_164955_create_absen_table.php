<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_siswa_id')->references('id')->on('kelas_siswa');
            $table->foreignId('mapel_id')->references('id')->on('mata_pelajaran');
            $table->enum('status', ['Hadir', 'Sakit', 'Izin', 'Tanpa Keterangan'])->nullable();
            $table->date('tanggal');
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
        Schema::dropIfExists('absen');
    }
}
