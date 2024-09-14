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
            $table->dateTime('jam_absen')->nullable();
            $table->string('telat')->nullable();
            $table->string('lat_absen')->nullable();
            $table->string('long_absen')->nullable();
            $table->string('jarak_masuk')->nullable();
            $table->string('foto_jam_absen')->nullable();
            $table->dateTime('jam_pulang')->nullable();
            $table->string('pulang_cepat')->nullable();
            $table->string('foto_jam_pulang')->nullable();
            $table->string('lat_pulang')->nullable();
            $table->string('long_pulang')->nullable();
            $table->string('jarak_pulang')->nullable();
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