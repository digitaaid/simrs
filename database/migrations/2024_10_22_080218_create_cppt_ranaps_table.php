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
        Schema::create('cppt_ranaps', function (Blueprint $table) {
            $table->id();
            $table->string('kunjungan_id');
            $table->string('kodekunjungan');
            $table->string('norm');
            $table->dateTime('tgl_input');
            $table->string('profesi');
            $table->text('subjective')->nullable();
            $table->text('objective')->nullable();
            $table->text('assessment')->nullable();
            $table->text('plan')->nullable();
            $table->string('dokter_jaga')->nullable();
            $table->string('dokter_dpjp')->nullable();
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
        Schema::dropIfExists('cppt_ranaps');
    }
};
