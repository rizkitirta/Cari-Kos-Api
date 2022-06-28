<?php

use App\Models\kategori;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('kategori_id');
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('lintang');
            $table->string('bujur');
            $table->integer('provinsi_id');
            $table->integer('kabkota_id');
            $table->integer('kecamatan_id');
            $table->text('alamat');
            $table->string('logo');
            $table->string('cover');
            $table->boolean('uang_muka');
            $table->integer('persentase_uang_muka');
            $table->integer('tipe_pembayaran');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('kategori_id')->references('id')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kos');
    }
}
