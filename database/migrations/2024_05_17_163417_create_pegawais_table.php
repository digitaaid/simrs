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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('nik')->nullable();
            $table->string('nohp');
            $table->date('awal_kerja')->nullable();
            $table->string('avatar')->nullable();
            $table->string('avatar_original')->nullable();
            $table->string('alamat')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();
            $table->string('departemen')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('sekolah')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('sip')->nullable();
            $table->string('str')->nullable();
            $table->string('sip_expire')->nullable();
            $table->string('status')->default(1);
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
        Schema::dropIfExists('pegawais');
    }
};
