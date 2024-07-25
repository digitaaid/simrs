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
        Schema::create('resep_farmasis', function (Blueprint $table) {
            $table->id();
            $table->string('kunjungan_id');
            $table->string('kodekunjungan');
            $table->string('antrian_id');
            $table->string('kodebooking');
            $table->string('counter');
            $table->string('norm');
            $table->string('nama');
            $table->string('tgl_lahir');
            $table->string('gender');
            $table->string('berat_badan')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('bsa')->nullable();
            // date resep
            $table->string('kode');
            $table->datetime('waktu');
            $table->string('dokter')->nullable();
            $table->string('namadokter')->nullable();
            $table->string('unit')->nullable();
            $table->string('namaunit')->nullable();
            $table->string('user')->nullable();
            $table->string('pic')->nullable();
            $table->string('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep_farmasis');
    }
};
