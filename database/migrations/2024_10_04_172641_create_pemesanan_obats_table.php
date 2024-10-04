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
            $table->string('kode')->unique(); // Kode unik pemesanan
            $table->string('nomor')->unique(); // Nomor unik pemesanan
            $table->string('penganggungjawab'); // Orang yang bertanggung jawab
            $table->string('jabatan'); // Jabatan penanggung jawab
            $table->string('sipa'); // Surat Izin Praktek Apoteker
            $table->foreignId('supplier_id')->constrained('supplier_obats')->onDelete('cascade'); // Relasi ke pemasok
            $table->string('alamat_distributor'); // Alamat distributor
            $table->string('nohp'); // Nomor telepon distributor
            $table->string('nama_sarana'); // Nama sarana
            $table->string('alamat_sarana'); // Alamat sarana
            $table->string('no_izin_sarana'); // Nomor izin sarana
            $table->string('apoteker'); // Nama apoteker
            $table->string('status')->default(1); // Status pemesanan (aktif/nonaktif)
            $table->foreignId('pic_id')->constrained('users')->onDelete('set null'); // Pengguna terakhir yang bertanggung jawab
            $table->foreignId('user_id')->constrained('users')->onDelete('set null'); // Pengguna yang terakhir mengubah data
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
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
