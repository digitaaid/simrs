<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\JadwalOperasiController;
use App\Http\Controllers\VclaimController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// ANTRIAN
Route::prefix('antrian')->group(function () {
    // API BPJS
    Route::get('ref_poli', [AntrianController::class, 'ref_poli'])->name('ref_poli');
    Route::get('ref_dokter', [AntrianController::class, 'ref_dokter'])->name('ref_dokter');
    Route::get('ref_jadwal_dokter', [AntrianController::class, 'ref_jadwal_dokter'])->name('ref_jadwal_dokter');
    Route::get('ref_poli_fingerprint', [AntrianController::class, 'ref_poli_fingerprint'])->name('ref_poli_fingerprint');
    Route::get('ref_pasien_fingerprint', [AntrianController::class, 'ref_pasien_fingerprint'])->name('ref_pasien_fingerprint');
    Route::post('update_jadwal_dokter', [AntrianController::class, 'update_jadwal_dokter'])->name('update_jadwal_dokter');
    Route::post('tambah_antrean', [AntrianController::class, 'tambah_antrean'])->name('tambah_antrean');
    Route::post('tambah_antrean_farmasi', [AntrianController::class, 'tambah_antrean_farmasi'])->name('tambah_antrean_farmasi');
    Route::post('update_antrean', [AntrianController::class, 'update_antrean'])->name('update_antrean');
    Route::post('batal_antrean', [AntrianController::class, 'batal_antrean'])->name('batal_antrean');
    Route::post('taskid_antrean', [AntrianController::class, 'taskid_antrean'])->name('taskid_antrean');
    Route::get('dashboard_tanggal', [AntrianController::class, 'dashboard_tanggal'])->name('dashboard_tanggal');
    Route::get('dashboard_bulan', [AntrianController::class, 'dashboard_bulan'])->name('dashboard_bulan');
    Route::get('antrian_tanggal', [AntrianController::class, 'antrian_tanggal'])->name('antrian_tanggal');
    Route::get('antrian_kodebooking', [AntrianController::class, 'antrian_kodebooking'])->name('antrian_kodebooking');
    Route::get('antrian_belum_dilayani', [AntrianController::class, 'antrian_belum_dilayani'])->name('antrian_belum_dilayani');
    Route::get('antrian_poliklinik', [AntrianController::class, 'antrian_poliklinik'])->name('antrian_poliklinik');
    // MJKN
    Route::get('token', [AntrianController::class, 'token'])->name('token');
    Route::post('statusantrean', [AntrianController::class, 'status_antrian'])->name('statusantrean');
    Route::post('ambilantrean', [AntrianController::class, 'ambil_antrian_mjkn'])->name('ambilantrean');
    Route::post('sisaantrean', [AntrianController::class, 'sisa_antrian'])->name('sisaantrean');
    Route::post('batalantrean', [AntrianController::class, 'batal_antrian'])->name('batalantrean');
    Route::post('checkin', [AntrianController::class, 'checkin_antrian'])->name('checkin');
    Route::post('infopasienbaru', [AntrianController::class, 'info_pasien_baru'])->name('infopasienbaru');
    Route::post('jadwaloperasi', [JadwalOperasiController::class, 'jadwal_operasi_rs'])->name('jadwaloperasi');
    Route::post('jadwaloperasipasien', [JadwalOperasiController::class, 'jadwal_operasi_pasien'])->name('jadwaloperasipasien');
    Route::post('ambilantreanfarmasi', [AntrianController::class, 'ambil_antrian_farmasi'])->name('ambilantreanfarmasi');
    Route::post('statusantreanfarmasi', [AntrianController::class, 'status_antrian_farmasi'])->name('statusantreanfarmasi');
});


Route::prefix('vclaim')->group(function () {
    Route::get('rujukan_nomor', [VclaimController::class, 'rujukan_nomor'])->name('rujukan_nomor');
    Route::get('rujukan_peserta', [VclaimController::class, 'rujukan_peserta'])->name('rujukan_peserta');
});
Route::prefix('wa')->group(function () {
    Route::post('webhook', [WhatsappController::class, 'webhook'])->name('webhook');
});
