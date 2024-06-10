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
        Schema::create('jadwal_dokters', function (Blueprint $table) {
            $table->id();
            $table->string('hari');
            $table->string('namahari');
            $table->string('kodepoli');
            $table->string('kodesubspesialis');
            $table->string('namapoli');
            $table->string('namasubspesialis');
            $table->string('kodedokter');
            $table->string('namadokter');
            $table->string('jampraktek');
            $table->string('kapasitas');
            $table->string('huruf');
            $table->boolean('libur')->default(0);
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
        Schema::dropIfExists('jadwal_dokters');
    }
};
