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
        Schema::create('surat_kontrols', function (Blueprint $table) {
            $table->id();
            $table->string('noSuratKontrol');
            $table->string('noSepAsalKontrol');
            $table->date('tglRencanaKontrol');
            $table->date('tglTerbitKontrol');
            $table->string('nomorkartu');
            $table->string('norm')->nullable();
            $table->string('nama')->nullable();
            $table->string('nohp')->nullable();
            $table->string('kelamin')->nullable();
            $table->string('tglLahir')->nullable();
            $table->string('poliKontrol');
            $table->string('namaPoliTujuan')->nullable();
            $table->string('kodeDokter');
            $table->string('namaDokter')->nullable();
            $table->string('catatan')->nullable();
            $table->string('user');
            $table->string('kodebooking')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_kontrols');
    }
};
