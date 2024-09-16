<?php

namespace App\Livewire\Farmasi;

use App\Models\Obat;
use App\Models\ResepFarmasiDetail;
use App\Models\StokObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class StokObatIndex extends Component
{
    public $obat, $resepfarmasidetails, $stoks;
    public $obat_id, $nama_obat, $harga_beli, $konversi_satuan;
    public $diskon_beli = 0, $pajak_ppn = 11, $jumlah_satuan = 0, $jumlah_kemasan = 0, $tgl_input, $tgl_expire;
    public $form = 0;
    public function store(Request $request)
    {
        $now = now()->timestamp;
        $obat = Obat::find($this->obat_id);
        $request['kode'] = 'SO' . $now;
        $request['obat_id'] = $obat->id;
        $request['nama'] = $obat->nama;
        $request['harga_beli'] = $this->harga_beli;
        $request['pajak_ppn'] = $this->pajak_ppn;
        $request['diskon_beli'] = $this->diskon_beli;
        $request['tgl_input'] = $this->tgl_input;
        $request['tgl_expire'] = $this->tgl_expire;
        $request['user'] = Auth::user()->id;
        $request['pic'] = Auth::user()->name;
        $request['jumlah_kemasan'] = $this->jumlah_kemasan;
        $request['jumlah_satuan'] = $this->jumlah_satuan + ($obat->konversi_satuan * $this->jumlah_kemasan);
        $hargasatuan = $this->harga_beli / $obat->konversi_satuan;
        $hargatotal = $hargasatuan * $request->jumlah_satuan;
        $hargapppn = $hargatotal + ($hargatotal * 11 / 100);
        $hargadiskon = $hargapppn - ($hargatotal * $this->diskon_beli / 100);
        $request['total_harga'] = round($hargadiskon);
        $stok = StokObat::create($request->all());
        Alert::success('Success', 'Berhasil Input Stok');
        $url = route('stokobat.index') . "?kode=" . $obat->id;
        return redirect()->to($url);
    }
    public function tambah()
    {
        $this->form = $this->form ? 0 : 1;
    }

    public function mount(Request $request)
    {
        $this->obat = Obat::find($request->kode);
        $this->stoks = StokObat::where('obat_id', $request->kode)->get();
        $this->obat_id = $this->obat->id;
        $this->nama_obat = $this->obat->nama;
        $this->harga_beli = $this->obat->harga_beli;
        $this->konversi_satuan = $this->obat->konversi_satuan;
        $this->resepfarmasidetails = ResepFarmasiDetail::with(['kunjungan', 'antrian'])
            ->where('obat_id', $this->obat->id)
            ->get();
    }
    public function render()
    {
        return view('livewire.farmasi.stok-obat-index')->title('Stok Obat ' . $this->obat->nama);
    }
}
