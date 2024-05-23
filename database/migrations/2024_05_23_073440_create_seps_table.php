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
        Schema::create('seps', function (Blueprint $table) {
            $table->id();
            $table->string('noSep');
            $table->date('tglSep');
            $table->string('jnsPelayanan');
            $table->string('kelasRawat');
            $table->string('noRujukan');
            $table->string('noSurat');

            $table->string('nomorkartu');
            $table->string('nama');
            $table->string('norm');
            $table->string('nohp');
            $table->date('tglLahir');
            $table->string('kelamin');
            $table->string('jnsPeserta');
            $table->string('hakKelas');

            $table->string('kodepoli');
            $table->string('namapoli');
            $table->string('kodedokter');
            $table->string('namadokter');
            $table->string('diagnosa');

            $table->string('tujuanKunj');
            $table->string('assestmenPel');
            $table->string('flagProcedure');
            $table->string('kdPenunjang');

            $table->string('eSEP');
            $table->string('catatan');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seps');
    }
};
