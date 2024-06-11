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
        Schema::create('stok_obats', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('obat_id');
            $table->string('nama');
            $table->integer('jumlah_kemasan');
            $table->integer('jumlah_satuan');
            $table->integer('harga_beli')->default(0);
            $table->integer('diskon_beli')->default(0);
            $table->bigInteger('total_harga')->default(0);
            $table->date('tgl_input')->nullable();
            $table->date('tgl_expire')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('stok_obats');
    }
};
