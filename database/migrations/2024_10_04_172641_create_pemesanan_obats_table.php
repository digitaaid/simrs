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
        Schema::create('pemesanan_obats', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nomor');
            $table->string('penganggungjawab');
            $table->string('jabatan');
            $table->string('sipa');
            $table->string('distributor');
            $table->string('alamat_distributor');
            $table->string('nohp');
            $table->string('nama_sarana');
            $table->string('alamat_sarana');
            $table->string('no_izin_sarana');
            $table->string('apoteker');
            $table->string('status')->default(1);
            $table->string('pic');
            $table->string('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_obats');
    }
};
