<?php

namespace App\Livewire\Satusehat;

use App\Http\Controllers\CondititionController;
use App\Http\Controllers\EncounterController;
use App\Models\Antrian;
use App\Models\Kunjungan;
use App\Models\Pengaturan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class EncounterIndex extends Component
{
    public $antrians = [], $tanggalperiksa;
    public $search = '';
    public function render()
    {
        if ($this->tanggalperiksa) {
            $search = '%' . $this->search . '%';
            $this->antrians = Antrian::where('tanggalperiksa', $this->tanggalperiksa)
                ->where('taskid', '>=', 3)
                ->where('taskid', '!=', 99)
                ->leftJoin('asesmen_rajals', 'antrians.id', '=', 'asesmen_rajals.antrian_id')
                ->with(['kunjungan', 'kunjungan.units', 'kunjungan.dokters', 'layanans', 'asesmenrajal', 'pic1'])
                ->orderBy('asesmen_rajals.status_asesmen_perawat', 'asc')
                ->select('antrians.*')
                ->where(function ($query) use ($search) {
                    $query->where('antrians.nama', 'like', "%{$search}%")
                        ->orWhere('antrians.norm', 'like', "%{$search}%");
                })
                ->get();
        }
        if ($this->search && $this->tanggalperiksa == null) {
            $search = '%' . $this->search . '%';
            $this->antrians = Antrian::where('taskid', '>=', 3)
                ->where('taskid', '!=', 99)
                ->leftJoin('asesmen_rajals', 'antrians.id', '=', 'asesmen_rajals.antrian_id')
                ->with(['kunjungan', 'kunjungan.units', 'kunjungan.dokters', 'layanans', 'asesmenrajal', 'pic1'])
                ->orderBy('asesmen_rajals.status_asesmen_perawat', 'asc')
                ->select('antrians.*')
                ->where(function ($query) use ($search) {
                    $query->where('antrians.nama', 'like', "%{$search}%")
                        ->orWhere('antrians.norm', 'like', "%{$search}%");
                })
                ->get();
        }
        return view('livewire.satusehat.encounter-index')->title('Encounter');
    }
    public function mount(Request $request)
    {
        $this->tanggalperiksa = $request->tanggalperiksa ?? now()->format('Y-m-d');
    }
    public function createEncounter($kode)
    {
        $kunjungan = Kunjungan::firstWhere('kode', $kode);
        $pasien = $kunjungan->pasien;
        $unit = $kunjungan->units;
        $dokter = $kunjungan->dokters;
        $request = new Request();
        $request['patient_id'] = $pasien->idpatient;
        $pengaturan = Pengaturan::firstOrFail();
        $request['organization_id'] =  $pengaturan->idorganization;
        $request['patient_name'] = $pasien->nama;
        $request['practitioner_id'] = $dokter->idpractitioner;
        $request['practitioner_name'] = $dokter->nama;
        $request['location_id'] = $unit->idlocation;
        $request['location_name'] = 'Lokasi poliklinik ' . $unit->nama;
        $request['encounter_id'] = $kunjungan->kode;
        $request['start'] = Carbon::parse($kunjungan->tgl_masuk);
        if (!$kunjungan->idencounter) {
            $api = new EncounterController();
            $res = $api->encounter_create($request);
            if ($res->metadata->code == 200) {
                $id = $res->response->id;
                $kunjungan->update([
                    'idencounter' => $id,
                ]);
                flash($res->metadata->message, 'success');
            } else {
                flash($res->metadata->message, 'danger');
            }
        } else {
            flash('Kunjungan telah syncron dengan satusehat id', 'danger');
        }
        return redirect()->back();
    }
    public function createConditition($kode)
    {
        $kunjungan = Kunjungan::firstWhere('kode', $kode);
        $pasien = $kunjungan->pasien;
        $asemen = $kunjungan->asesmenrajal;
        $request = new Request();
        $request['patient_id'] = $pasien->idpatient;
        $request['patient_name'] = $pasien->nama;
        $request['encounter_id'] = $kunjungan->idencounter;
        $request['code_idc10'] = explode(' - ', $asemen->icd1)[0];
        $request['name_icd10'] = explode(' - ', $asemen->icd1)[1];
        $api = new CondititionController();
        $res  = $api->conditition_create($request);
        if ($res->metadata->code == 200) {
            $id = $res->response->id;
            $kunjungan->update([
                'idconditition' => $id
            ]);
            flash($res->metadata->message, 'success');
        } else {
            flash($res->metadata->message, 'danger');
        }
        return redirect()->back();
    }
}
