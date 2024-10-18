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
        Schema::create('shift_pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('shift_id');
            $table->date('tanggal');
            $table->string('nama_shift')->nullable();
            $table->string('jam_masuk')->nullable();
            $table->string('jam_pulang')->nullable();
            // absensi masuk
            $table->dateTime('absensi_masuk')->nullable();
            $table->string('telat')->nullable();
            $table->string('lat_masuk')->nullable();
            $table->string('long_masuk')->nullable();
            $table->string('jarak_masuk')->nullable();
            $table->string('foto_absensi_masuk')->nullable();
            // absensi pulang
            $table->dateTime('absensi_pulang')->nullable();
            $table->string('pulang_cepat')->nullable();
            $table->string('lat_pulang')->nullable();
            $table->string('long_pulang')->nullable();
            $table->string('jarak_pulang')->nullable();
            $table->string('foto_absensi_pulang')->nullable();
            $table->string('status_absen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_pegawais');
    }
};
