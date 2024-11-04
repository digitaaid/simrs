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
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique()->index();
            $table->integer('counter');
            $table->datetime('tgl_masuk');
            $table->datetime('tgl_pulang')->nullable();
            $table->string('jaminan');
            // identitas pasien
            $table->string('nomorkartu');
            $table->string('norm');
            $table->string('nama');
            $table->date('tgl_lahir');
            $table->string('gender');
            $table->string('kelas');
            $table->string('penjamin');

            $table->string('unit');
            $table->string('dokter');
            // ranap
            $table->string('kode_transfer')->nullable();
            $table->string('kamar_id')->nullable();
            $table->string('bed_id')->nullable();
            $table->string('status_pulang')->nullable();
            $table->date('tgl_meninggal')->nullable();
            $table->string('noSuratMeninggal')->nullable();
            $table->string('noLPManual')->nullable();

            $table->string('jeniskunjungan');
            $table->string('nomorreferensi')->nullable();
            $table->string('sep')->nullable();

            $table->string('diagnosa_awal')->nullable();
            $table->string('diagnosa1')->nullable();
            $table->string('diagnosa2')->nullable();

            $table->string('cara_masuk');
            $table->string('alasan_pulang')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('catatan')->nullable();
            $table->string('status');
            $table->string('idencounter')->nullable();
            $table->string('idconditition')->nullable();
            $table->string('user1')->nullable(); #pendaftaran
            $table->string('user2')->nullable(); #perawat
            $table->string('user3')->nullable(); #dokter
            $table->string('user4')->nullable(); #farmasi
            $table->string('user5')->nullable(); #rm
            $table->string('user6')->nullable(); #keuangan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungans');
    }
};
