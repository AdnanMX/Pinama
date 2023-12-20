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
        Schema::create('borrow', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam');
            $table->bigInteger('no_hp');
            $table->string('alamat');
            $table->string('nomor_borrow', 10)->unique();
            $table->string("foto")->nullable();
            $table->integer('jumlah_pinjam');
            $table->integer('bunga');
            $table->unsignedInteger('lama_pinjam')->default(1);
            $table->integer('total_pinjam');
            $table->integer('sisa_bayar');
            $table->enum('status', ['belum_lunas', 'lunas'])->default('belum_lunas');
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
        Schema::dropIfExists('borrow');
    }
};
