<?php

use App\Models\kos;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKamarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kamar', function (Blueprint $table) {
            $table->id();
            $table->integer('kos_id');
            $table->string('nama');
            $table->string('tipe_kamar');
            $table->integer('harga');
            $table->integer('max_orang');
            $table->text('deskripsi');
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
        Schema::dropIfExists('kamar');
    }
}
