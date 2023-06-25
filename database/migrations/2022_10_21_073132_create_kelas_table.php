<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_ajaran_id')->references('id')->on('tahun_ajaran');
            $table->string('kelas', 50);
            $table->string('jenjang', 50);
            $table->string('wali_kelas', 18);
            $table->foreign('wali_kelas')->references('nip')->on('guru')->onUpdate('cascade');
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
        Schema::dropIfExists('kelas');
    }
}
