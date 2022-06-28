<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriKosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_kos', function (Blueprint $table) {
            $table->id();
            $table->integer('kategori_id');
            $table->integer('kos_id');
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategori');
            $table->foreign('kos_id')->references('id')->on('kos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_kos');
    }
}
