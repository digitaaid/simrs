<?php

namespace App\Livewire\Absensi;

use App\Models\ActivityLog;
use App\Models\LokasiAbsensi;
use App\Models\ShiftPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiProses extends Component
{
    public $user, $shift, $lat_kantor, $long_kantor, $rad_kantor;
    public $message;

    public function masuk($id, Request $request)
    {
        $lokasikantor = LokasiAbsensi::first();
        $lat_kantor = $lokasikantor->latitude;
        $long_kantor = $lokasikantor->longitude;
        $request["jarak_masuk"] = $this->distance($request["lat_masuk"], $request["long_masuk"], $lat_kantor, $long_kantor, "K") * 1000;
        if ($request["jarak_masuk"] > $lokasikantor->radius) {
            Alert::error('Diluar Jangkauan', 'Lokasi Anda Diluar Radius Kantor');
            return redirect()->route('absensi.proses');
        } else {
            $foto_absensi_masuk = $request["foto_absensi"];
            $image_parts = explode(";base64,", $foto_absensi_masuk);
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = 'foto_absensi_masuk/' . uniqid() . '.png';
            Storage::put($fileName, $image_base64);
            $request["foto_absensi_masuk"] = $fileName;
            $request["status_absen"] = "Masuk";
            $request["absensi_masuk"] = now()->format("Y-m-d H:i");
            $shiftpegawai = ShiftPegawai::where('id', $id)->first();
            $tgl_skrg = date("Y-m-d");
            $awal  = strtotime($shiftpegawai->tanggal . ' ' . $shiftpegawai->jam_masuk);
            $akhir = strtotime($request["absensi_masuk"]);
            $diff  = $akhir - $awal;
            if ($diff <= 0) {
                $request["telat"] = 0;
            } else {
                $request["telat"] = $diff;
            }
            $shiftpegawai->update($request->all());
            Alert::success('Success', 'Berhasil Absen Masuk');
            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'activity' => 'Absensi Masuk',
                'description' => auth()->user()->name . ' telah melakukan absensi masuk',
            ]);
            return redirect()->route('absensi.proses');
        }
    }
    public function pulang($id, Request $request)
    {
        $lokasikantor = LokasiAbsensi::first();
        $lat_kantor = $lokasikantor->latitude;
        $long_kantor = $lokasikantor->longitude;
        $request["jarak_pulang"] = $this->distance($request["lat_pulang"], $request["long_pulang"], $lat_kantor, $long_kantor, "K") * 1000;
        if ($request["jarak_pulang"] > $lokasikantor->radius) {
            Alert::error('Diluar Jangkauan', 'Lokasi Anda Diluar Radius Kantor');
            return redirect()->route('absensi.proses');
        } else {
            $foto_absensi_pulang = $request["foto_absensi"];
            $image_parts = explode(";base64,", $foto_absensi_pulang);
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = 'foto_absensi_pulang/' . uniqid() . '.png';
            Storage::put($fileName, $image_base64);
            $request["foto_absensi_pulang"] = $fileName;
            $request["status_absen"] = "Pulang";
            $request["absensi_pulang"] = now()->format("Y-m-d H:i");
            $shiftpegawai = ShiftPegawai::where('id', $id)->first();
            $tgl_skrg = date("Y-m-d");
            $awal  = strtotime($shiftpegawai->tanggal . ' ' . $shiftpegawai->jam_pulang);
            $akhir = strtotime($request["absensi_pulang"]);
            $diff  = $akhir - $awal;
            if ($diff >= 0) {
                $request["pulang_cepat"] = 0;
            } else {
                $request["pulang_cepat"] = $diff;
            }
            $shiftpegawai->update($request->all());
            Alert::success('Success', 'Berhasil Absensi Pulang');
            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'activity' => 'Absensi Masuk',
                'description' => auth()->user()->name . ' telah melakukan absensi pulang',
            ]);
            return redirect()->route('absensi.proses');
        }
    }
    public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
    public function mount()
    {
        $this->user = auth()->user();
        $shiftkemarin = ShiftPegawai::where('user_id', $this->user->id)
            ->where('tanggal', now()->subDays(1)->format('Y-m-d'))
            ->first();
        $shifthariini = ShiftPegawai::where('user_id', $this->user->id)
            ->where('tanggal', now()->format('Y-m-d'))
            ->first();
        if ($shiftkemarin) {
            if ($shiftkemarin->absensi_pulang) {
                $this->shift = $shifthariini;
            } else {
                $this->shift = $shiftkemarin;
                flash("Anda memiliki absensi hari kemarin yang belum diselesaikan", 'warning');
            }
        } else {
            $this->shift = $shifthariini;
        }
        $lokasikantor = LokasiAbsensi::first();
        $this->lat_kantor = $lokasikantor->latitude ?? 0;
        $this->long_kantor = $lokasikantor->longitude ?? 0;
        $this->rad_kantor = $lokasikantor->radius ?? 10;
    }
    public function render()
    {
        return view('livewire.absensi.absensi-proses')->title('Proses Absensi');
    }
}
