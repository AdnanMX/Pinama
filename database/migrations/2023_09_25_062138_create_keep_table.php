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
        Schema::create('keep', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penyimpan');
            $table->string('nomor_keep', 10)->unique();
            $table->integer('jumlah_simpan');
            $table->integer('pajak');
            $table->integer('total_simpan');
            $table->integer('sisa_simpan');
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
        Schema::dropIfExists('keep');
    }
};
