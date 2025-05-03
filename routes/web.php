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
use App\Livewire\Antrian\DaftarAntrian;
use App\Livewire\Aplikasi\PengaturanAplikasiIndex;
use App\Livewire\Apotek\PenjualanObat;
use App\Livewire\Bpjs\Antrian\AntreanBelumLayani;
use App\Livewire\Bpjs\Antrian\AntreanDokter;
use App\Livewire\Bpjs\Antrian\AntreanKodebooking;
use App\Livewire\Bpjs\Antrian\AntreanTanggal;
use App\Livewire\Bpjs\Antrian\DashboardBulan;
use App\Livewire\Bpjs\Antrian\DashboardTanggal;
use App\Livewire\Bpjs\Antrian\ListTaskid;
use App\Livewire\Bpjs\Antrian\PengaturanAntrianIndex;
use App\Livewire\Bpjs\Antrian\RefDokter;
use App\Livewire\Bpjs\Antrian\RefJadwalDokter;
use App\Livewire\Bpjs\Antrian\RefPesertaFingerprint;
use App\Livewire\Bpjs\Antrian\RefPoliklinik;
use App\Livewire\Bpjs\Antrian\RefPoliklinikFingerprint;
use App\Livewire\Bpjs\Vclaim\MonitoringDataKlaim;
use App\Livewire\Bpjs\Vclaim\MonitoringDataKunjungan;
use App\Livewire\Bpjs\Vclaim\MonitoringKlaimJasaRaharja;
use App\Livewire\Bpjs\Vclaim\MonitoringPelayananPeserta;
use App\Livewire\Bpjs\Vclaim\PengaturanVclaimIndex;
use App\Livewire\Bpjs\Vclaim\Peserta;
use App\Livewire\Bpjs\Vclaim\Referensi;
use App\Livewire\Bpjs\Vclaim\Rujukan;
use App\Livewire\Bpjs\Vclaim\Sep;
use App\Livewire\Bpjs\Vclaim\SuratKontrol;
use App\Livewire\Dokter\DokterIndex;
use App\Livewire\Integration\IntegrationIndex;
use App\Livewire\Jadwaldokter\JadwalDokterIndex;
use App\Livewire\Pasien\PasienForm;
use App\Livewire\Pasien\PasienIndex;
use App\Livewire\Pegawai\PegawaiForm;
use App\Livewire\Pegawai\PegawaiIndex;
use App\Livewire\Farmasi\ObatIndex;
use App\Livewire\Farmasi\PemesananObatIndex;
use App\Livewire\Farmasi\SatuanKemasanIndex;
use App\Livewire\Farmasi\StokObatIndex;
use App\Livewire\Farmasi\SupplierObatIndex;
use App\Livewire\Igd\FarmasiIgd;
use App\Livewire\Igd\FarmasiIgdProses;
use App\Livewire\Igd\KasirIgd;
use App\Livewire\Igd\KasirIgdProses;
use App\Livewire\Igd\KeperawatanIgd;
use App\Livewire\Igd\KeperawatanIgdProses;
use App\Livewire\Igd\PemeriksaanIgd;
use App\Livewire\Igd\PemeriksaanIgdProses;
use App\Livewire\Igd\PendaftaranIgd;
use App\Livewire\Igd\PendaftaranIgdProses;
use App\Livewire\Jaminan\JaminanIndex;
use App\Livewire\Kamarbed\KamarBedIndex;
use App\Livewire\Pendaftaran\DashboardPendaftaran;
use App\Livewire\Pendaftaran\MonitoringRajal;
use App\Livewire\Perawat\PerawatIndex;
use App\Livewire\Perawat\TindakanIndex;
use App\Livewire\Rajal\FarmasiRajal;
use App\Livewire\Rajal\KeperawatanRajal;
use App\Livewire\Rajal\KeperawatanRajalProses;
use App\Livewire\Rajal\PemeriksaanRajal;
use App\Livewire\Rajal\PemeriksaanRajalProses;
use App\Livewire\Rajal\PendaftaranRajal;
use App\Livewire\Rajal\PendaftaranRajalProses;
use App\Livewire\User\ProfilIndex;
use App\Livewire\Ranap\DisplayRanap;
use App\Livewire\Rekammedis\RekamMedisRajal;
use App\Livewire\Rekammedis\RekamMedisRajalEdit;
use App\Livewire\Satusehat\EncounterEdit;
use App\Livewire\Satusehat\EncounterIndex;
use App\Livewire\Satusehat\TokenIndex;
use App\Livewire\Unit\UnitIndex;
use App\Livewire\User\HomeIndex;
use App\Livewire\User\LogAktifitas;
use App\Livewire\User\RolePermission;
use App\Livewire\User\UserIndex;
use App\Livewire\Wa\WhatsappIndex;
use App\Models\PengaturanSatuSehat;
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
    Route::middleware(['can:data-role'])->get('role-permission', RolePermission::class)->name('role-permission');
    Route::middleware(['can:data-user'])->get('user', UserIndex::class)->name('user.index');
    Route::middleware(['can:data-whatsapp'])->get('pengaturan-whatsapp', WhatsappIndex::class)->name('pengaturan.whatsapp.index');
    Route::middleware(['can:data-aplikasi'])->get('pengaturan-aplikasi', PengaturanAplikasiIndex::class)->name('pengaturan.aplikasi.index');
    Route::middleware(['can:data-aplikasi'])->get('integration', IntegrationIndex::class)->name('integration.index');

    Route::middleware(['can:data-pegawai'])->get('pegawai', PegawaiIndex::class)->name('pegawai.index');
    Route::middleware(['can:data-pegawai'])->get('pegawai/create', PegawaiForm::class)->name('pegawai.create');
    Route::middleware(['can:data-pegawai'])->get('pegawai/edit/{id}', PegawaiForm::class)->name('pegawai.edit');

    Route::middleware(['can:data-absensi'])->get('absensi-proses', AbsensiProses::class)->name('absensi.proses');
    Route::middleware(['can:data-absensi'])->put('absensi-masuk/{id}', [AbsensiProses::class, 'masuk'])->name('absensi.masuk');
    Route::middleware(['can:data-absensi'])->put('absensi-pulang/{id}', [AbsensiProses::class, 'pulang'])->name('absensi.pulang');
    Route::middleware(['can:data-absensi'])->get('laporan-absensi', LaporanAbsensi::class)->name('laporan.absensi');
    Route::middleware(['can:data-absensi'])->get('print-laporan-absensi', [LaporanAbsensi::class, 'print'])->name('print.laporan.absensi');
    Route::middleware(['can:data-absensi'])->get('lokasi-saya', LokasiSaya::class)->name('lokasi.saya');
    Route::middleware(['can:data-absensi'])->get('lokasi-absensi', LokasiAbsensi::class)->name('lokasi.absensi');
    Route::middleware(['can:data-absensi'])->get('shift-absensi', ShiftAbsensi::class)->name('shift.absensi');
    Route::middleware(['can:data-absensi'])->get('shift-pegawai', ShiftPegawai::class)->name('shift.pegawai');
    Route::middleware(['can:data-absensi'])->get('shift-pegawai-edit', ShiftPegawaiEdit::class)->name('shift.pegawai.edit');

    Route::middleware(['can:data-pasien'])->get('pasien', PasienIndex::class)->name('pasien.index');
    Route::middleware(['can:data-pasien'])->get('pasien/create', PasienForm::class)->name('pasien.create');
    Route::middleware(['can:data-pasien'])->get('pasien/edit/{norm}', PasienForm::class)->name('pasien.edit');

    Route::middleware(['can:data-unit'])->get('unit', UnitIndex::class)->name('unit.index');
    Route::middleware(['can:data-dokter'])->get('dokter', DokterIndex::class)->name('dokter.index');
    Route::middleware(['can:data-perawat'])->get('perawat', PerawatIndex::class)->name('perawat.index');
    Route::middleware(['can:data-tindakan'])->get('tindakan', TindakanIndex::class)->name('tindakan.index');
    Route::middleware(['can:data-jaminan'])->get('jaminan', JaminanIndex::class)->name('jaminan.index');
    Route::middleware(['can:data-wilayah-indonesia'])->get('wilayah-indonesia', WilayahIndonesia::class)->name('wilayah.indonesia');

    Route::get('anjunganantrian', AnjunganAntrian::class)->name('anjunganantrian.index');
    Route::get('anjunganantrian/mandiri', AnjunganAntrianMandiri::class)->name('anjunganantrian.mandiri');
    Route::get('anjunganantrian/umum', AnjunganAntrianUmum::class)->name('anjunganantrian.umum');
    Route::get('anjunganantrian/bpjs', AnjunganAntrianBpjs::class)->name('anjunganantrian.bpjs');
    Route::get('anjunganantrian/create', AnjunganAntrianCreate::class)->name('anjunganantrian.create');
    Route::get('anjunganantrian/checkin/', AnjunganAntrian::class)->name('anjunganantrian.checkin');
    Route::get('anjunganantrian/print/{kodebooking}', [PendaftaranController::class, 'printkarcis'])->name('anjunganantrian.print');
    Route::get('anjunganantrian/test/', [AnjunganAntrian::class, 'test'])->name('anjunganantrian.test');

    Route::middleware(['can:rajal-pendaftaran'])->get('rajal/pendaftaran', PendaftaranRajal::class)->name('pendaftaran.rajal.index');
    Route::middleware(['can:rajal-pendaftaran'])->get('rajal/pendaftaran/proses/{kodebooking}', PendaftaranRajalProses::class)->name('pendaftaran.rajal.proses');
    Route::middleware(['can:rajal-keperawatan'])->get('rajal/keperawatan', KeperawatanRajal::class)->name('keperawatan.rajal.index');
    Route::middleware(['can:rajal-keperawatan'])->get('rajal/keperawatan/proses/{kodebooking}', KeperawatanRajalProses::class)->name('keperawatan.rajal.proses');
    Route::middleware(['can:rajal-pemeriksaan'])->get('rajal/pemeriksaan', PemeriksaanRajal::class)->name('pemeriksaan.rajal.index');
    Route::middleware(['can:rajal-pemeriksaan'])->get('rajal/pemeriksaan/proses/{kodebooking}', PemeriksaanRajalProses::class)->name('pemeriksaan.rajal.proses');
    Route::middleware(['can:rajal-farmasi'])->get('rajal/farmasi', FarmasiRajal::class)->name('farmasi.rajal.index');
    Route::middleware(['can:rajal-farmasi'])->get('rajal/farmasi/penjualanobat', PenjualanObat::class)->name('apotek.resepobat.rajal');
    Route::middleware(['can:rajal-pendaftaran'])->get('rajal/monitoring', MonitoringRajal::class)->name('monitoring.rajal');
    Route::middleware(['can:rajal-pendaftaran'])->get('rajal/pendaftaran/jadwaldokter', JadwalDokterIndex::class)->name('pendaftaran.rajal.jadwaldokter');

    Route::middleware(['can:igd-pendaftaran'])->get('igd/pendaftaran', PendaftaranIgd::class)->name('pendaftaran.igd');
    Route::middleware(['can:igd-pendaftaran'])->get('igd/pendaftaran/proses/{kodebooking}', PendaftaranIgdProses::class)->name('pendaftaran.igd.proses');
    Route::middleware(['can:igd-keperawatan'])->get('igd/keperawatan', KeperawatanIgd::class)->name('keperawatan.igd');
    Route::middleware(['can:igd-keperawatan'])->get('igd/keperawatan/proses/{kodebooking}', KeperawatanIgdProses::class)->name('keperawatan.igd.proses');
    Route::middleware(['can:igd-pemeriksaan'])->get('igd/pemeriksaan', PemeriksaanIgd::class)->name('pemeriksaan.igd');
    Route::middleware(['can:igd-pemeriksaan'])->get('igd/pemeriksaan/proses/{kodebooking}', PemeriksaanIgdProses::class)->name('pemeriksaan.igd.proses');
    Route::middleware(['can:igd-farmasi'])->get('igd/farmasi', FarmasiRajal::class)->name('farmasi.igd');
    Route::middleware(['can:igd-kasir'])->get('igd/kasir', KasirIgd::class)->name('kasir.igd');
    Route::middleware(['can:igd-kasir'])->get('igd/kasir/proses/{kodebooking}', KasirIgdProses::class)->name('kasir.igd.proses');

    Route::middleware(['can:ranap-pendaftaran'])->get('ranap/pendaftaran', PendaftaranIgd::class)->name('pendaftaran.igd');
    Route::middleware(['can:ranap-pendaftaran'])->get('ranap/pendaftaran/proses/{kodebooking}', PendaftaranIgdProses::class)->name('pendaftaran.igd.proses');
    Route::middleware(['can:ranap-keperawatan'])->get('ranap/keperawatan', KeperawatanIgd::class)->name('keperawatan.igd');
    Route::middleware(['can:ranap-keperawatan'])->get('ranap/keperawatan/proses/{kodebooking}', KeperawatanIgdProses::class)->name('keperawatan.igd.proses');
    Route::middleware(['can:ranap-pemeriksaan'])->get('ranap/pemeriksaan', PemeriksaanIgd::class)->name('pemeriksaan.igd');
    Route::middleware(['can:ranap-pemeriksaan'])->get('ranap/pemeriksaan/proses/{kodebooking}', PemeriksaanIgdProses::class)->name('pemeriksaan.igd.proses');
    Route::middleware(['can:ranap-farmasi'])->get('ranap/farmasi', FarmasiIgd::class)->name('farmasi.igd');
    Route::middleware(['can:ranap-farmasi'])->get('ranap/farmasi/proses/{kodebooking}', FarmasiIgdProses::class)->name('farmasi.igd.proses');
    Route::middleware(['can:ranap-kasir'])->get('ranap/kasir', KasirIgd::class)->name('kasir.igd');
    Route::middleware(['can:ranap-kasir'])->get('ranap/kasir/proses/{kodebooking}', KasirIgdProses::class)->name('kasir.igd.proses');

    Route::middleware(['can:farmasi'])->get('farmasi/supplier-obat', SupplierObatIndex::class)->name('supplier.obat');
    Route::middleware(['can:farmasi'])->get('farmasi/satuan-kemasan', SatuanKemasanIndex::class)->name('satuan.kemasan');
    Route::middleware(['can:farmasi'])->get('farmasi/pemesanan-obat', PemesananObatIndex::class)->name('pemesanan.obat');
    Route::middleware(['can:farmasi'])->get('farmasi/obat', ObatIndex::class)->name('obat.index');
    Route::middleware(['can:farmasi'])->get('stokobat', StokObatIndex::class)->name('stokobat.index');
    Route::middleware(['can:farmasi'])->get('farmasi/stok-opname', PemesananObatIndex::class)->name('stok.opname');
    // rekam medis
    Route::middleware(['can:rekam-medis'])->get('rekam-medis/rajal', RekamMedisRajal::class)->name('rekammedis.rajal');
    Route::middleware(['can:rekam-medis'])->get('rekam-medis/rajal/edit/{kodebooking}', RekamMedisRajalEdit::class)->name('rekammedis.rajal.edit');
    Route::middleware(['can:ranap-pendaftaran'])->get('kamar-bed', KamarBedIndex::class)->name('kamar.bed.index');

    Route::middleware(['can:satusehat'])->group(function () {
        // Route::get('satusehat/pengaturan', PengaturanSatuSehat::class)->name('pengaturan.satusehat.index');
        Route::get('satusehat/token', TokenIndex::class)->name('satusehat.token');
        Route::get('satusehat/patient', PasienIndex::class)->name('satusehat.patient');
        Route::get('satusehat/practitioner', DokterIndex::class)->name('satusehat.practitioner');
        Route::get('satusehat/organization', UnitIndex::class)->name('satusehat.organization');
        Route::get('satusehat/location', UnitIndex::class)->name('satusehat.location');
        Route::get('satusehat/encounter', EncounterIndex::class)->name('satusehat.encounter');
        Route::get('satusehat/encounter/{idencounter}', EncounterEdit::class)->name('satusehat.encounter.edit');
        // Route::get('satusehat/conditition', CondititionIndex::class)->name('satusehat.conditition');
    });
    Route::middleware(['can:bpjs-antrian'])->group(function () {
        Route::get('bpjs/antrian/pengaturan', PengaturanAntrianIndex::class)->name('pengaturan.antrian.index');
        Route::get('bpjs/antrian/refpoliklinik', RefPoliklinik::class)->name('antrian.refpoliklinik');
        Route::get('bpjs/antrian/refdokter', RefDokter::class)->name('antrian.refdokter');
        Route::get('bpjs/antrian/refjadwaldokter', RefJadwalDokter::class)->name('antrian.refjadwaldokter');
        Route::get('bpjs/antrian/refpoliklinik-fingerprint', RefPoliklinikFingerprint::class)->name('antrian.refpoliklinik.fingerprint');
        Route::get('bpjs/antrian/refpeserta-fingerprint', RefPesertaFingerprint::class)->name('antrian.refpeserta.fingerprint');
        Route::get('bpjs/antrian/listtaskid', ListTaskid::class)->name('antrian.listtaskid');
        Route::get('bpjs/antrian/dashboardtanggal', DashboardTanggal::class)->name('antrian.dashboardtanggal');
        Route::get('bpjs/antrian/dashboardbulan', DashboardBulan::class)->name('antrian.dashboardbulan');
        Route::get('bpjs/antrian/antreantanggal', AntreanTanggal::class)->name('antrian.antreantanggal');
        Route::get('bpjs/antrian/antreankodebooking/{kodebooking}', AntreanKodebooking::class)->name('antrian.antreankodebooking');
        Route::get('bpjs/antrian/antreanbelumlayani', AntreanBelumLayani::class)->name('antrian.antreanbelumlayani');
        Route::get('bpjs/antrian/antreandokter', AntreanDokter::class)->name('antrian.antreandokter');
    });
    Route::middleware(['can:bpjs-vclaim'])->group(function () {
        Route::get('bpjs/vclaim/pengaturan', PengaturanVclaimIndex::class)->name('pengaturan.vclaim.index');
        Route::get('bpjs/vclaim/monitoring-data-kunjungan', MonitoringDataKunjungan::class)->name('vclaim.monitoring.datakunjungan');
        Route::get('bpjs/vclaim/monitoring-data-klaim', MonitoringDataKlaim::class)->name('vclaim.monitoring.dataklaim');
        Route::get('bpjs/vclaim/monitoring-pelayanan-peserta', MonitoringPelayananPeserta::class)->name('vclaim.monitoring.pelayananpeserta');
        Route::get('bpjs/vclaim/monitoring-klaim-jasa-raharja', MonitoringKlaimJasaRaharja::class)->name('vclaim.monitoring.klaimjasaraharja');
        Route::get('bpjs/vclaim/peserta-bpjs', Peserta::class)->name('vclaim.peserta.bpjs');
        Route::get('bpjs/vclaim/referensi', Referensi::class)->name('vclaim.referensi');
        Route::get('bpjs/vclaim/surat-kontrol', SuratKontrol::class)->name('vclaim.suratkontrol');
        Route::get('bpjs/vclaim/suratkontrol_print', [SuratKontrolController::class, 'suratkontrol_print'])->name('vclaim.suratkontrol_print');
        Route::get('bpjs/vclaim/spri_print', [SuratKontrolController::class, 'spri_print'])->name('vclaim.spri_print');
        Route::get('bpjs/vclaim/rujukan', Rujukan::class)->name('vclaim.rujukan');
        Route::get('bpjs/vclaim/sep', Sep::class)->name('vclaim.sep');
        Route::get('bpjs/vclaim/sep_print', [SepController::class, 'sep_print'])->name('vclaim.sep_print');
    });
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
