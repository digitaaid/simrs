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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('kodejkn')->nullable();
            $table->string('idorganization')->nullable();
            $table->string('idlocation')->nullable();
            $table->string('nama');
            $table->string('jenis')->nullable();
            $table->string('lokasi')->nullable();
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
        Schema::dropIfExists('units');
    }
};
