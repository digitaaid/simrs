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
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nama_panjang')->nullable();
            $table->string('ip_public')->nullable();
            $table->string('logo_icon')->nullable();
            $table->string('auth_img')->nullable();

            $table->string('anjungan_color')->nullable();
            $table->string('anjungan_qr')->nullable();
            $table->string('anjungan_img_info')->nullable();
            $table->string('logo_karcis')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
    }
};
