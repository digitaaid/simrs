<?php

namespace App\Livewire\Pendaftaran;

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\VclaimController;
use App\Models\ActivityLog;
use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\JadwalDokter;
use App\Models\Pasien;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class ModalAntrianRajal extends Component
{
    public $antrian, $polikliniks, $dokters;
    public $antrianId, $kodebooking, $nomorkartu, $nik, $norm, $nama, $nohp, $tanggalperiksa, $kodepoli, $kodedokter, $jampraktek, $namadokter, $jenispasien, $keterangan, $perujuk, $jeniskunjungan, $jeniskunjunjgan;
    public $gender, $tgl_lahir, $fktp, $jenispeserta, $hakkelas;
    public $pasienbaru, $estimasidilayani, $sisakuotajkn, $kuotajkn, $sisakuotanonjkn, $kuotanonjkn;
    public $asalRujukan, $nomorreferensi, $noRujukan, $noSurat;
    public  $bridgingantrian;
    public $rujukans = [], $suratkontrols = [], $jadwals = [];
    public function getJadwalDokter()
    {
        $this->validate([
            'tanggalperiksa' => 'required|date',
            'kodepoli' => 'required',
            'kodedokter' => 'required',
        ]);
        $hari =  Carbon::parse($this->tanggalperiksa)->dayOfWeek;
        $this->jadwals = JadwalDokter::where('hari', $hari)
            ->where('kodepoli', $this->kodepoli)
            ->where('kodedokter', $this->kodedokter)
            ->get();
    }
    public function editAntrian()
    {
        $this->validate([
            'nomorkartu' => 'required',
            'nik' => 'required|digits:16',
            'norm' => 'required',
            'nama' => 'required',
            'nohp' => 'required|numeric',
            'tanggalperiksa' => 'required|date',
            'jenispasien' => 'required',
            'kodepoli' => 'required',
            'kodedokter' => 'required',
        ]);
        $this->pasienbaru = $this->pasienbaru ? 1 : 0;
        // proses data antrian
        if ($this->jenispasien == "JKN") {
            $this->validate([
                'noRujukan' => 'required_if:noSurat,null',
                'noSurat' => 'required_if:noRujukan,null',
            ]);
            $vclaim = new VclaimController();
            $request = new Request();
            if ($this->noSurat) {
                $this->jeniskunjungan = 3;
                $request['nomorsuratkontrol'] = $this->noSurat;
                $request['noSuratKontrol'] = $this->noSurat;
                $res =  $vclaim->suratkontrol_nomor($request);
                if ($res->metadata->code == 200) {
                    $this->perujuk = $res->response->sep->provPerujuk->nmProviderPerujuk;
                }
                $this->nomorreferensi = $this->noSurat;
            } else {
                $request['nomorrujukan'] = $this->noRujukan;
                if ($this->asalRujukan == 2) {
                    $this->jeniskunjungan = 4;
                    $res =  $vclaim->rujukan_rs_nomor($request);
                } else {
                    $this->jeniskunjungan = 1;
                    $res =  $vclaim->rujukan_nomor($request);
                }
                if ($res->metadata->code == 200) {
                    $this->perujuk = $res->response->rujukan->provPerujuk->nama;
                }
                $this->nomorreferensi = $this->noRujukan;
            }
        } else {
            $this->jeniskunjungan = 2;
        }
        $this->keterangan = "Antrian proses di pendaftaran";
        if (!$this->kodebooking) {
            $request = new Request([
                'nomorkartu' => $this->nomorkartu,
                'nik' => $this->nik,
                'nohp' => $this->nohp,
                'kodepoli' => $this->kodepoli,
                'norm' => $this->norm,
                'tanggalperiksa' => $this->tanggalperiksa,
                'kodedokter' => $this->kodedokter,
                'jampraktek' => $this->jampraktek,
                'jeniskunjungan' => $this->jeniskunjungan,
                'nomorreferensi' => $this->nomorreferensi,
            ]);
            $api =  new AntrianController();
            $res = $api->ambil_antrian($request);
            if ($res->metadata->code == 200) {
                $this->kodebooking = $res->response->kodebooking;
            } else {
                dd($res);
            }
        }
        // simpan antrean
        $antrian = Antrian::where('kodebooking', $this->kodebooking)->first();
        // cek antrian sebelumnya
        $antrianx = Antrian::where('norm', $this->norm)
            ->whereDate('tanggalperiksa', $this->tanggalperiksa)
            ->where('taskid', '<=', 5)
            ->first();
        if ($antrianx) {
            if ($antrianx->taskid >= 3 && $antrianx->taskid <= 5 && $antrianx->id != $antrian->id) {
                return flash('Pasien sudah mendapatkan pelayanan. Silahkan batalkan terlebih dahulu.', 'danger');
            }
        }
        $dokter = Dokter::where('kodejkn', $this->kodedokter)->first();
        $antrian->update([
            'nomorkartu' => $this->nomorkartu,
            'nik' => $this->nik,
            'norm' => $this->norm,
            'nama' => $this->nama,
            'nohp' => $this->nohp,
            'tanggalperiksa' => $this->tanggalperiksa,
            'kodepoli' => $this->kodepoli,
            'kodedokter' => $this->kodedokter,
            'namadokter' => $dokter->nama,
            'jenispasien' => $this->jenispasien,
            'jeniskunjungan' => $this->jeniskunjungan,
            'perujuk' => $this->perujuk,
            'nomorreferensi' => $this->nomorreferensi,
            'nomorrujukan' => $this->noRujukan,
            'nomorsuratkontrol' => $this->noSurat,
            'keterangan' => $this->keterangan,
            'pasienbaru' => $this->pasienbaru,
            'bridgingantrian' => $this->bridgingantrian,
            'user1' => auth()->user()->id,
        ]);
        $pasien = Pasien::where('norm', $this->norm)->first();
        $pasien->nohp = $this->nohp;
        $pasien->nomorkartu = $this->nomorkartu;
        $pasien->nik = $this->nik;
        $pasien->nama = $this->nama;
        $pasien->update();
        // status antrean
        $api = new AntrianController();
        $request = new Request([
            "kodepoli" => $antrian->kodepoli,
            "kodedokter" => $this->kodedokter,
            "tanggalperiksa" => $this->tanggalperiksa,
            "jampraktek" => $antrian->jampraktek,
        ]);
        $res = $api->status_antrian($request);
        if ($res->metadata->code == 200) {
            $this->estimasidilayani = Carbon::parse($this->tanggalperiksa . ' ' . explode('-', $antrian->jampraktek)[0])->addSeconds(300 + $res->response->totalantrean * 300);
            $this->sisakuotajkn = $res->response->sisakuotajkn;
            $this->kuotajkn = $res->response->kuotajkn;
            $this->sisakuotanonjkn = $res->response->sisakuotanonjkn;
            $this->kuotanonjkn = $res->response->kuotanonjkn;
        } else {
            return flash($res->metadata->message, 'danger');
        }
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Create/Update Antrian Pasien',
            'description' => auth()->user()->name . ' telah create/update antrian pasien ' . $antrian->nama . ' dengan kodebooking ' . $antrian->kodebooking . ' pada tanggal ' . $antrian->tanggalperiksa . ' dan nomorantrean ' . $antrian->nomorantrean,
        ]);
        // tambah antrean
        $request = new Request([
            "kodebooking" => $this->kodebooking,
            "jenispasien" =>  $this->jenispasien,
            "nomorkartu" => $this->nomorkartu,
            "nik" =>  $this->nik,
            "nohp" => $this->nohp,
            "kodepoli" => $this->kodepoli,
            "namapoli" => $antrian->namapoli,
            "pasienbaru" => $this->pasienbaru,
            "norm" => $this->norm,
            "tanggalperiksa" =>  $this->tanggalperiksa,
            "kodedokter" => $this->kodedokter,
            "namadokter" => $antrian->namadokter,
            "jampraktek" => $antrian->jampraktek,
            "jeniskunjungan" => $this->jeniskunjungan,
            "nomorreferensi" => $this->nomorreferensi,
            "nomorantrean" => $antrian->nomorantrean,
            "angkaantrean" => $antrian->angkaantrean,
            "estimasidilayani" => $this->estimasidilayani,
            "sisakuotajkn" => $this->sisakuotajkn,
            "kuotajkn" => $this->kuotajkn,
            "sisakuotanonjkn" => $this->sisakuotanonjkn,
            "kuotanonjkn" => $this->kuotanonjkn,
            "keterangan" =>    $this->keterangan,
            "nama" => $this->nama,
        ]);
        if ($antrian->bridgingantrian) {
            $res =  $api->tambah_antrean($request);
            if ($res->metadata->code == 200) {
                $antrian->status = 1;
                $antrian->update();
                Alert::success('Success', $res->metadata->message);
            } else {
                Alert::error('Mohon Maaf', $res->metadata->message);
            }
        } else {
            $antrian->status = 1;
            $antrian->update();
            Alert::success('Success', 'Antrian berhasil disimpan');
        }
        $url = route('pendaftaran.rajal.proses', $this->kodebooking);
        return redirect()->to($url);
    }
    public function cariRujukan()
    {
        $this->validate([
            'nomorkartu' => 'required',
            'asalRujukan' => 'required',
        ]);
        $api  = new VclaimController();
        $request = new Request([
            "nomorkartu" => $this->nomorkartu,
        ]);
        if ($this->asalRujukan == 1) {
            $res = $api->rujukan_peserta($request);
        } else {
            $res = $api->rujukan_rs_peserta($request);
        }
        if ($res->metadata->code == 200) {
            $this->rujukans = [];
            foreach ($res->response->rujukan as $key => $value) {
                $this->rujukans[] = [
                    'no' => $key + 1,
                    'noKunjungan' => $value->noKunjungan,
                    'tglKunjungan' => $value->tglKunjungan,
                    'namaPoli' => $value->poliRujukan->nama,
                    'jenisPelayanan' => $value->pelayanan->nama,
                ];
            }
            return flash($res->metadata->message, 'success');
        } else {
            return flash($res->metadata->message, 'danger');
        }
    }
    public function cariSuratKontrol()
    {
        $this->validate([
            'nomorkartu' => 'required',
            'tanggalperiksa' => 'required',
        ]);
        $api  = new VclaimController();
        $request = new Request([
            "nomorkartu" => $this->nomorkartu,
            "formatfilter" => 2,
            "bulan" => Carbon::parse($this->tanggalperiksa)->format('m'),
            "tahun" => Carbon::parse($this->tanggalperiksa)->format('Y'),
        ]);
        $res = $api->suratkontrol_peserta($request);
        if ($res->metadata->code == 200) {
            $this->suratkontrols = [];
            foreach ($res->response->list as $key => $value) {
                $this->suratkontrols[] = [
                    'no' => $key + 1,
                    'noSuratKontrol' => $value->noSuratKontrol,
                    'tglRencanaKontrol' => $value->tglRencanaKontrol,
                    'namaPoliTujuan' => $value->namaPoliTujuan,
                    'terbitSEP' => $value->terbitSEP,
                ];
            }
            return flash($res->metadata->message, 'success');
        } else {
            return flash($res->metadata->message, 'danger');
        }
    }
    public function cariNomorKartu()
    {
        $request = new Request([
            'nomorkartu' => $this->nomorkartu,
            'tanggal' => now()->format('Y-m-d'),
        ]);
        $pasien = Pasien::where('nomorkartu', $this->nomorkartu)->first();
        if ($pasien) {
            $this->norm = $pasien->norm;
            $this->nohp = $pasien->nohp;
        }
        $api = new VclaimController();
        $res =  $api->peserta_nomorkartu($request);
        if ($res->metadata->code == 200) {
            $peserta = $res->response->peserta;
            $this->nama = $peserta->nama;
            $this->nomorkartu = $peserta->noKartu;
            $this->nik = $peserta->nik;
            $this->tgl_lahir = $peserta->tglLahir;
            $this->fktp = $peserta->provUmum->nmProvider;
            $this->jenispeserta = $peserta->jenisPeserta->keterangan;
            $this->hakkelas = $peserta->hakKelas->kode;
            $this->gender = $peserta->sex;
            return flash($res->metadata->message, 'success');
        } else {
            return flash($res->metadata->message, 'danger');
        }
    }
    public function cariNIK()
    {
        $request = new Request([
            'nik' => $this->nik,
            'tanggal' => now()->format('Y-m-d'),
        ]);
        $pasien = Pasien::where('nik', $this->nik)->first();
        if ($pasien) {
            $this->norm = $pasien->norm;
            $this->nohp = $pasien->nohp;
        }
        $api = new VclaimController();
        $res =  $api->peserta_nik($request);
        if ($res->metadata->code == 200) {
            $peserta = $res->response->peserta;
            $this->nama = $peserta->nama;
            $this->nomorkartu = $peserta->noKartu;
            $this->nik = $peserta->nik;
            $this->tgl_lahir = $peserta->tglLahir;
            $this->fktp = $peserta->provUmum->nmProvider;
            $this->jenispeserta = $peserta->jenisPeserta->keterangan;
            $this->hakkelas = $peserta->hakKelas->kode;
            $this->gender = $peserta->sex;
            return flash($res->metadata->message, 'success');
        } else {
            return flash($res->metadata->message, 'danger');
        }
    }
    public function cariNoRM()
    {
        $pasien = Pasien::where('norm', $this->norm)->first();
        if ($pasien) {
            $this->nomorkartu = $pasien->nomorkartu;
            $this->nik = $pasien->nik;
            $this->norm = $pasien->norm;
            $this->nama = $pasien->nama;
            $this->nohp = $pasien->nohp;
        }
    }
    public function formAntrian()
    {
        $this->dispatch('formAntrian');
    }
    public function mount($antrian)
    {
        if ($antrian) {
            $this->antrian = $antrian;
            $this->antrianId = $antrian->id;
            $this->kodebooking = $antrian->kodebooking;
            $this->nomorkartu = $antrian->nomorkartu;
            $this->nik = $antrian->nik;
            $this->norm = $antrian->norm;
            $this->bridgingantrian = $antrian->bridgingantrian ? true : false;
            $this->nama = $antrian->nama;
            $this->nohp = $antrian->nohp;
            $this->tanggalperiksa = $antrian->tanggalperiksa;
            $this->kodepoli = $antrian->kodepoli;
            $this->kodedokter = $antrian->kodedokter;
            $this->jenispasien = $antrian->jenispasien;
            $this->pasienbaru = $antrian->pasienbaru ? true : false;
            if ($antrian->jeniskunjungan == 3) {
                $this->noSurat = $antrian->nomorsuratkontrol;
            } else {
                $this->noRujukan = $antrian->nomorrujukan;
                switch ($antrian->jeniskunjungan) {
                    case 1:
                        $this->asalRujukan = 1;
                        break;

                    case 4:
                        $this->asalRujukan = 2;
                        break;

                    default:
                        break;
                }
            }
        }
        $this->polikliniks = Unit::pluck('nama', 'kode');
        $this->dokters = Dokter::pluck('nama', 'kode');
    }
    public function render()
    {
        return view('livewire.pendaftaran.modal-antrian-rajal');
    }
}
