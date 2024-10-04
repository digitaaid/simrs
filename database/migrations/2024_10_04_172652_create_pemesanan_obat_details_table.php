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
            $table->string('kode');
            $table->string('pemesanan_obat_id');
            $table->string('obat_id');
            $table->string('nama');
            $table->string('kekuatan');
            $table->string('zat_aktif');
            $table->string('satuan');
            $table->string('kemasan');
            $table->string('jumlah');
            $table->string('harga');
            $table->string('total');
            $table->string('status')->default(0);
            $table->string('pic');
            $table->string('user');
            $table->timestamps();
            $table->softDeletes();
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
