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
        Schema::create('soap', function (Blueprint $table) {
            $table->id();
            $table->string('kunjungan_id');
            $table->dateTime('tanggal');
            $table->string('ppa');
            $table->string('tipe')->nullable();
            // isi
            $table->text('subject')->nullable();
            $table->text('object')->nullable();
            $table->text('assesment')->nullable();
            $table->text('plan')->nullable();
            $table->text('implementation')->nullable();
            $table->text('evaluation')->nullable();
            $table->text('revised')->nullable();
            $table->string('pic')->nullable();
            $table->string('user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soap');
    }
};
