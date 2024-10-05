<?php

namespace App\Livewire\Farmasi;

use App\Exports\ObatExport;
use App\Imports\ObatImport;
use App\Models\Obat;
use App\Models\SatuanKemasan;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ObatIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $obat, $stokminus, $obataktif, $stokterbatas, $filter, $paginate = 1, $satuans;
    public $id, $nama, $zat_aktif, $kekuatan, $kemasan, $konversi_satuan, $satuan, $stok_minimum, $jenisobat, $tipeobat, $harga_beli, $diskon_beli, $harga_jual, $harga_klinik, $harga_bpjs, $merk, $distributor, $bpom, $barcode;
    public $search = '';
    public $form = false;
    public $formImport = false;
    public $fileObatImport;

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'kemasan' => 'string',
            'konversi_satuan' => 'required|integer|min:1',
            'satuan' => 'string',
            'stok_minimum' => 'nullable|integer|min:0',
            'jenisobat' => 'required',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
        ]);
        if ($this->obat) {
            $obat = $this->obat;
        } else {
            $obat = new Obat();
        }
        $obat->nama = $this->nama;
        $obat->kemasan = $this->kemasan;
        $obat->konversi_satuan = $this->konversi_satuan;
        $obat->satuan = $this->satuan;
        $obat->stok_minimum = $this->stok_minimum;
        $obat->jenisobat = $this->jenisobat;
        $obat->tipeobat = $this->tipeobat;
        $obat->harga_beli = $this->harga_beli;
        $obat->diskon_beli = $this->diskon_beli ?? 0;
        $obat->harga_jual = $this->harga_jual;
        $obat->harga_klinik = $this->harga_klinik ?? $this->harga_jual;
        $obat->harga_bpjs = $this->harga_bpjs;
        $obat->merk = $this->merk;
        $obat->distributor = $this->distributor;
        $obat->bpom = $this->bpom;
        $obat->barcode = $this->barcode;
        $obat->zat_aktif = $this->zat_aktif;
        $obat->kekuatan = $this->kekuatan;
        $obat->status =  1;
        $obat->user = auth()->user()->id;
        $obat->pic = auth()->user()->name;
        $obat->save();
        SatuanKemasan::updateOrCreate(['nama' => $this->satuan]);
        SatuanKemasan::updateOrCreate(['nama' => $this->kemasan]);
        $this->reset(['nama', 'kemasan', 'konversi_satuan', 'satuan', 'stok_minimum', 'jenisobat', 'tipeobat', 'harga_beli', 'diskon_beli', 'harga_jual', 'harga_klinik', 'harga_bpjs', 'merk', 'distributor', 'bpom', 'barcode']);
        $this->openForm();
        flash('Obat ' . $obat->nama . ' saved successfully', 'success');
    }
    public function nonaktif(Obat $obat)
    {
        $obat->status = $obat->status ? 0 : 1;
        $obat->update();
        flash('Obat ' . $obat->nama . ' dinonaktifkan successfully', 'success');
        $this->reset(['nama', 'kemasan', 'konversi_satuan', 'satuan', 'stok_minimum', 'jenisobat', 'tipeobat', 'harga_beli', 'diskon_beli', 'harga_jual', 'harga_klinik', 'harga_bpjs', 'merk', 'distributor', 'bpom', 'barcode']);
        $this->openForm();
    }
    public function edit(Obat $obat)
    {
        $this->obat = $obat;
        $this->nama = $obat->nama;
        $this->kemasan = $obat->kemasan;
        $this->konversi_satuan = $obat->konversi_satuan;
        $this->satuan = $obat->satuan;
        $this->stok_minimum = $obat->stok_minimum;
        $this->jenisobat = $obat->jenisobat;
        $this->tipeobat = $obat->tipeobat;
        $this->harga_beli = $obat->harga_beli;
        $this->diskon_beli = $obat->diskon_beli;
        $this->harga_jual = $obat->harga_jual;
        $this->harga_klinik = $obat->harga_klinik;
        $this->harga_bpjs = $obat->harga_bpjs;
        $this->merk = $obat->merk;
        $this->distributor = $obat->distributor;
        $this->bpom = $obat->bpom;
        $this->barcode = $obat->barcode;
        if ($this->harga_beli && $this->konversi_satuan) {
            $this->hargabelippn = $this->harga_beli + ($this->harga_beli * 11 / 100);
            $this->hargabelisatuan = $this->harga_beli / $this->konversi_satuan;
            $this->hargabelisatuanppn =  $this->hargabelippn / $this->konversi_satuan ?? 0;
            $this->hargabelimargin = $this->hargabelisatuanppn + ($this->hargabelisatuanppn * 25 / 100);
            $this->hargajualppn = $this->hargabelimargin + ($this->hargabelimargin * 11 / 100);
        }
        $this->form = true;
    }
    public function import()
    {
        try {
            $this->validate([
                'fileObatImport' => 'required|mimes:xlsx'
            ]);
            Excel::import(new ObatImport, $this->fileObatImport->getRealPath());
            flash('Import Obat successfully', 'success');
            $this->formImport = false;
            $this->fileObatImport = null;
            return redirect()->route('obat.index');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function export()
    {
        try {
            $time = now()->format('Y-m-d');
            return Excel::download(new ObatExport, 'obat_backup_' . $time . '.xlsx');
            flash('Export Obat successfully', 'success');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function openFormImport()
    {
        $this->formImport =  $this->formImport ? false : true;
    }
    public function openForm()
    {
        $fields = ['nama', 'kemasan', 'konversi_satuan', 'satuan', 'stok_minimum', 'jenisobat', 'tipeobat', 'harga_beli', 'diskon_beli', 'harga_jual', 'harga_klinik', 'harga_bpjs', 'merk', 'distributor', 'bpom', 'barcode'];
        $this->reset($fields);
        $this->form = $this->form ? false : true;
        $this->satuans = SatuanKemasan::pluck('nama');
    }
    public $hargabelippn = 0;
    public $hargabelisatuan = 0;
    public $hargabelisatuanppn = 0;
    public $hargabelimargin = 0;
    public $hargajualppn = 0;

    public function updatedHargaBeli()
    {
        $this->validate([
            'konversi_satuan' => 'required|integer|min:1',
        ]);
        $this->hargabelippn = $this->harga_beli + ($this->harga_beli * 11 / 100);
        $this->hargabelisatuan = $this->harga_beli / $this->konversi_satuan;
        $this->hargabelisatuanppn =  $this->hargabelippn / $this->konversi_satuan ?? 0;
        $this->hargabelimargin = $this->hargabelisatuanppn + ($this->hargabelisatuanppn * 25 / 100);
        $this->hargajualppn = $this->hargabelimargin + ($this->hargabelimargin * 11 / 100);
    }
    public function updatedKonversiSatuan()
    {
        $this->validate([
            'harga_beli' => 'required|integer|min:1',
        ]);
        $this->hargabelippn = $this->harga_beli + ($this->harga_beli * 11 / 100);
        $this->hargabelisatuan = $this->harga_beli / $this->konversi_satuan;
        $this->hargabelisatuanppn =  $this->hargabelippn / $this->konversi_satuan ?? 0;
        $this->hargabelimargin = $this->hargabelisatuanppn + ($this->hargabelisatuanppn * 25 / 100);
        $this->hargajualppn = $this->hargabelimargin + ($this->hargabelimargin * 11 / 100);
    }
    public function mount(Request $request)
    {
        $this->filter = $request->filter;
        $this->satuans = SatuanKemasan::pluck('nama');
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        if ($this->filter) {
            $this->paginate = 0;
            if ($this->filter == "minus") {
                $obats = Obat::where('nama', 'like', $search)
                    ->with(['reseps', 'stoks'])
                    ->orderBy('status', 'desc')
                    ->orderBy('nama', 'asc')
                    ->get()->filter(function ($obat) {
                        return $obat->real_stok < 0;
                    });
            }
            if ($this->filter == "minimum") {
                $obats = Obat::where('nama', 'like', $search)
                    ->with(['reseps', 'stoks'])
                    ->orderBy('status', 'desc')
                    ->orderBy('nama', 'asc')
                    ->get()->filter(function ($obat) {
                        $stokmin = $obat->stok_minimum ?? 0;
                        return $obat->real_stok < $stokmin;
                    });
            }
        } else {
            $obats = Obat::where('nama', 'like', $search)
                ->with(['reseps', 'stoks'])
                ->orderBy('status', 'desc')
                ->orderBy('nama', 'asc')
                ->paginate(10);
        }
        return view('livewire.farmasi.obat-index', compact('obats'))->title('Obat');
    }
}
