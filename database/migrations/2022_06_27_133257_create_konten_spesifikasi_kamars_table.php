<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontenSpesifikasiKamarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konten_spesifikasi_kamar', function (Blueprint $table) {
            $table->id();
            $table->integer('spesifikasi_kamar_id');
            $table->string('konten');
            $table->timestamps();

            $table->foreign('spesifikasi_kamar_id')->references('id')->on('spesifikasi_kamar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konten_spesifikasi_kamar');
    }
}
