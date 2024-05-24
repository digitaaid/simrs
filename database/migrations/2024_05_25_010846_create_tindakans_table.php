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
        Schema::create('tindakans', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->index();
            $table->string('klasifikasi');
            $table->string('jenispasien')->default('SEMUA');
            $table->string('jasa_pelayanan')->default(0);
            $table->string('jasa_rs')->default(0);
            $table->string('harga')->default(0);
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
        Schema::dropIfExists('tindakans');
    }
};
