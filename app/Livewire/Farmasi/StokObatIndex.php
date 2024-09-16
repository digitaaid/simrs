<?php

namespace App\Livewire\Farmasi;

use App\Models\Obat;
use App\Models\ResepFarmasiDetail;
use App\Models\StokObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StokObatIndex extends Component
{
    public $obat, $resepfarmasidetails, $stoks;
    public $obat_id, $nama_obat, $harga_kemasan, $konversi_satuan;
    public $diskon_pembelian = 0, $jumlah_satuan = 0, $jumlah_kemasan = 0, $tgl_input, $tgl_expire;
    public $form = 0;
    public function store(Request $request)
    {
        $now = now()->timestamp;
        $request['kode'] = 'SO' . $now;
        $request['user'] = Auth::user()->id;
        $request['pic'] = Auth::user()->name;
        $obat = Obat::find($this->obat_id);
        $request['obat_id'] = $obat->id;
        $request['nama'] = $obat->nama;
        $request['jumlah_kemasan'] = $this->jumlah_kemasan;
        $request['jumlah_kemasan'] = $this->jumlah_kemasan;
        $request['harga_kemasan'] = $this->harga_kemasan;
        $request['tgl_input'] = $this->tgl_input;
        $request['tgl_expire'] = $this->tgl_expire;
        if ($this->jumlah_kemasan) {
            $request['jumlah_satuan'] = $this->jumlah_satuan + ($obat->konversi_satuan * $this->jumlah_kemasan);
        }
        // $hargadiskon = $request->harga_beli - ($request->harga_beli * $this->diskon_pembelian / 100);
        // $hargapppn = $hargadiskon + ($hargadiskon * 11 / 100);
        // $hargabelisatuan = $hargapppn / $obat->konversi_satuan;
        // $hargatotal = $hargabelisatuan * $request->jumlah;
        // $request['harga_total'] = round($hargatotal);
        $stok = StokObat::create($request->all());
        $url = route('stokobat.index') . "?kode=" . $obat->id;
        return redirect()->to($url);
        // Alert::success('Success', 'Berhasil Input Stok');
        // return redirect()->back();
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
        $this->harga_kemasan = $this->obat->harga_beli;
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
