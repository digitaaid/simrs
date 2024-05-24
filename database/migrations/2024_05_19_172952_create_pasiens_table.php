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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('norm')->unique();
            $table->string('nama');
            $table->string('nomorkartu')->nullable();
            $table->string('nik')->nullable();
            $table->string('idpatient')->nullable();
            $table->string('nohp')->nullable();
            $table->string('gender')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('hakkelas')->nullable();
            $table->string('jenispeserta')->nullable();
            $table->string('fktp')->nullable();
            $table->string('desa_id')->nullable();
            $table->string('kecamatan_id')->nullable();
            $table->string('kabupaten_id')->nullable();
            $table->string('provinsi_id')->nullable();
            $table->text('alamat')->nullable();
            $table->string('status')->default(1);
            $table->string('keterangan')->nullable();
            // masuk ke pasien
            // $table->string('pekerjaan')->nullable();
            // $table->string('agama')->nullable();
            // $table->string('pendidikan')->nullable();
            // $table->string('status_nikah')->nullable();
            // $table->string('bahasa')->nullable();
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
        Schema::dropIfExists('pasiens');
    }
};
