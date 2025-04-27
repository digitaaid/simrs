<?php

namespace App\Livewire\Aplikasi;

use App\Exports\PengaturanAplikasiExport;
use App\Imports\PengaturanAplikasiImport;
use App\Models\Pengaturan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class PengaturanAplikasiIndex extends Component
{
    use WithFileUploads;
    public $pengaturan;
    public $formImport = false;
    public $fileImport;
    public $nama, $nama_panjang, $logo_icon, $auth_img, $anjungan_color, $anjungan_qr, $anjungan_img_info, $logo_karcis;
    public function import()
    {
        try {
            $this->validate([
                'fileImport' => 'required|mimes:xlsx'
            ]);
            Excel::import(new PengaturanAplikasiImport, $this->fileImport->getRealPath());
            flash('Import successfully', 'success');
            $this->formImport = false;
            $this->fileImport = null;
            return redirect()->route('pengaturan.aplikasi.index');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function export()
    {
        try {
            $time = now()->format('Y-m-d');
            return Excel::download(new PengaturanAplikasiExport, 'pengaturanaplikasi_backup_' . $time . '.xlsx');
            flash('Export successfully', 'success');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function openFormImport()
    {
        $this->formImport =  $this->formImport ? false : true;
    }
    public function mount()
    {
        $this->pengaturan = Pengaturan::first();
        if ($this->pengaturan) {
            $this->nama = $this->pengaturan->nama;
            $this->nama_panjang = $this->pengaturan->nama_panjang;
            $this->logo_icon = $this->pengaturan->logo_icon;
            $this->auth_img = $this->pengaturan->auth_img;
            $this->anjungan_color = $this->pengaturan->anjungan_color;
            $this->anjungan_qr = $this->pengaturan->anjungan_qr;
            $this->anjungan_img_info = $this->pengaturan->anjungan_img_info;
            $this->logo_karcis = $this->pengaturan->logo_karcis;
        }
    }
    public function render()
    {
        return view('livewire.aplikasi.pengaturan-aplikasi-index')->title('Pengaturan Aplikasi');
    }
    public function store()
    {
        $this->validate([
            'nama' => 'required',
        ]);
        if (is_file($this->logo_icon)) {
            $logo_icon =  'logo_icon.' . $this->logo_icon->getClientOriginalExtension();
            $path =  $this->logo_icon->storeAs('public/pengaturan',  $logo_icon);
            $this->logo_icon =  $logo_icon;
        }
        if (is_file($this->auth_img)) {
            $auth_img =  'auth_img.' . $this->auth_img->getClientOriginalExtension();
            $path =  $this->auth_img->storeAs('public/pengaturan',  $auth_img);
            $this->auth_img =  $auth_img;
        }
        if (is_file($this->logo_karcis)) {
            $logo_karcis =  'logo_karcis.' . $this->logo_karcis->getClientOriginalExtension();
            $path =  $this->logo_karcis->storeAs('public/pengaturan',  $logo_karcis);
            $this->logo_karcis =  $logo_karcis;
        }
        if (is_file($this->anjungan_qr)) {
            $anjungan_qr =  'anjungan_qr.' . $this->anjungan_qr->getClientOriginalExtension();
            $path =  $this->anjungan_qr->storeAs('public/pengaturan',  $anjungan_qr);
            $this->anjungan_qr =  $anjungan_qr;
        }
        if (is_file($this->anjungan_img_info)) {
            $anjungan_img_info =  'anjungan_img_info.' . $this->anjungan_img_info->getClientOriginalExtension();
            $path =  $this->anjungan_img_info->storeAs('public/pengaturan',  $anjungan_img_info);
            $this->anjungan_img_info =  $anjungan_img_info;
        }
        $pengaturan = Pengaturan::first();
        if ($pengaturan) {
            $pengaturan->update([
                'nama' => $this->nama,
                'nama_panjang' => $this->nama_panjang,
                'logo_icon' => $this->logo_icon,
                'auth_img' => $this->auth_img,
                'anjungan_color' => $this->anjungan_color,
                'anjungan_qr' => $this->anjungan_qr,
                'anjungan_img_info' => $this->anjungan_img_info,
                'logo_karcis' => $this->logo_karcis,
            ]);
        } else {
            $pengaturan =  Pengaturan::create([
                'nama' => $this->nama,
                'nama_panjang' => $this->nama_panjang,
                'logo_icon' => $this->logo_icon,
                'auth_img' => $this->auth_img,
                'anjungan_color' => $this->anjungan_color,
                'anjungan_qr' => $this->anjungan_qr,
                'anjungan_img_info' => $this->anjungan_img_info,
                'logo_karcis' => $this->logo_karcis,
            ]);
        }
        flash('Data berhasil disimpan', 'success');
    }
}
