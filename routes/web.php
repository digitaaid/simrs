<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftaranController;
use App\Livewire\Antrian\AnjunganAntrian;
use App\Livewire\Antrian\AnjunganAntrianCreate;
use App\Livewire\Bpjs\Antrian\AntreanBelumLayani;
use App\Livewire\Bpjs\Antrian\AntreanDokter;
use App\Livewire\Bpjs\Antrian\AntreanKodebooking;
use App\Livewire\Bpjs\Antrian\AntreanTanggal;
use App\Livewire\Bpjs\Antrian\DashboardBulan;
use App\Livewire\Bpjs\Antrian\DashboardTanggal;
use App\Livewire\Bpjs\Antrian\ListTaskid;
use App\Livewire\Bpjs\Antrian\RefDokter;
use App\Livewire\Bpjs\Antrian\RefJadwalDokter;
use App\Livewire\Bpjs\Antrian\RefPesertaFingerprint;
use App\Livewire\Bpjs\Antrian\RefPoliklinik;
use App\Livewire\Bpjs\Antrian\RefPoliklinikFingerprint;
use App\Livewire\Counter;
use App\Livewire\Dokter\DokterIndex;
use App\Livewire\Integration\IntegrationForm;
use App\Livewire\Integration\IntegrationIndex;
use App\Livewire\Jadwaldokter\JadwalDokterIndex;
use App\Livewire\Pasien\PasienForm;
use App\Livewire\Pasien\PasienIndex;
use App\Livewire\Pegawai\PegawaiCreate;
use App\Livewire\Pegawai\PegawaiForm;
use App\Livewire\Pegawai\PegawaiIndex;
use App\Livewire\Pendaftaran\PendaftaranRajal;
use App\Livewire\Pendaftaran\PendaftaranRajalProses;
use App\Livewire\Perawat\PerawatIndex;
use App\Livewire\Profil\ProfilIndex;
use App\Livewire\Unit\UnitIndex;
use App\Livewire\User\PermissionIndex;
use App\Livewire\User\RoleIndex;
use App\Livewire\User\RolePermission;
use App\Livewire\User\UserCreate;
use App\Livewire\User\UserForm;
use App\Livewire\User\UserIndex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'landingpage'])->name('landingpage');

Auth::routes();

// display antrian
Route::get('displayantrian', [AntrianController::class, 'displayAntrian'])->name('displayantrian');
Route::get('updatenomorantrean', [AntrianController::class, 'updatenomorantrean'])->name('updatenomorantrean');
Route::get('displaynomor', [AntrianController::class, 'displaynomor'])->name('displaynomor');
Route::get('getdisplayantrian', [AntrianController::class, 'getdisplayantrian'])->name('getdisplayantrian');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::middleware(['can:admin'])->group(function () {
        Route::get('role-permission', RolePermission::class)->name('role-permission');
        Route::get('integration', IntegrationIndex::class)->name('integration.index');
        Route::get('user', UserIndex::class)->name('user.index');
        Route::get('user/create', UserForm::class)->name('user.create');
        Route::get('user/edit/{id}', UserForm::class)->name('user.edit');
    });
    Route::middleware(['can:pegawai'])->group(function () {
        Route::get('pegawai', PegawaiIndex::class)->name('pegawai.index');
        Route::get('pegawai/create', PegawaiForm::class)->name('pegawai.create');
        Route::get('pegawai/edit/{id}', PegawaiForm::class)->name('pegawai.edit');
    });
    Route::middleware(['can:antrian-bpjs'])->group(function () {
        Route::get('bpjs/antrian/refpoliklinik', RefPoliklinik::class)->name('antrian.refpoliklinik')->lazy();
        Route::get('bpjs/antrian/refdokter', RefDokter::class)->name('antrian.refdokter')->lazy();
        Route::get('bpjs/antrian/refjadwaldokter', RefJadwalDokter::class)->name('antrian.refjadwaldokter')->lazy();
        Route::get('bpjs/antrian/refpoliklinik-fingerprint', RefPoliklinikFingerprint::class)->name('antrian.refpoliklinik.fingerprint')->lazy();
        Route::get('bpjs/antrian/refpeserta-fingerprint', RefPesertaFingerprint::class)->name('antrian.refpeserta.fingerprint')->lazy();
        Route::get('bpjs/antrian/listtaskid', ListTaskid::class)->name('antrian.listtaskid')->lazy();
        Route::get('bpjs/antrian/dashboardtanggal', DashboardTanggal::class)->name('antrian.dashboardtanggal')->lazy();
        Route::get('bpjs/antrian/dashboardbulan', DashboardBulan::class)->name('antrian.dashboardbulan')->lazy();
        Route::get('bpjs/antrian/antreantanggal', AntreanTanggal::class)->name('antrian.antreantanggal')->lazy();
        Route::get('bpjs/antrian/antreankodebooking', AntreanKodebooking::class)->name('antrian.antreankodebooking')->lazy();
        Route::get('bpjs/antrian/antreanbelumlayani', AntreanBelumLayani::class)->name('antrian.antreanbelumlayani')->lazy();
        Route::get('bpjs/antrian/antreandokter', AntreanDokter::class)->name('antrian.antreandokter')->lazy();
    });
    Route::middleware(['can:manajemen-pelayanan'])->group(function () {
        Route::get('pasien', PasienIndex::class)->name('pasien.index');
        Route::get('pasien/create', PasienForm::class)->name('pasien.create');
        Route::get('pasien/edit/{norm}', PasienForm::class)->name('pasien.edit');
        Route::get('dokter', DokterIndex::class)->name('dokter.index');
        Route::get('perawat', PerawatIndex::class)->name('perawat.index');
        Route::get('unit', UnitIndex::class)->name('unit.index');
        Route::get('jadwaldokter', JadwalDokterIndex::class)->name('jadwaldokter.index');
    });
    // anjungan antrian
    Route::get('anjunganantrian', AnjunganAntrian::class)->name('anjunganantrian.index');
    Route::get('anjunganantrian/create/{jenispasien}/{tanggalperiksa}', AnjunganAntrianCreate::class)->name('anjunganantrian.create');
    Route::get('anjunganantrian/checkin/', AnjunganAntrian::class)->name('anjunganantrian.checkin');
    Route::get('anjunganantrian/print/{kodebooking}', [PendaftaranController::class, 'printkarcis'])->name('anjunganantrian.print');
    Route::get('anjunganantrian/test/', AnjunganAntrian::class)->name('anjunganantrian.test');

    // pendaftaran
    Route::get('pendaftaran/rajal', PendaftaranRajal::class)->name('pendaftaran.rajal');
    Route::get('pendaftaran/rajal/{kodebooking}', PendaftaranRajalProses::class)->name('pendaftaran.rajal.proses');
    Route::get('profil', ProfilIndex::class)->lazy()->name('profil');
});
