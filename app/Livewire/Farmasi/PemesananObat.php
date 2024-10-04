<?php

namespace App\Livewire\Farmasi;

use App\Models\FrekuensiObat;
use App\Models\Obat;
use App\Models\PemesananObat as ModelsPemesananObat;
use App\Models\WaktuObat;
use Livewire\Component;

class PemesananObat extends Component
{
    public $tanggal;
    public $form = 0, $formimport = 0;
    public $obats = [], $frekuensiObats = [], $waktuObats = [];
    public $nomor, $penanggungjawab, $jabatan, $sipa, $distributor, $alamat_distributor, $nohp, $nama_sarana, $alamat_sarana, $no_izin_sarana, $apoteker;
    public $resepObat = [
        [
            'obat' => '',
            'zat_aktif' => '',
            'satuan' => '',
            'kekuatan' => '',
            'jumlah' => '',
            'kemasan' => '',
        ]
    ];
    public function addObat()
    {
        $this->resepObat[] = [
            'obat' => '',
            'zat_aktif' => '',
            'satuan' => '',
            'kekuatan' => '',
            'jumlah' => '',
            'kemasan' => '',
        ];
    }
    public function removeObat($index)
    {
        unset($this->resepObat[$index]);
        $this->resepObat = array_values($this->resepObat);
    }
    public function updatedResepObat($value, $name)
    {
        $index = explode('.', $name)[0];  // Mendapatkan index dari nama yang diubah
        $this->prosesObat($value, $index);  // Memanggil fungsi yang diinginkan
    }
    public function prosesObat($namaObat, $index)
    {
        $obat = Obat::where('nama', $namaObat)->first();
        if ($obat) {
            $this->resepObat[$index]['harga_beli'] = $obat->harga_beli;
            $this->resepObat[$index]['kemasan'] = $obat->kemasan;
            $this->resepObat[$index]['satuan'] = $obat->satuan;
        }
    }
    public function tambah()
    {
        $this->form = $this->form  ? 0 : 1;
    }
    public function mount()
    {
        $this->tanggal = now()->format('Y-m-d');
        $this->penanggungjawab = "Apt. Nunung Nurhayati, S.Si";
        $this->jabatan = "Apoteker Penanggung Jawab";
        $this->sipa = "449/SIPA-242/SDK/DINKES/XI/2023";
        $this->nama_sarana = "Klinik Utama Kita Sehat";
        $this->alamat_sarana = "Jl. Merdeka Utara, Ciledug Kulon, Ciledug, Cirebon";
        $this->no_izin_sarana = "16082100122660007";
    }
    public function simpan()
    {
        ModelsPemesananObat::create([
            ''
        ]);
    }


    public function render()
    {
        $this->obats = Obat::get(['nama', 'harga_beli', 'kemasan', 'satuan',]);
        return view('livewire.farmasi.pemesanan-obat')->title('Pemesanan Obat');
    }
}
