<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\FarmasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\SepController;
use App\Http\Controllers\SuratKontrolController;
use App\Livewire\Antrian\AnjunganAntrian;
use App\Livewire\Antrian\AnjunganAntrianCreate;
use App\Livewire\Antrian\DaftarAntrian;
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
use App\Livewire\Bpjs\Vclaim\MonitoringDataKlaim;
use App\Livewire\Bpjs\Vclaim\MonitoringDataKunjungan;
use App\Livewire\Bpjs\Vclaim\MonitoringKlaimJasaRaharja;
use App\Livewire\Bpjs\Vclaim\MonitoringPelayananPeserta;
use App\Livewire\Bpjs\Vclaim\Peserta;
use App\Livewire\Bpjs\Vclaim\Referensi;
use App\Livewire\Bpjs\Vclaim\Rujukan;
use App\Livewire\Bpjs\Vclaim\Sep;
use App\Livewire\Bpjs\Vclaim\SuratKontrol;
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
use App\Livewire\Dokter\PemeriksaanDokterRajal;
use App\Livewire\Dokter\PemeriksaanDokterRajalProses;
use App\Livewire\Farmasi\ObatIndex;
use App\Livewire\Farmasi\PengambilanResep;
use App\Livewire\Perawat\LayananIndex;
use App\Livewire\Perawat\PemeriksaanPerawatRajal;
use App\Livewire\Perawat\PemeriksaanPerawatRajalProses;
use App\Livewire\Perawat\PerawatIndex;
use App\Livewire\Perawat\TindakanIndex;
use App\Livewire\Profil\ProfilIndex;
use App\Livewire\Rekammedis\RekamMedisRajal;
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


Auth::routes(['verify' => true]);
Route::get('/', [HomeController::class, 'landingpage'])->name('landingpage');
// display antrian
Route::get('displayantrian', [AntrianController::class, 'displayAntrian'])->name('displayantrian');
Route::get('updatenomorantrean', [AntrianController::class, 'updatenomorantrean'])->name('updatenomorantrean');
Route::get('displaynomor', [AntrianController::class, 'displaynomor'])->name('displaynomor');
Route::get('getdisplayantrian', [AntrianController::class, 'getdisplayantrian'])->name('getdisplayantrian');
Route::get('daftarantrian', DaftarAntrian::class)->name('daftarantrian');
Route::get('antrianonline/{kodebooking}', [PendaftaranController::class, 'antrianonline'])->name('antrianonline');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('profil', ProfilIndex::class)->name('profil')->lazy();
    Route::middleware(['can:admin'])->group(function () {
        Route::get('role-permission', RolePermission::class)->name('role-permission')->lazy();
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
        Route::get('bpjs/antrian/antreankodebooking/{kodebooking}', AntreanKodebooking::class)->name('antrian.antreankodebooking')->lazy();
        Route::get('bpjs/antrian/antreanbelumlayani', AntreanBelumLayani::class)->name('antrian.antreanbelumlayani')->lazy();
        Route::get('bpjs/antrian/antreandokter', AntreanDokter::class)->name('antrian.antreandokter')->lazy();
    });
    Route::middleware(['can:vclaim-bpjs'])->group(function () {
        Route::get('bpjs/vclaim/monitoring-data-kunjungan', MonitoringDataKunjungan::class)->name('vclaim.monitoring.datakunjungan')->lazy();
        Route::get('bpjs/vclaim/monitoring-data-klaim', MonitoringDataKlaim::class)->name('vclaim.monitoring.dataklaim')->lazy();
        Route::get('bpjs/vclaim/monitoring-pelayanan-peserta', MonitoringPelayananPeserta::class)->name('vclaim.monitoring.pelayananpeserta')->lazy();
        Route::get('bpjs/vclaim/monitoring-klaim-jasa-raharja', MonitoringKlaimJasaRaharja::class)->name('vclaim.monitoring.klaimjasaraharja')->lazy();
        Route::get('bpjs/vclaim/peserta-bpjs', Peserta::class)->name('vclaim.peserta.bpjs')->lazy();
        Route::get('bpjs/vclaim/referensi', Referensi::class)->name('vclaim.referensi')->lazy();
        Route::get('bpjs/vclaim/surat-kontrol', SuratKontrol::class)->name('vclaim.suratkontrol')->lazy();
        Route::get('bpjs/vclaim/suratkontrol_print', [SuratKontrolController::class, 'suratkontrol_print'])->name('vclaim.suratkontrol_print');
        Route::get('bpjs/vclaim/rujukan', Rujukan::class)->name('vclaim.rujukan')->lazy();
        Route::get('bpjs/vclaim/sep', Sep::class)->name('vclaim.sep')->lazy();
        Route::get('bpjs/vclaim/sep_print', [SepController::class, 'sep_print'])->name('vclaim.sep_print');
    });
    Route::middleware(['can:manajemen-pelayanan'])->group(function () {
        Route::get('pasien', PasienIndex::class)->name('pasien.index')->lazy();
        Route::get('pasien/create', PasienForm::class)->name('pasien.create');
        Route::get('pasien/edit/{norm}', PasienForm::class)->name('pasien.edit');
        Route::get('dokter', DokterIndex::class)->name('dokter.index');
        Route::get('perawat', PerawatIndex::class)->name('perawat.index');
        Route::get('unit', UnitIndex::class)->name('unit.index');
        Route::get('jadwaldokter', JadwalDokterIndex::class)->name('jadwaldokter.index');
        Route::get('obat', ObatIndex::class)->name('obat.index');
        Route::get('tindakan', TindakanIndex::class)->name('tindakan.index');
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
    // pemeriksaan perawat
    Route::get('pemeriksaan/perawat/rajal', PemeriksaanPerawatRajal::class)->name('pemeriksaan.perawat.rajal');
    Route::get('pemeriksaan/perawat/rajal/{kodebooking}', PemeriksaanPerawatRajalProses::class)->name('pemeriksaan.perawat.rajal.proses');
    Route::get('pemeriksaan/dokter/rajal', PemeriksaanDokterRajal::class)->name('pemeriksaan.dokter.rajal');
    Route::get('pemeriksaan/dokter/rajal/{kodebooking}', PemeriksaanDokterRajalProses::class)->name('pemeriksaan.dokter.rajal.proses');
    // farmasi
    Route::get('farmasi/pengambilan_resep', PengambilanResep::class)->name('pengambilan.resep');
    Route::get('farmasi/print_resep/{kodebooking}', [FarmasiController::class, 'print_resep'])->name('print.resep');
    Route::get('farmasi/print_etiket', [FarmasiController::class, 'print_etiket'])->name('print.etiket');
    Route::get('farmasi/print_gelang', [FarmasiController::class, 'print_gelang'])->name('print.gelang');
    // rekam medis
    Route::get('rekammedis/rajal', RekamMedisRajal::class)->name('rekammedis.rajal');
    Route::get('resumerajal/{kodebooking}',  [RekamMedisController::class, 'resumerajal'])->name('resume.rajal');
});
