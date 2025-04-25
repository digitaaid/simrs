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
        Schema::create('riwayat_obat_details', function (Blueprint $table) {
            $table->id();
            $table->string('kunjungan_id');
            $table->string('antrian_id');
            $table->string('resep_id');
            $table->string('koderesep');
            $table->string('jaminan');
            // sigma
            $table->string('nama');
            $table->integer('jumlah');
            $table->string('frekuensi')->nullable();
            $table->string('waktu')->nullable();
            $table->text('keterangan')->nullable();
            // harga layanan
            $table->string('obat_id')->nullable();
            $table->double('harga')->nullable();
            $table->double('diskon')->default(0);
            $table->double('subtotal')->nullable();
            $table->string('klasifikasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_obat_details');
    }
};
