<?php

namespace App\Livewire\Pendaftaran;

use App\Models\Antrian;
use Carbon\Carbon;
use Livewire\Component;

class DashboardPendaftaran extends Component
{
    public $antrians, $arrayHariBulanIni, $jumlahAntrianPerTanggaljkn, $jumlahAntrianPerTanggalumum;
    public $antrianjkn = [];
    public $antrianumum = [];
    public function mount()
    {
        $this->antrians = Antrian::where('taskid', '>=', 3)
            ->where('taskid', '!=', 99)
            ->has('kunjungan')
            ->get();

        // Mengambil tahun saat ini untuk contoh, sesuaikan sesuai kebutuhan
        $tahunSaatIni = now()->year;
        $jumlahAntrianPerBulan = array_fill(0, 12, 0);
        $antrianPerBulan = Antrian::where('taskid', '>=', 3)
            ->where('taskid', '!=', 99)
            ->where('jenispasien', 'NON-JKN')
            ->has('kunjungan')
            ->whereYear('created_at', $tahunSaatIni) // Asumsi menggunakan kolom `created_at` untuk tanggal antrian
            ->get()
            ->groupBy(function ($date) {
                // Mengelompokkan berdasarkan bulan dari tanggal `created_at`
                return Carbon::parse($date->created_at)->format('m'); // 'm' untuk format bulan dengan leading zero
            })
            ->map(function ($row) {
                return $row->count(); // Menghitung jumlah antrian per bulan
            });

        foreach ($antrianPerBulan as $bulan => $jumlah) {
            $indexBulan = (int)$bulan - 1;
            $jumlahAntrianPerBulan[$indexBulan] = $jumlah;
        }
        $this->antrianumum = $jumlahAntrianPerBulan;
        // Mengambil tahun saat ini untuk contoh, sesuaikan sesuai kebutuhan
        $tahunSaatIni = now()->year;
        $jumlahAntrianPerBulan = array_fill(0, 12, 0);
        $antrianPerBulan = Antrian::where('taskid', '>=', 3)
            ->where('taskid', '!=', 99)
            ->where('jenispasien', 'JKN')
            ->has('kunjungan')
            ->whereYear('created_at', $tahunSaatIni) // Asumsi menggunakan kolom `created_at` untuk tanggal antrian
            ->get()
            ->groupBy(function ($date) {
                // Mengelompokkan berdasarkan bulan dari tanggal `created_at`
                return Carbon::parse($date->created_at)->format('m'); // 'm' untuk format bulan dengan leading zero
            })
            ->map(function ($row) {
                return $row->count(); // Menghitung jumlah antrian per bulan
            });
        foreach ($antrianPerBulan as $bulan => $jumlah) {
            $indexBulan = (int)$bulan - 1;
            $jumlahAntrianPerBulan[$indexBulan] = $jumlah;
        }
        $this->antrianjkn = $jumlahAntrianPerBulan;

        $jumlahHari = now()->daysInMonth;
        $this->arrayHariBulanIni = range(1, $jumlahHari);


        // Mengambil tahun dan bulan saat ini
        $tahunSaatIni = now()->year;
        $bulanSaatIni = now()->month;
        $jumlahHari = now()->daysInMonth;
        $jumlahAntrianPerTanggal = array_fill(0, $jumlahHari, 0);
        $antrianBulanIni = Antrian::where('taskid', '>=', 3)
            ->where('taskid', '!=', 99)
            ->where('jenispasien', 'NON-JKN')
            ->has('kunjungan')
            ->whereMonth('created_at', $bulanSaatIni)
            ->whereYear('created_at', $tahunSaatIni)
            ->get()
            ->groupBy(function ($date) {
                // Mengelompokkan berdasarkan tanggal dari tanggal `created_at`
                return Carbon::parse($date->created_at)->format('d'); // 'd' untuk format tanggal dengan leading zero
            })
            ->map(function ($row) {
                return $row->count(); // Menghitung jumlah antrian per tanggal
            });
        foreach ($antrianBulanIni as $tanggal => $jumlah) {
            // Mengubah format tanggal ke integer dan mengurangi 1 karena array dimulai dari 0
            $indexTanggal = (int)$tanggal - 1;
            if ($indexTanggal < count($jumlahAntrianPerTanggal)) {
                $jumlahAntrianPerTanggal[$indexTanggal] = $jumlah;
            }
        }
        $this->jumlahAntrianPerTanggalumum = $jumlahAntrianPerTanggal;


        // Mengambil tahun dan bulan saat ini
        $tahunSaatIni = now()->year;
        $bulanSaatIni = now()->month;
        $jumlahHari = now()->daysInMonth;
        $jumlahAntrianPerTanggal = array_fill(0, $jumlahHari, 0);
        $antrianBulanIni = Antrian::where('taskid', '>=', 3)
            ->where('taskid', '!=', 99)
            ->where('jenispasien', 'JKN')
            ->has('kunjungan')
            ->whereMonth('created_at', $bulanSaatIni)
            ->whereYear('created_at', $tahunSaatIni)
            ->get()
            ->groupBy(function ($date) {
                // Mengelompokkan berdasarkan tanggal dari tanggal `created_at`
                return Carbon::parse($date->created_at)->format('d'); // 'd' untuk format tanggal dengan leading zero
            })
            ->map(function ($row) {
                return $row->count(); // Menghitung jumlah antrian per tanggal
            });
        foreach ($antrianBulanIni as $tanggal => $jumlah) {
            // Mengubah format tanggal ke integer dan mengurangi 1 karena array dimulai dari 0
            $indexTanggal = (int)$tanggal - 1;
            if ($indexTanggal < count($jumlahAntrianPerTanggal)) {
                $jumlahAntrianPerTanggal[$indexTanggal] = $jumlah;
            }
        }
        $this->jumlahAntrianPerTanggaljkn = $jumlahAntrianPerTanggal;
        // dd($this->jumlahAntrianPerTanggalumum);
    }
    public function render()
    {
        // $antrianjkn =  [65, 59, 80, 81, 56, 55, 40];
        return view('livewire.pendaftaran.dashboard-pendaftaran')->title('Dashboard');
    }
}
