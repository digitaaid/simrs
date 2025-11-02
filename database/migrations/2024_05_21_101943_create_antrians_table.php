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
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();
            $table->string('kodebooking')->unique()->index();
            $table->string('kunjungan_id')->nullable();
            $table->string('kodekunjungan')->nullable();
            $table->string('jenispasien');
            $table->string('nomorkartu');
            $table->string('nik');
            $table->string('norm');
            $table->string('nohp');
            $table->string('kodepoli');
            $table->string('namapoli')->nullable();
            $table->string('pasienbaru');
            $table->date('tanggalperiksa');
            $table->string('kodedokter');
            $table->string('namadokter')->nullable();
            $table->string('jampraktek')->nullable();
            $table->string('jeniskunjungan');
            $table->string('nomorreferensi')->nullable();
            $table->string('nomorantrean');
            $table->string('angkaantrean');
            $table->text('keterangan')->nullable();
            $table->text('jenisresep')->nullable();
            $table->text('catatan')->nullable();
            $table->string('nama');
            $table->string('sep_id')->nullable();
            $table->string('sep')->nullable();
            $table->string('nomorrujukan')->nullable();
            $table->string('nomorsuratkontrol')->nullable();
            $table->string('perujuk')->nullable();
            $table->string('estimasidilayani')->nullable();
            $table->string('jadwal_id');
            $table->string('method');
            $table->integer('taskid')->default(0);
            $table->boolean('status')->default(0);
            $table->string('bridgingantrian')->default(1);
            $table->boolean('sync_antrian')->default(0);
            $table->boolean('sync_inacbg')->default(0);
            $table->boolean('panggil')->default(0);
            $table->dateTime('taskid1')->nullable();
            $table->dateTime('taskid2')->nullable();
            $table->dateTime('taskid3')->nullable();
            $table->dateTime('taskid4')->nullable();
            $table->dateTime('taskid5')->nullable();
            $table->dateTime('taskid6')->nullable();
            $table->dateTime('taskid7')->nullable();
            $table->string('user1')->nullable();#pendaftaran
            $table->string('user2')->nullable();#perawat
            $table->string('user3')->nullable();#dokter
            $table->string('user4')->nullable();#farmasi
            $table->string('user5')->nullable();#rm
            $table->string('user6')->nullable();#keuangan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrians');
    }
};
