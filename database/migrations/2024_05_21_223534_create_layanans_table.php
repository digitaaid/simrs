<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->string('kodekunjungan')->index()->nullable();
            $table->string('kunjungan_id')->index()->nullable();
            $table->string('kodebooking')->index()->nullable();
            $table->string('antrian_id')->index()->nullable();
            $table->string('nama');
            $table->string('tarif_id');
            $table->double('harga');
            $table->integer('jumlah');
            $table->integer('diskon');
            $table->double('subtotal');
            $table->string('klasifikasi');
            $table->string('jaminan');
            $table->string('status')->default('1');
            $table->string('pic');
            $table->string('user');
            $table->text('keterangan')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->dateTime('tgl_transaksi')->nullable();
            $table->dateTime('tgl_verifikasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
