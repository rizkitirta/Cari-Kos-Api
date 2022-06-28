<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeraturanKosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peraturan_kos', function (Blueprint $table) {
            $table->id();
            $table->integer('kos_id');
            $table->string('judul');
            $table->timestamps();

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
        Schema::dropIfExists('peraturan_kos');
    }
}
