<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontenFasilitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konten_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->integer('fasilitas_id');
            $table->string('konten');
            $table->timestamps();

            $table->foreign('fasilitas_id')->references('id')->on('fasilitas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konten_fasilitas');
    }
}
