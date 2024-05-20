<?php

use App\Livewire\Bpjs\Antrian\RefDokter;
use App\Livewire\Bpjs\Antrian\RefJadwalDokter;
use App\Livewire\Bpjs\Antrian\RefPoliklinik;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

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
        Route::get('bpjs/antrian/refpoliklinik', RefPoliklinik::class)->name('antrian.refpoliklinik');
        Route::get('bpjs/antrian/refdokter', RefDokter::class)->name('antrian.refdokter');
        Route::get('bpjs/antrian/refjadwaldokter', RefJadwalDokter::class)->name('antrian.refjadwaldokter');
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
    Route::get('profil', ProfilIndex::class)->lazy()->name('profil');
});
