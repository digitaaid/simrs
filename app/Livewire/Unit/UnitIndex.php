<?php

namespace App\Livewire\Unit;

use App\Exports\UnitExport;
use App\Http\Controllers\SatuSehatController;
use App\Imports\UnitImport;
use App\Models\Integration;
use App\Models\Pengaturan;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class UnitIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search = '';
    public $form = false;
    public $formImport = false;
    public $fileImport;
    public $id, $nama, $kode, $kodejkn,  $idorganization, $idlocation, $jenis, $lokasi, $status, $user, $pic;
    public $unit;

    public function cariIdOrganization($kode)
    {
        $unit = Unit::where('kode', $kode)->first();
        $pengaturan = Pengaturan::firstOrFail();
        $request = new Request([
            'organization_id' => $pengaturan->idorganization,
            'identifier' => $unit->nama,
            'name' => $unit->nama,
            'phone' => $pengaturan->phone,
            'email' => $pengaturan->email,
            'url' => $pengaturan->website,
            'address' => $pengaturan->address,
            'postalCode' => $pengaturan->postalCode,
            'province' => $pengaturan->province,
            'city' => $pengaturan->city,
            'district' => $pengaturan->district,
            'village' => $pengaturan->village,
        ]);
        $res = $this->organization_store($request);
        $json = $res->response;
        dd($json);
        if ($json->resourceType == "Organization") {
            $unit->update(['idorganization' => $json->id]);
        } else {
        }
        return redirect()->back();
    }
    public function organization_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "organization_id" => "required",
            "identifier" => "required",
            "name" => "required",
            "phone" => "required",
            "email" => "required|email",
            "url" => "required",
            "address" => "required",
            "postalCode" => "required",
            "province" => "required",
            "city" => "required",
            "district" => "required",
            "village" => "required",
        ]);
        $token = Cache::get('satusehat_access_token');
        $api = Integration::where('name', 'Satu Sehat')->first();
        $url =  $api->base_url . "/Organization";
        $data = [
            "resourceType" => "Organization",
            "active" => true,
            "identifier" => [
                [
                    "use" => "official",
                    "system" => "http://sys-ids.kemkes.go.id/organization/" . $request->organization_id,
                    "value" => $request->identifier
                ]
            ],
            "type" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/organization-type",
                            "code" => "dept",
                            "display" => "Hospital Department"
                        ]
                    ]
                ]
            ],
            "name" => $request->name,
            "telecom" => [
                [
                    "system" => "phone",
                    "value" => $request->phone,
                    "use" => "work"
                ],
                [
                    "system" => "email",
                    "value" => $request->email,
                    "use" => "work"
                ],
                [
                    "system" => "url",
                    "value" => $request->url,
                    "use" => "work"
                ]
            ],
            "address" => [
                [
                    "use" => "work",
                    "type" => "both",
                    "line" => [
                        $request->address
                    ],
                    "city" => $request->city,
                    "postalCode" => $request->postalCode,
                    "country" => "ID",
                    "extension" => [
                        [
                            "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
                            "extension" => [
                                [
                                    "url" => "province",
                                    "valueCode" => $request->province,
                                ],
                                [
                                    "url" => "city",
                                    "valueCode" =>  $request->city,
                                ],
                                [
                                    "url" => "district",
                                    "valueCode" =>  $request->district,
                                ],
                                [
                                    "url" => "village",
                                    "valueCode" =>  $request->village,
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            "partOf" => [
                "reference" => "Organization/" . $request->organization_id,
            ]
        ];
        $response = Http::withToken($token)->post($url, $data);
        $res = $response->json();
        $api = new SatuSehatController();
        return $api->responseSatuSehat($data);
    }
    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'kode' => 'required',
        ]);
        if ($this->unit) {
            $unit = $this->unit;
        } else {
            $unit = new Unit();
        }
        $unit->kode = $this->kode;
        $unit->nama = $this->nama;
        $unit->kodejkn = $this->kodejkn;
        $unit->idorganization = $this->idorganization;
        $unit->idlocation = $this->idlocation;
        $unit->jenis = $this->jenis;
        $unit->lokasi = $this->lokasi;
        $unit->status = 1;
        $unit->user = auth()->user()->id;
        $unit->pic = auth()->user()->name;
        $unit->save();
        $this->reset(['id', 'nama', 'kode', 'kodejkn', 'idorganization', 'idlocation', 'jenis', 'lokasi']);
        $this->openForm();
        flash('Unit ' . $unit->nama . ' saved successfully', 'success');
    }
    public function edit(Unit $unit)
    {
        $this->unit = $unit;
        $this->id = $unit->id;
        $this->nama = $unit->nama;
        $this->kode = $unit->kode;
        $this->kodejkn = $unit->kodejkn;
        $this->idorganization = $unit->idorganization;
        $this->idlocation = $unit->idlocation;
        $this->jenis = $unit->jenis;
        $this->lokasi = $unit->lokasi;
        $this->status = $unit->status;
        $this->form = true;
    }
    public function destroy(Unit $unit)
    {
        $unit->delete();
        flash('Unit ' . $unit->nama . ' deleted successfully', 'success');
    }
    public function nonaktif(Unit $unit)
    {
        $status = $unit->status ? 0 : 1;
        $unit->status =  $status;
        $unit->user =  auth()->user()->id;
        $unit->pic =  auth()->user()->name;
        $unit->save();
        flash('Unit ' . $unit->nama . ' noncactive successfully', 'success');
    }
    public function import()
    {
        try {
            $this->validate([
                'fileImport' => 'required|mimes:xlsx'
            ]);
            Excel::import(new UnitImport, $this->fileImport->getRealPath());
            flash('Import Unit successfully', 'success');
            $this->formImport = false;
            $this->fileImport = null;
            return redirect()->route('unit.index');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function export()
    {
        try {
            $time = now()->format('Y-m-d');
            return Excel::download(new UnitExport, 'unit_backup_' . $time . '.xlsx');
            flash('Export Unit successfully', 'success');
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
        $this->form =  $this->form ? false : true;
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $units = Unit::where('nama', 'like', $search)->paginate();
        return view('livewire.unit.unit-index', compact('units'))->title('Unit');
    }
}
