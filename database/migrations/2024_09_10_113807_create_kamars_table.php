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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('unit_id');
            $table->string('koderuang');
            $table->string('namaruang');
            $table->string('kodekelas');
            $table->string('kapasitastotal')->default(0);
            $table->string('kapasitaspria')->default(0);
            $table->string('kapasitaswanita')->default(0);
            $table->string('kapasitaspriawanita')->default(0);
            $table->string('status');
            $table->string('pic');
            $table->string('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
