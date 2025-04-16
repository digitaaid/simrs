<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\FarmasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\SepController;
use App\Http\Controllers\SuratKontrolController;
use App\Livewire\Absensi\AbsensiProses;
use App\Livewire\Absensi\LaporanAbsensi;
use App\Livewire\Absensi\LokasiAbsensi;
use App\Livewire\Absensi\LokasiSaya;
use App\Livewire\Absensi\ShiftAbsensi;
use App\Livewire\Absensi\ShiftPegawai;
use App\Livewire\Absensi\ShiftPegawaiEdit;
use App\Livewire\Admin\WilayahIndonesia;
use App\Livewire\Antrian\AnjunganAntrian;
use App\Livewire\Antrian\AnjunganAntrianBpjs;
use App\Livewire\Antrian\AnjunganAntrianCreate;
use App\Livewire\Antrian\AnjunganAntrianMandiri;
use App\Livewire\Antrian\AnjunganAntrianUmum;
use App\Livewire\Antrian\AnjunganPasien;
use App\Livewire\Antrian\DaftarAntrian;
use App\Livewire\Aplikasi\PengaturanIndex;
use App\Livewire\Apotek\PenjualanObat;
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
use App\Livewire\Farmasi\PemesananObat;
use App\Livewire\Farmasi\PemesananObatIndex;
use App\Livewire\Farmasi\PengambilanObatIgd;
use App\Livewire\Farmasi\PengambilanObatRanap;
use App\Livewire\Farmasi\PengambilanResep;
use App\Livewire\Farmasi\SatuanKemasanIndex;
use App\Livewire\Farmasi\StokObatIndex;
use App\Livewire\Farmasi\SupplierObatIndex;
use App\Livewire\Igd\PendaftaranIgd;
use App\Livewire\Igd\PendaftaranIgdProses;
use App\Livewire\Jaminan\JaminanIndex;
use App\Livewire\Kamarbed\KamarBedIndex;
use App\Livewire\Kasir\KasirPembayaran;
use App\Livewire\Pendaftaran\DashboardPendaftaran;
use App\Livewire\Pendaftaran\MonitoringRajal;
use App\Livewire\Perawat\LayananIndex;
use App\Livewire\Perawat\PemeriksaanPerawatRajal;
use App\Livewire\Perawat\PemeriksaanPerawatRajalProses;
use App\Livewire\Perawat\PerawatIndex;
use App\Livewire\Perawat\TindakanIndex;
use App\Livewire\Profil\ProfilIndex;
use App\Livewire\Ranap\DisplayRanap;
use App\Livewire\Ranap\PendaftaranRanap;
use App\Livewire\Ranap\PendaftaranRanapProses;
use App\Livewire\Rekammedis\RekamMedisRajal;
use App\Livewire\Rekammedis\RekamMedisRajalEdit;
use App\Livewire\Satusehat\EncounterEdit;
use App\Livewire\Satusehat\EncounterIndex;
use App\Livewire\Satusehat\LocationIndex;
use App\Livewire\Satusehat\OrganizationIndex;
use App\Livewire\Satusehat\PatientIndex;
use App\Livewire\Satusehat\PractitionerIndex;
use App\Livewire\Satusehat\TokenIndex;
use App\Livewire\Unit\UnitIndex;
use App\Livewire\User\HomeIndex;
use App\Livewire\User\LogAktifitas;
use App\Livewire\User\PermissionIndex;
use App\Livewire\User\RolePermission;
use App\Livewire\User\UserCreate;
use App\Livewire\User\UserForm;
use App\Livewire\User\UserIndex;
use App\Livewire\Wa\WhatsappIndex;
use App\Models\Jaminan;
use App\Models\SupplierObat;
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

