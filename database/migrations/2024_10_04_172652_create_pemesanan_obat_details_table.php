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
        Schema::create('pemesanan_obat_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_obat_id')->from('pemesanan_obats')->onDelete('cascade'); // Relasi ke pemesanan obat utama
            $table->foreignId('obat_id')->from('obats')->onDelete('cascade'); // Relasi ke tabel obat
            $table->string('nama'); // Nama obat
            $table->string('kekuatan'); // Kekuatan obat
            $table->string('zat_aktif'); // Zat aktif obat
            $table->string('satuan'); // Satuan obat
            $table->string('kemasan'); // Kemasan obat
            $table->integer('jumlah'); // Jumlah pemesanan
            $table->double('harga'); // Harga obat
            $table->double('total'); // Total (jumlah * harga)
            $table->boolean('status')->default(1); // Status detail pemesanan (belum selesai/sudah selesai)
            $table->foreignId('pic'); // Pengguna terakhir yang bertanggung jawab
            $table->foreignId('user'); // Pengguna yang terakhir mengubah data
            $table->timestamps();
            $table->softDeletes(); // Mendukung soft delete untuk detail pemesanan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_obat_details');
    }
};
