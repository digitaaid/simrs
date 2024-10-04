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
        Schema::create('supplier_obats', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama pemasok
            $table->string('alamat'); // Alamat pemasok
            $table->string('kontak'); // Kontak pemasok
            $table->string('email')->nullable(); // Email pemasok (optional)
            $table->string('nohp')->nullable(); // Nomor HP pemasok (optional)
            $table->softDeletes(); // Soft delete jika diperlukan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_obats');
    }
};
