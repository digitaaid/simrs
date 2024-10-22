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
        Schema::create('resume_ranaps', function (Blueprint $table) {
            $table->id();
            $table->string('kunjungan_id');
            $table->string('kodekunjungan');
            $table->string('norm');
            $table->date('tgl_resume');
            $table->text('diagnosis_masuk')->nullable();
            $table->text('anamnesis')->nullable();
            $table->text('pemeriksaan_fisik')->nullable();
            $table->text('alasan_dirawat')->nullable();
            $table->text('pemeriksaan_penunjang')->nullable();
            $table->text('diagnosis_primer')->nullable();
            $table->text('diagnosis_sekunder')->nullable();
            $table->text('tindakan_operasi')->nullable();
            $table->text('pengobatan')->nullable();
            $table->string('kondisi_pulang')->nullable();
            $table->string('cara_pulang')->nullable();
            $table->string('di_rujuk')->nullable();
            $table->dateTime('tgl_kontrol')->nullable();
            $table->string('ttd_pasien')->nullable();
            $table->string('ttd_dokter')->nullable();
            $table->string('user');
            $table->string('pic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_ranaps');
    }
};
