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
            $table->date('tgl_pemesanan');
            $table->date('tgl_kedatangan')->nullable();
            $table->string('jenis_obat')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('penanggungjawab'); // Orang yang bertanggung jawab
            $table->string('jabatan'); // Jabatan penanggung jawab
            $table->string('sipa'); // Surat Izin Praktek Apoteker
            $table->foreignId('supplier_id')->from('supplier_obats')->onDelete('cascade'); // Relasi ke pemasok
            $table->string('nama_supplier'); // Alamat distributor
            $table->string('alamat_supplier'); // Alamat distributor
            $table->string('nohp_supplier'); // Nomor telepon distributor
            $table->string('nama_sarana'); // Nama sarana
            $table->string('alamat_sarana'); // Alamat sarana
            $table->string('no_izin_sarana'); // Nomor izin sarana
            $table->string('apoteker'); // Nama apoteker
            $table->string('status')->default(1); // Status pemesanan (aktif/nonaktif)
            $table->string('pic'); // Pengguna terakhir yang bertanggung jawab
            $table->string('user'); // Pengguna yang terakhir mengubah data
            $table->timestamps();
            $table->softDeletes();
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