Route::get('/refresh-captcha', function () {
    return response()->json(['captcha' => captcha_img()]);
});
Auth::routes(['verify' => true]);
Route::get('/', [HomeController::class, 'landingpage'])->name('landingpage');
// display antrian
Route::get('displayantrian', [AntrianController::class, 'displayAntrian'])->name('displayantrian');
Route::get('updatenomorantrean', [AntrianController::class, 'updatenomorantrean'])->name('updatenomorantrean');
Route::get('displaynomor', [AntrianController::class, 'displaynomor'])->name('displaynomor');
Route::get('getdisplayantrian', [AntrianController::class, 'getdisplayantrian'])->name('getdisplayantrian');
Route::get('displayantrianfarmasi', [AntrianController::class, 'displayantrianfarmasi'])->name('displayantrianfarmasi');
Route::get('displaynomorfarmasi', [AntrianController::class, 'displaynomorfarmasi'])->name('displaynomorfarmasi');
Route::get('displayranap', DisplayRanap::class)->name('displayranap');
// daftar online
Route::get('daftarantrian', DaftarAntrian::class)->name('daftarantrian');
Route::get('antrianonline/{kodebooking}', [PendaftaranController::class, 'antrianonline'])->name('antrianonline');
// login
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('home', HomeIndex::class)->name('home');
    Route::get('profil', ProfilIndex::class)->name('profil');
    Route::get('dashboard', DashboardPendaftaran::class)->name('dashboard');
    Route::get('log-aktifitas', LogAktifitas::class)->name('log-aktifitas');
    // admin
    Route::middleware(['can:admin'])->group(function () {
        Route::get('role-permission', RolePermission::class)->name('role-permission');
        Route::get('user', UserIndex::class)->name('user.index');
        Route::get('aplikasi', PengaturanIndex::class)->name('aplikasi.index');
        Route::get('integration', IntegrationIndex::class)->name('integration.index');
        Route::get('whatsapp', WhatsappIndex::class)->name('whatsapp.index');
    });
    Route::middleware(['can:crud-pegawai'])->group(function () {
        Route::get('pegawai', PegawaiIndex::class)->name('pegawai.index');
        Route::get('pegawai/create', PegawaiForm::class)->name('pegawai.create');
        Route::get('pegawai/edit/{id}', PegawaiForm::class)->name('pegawai.edit');
    });
    Route::get('absensi-proses', AbsensiProses::class)->name('absensi.proses');
    Route::put('absensi-masuk/{id}', [AbsensiProses::class, 'masuk'])->name('absensi.masuk');
    Route::put('absensi-pulang/{id}', [AbsensiProses::class, 'pulang'])->name('absensi.pulang');
    Route::get('laporan-absensi', LaporanAbsensi::class)->name('laporan.absensi');
    Route::get('print-laporan-absensi', [LaporanAbsensi::class, 'print'])->name('print.laporan.absensi');
    Route::get('lokasi-saya', LokasiSaya::class)->name('lokasi.saya');
    Route::get('lokasi-absensi', LokasiAbsensi::class)->name('lokasi.absensi');
    Route::get('shift-absensi', ShiftAbsensi::class)->name('shift.absensi');
    Route::get('shift-pegawai', ShiftPegawai::class)->name('shift.pegawai');
    Route::get('shift-pegawai-edit', ShiftPegawaiEdit::class)->name('shift.pegawai.edit');
    Route::middleware(['can:crud-pasien'])->group(function () {
        Route::get('pasien', PasienIndex::class)->name('pasien.index')->lazy();
        Route::get('pasien/create', PasienForm::class)->name('pasien.create')->lazy();
        Route::get('pasien/edit/{norm}', PasienForm::class)->name('pasien.edit')->lazy();
    });
    Route::middleware(['can:crud-unit'])->group(function () {
        Route::get('unit', UnitIndex::class)->name('unit.index');
    });
    Route::middleware(['can:crud-dokter'])->group(function () {
        Route::get('dokter', DokterIndex::class)->name('dokter.index');
    });
    Route::middleware(['can:crud-perawat'])->group(function () {
        Route::get('perawat', PerawatIndex::class)->name('perawat.index');
    });
    Route::middleware(['can:crud-tindakan'])->group(function () {
        Route::get('tindakan', TindakanIndex::class)->name('tindakan.index');
    });
    Route::middleware(['can:crud-tindakan'])->group(function () {
        Route::get('jaminan', JaminanIndex::class)->name('jaminan.index');
    });
    Route::get('wilayah-indonesia', WilayahIndonesia::class)->name('wilayah.indonesia');
    // anjungan antrian
    Route::get('anjunganantrian', AnjunganAntrian::class)->name('anjunganantrian.index');
    Route::get('anjunganantrian/mandiri', AnjunganAntrianMandiri::class)->name('anjunganantrian.mandiri');
    Route::get('anjunganantrian/umum', AnjunganAntrianUmum::class)->name('anjunganantrian.umum');
    Route::get('anjunganantrian/bpjs', AnjunganAntrianBpjs::class)->name('anjunganantrian.bpjs');
    Route::get('anjunganantrian/pasien', AnjunganPasien::class)->name('anjunganantrian.pasien');
    Route::get('anjunganantrian/create', AnjunganAntrianCreate::class)->name('anjunganantrian.create');
    Route::get('anjunganantrian/checkin/', AnjunganAntrian::class)->name('anjunganantrian.checkin');
    Route::get('anjunganantrian/print/{kodebooking}', [PendaftaranController::class, 'printkarcis'])->name('anjunganantrian.print');
    Route::get('anjunganantrian/test/', [AnjunganAntrian::class, 'test'])->name('anjunganantrian.test');
    // pendaftaran rawat jalan
    Route::middleware(['can:pendaftaran-rawat-jalan'])->group(function () {
        Route::get('pendaftaran-rajal', PendaftaranRajal::class)->name('pendaftaran.rajal.index');
        Route::get('pendaftaran-rajal/proses/{kodebooking}', PendaftaranRajalProses::class)->name('pendaftaran.rajal.proses');
        Route::get('pendaftaran-rajal/jadwaldokter', JadwalDokterIndex::class)->name('pendaftaran.rajal.jadwaldokter');
        Route::get('monitoring-rajal', MonitoringRajal::class)->name('monitoring.rajal');
    });
    // perawat rawat jalan
    Route::middleware(['can:perawat-rawat-jalan'])->group(function () {
        Route::get('perawat-rawat-jalan/pemeriksaan', PemeriksaanPerawatRajal::class)->name('perawat.rajal.pemeriksaan');
        Route::get('perawat-rawat-jalan/pemeriksaan/{kodebooking}', PemeriksaanPerawatRajalProses::class)->name('perawat.rajal.pemeriksaan.proses');
    });
    // dokter rawat jalan
    Route::middleware(['can:dokter-rawat-jalan'])->group(function () {
        Route::get('dokter-rawat-jalan/pemeriksaan', PemeriksaanDokterRajal::class)->name('dokter.rajal.pemeriksaan');
        Route::get('dokter-rawat-jalan/pemeriksaan/{kodebooking}', PemeriksaanDokterRajalProses::class)->name('dokter.rajal.pemeriksaan.proses');
    });
    // apotek
    Route::middleware(['can:apotek'])->group(function () {
        Route::get('apotek/penjualan_obat', PenjualanObat::class)->name('apotek.resepobat.rajal');
        Route::get('apotek/resep_obat_rajal', PengambilanResep::class)->name('apotek.resepobat.rajal');
        Route::get('apotek/resep_obat_igd', PengambilanObatIgd::class)->name('apotek.resepobat.igd');
        Route::get('apotek/resep_obat_ranap', PengambilanObatRanap::class)->name('apotek.resepobat.ranap');
    });
    // farmasi
    Route::middleware(['can:farmasi'])->group(function () {
        Route::get('farmasi/supplier-obat', SupplierObatIndex::class)->name('supplier.obat');
        Route::get('farmasi/satuan-kemasan', SatuanKemasanIndex::class)->name('satuan.kemasan');
        Route::get('farmasi/pemesanan-obat', PemesananObatIndex::class)->name('pemesanan.obat');
        Route::get('farmasi/obat', ObatIndex::class)->name('obat.index');
        Route::get('stokobat', StokObatIndex::class)->name('stokobat.index');
        Route::get('farmasi/stok-opname', PemesananObatIndex::class)->name('stok.opname');
    });
    // rekam medis
    Route::middleware(['can:rekam-medis'])->group(function () {
        Route::get('rekam-medis/rajal', RekamMedisRajal::class)->name('rekammedis.rajal');
        Route::get('rekam-medis/rajal/edit/{kodebooking}', RekamMedisRajalEdit::class)->name('rekammedis.rajal.edit');
    });
    // pendaftaran rawat inap
    Route::middleware(['can:pendaftaran-rawat-inap'])->group(function () {
        Route::get('kamar-bed', KamarBedIndex::class)->name('kamar.bed.index');
    });
    // satusehat
    Route::middleware(['can:satu-sehat'])->group(function () {
        Route::get('satusehat/token', TokenIndex::class)->name('satusehat.token');
        Route::get('satusehat/patient', PasienIndex::class)->name('satusehat.patient');
        Route::get('satusehat/practitioner', DokterIndex::class)->name('satusehat.practitioner');
        Route::get('satusehat/organization', UnitIndex::class)->name('satusehat.organization');
        Route::get('satusehat/location', UnitIndex::class)->name('satusehat.location');
        Route::get('satusehat/encounter', EncounterIndex::class)->name('satusehat.encounter');
        Route::get('satusehat/encounter/{idencounter}', EncounterEdit::class)->name('satusehat.encounter.edit');
        // Route::get('satusehat/conditition', CondititionIndex::class)->name('satusehat.conditition');
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
        Route::get('bpjs/antrian/antreankodebooking/{kodebooking}', AntreanKodebooking::class)->name('antrian.antreankodebooking');
        Route::get('bpjs/antrian/antreanbelumlayani', AntreanBelumLayani::class)->name('antrian.antreanbelumlayani');
        Route::get('bpjs/antrian/antreandokter', AntreanDokter::class)->name('antrian.antreandokter');
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
        Route::get('bpjs/vclaim/spri_print', [SuratKontrolController::class, 'spri_print'])->name('vclaim.spri_print');
        Route::get('bpjs/vclaim/rujukan', Rujukan::class)->name('vclaim.rujukan')->lazy();
        Route::get('bpjs/vclaim/sep', Sep::class)->name('vclaim.sep')->lazy();
        Route::get('bpjs/vclaim/sep_print', [SepController::class, 'sep_print'])->name('vclaim.sep_print');
    });


    // kasir
    Route::get('kasir-pembayaran', KasirPembayaran::class)->name('kasir.pembayran');
    // rawat igd
    Route::get('pendaftaran/igd', PendaftaranIgd::class)->name('pendaftaran.igd');
    Route::get('pendaftaran/igd/proses', PendaftaranIgdProses::class)->name('pendaftaran.igd.proses');
    // rawat inap
    Route::get('pendaftaran/ranap', PendaftaranRanap::class)->name('pendaftaran.ranap');
    Route::get('pendaftaran/ranap/proses', PendaftaranRanapProses::class)->name('pendaftaran.ranap.proses');
});
// print
Route::get('farmasi/print_resep/{kodebooking}', [FarmasiController::class, 'print_resep'])->name('print.resep');
Route::get('farmasi/print_resepfarmasi/{kodebooking}', [FarmasiController::class, 'print_resepfarmasi'])->name('print.resepfarmasi');
Route::get('apoteker/print_penjualan_obat/{kode}', [FarmasiController::class, 'print_penjualan_obat'])->name('print.penjualanobat');
Route::get('apoteker/print_nota_penjualanobat/{kode}', [KasirController::class, 'print_nota_penjualanobat'])->name('print.notapenjualanobat');
Route::get('farmasi/print_etiket', [FarmasiController::class, 'print_etiket'])->name('print.etiket');
Route::get('farmasi/print_gelang', [FarmasiController::class, 'print_gelang'])->name('print.gelang');
Route::get('resumerajal/{kodebooking}',  [RekamMedisController::class, 'resumerajal'])->name('resume.rajal');
Route::get('resumerajalf/{kodebooking}',  [RekamMedisController::class, 'resumerajalf'])->name('resume.rajalf');
Route::get('print_cpptranap',  [RekamMedisController::class, 'print_cpptranap'])->name('print.cpptranap');
Route::get('print_resumeranap',  [RekamMedisController::class, 'print_resumeranap'])->name('print.resumeranap');
Route::get('rekammedis/rajal_print/{kodebooking}',  [RekamMedisController::class, 'rajal_print'])->name('rekammedis.rajal.print');
Route::get('rekammedis/rajal_printf/{kodebooking}',  [RekamMedisController::class, 'rajal_printf'])->name('rekammedis.rajal.printf');
Route::get('kasir/print_notarajal/{kodebooking}', [KasirController::class, 'print_notarajal'])->name('print.notarajal');
Route::get('kasir/print_notarajalf/{kodebooking}', [KasirController::class, 'print_notarajalf'])->name('print.notarajalf');
