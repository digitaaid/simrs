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
        Schema::create('asesmen_rajals', function (Blueprint $table) {
            $table->id();
            // asesmen perawat
            $table->string('sumber_data')->nullable();
            $table->text('keluhan_utama')->nullable();
            $table->text('riwayat_penyakit')->nullable();
            $table->text('riwayat_penyakit_keluarga')->nullable();
            $table->text('riwayat_alergi')->nullable();
            $table->string('pernah_berobat')->nullable();
            $table->text('riwayat_pengobatan')->nullable();
            // skala nyeri dan fungsi kognitif
            $table->string('skala_nyeri')->nullable();
            $table->string('keluhan_nyeri')->nullable();
            $table->string('respon_buka_mata')->nullable();
            $table->string('respon_verbal')->nullable();
            $table->string('respon_motorik')->nullable();
            $table->string('resiko_jatuh')->nullable();
            $table->string('alat_bantu')->nullable();
            $table->string('alat_bantu_text')->nullable();
            $table->string('cacat_fisik')->nullable();
            $table->string('cacat_fisik_text')->nullable();
            // psikologi
            $table->string('status_psikologi')->nullable();
            $table->string('tinggal_dengan')->nullable();
            $table->string('hubungan_keluarga')->nullable();
            $table->string('ekonomi')->nullable();
            $table->string('edukasi')->nullable();
            // diet
            $table->string('penurunan_berat_badan')->nullable();
            $table->string('asupan_berkurang')->nullable();
            $table->string('apakah_diagnosa_khusus')->nullable();
            // tandatanda vital
            $table->string('denyut_jantung')->nullable();
            $table->string('pernapasan')->nullable();
            $table->string('sistole')->nullable();
            $table->string('distole')->nullable();
            $table->string('suhu')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('bsa')->nullable();
            $table->string('bmi')->nullable();
            $table->string('tingkat_kesadaran')->nullable();
            $table->text('pemeriksaan_fisik_perawat')->nullable();
            // expertise
            $table->text('pemeriksaan_lab')->nullable();
            $table->text('pemeriksaan_rad')->nullable();
            $table->text('pemeriksaan_penunjang')->nullable();
            // a dan p perawat
            $table->text('diagnosa_keperawatan')->nullable();
            $table->text('rencana_keperawatan')->nullable();
            $table->text('tindakan_keperawatan')->nullable();
            $table->text('evaluasi_keperawatan')->nullable();
            // data dasar
            $table->string('kunjungan_id');
            $table->string('kodekunjungan');
            $table->string('antrian_id');
            $table->string('kodebooking');
            $table->string('counter');
            $table->string('norm');
            $table->string('nama');
            $table->string('tgl_lahir');
            $table->string('gender');
            // asesmen perawat
            $table->datetime('waktu_asesmen_perawat')->nullable();
            $table->string('status_asesmen_perawat')->default('0');
            $table->string('pic_perawat')->nullable();
            $table->string('user_perawat')->nullable();
            // s & a dokter
            $table->text('pemeriksaan_fisik_dokter')->nullable();
            $table->text('diagnosa_dokter')->nullable();
            $table->text('diagnosa')->nullable();
            $table->text('icd1')->nullable();
            $table->text('idc1_text')->nullable();
            $table->text('icd2')->nullable();
            $table->text('icd2_text')->nullable();
            $table->text('icd29')->nullable();
            $table->text('icd29_text')->nullable();
            // p dokter
            $table->text('rencana_medis')->nullable();
            $table->text('tindakan_medis')->nullable();
            $table->text('instruksi_medis')->nullable();
            // asesmen dokter
            $table->datetime('waktu_asesmen_dokter')->nullable();
            $table->string('status_asesmen_dokter')->default('0');
            $table->string('pic_dokter')->nullable();
            $table->string('user_dokter')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesmen_rajals');
    }
};
