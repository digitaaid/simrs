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
        Schema::create('asesmen_igds', function (Blueprint $table) {
            $table->id();
            $table->string('kunjungan_id');
            $table->string('kodekunjungan');
            // triase igd
            $table->dateTime('tgl_masuk')->nullable();
            $table->dateTime('tgl_keluar')->nullable();
            $table->string('transportasi')->nullable();
            $table->string('rujukan_igd')->nullable();
            $table->string('kondisi_datang')->nullable();
            $table->string('nama_pengantar')->nullable();
            $table->string('nohp_pengantar')->nullable();
            $table->string('triaseigd')->nullable();
            $table->string('user_triaseigd')->nullable();
            $table->dateTime('time_triaseigd')->nullable();
            // anamnesa
            $table->text('keluhan_utama')->nullable();
            $table->text('riwayat_penyakit')->nullable();
            $table->text('riwayat_alergi')->nullable();
            $table->text('riwayat_pengobatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesmen_igds');
    }
};
