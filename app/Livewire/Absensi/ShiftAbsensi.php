<?php

namespace App\Livewire\Absensi;

use App\Exports\JadwalAbsensiExport;
use App\Imports\JadwalAbsensiImport;
use App\Models\ActivityLog;
use App\Models\ShiftAbsensi as ModelsShiftAbsensi;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ShiftAbsensi extends Component
{
    use WithFileUploads;
    public $form = 0, $formimport = 0, $fileimport;
    public $shifts, $shift, $id, $nama, $slug, $jam_masuk, $jam_pulang;
    public function tambah()
    {
        $this->form = $this->form ? 0 : 1;
        $this->reset(['shift', 'id', 'nama', 'jam_masuk', 'jam_pulang']);
    }
    public function store()
    {
        if ($this->id) {
            $shift = ModelsShiftAbsensi::find($this->id);
        } else {
            $shift = new ModelsShiftAbsensi();
        }
        $shift->nama = $this->nama;
        $shift->slug = $this->slug;
        $shift->jam_masuk = $this->jam_masuk;
        $shift->jam_pulang = $this->jam_pulang;
        $shift->user = auth()->user()->id;
        $shift->pic =  auth()->user()->name;
        $shift->save();
        $this->form =  0;
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Update/Create Jadwal Shift Kerja',
            'description' => auth()->user()->name . ' telah menyimpan jadwal shift kerja ' . $shift->nama,
        ]);
        flash('Jadwal Shift Kerja ' . $shift->nama . ' berhasil disimpan.', 'success');
    }
    public function edit(ModelsShiftAbsensi $shift)
    {
        $this->shift = $shift;
        $this->id = $shift->id;
        $this->nama = $shift->nama;
        $this->slug = $shift->slug;
        $this->jam_masuk = $shift->jam_masuk;
        $this->jam_pulang = $shift->jam_pulang;
        $this->form =  1;
    }
    public function hapus(ModelsShiftAbsensi $shift)
    {
        $shift->delete();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Hapus Shift Kerja',
            'description' => auth()->user()->name . ' telah menghapus jadwal shift kerja',
        ]);
        flash('Jadwal Shift Kerja berhasil dihapus.', 'success');
    }
    public function export()
    {
        try {
            $time = now()->format('Y-m-d');
            return Excel::download(new JadwalAbsensiExport, 'jadwalabsensi_backup_' . $time . '.xlsx');
            flash('Export Jadwal Absesni successfully', 'success');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function importform()
    {
        $this->formimport = $this->formimport ? 0 : 1;
        $this->reset(['fileimport']);
    }
    public function import()
    {
        try {
            $this->validate([
                'fileimport' => 'required|mimes:xlsx'
            ]);
            Excel::import(new JadwalAbsensiImport, $this->fileimport->getRealPath());
            flash('Import Jadwal Abensi successfully', 'success');
            $this->formimport = 0;
            $this->fileimport = null;
            return redirect()->route('shift.absensi');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function render()
    {
        $this->shifts = ModelsShiftAbsensi::orderBy('nama', 'asc')->get();
        return view('livewire.absensi.shift-absensi')->title('Jadwal Shift Kerja');
    }
}
