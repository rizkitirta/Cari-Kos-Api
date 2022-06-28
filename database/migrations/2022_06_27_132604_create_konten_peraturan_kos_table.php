<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontenPeraturanKosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konten_peraturan_kos', function (Blueprint $table) {
            $table->id();
            $table->integer('peraturan_kos_id');
            $table->string('konten');
            $table->timestamps();

            $table->foreign('peraturan_kos_id')->references('id')->on('peraturan_kos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konten_peraturan_kos');
    }
}
