<?php

namespace App\Livewire\Antrian;

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\VclaimController;
use App\Models\Antrian;
use App\Models\JadwalDokter;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class AnjunganAntrianCreate extends Component
{
    public $pasienbaru;
    public $tanggalperiksa;
    public $hari;
    public $inputidentitas = 'nik';
    public $jenispasien, $nik, $nomorkartu, $norm, $nohp, $nama, $nomorreferensi, $poliklinik, $kodepoli, $jadwaldokter, $jeniskunjungan, $estimasidilayani;
    public $polikliniks = [], $jadwals = [];
    public $rujukans = [], $suratkontrols = [], $rujukanrs = [];
    protected $queryString = ['pasienbaru', 'jenispasien', 'tanggalperiksa', 'jeniskunjungan', 'nomorreferensi'];
    public function ambilantrian($jadwal)
    {
        $jadwal = JadwalDokter::find($jadwal);
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
        }
        $antrian = new Antrian();
        $antrian->jadwal_id = $jadwal->id;
        $antrian->jenispasien = $this->jenispasien;
        $antrian->tanggalperiksa = $this->tanggalperiksa;
        $antrian->nomorkartu = '';
        $antrian->nik = '';
        $antrian->norm = '';
        $antrian->nohp = '';
        $antrian->nama = '';
        $antrian->jeniskunjungan = '';
        $antrian->pasienbaru = $this->pasienbaru;
        $antrian->taskid = 1;
        $antrian->taskid1 = now();
        $antrian->method = 'Offline';
        $antrian->kodepoli = $jadwal->kodepoli;
        $antrian->namapoli = $jadwal->namapoli;
        $antrian->kodedokter = $jadwal->kodedokter;
        $antrian->namadokter = $jadwal->namadokter;
        $antrian->jampraktek = $jadwal->jampraktek;
        $antrian->estimasidilayani = $this->estimasidilayani;
        $antiranhari = Antrian::where('tanggalperiksa', $this->tanggalperiksa)->count();
        $antrianpoli = Antrian::where('tanggalperiksa', $this->tanggalperiksa)->where('jadwal_id', $jadwal->id)->count();
        $antrian->kodebooking = strtoupper(uniqid());
        $antrian->nomorantrean = $jadwal->huruf . $antrianpoli + 1;
        $antrian->angkaantrean = $antiranhari + 1;
        $antrian->save();
        return redirect()->route('anjunganantrian.print', $antrian->kodebooking);
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
        } else if ($this->nomorkartu) {
            $pasien = Pasien::firstWhere('nomorkartu', $this->nomorkartu);
        } else {
            return flash("Mohon maaf, Silahkan isi salah satu nik atau nomor BPJS", 'danger');
        }
        if ($pasien) {
            $this->nomorkartu = $pasien->nomorkartu;
            $this->nik = $pasien->nik;
            $this->norm = $pasien->norm;
            $this->nohp = $pasien->nohp;
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
                    flash("Pasien Ditemukan atas nama " . $pasien->nama, 'success');
                } else {
                    return flash("Mohon maaf, Status Peserta BPJS " . $peserta->statusPeserta->keterangan, 'danger');
                }
            } else {
                return flash($res->metadata->message, 'danger');
            }
        } else {
            return flash("Mohon maaf, NIK atau Nomor Kartu Pasien Tidak Ditemukan", 'danger');
        }
    }
    public function pilihSurat($nomorreferensi, $jeniskunjungan)
    {
        $this->jadwals = [];
        $this->nomorreferensi = $nomorreferensi;
        $this->jeniskunjungan = $jeniskunjungan;
    }
    public function updatedInputidentitas()
    {
        $this->reset(['rujukanrs', 'rujukans', 'suratkontrols', 'nik', 'nomorkartu', 'norm', 'nohp', 'nama', 'nomorreferensi']);
    }
    public function updatedKodepoli()
    {
        $this->jadwaldokter = null;
        $this->jadwals = [];
        $this->jadwals = JadwalDokter::where('hari', now()->dayOfWeek)->where('kodesubspesialis', $this->kodepoli)->get();
    }
    public function daftar()
    {
        $jadwal = JadwalDokter::find($this->jadwaldokter);
        $antrian = new Antrian();
        $antrian->jadwal_id = $jadwal->id;
        $antrian->jenispasien = $this->jenispasien;
        $antrian->tanggalperiksa = $this->tanggalperiksa;
        $antrian->nomorkartu = $this->nomorkartu;
        $antrian->nik = $this->nik;
        $antrian->norm = $this->norm;
        $antrian->nohp = $this->nohp;
        $antrian->nama = $this->nama;
        $antrian->jeniskunjungan = $this->jeniskunjungan;
        $antrian->pasienbaru = $this->pasienbaru;
        $antrian->nomorreferensi = $this->nomorreferensi;
        $antrian->taskid = 1;
        $antrian->taskid1 = now();
        $antrian->method = 'Offline';
        $antrian->kodepoli = $jadwal->kodepoli;
        $antrian->namapoli = $jadwal->namapoli;
        $antrian->kodedokter = $jadwal->kodedokter;
        $antrian->namadokter = $jadwal->namadokter;
        $antrian->jampraktek = $jadwal->jampraktek;
        $antiranhari = Antrian::where('tanggalperiksa', $this->tanggalperiksa)->count();
        $antrianpoli = Antrian::where('tanggalperiksa', $this->tanggalperiksa)->where('jadwal_id', $jadwal->id)->count();
        $antrian->kodebooking = strtoupper(uniqid());
        $antrian->nomorantrean = $jadwal->huruf . $antrianpoli + 1;
        $antrian->angkaantrean = $antiranhari + 1;
        $antrian->save();
        return redirect()->route('anjunganantrian.print', $antrian->kodebooking);
    }
    public function mount()
    {
        // $this->tanggalperiksa = $tanggalperiksa;
        // $this->jenispasien = $jenispasien;
        $this->hari = Carbon::parse($this->tanggalperiksa)->dayOfWeek;
    }
    public function render()
    {
        $this->jadwals = JadwalDokter::where('hari', $this->hari)->get();
        return view('livewire.antrian.anjungan-antrian-create')->layout('components.layouts.layout_anjungan');
    }
}
