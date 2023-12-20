<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('take', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_take');
            $table->string('nomor_take', 10)->unique();
            $table->string('nama_pengambil');
            $table->string("foto")->nullable();
            $table->integer('uang_ambil');
            $table->unsignedInteger('lama_ambil')->default(1);
            $table->integer('bunga');
            $table->integer('total_ambil');
            $table->integer('total_simpan');
            $table->integer('simpanan');
            $table->timestamps();

            $table->foreign('id_take')->references('id')->on('keep');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('take');
    }
};
