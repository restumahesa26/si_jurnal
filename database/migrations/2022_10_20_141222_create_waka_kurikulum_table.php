<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWakaKurikulumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waka_kurikulum', function (Blueprint $table) {
            $table->string('nip')->primary();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('pangkat')->nullable();
            $table->string('golongan')->nullable();
            $table->string('jabatan')->nullable();
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
        Schema::dropIfExists('waka_kurikulum');
    }
}
