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
        Schema::create('hasil_laboratoria', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('norm');
            $table->string('nik')->nullable();
            $table->string('nomorkartu')->nullable();
            $table->date('tanggal');
            $table->string('filename');
            $table->string('fileurl');
            $table->text('pemeriksaan');
            $table->text('hasil');
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
        Schema::dropIfExists('hasil_laboratoria');
    }
};
