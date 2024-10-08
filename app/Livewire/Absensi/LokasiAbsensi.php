<?php

namespace App\Livewire\Absensi;

use App\Models\ActivityLog;
use App\Models\LokasiAbsensi as ModelsLokasiAbsensi;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class LokasiAbsensi extends Component
{
    public $latitude, $longitude, $radius;
    public function simpan()
    {
        $lokasi = ModelsLokasiAbsensi::first();
        if ($lokasi) {
            $lokasi->latitude = $this->latitude;
            $lokasi->longitude = $this->longitude;
            $lokasi->radius = $this->radius;
            $lokasi->save();
        } else {
            $lokasi = ModelsLokasiAbsensi::create([
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'radius' => $this->radius,
            ]);
        }
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Update/Create Lokasi Kantor',
            'description' => auth()->user()->name . ' telah menyimpan lokasi kantor',
        ]);
        Alert::success('Success', 'Berhasil Simpan Lokasi Absensi');
        $url = route('lokasi.absensi');
        redirect()->to($url);
    }
    public function mount()
    {
        $lokasi = ModelsLokasiAbsensi::first();
        if ($lokasi) {
            $this->latitude = $lokasi->latitude;
            $this->longitude = $lokasi->longitude;
            $this->radius = $lokasi->radius;
        }
    }
    public function render()
    {
        return view('livewire.absensi.lokasi-absensi')->title('Lokasi Absensi');
    }
}
