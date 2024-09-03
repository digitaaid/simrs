<?php

namespace App\Livewire\Antrian;

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\VclaimController;
use App\Models\Antrian;
use App\Models\JadwalDokter;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class AnjunganAntrianMandiri extends Component
{
    public $inputidentitas = 'nik';
    public $keyInput = 1;
    public $jenispasien, $nik, $estimasidilayani, $nomorkartu, $norm, $nohp, $nama, $nomorreferensi, $pasienbaru, $poliklinik, $kodepoli, $jadwaldokter, $jeniskunjungan, $tanggalperiksa;
    public $kodebooking, $nomorantrean, $angkaantrean;
    public $tgl_lahir, $gender, $hakkelas, $jenispeserta, $unit, $dokter, $caramasuk, $diagnosa, $sep;
    public $sisakuotajkn, $kuotajkn, $sisakuotanonjkn, $kuotanonjkn;
    public $polikliniks = [], $jadwals = [];
    public $rujukans = [], $suratkontrols = [], $rujukanrs = [];

    public function addDigit($digit)
    {
        if ($this->inputidentitas == 'nik') {
            $this->nik .= $digit;
        } else {
            $this->nomorkartu .= $digit;
        }
    }
    public function deleteDigit()
    {
        if ($this->inputidentitas == 'nik') {
            $this->nik = substr($this->nik, 0, -1);
        } else {
            $this->nomorkartu = substr($this->nomorkartu, 0, -1);
        }
    }
    public function updatedInputidentitas()
    {
        $this->keyInput = 1;
        $this->reset(['nik', 'nomorkartu',]);
    }
    public function cariPasien()
    {
        $this->nomorreferensi = null;
        $this->kodepoli = null;
        $this->jadwals = [];
        $this->rujukans = [];
        $this->suratkontrols = [];
        $this->rujukanrs = [];
        if ($this->nik) {
            $pasien = Pasien::firstWhere('nik', $this->nik);
            $api = new VclaimController();
            $request = new Request([
                'nik' => $this->nik,
                'tanggal' => now()->format('Y-m-d'),
            ]);
            $res = $api->peserta_nik($request);
        } else if ($this->nomorkartu) {
            $pasien = Pasien::firstWhere('nomorkartu', $this->nomorkartu);
            $api = new VclaimController();
            $request = new Request([
                'nomorkartu' => $this->nomorkartu,
                'tanggal' => now()->format('Y-m-d'),
            ]);
            $res = $api->peserta_nomorkartu($request);
        } else {
            return flash("Mohon maaf, Silahkan isi salah satu nik atau nomor BPJS", 'danger');
        }
        if ($pasien) {
            $this->pasienbaru = 0;
            $this->keyInput = 0;
            $this->nomorkartu = $pasien->nomorkartu;
            $this->nik = $pasien->nik;
            $this->norm = $pasien->norm;
            $this->nama = $pasien->nama;
            $api = new VclaimController();
            $request = new Request([
                'nik' => $pasien->nik,
                'tanggal' => now()->format('Y-m-d'),
            ]);
            $res = $api->peserta_nik($request);
            if ($res->metadata->code == 200) {
                $peserta = $res->response->peserta;
                $status = $peserta->statusPeserta->kode;
                if ($status == 0) {
                    $this->nohp = $peserta->mr->noTelepon ?? "0895299099036";
                    $this->tgl_lahir = $peserta->tglLahir;
                    $this->gender = $peserta->sex;
                    $this->hakkelas = $peserta->hakKelas->kode;
                    $this->jenispeserta = $peserta->jenisPeserta->keterangan;
                    $request = new Request([
                        'nomorkartu' =>  $peserta->noKartu,
                        'tanggal' => now()->format('Y-m-d'),
                    ]);
                    $this->tgl_lahir = $peserta->tglLahir;
                    $this->gender = $peserta->sex;
                    $this->hakkelas = $peserta->hakKelas->kode;
                    $this->jenispeserta = $peserta->jenisPeserta->keterangan;;
                    $res = $api->suratkontrol_peserta($request);
                    if ($res->metadata->code == 200) {
                        $this->suratkontrols = $res->response->list;
                    }
                    $res = $api->rujukan_peserta($request);
                    if ($res->metadata->code == 200) {
                        $threeMonthsAgo = Carbon::now()->subMonths(3);
                        $this->rujukans = collect($res->response->rujukan)->filter(function ($rujukan) use ($threeMonthsAgo) {
                            return Carbon::parse($rujukan->tglKunjungan)->greaterThanOrEqualTo($threeMonthsAgo);
                        });
                    }
                    $res = $api->rujukan_rs_peserta($request);
                    if ($res->metadata->code == 200) {
                        $threeMonthsAgo = Carbon::now()->subMonths(3);
                        $this->rujukans = collect($res->response->rujukan)->filter(function ($rujukan) use ($threeMonthsAgo) {
                            return Carbon::parse($rujukan->tglKunjungan)->greaterThanOrEqualTo($threeMonthsAgo);
                        });
                    }
                    flash("Pasien Ditemukan atas nama " . $pasien->nama, 'success');
                } else {
                    return flash("Mohon maaf, Status Peserta BPJS " . $peserta->statusPeserta->keterangan, 'danger');
                }
            } else {
                return flash($res->metadata->message, 'danger');
            }
        } else {
            if ($res->metadata->code == 200) {
                $peserta = $res->response->peserta;
                $this->pasienbaru = 1;
                $this->nomorkartu = $peserta->noKartu;
                $this->nik = $peserta->nik;
                $this->norm = "000000000";
                $this->nohp = $peserta->mr->noTelepon ?? "0895299099036";
                $this->nama = $peserta->nama;
                $this->keyInput = 0;
                $status = $peserta->statusPeserta->kode;
                if ($status == 0) {
                    $this->tgl_lahir = $peserta->tglLahir;
                    $this->gender = $peserta->sex;
                    $this->hakkelas = $peserta->hakKelas->kode;
                    $this->jenispeserta = $peserta->jenisPeserta->keterangan;
                    $request = new Request([
                        'nomorkartu' =>  $peserta->noKartu,
                        'tanggal' => now()->format('Y-m-d'),
                    ]);
                    $res = $api->suratkontrol_peserta($request);
                    if ($res->metadata->code == 200) {
                        $this->suratkontrols = $res->response->list;
                    }
                    $res = $api->rujukan_peserta($request);
                    if ($res->metadata->code == 200) {
                        $threeMonthsAgo = Carbon::now()->subMonths(3);
                        $this->rujukans = collect($res->response->rujukan)->filter(function ($rujukan) use ($threeMonthsAgo) {
                            return Carbon::parse($rujukan->tglKunjungan)->greaterThanOrEqualTo($threeMonthsAgo);
                        });
                    }
                    $res = $api->rujukan_rs_peserta($request);
                    if ($res->metadata->code == 200) {
                        $threeMonthsAgo = Carbon::now()->subMonths(3);
                        $this->rujukans = collect($res->response->rujukan)->filter(function ($rujukan) use ($threeMonthsAgo) {
                            return Carbon::parse($rujukan->tglKunjungan)->greaterThanOrEqualTo($threeMonthsAgo);
                        });
                    }
                    flash("Pasien Ditemukan atas nama " . $peserta->nama, 'success');
                } else {
                    return flash("Mohon maaf, Status Peserta BPJS " . $peserta->statusPeserta->keterangan, 'danger');
                }
            } else {
                return flash($res->metadata->message, 'danger');
            }
        }
    }
    public function pilihSurat($nomorreferensi, $jeniskunjungan, $kodepoli)
    {
        $this->jadwals = [];
        $this->kodepoli = $kodepoli;
        $this->nomorreferensi = $nomorreferensi;
        $this->jeniskunjungan = $jeniskunjungan;
        $this->jadwals = JadwalDokter::where('hari', now()->dayOfWeek)->where('kodesubspesialis', $this->kodepoli)->get();
    }
    public function updatedKodepoli()
    {
        $this->jadwaldokter = null;
        $this->jadwals = [];
        $this->jadwals = JadwalDokter::where('hari', now()->dayOfWeek)->where('kodesubspesialis', $this->kodepoli)->get();
    }
    public $asalRujukan;
    public $noRujukan;
    public $tglRujukan;
    public $ppkRujukan;
    public $noSurat;
    public $tujuan;
    public $dpjpLayan;
    public $diagAwal;
    public $tujuanKunj;
    public $flagProcedure;
    public $kdPenunjang;
    public $assesmentPel;
    public function daftar()
    {
        $this->tanggalperiksa = now()->format('Y-m-d');
        $jadwal = JadwalDokter::find($this->jadwaldokter);
        $api = new AntrianController();
        $request = new Request([
            "kodepoli" => $jadwal->kodepoli,
            "kodedokter" => $jadwal->kodedokter,
            "tanggalperiksa" => $this->tanggalperiksa,
            "jampraktek" => $jadwal->jampraktek
        ]);
        $res = $api->status_antrian($request);
        if ($res->metadata->code == 200) {
            $timestamp = $this->tanggalperiksa . ' ' . explode('-', $jadwal->jampraktek)[0] . ':00';
            $jadwal_estimasi = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'Asia/Jakarta')->addMinutes(6 * ($res->response->totalantrean + 1));
            $this->estimasidilayani = $jadwal_estimasi->timestamp * 1000;
            $this->sisakuotajkn = $res->response->sisakuotajkn;
            $this->kuotajkn = $res->response->kuotajkn;
            $this->sisakuotanonjkn = $res->response->sisakuotanonjkn;
            $this->kuotanonjkn = $res->response->kuotanonjkn;
        } else {
            return flash($res->metadata->message, 'danger');
        }
        $antiranhari = Antrian::where('tanggalperiksa', $this->tanggalperiksa)->count();
        $antrianpoli = Antrian::where('tanggalperiksa', $this->tanggalperiksa)->where('jadwal_id', $jadwal->id)->count();
        $this->kodebooking = strtoupper(uniqid());
        $this->nomorantrean = $jadwal->huruf . $antrianpoli + 1;
        $this->angkaantrean = $antiranhari + 1;
        $request = new Request([
            'kodebooking' => $this->kodebooking,
            // 'jenispasien' => "JKN",
            'jenispasien' => "NON-JKN",
            'nomorkartu' => $this->nomorkartu,
            'nik' => $this->nik,
            'nohp' => $this->nohp ?? '0895299099036',
            'kodepoli' => $jadwal->kodepoli,
            'namapoli' => $jadwal->namasubspesialis,
            'pasienbaru' => $this->pasienbaru,
            'norm' => $this->norm,
            'tanggalperiksa' => now()->format('Y-m-d'),
            // 'kodedokter' => $jadwal->kodedokter,
            'kodedokter' => "35875",
            'namadokter' => $jadwal->namadokter,
            'jampraktek' => $jadwal->jampraktek,
            'jeniskunjungan' => $this->jeniskunjungan,
            'method' => "Anjungan Pelayanan Mandiri",
            // 'nomorreferensi' => $this->nomorreferensi,
            'nomorreferensi' => "",
            'nomorantrean' => $this->nomorantrean,
            'angkaantrean' => $this->angkaantrean,
            'estimasidilayani' => $this->estimasidilayani,
            'sisakuotajkn' => $this->sisakuotajkn,
            'kuotajkn' => $this->kuotajkn,
            'sisakuotanonjkn' => $this->sisakuotanonjkn,
            'kuotanonjkn' => $this->kuotanonjkn,
            "keterangan" =>  "Silahkan ke loket pendaftaran",
            "nama" =>  $this->nama,
        ]);
        $api = new AntrianController();
        $res = $api->tambah_antrean($request);
        if ($res->metadata->code != 200) {
            return flash($res->metadata->message, 'danger');
        }
        $antrian = new Antrian();
        $antrian->jadwal_id = $jadwal->id;
        $antrian->taskid = 1;
        $antrian->taskid1 = now();
        $antrian->kodebooking = $this->kodebooking;
        $antrian->jenispasien = "JKN";
        $antrian->nomorkartu = $this->nomorkartu;
        $antrian->nik = $this->nik;
        $antrian->nohp = $this->nohp;
        $antrian->kodepoli = $jadwal->kodepoli;
        $antrian->namapoli = $jadwal->namapoli;
        $antrian->pasienbaru = $this->pasienbaru;
        $antrian->norm = $this->norm;
        $antrian->tanggalperiksa = $this->tanggalperiksa;
        $antrian->kodedokter = $jadwal->kodedokter;
        $antrian->namadokter = $jadwal->namadokter;
        $antrian->jampraktek = $jadwal->jampraktek;
        $antrian->jeniskunjungan = $this->jeniskunjungan;
        $antrian->method = "Anjungan Pelayanan Mandiri";
        $antrian->nomorreferensi = $this->nomorreferensi;
        $antrian->nomorantrean = $this->nomorantrean;
        $antrian->angkaantrean = $this->angkaantrean;
        $antrian->estimasidilayani = $this->estimasidilayani;
        $antrian->keterangan = "Silahkan ke loket pendaftaran";
        $antrian->nama = $this->nama;
        // periksa rujukan dan surat kontrol
        $api = new VclaimController();
        if ($antrian->jeniskunjungan == 3) {
            $this->tujuanKunj = "2";
            $this->flagProcedure = "";
            $this->kdPenunjang = "";
            $this->assesmentPel = "2";
            $request = new Request([
                "noSuratKontrol" => $antrian->nomorreferensi,
            ]);
            $res = $api->suratkontrol_nomor($request);
            if ($res->metadata->code == 200) {
                $this->diagAwal =  explode(' - ', $res->response->sep->diagnosa)[0];
                $rujukan = $res->response->sep->provPerujuk;
                $this->asalRujukan = $rujukan->asalRujukan;
                $this->noRujukan = $rujukan->noRujukan;
                $this->tglRujukan = $rujukan->tglRujukan;
                $this->ppkRujukan = $rujukan->kdProviderPerujuk;
                flash($res->metadata->message, 'success');
            } else {
                return flash($res->metadata->message, 'danger');
            }
            $this->noSurat = $antrian->nomorreferensi;
        } else {
            $this->noRujukan = $antrian->nomorreferensi;
            $request = new Request([
                "nomorrujukan" => $this->noRujukan,
            ]);
            if ($antrian->jeniskunjungan == 1) {
                $res = $api->rujukan_nomor($request);
                $this->asalRujukan = 1;
            } else {
                $res = $api->rujukan_rs_nomor($request);
                $this->asalRujukan = 2;
            }
            if ($res->metadata->code == 200) {
                $rujukan = $res->response->rujukan;
                $this->asalRujukan = $this->asalRujukan;
                $this->noRujukan = $rujukan->noKunjungan;
                $this->tglRujukan = $rujukan->tglKunjungan;
                $this->ppkRujukan = $rujukan->peserta->provUmum->kdProvider;
                flash($res->metadata->message, 'success');
            } else {
                return flash($res->metadata->message, 'danger');
            }
            $this->tujuanKunj = "0";
            $this->flagProcedure = "";
            $this->kdPenunjang = "";
            $this->assesmentPel = "";
            $this->diagAwal =  $res->response->rujukan->diagnosa->kode;
        }
        $this->tujuan = $antrian->kodepoli;
        $this->dpjpLayan = $antrian->kodedokter;
        $request = new Request([
            "noKartu" => $this->nomorkartu,
            "tglSep" => $antrian->tanggalperiksa,
            "nama" => $this->nama,
            "noMR" => $this->norm,
            "noTelp" => $this->nohp,
            'noRujukan' => $this->noRujukan,
            'asalRujukan' => $this->asalRujukan,
            'tglRujukan' => $this->tglRujukan,
            'ppkRujukan' => $this->ppkRujukan,
            'noSurat' => $this->noSurat,
            "jnsPelayanan" => 2,
            "tujuan" => $this->tujuan,
            "dpjpLayan" => $this->dpjpLayan,
            "diagAwal" => $this->diagAwal,
            "catatan" => 'SEP Anjungan Pelayanan Mandiri',
            "tujuanKunj" => $this->tujuanKunj,
            "flagProcedure" => $this->flagProcedure,
            "kdPenunjang" => $this->kdPenunjang,
            "assesmentPel" => $this->assesmentPel,
            "eksekutif" =>  0,
            "ppkPelayanan" => "0125S007",
            "klsRawatHak" => "3",
            "user" => auth()->user()->name,
        ]);
        $res = $api->sep_insert($request);
        if ($res->metadata->code != 200) {
            return flash($res->metadata->message, 'danger');
        }
        $this->sep = $res->response->sep->noSep ?? null;
        $antrian->sep = $this->sep;
        // create kunjungan
        $counter = Kunjungan::where('norm', $antrian->norm)->first()?->counter ?? 1;
        $kunjungan = new Kunjungan();
        $kunjungan->kode = $antrian->kodebooking;
        $kunjungan->counter = $counter;
        $kunjungan->tgl_masuk = now();
        $kunjungan->jaminan = "00001";
        $kunjungan->nomorkartu = $this->nomorkartu;
        $kunjungan->norm = $this->norm;
        $kunjungan->nama = $this->nama;
        $kunjungan->tgl_lahir = $this->tgl_lahir;
        $kunjungan->gender = $this->gender;
        $kunjungan->kelas = $this->hakkelas;
        $kunjungan->penjamin = $this->jenispeserta;
        $kunjungan->unit = $jadwal->kodesubspesialis;
        $kunjungan->dokter = $jadwal->kodedokter;
        $kunjungan->jeniskunjungan = $this->jeniskunjungan;
        $kunjungan->nomorreferensi = $this->nomorreferensi;
        $kunjungan->sep = $this->sep;
        $kunjungan->diagnosa_awal = $this->diagAwal;
        $kunjungan->cara_masuk = "gnp";
        $kunjungan->status = 1;
        $kunjungan->user1 = auth()->user()->id;
        $kunjungan->save();
        // update antrian
        $antrian->kunjungan_id = $kunjungan->id;
        $antrian->kodekunjungan = $kunjungan->kode;
        $antrian->save();
        // jika pasien lama
        $antrian->taskid = 3;
        $antrian->taskid3 = now();
        $antrian->user1 = 1;
        $antrian->save();
        return redirect()->route('anjunganantrian.print', $antrian->kodebooking);
    }
    public function render()
    {
        $this->polikliniks = JadwalDokter::where('hari', now()->dayOfWeek)->select('kodesubspesialis', 'namasubspesialis')->groupBy('kodesubspesialis', 'namasubspesialis')->get();
        return view('livewire.antrian.anjungan-antrian-mandiri')->layout('components.layouts.layout_anjungan');
    }
}
