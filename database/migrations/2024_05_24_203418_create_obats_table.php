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
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->index();
            $table->string('kemasan')->nullable();
            $table->integer('konversi_satuan')->default(1);
            $table->string('satuan')->nullable();
            $table->string('stok_minimum')->nullable();
            $table->string('jenisobat');
            $table->string('tipeobat')->nullable();
            // harga
            $table->string('harga_beli')->default(0);
            $table->string('diskon_beli')->default(0);
            $table->string('harga_jual')->default(0);
            $table->string('harga_klinik')->default(0);
            $table->string('harga_bpjs')->default(0);
            // merk
            $table->string('merk')->nullable();
            $table->string('distributor')->nullable();
            $table->string('bpom')->nullable();
            $table->string('barcode')->nullable();
            // manajemen
            $table->string('user');
            $table->string('pic');
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};
