<?php

namespace App\Livewire\Satusehat;

use App\Http\Controllers\SatuSehatController;
use App\Models\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PatientIndex extends Component
{
    public function patient_by_nik(Request $request)
    {
        $token = Cache::get('satusehat_access_token');
        $api = Integration::where('name', 'Satu Sehat')->first();
        $url = $api->base_url . "/Patient?identifier=https://fhir.kemkes.go.id/id/nik|9104025209000006";
        $response = Http::withToken($token)->get($url);
        $data =  $response->json();
        // satusehat
        $api = new SatuSehatController();
        return $api->responseSatuSehat($data);
    }
    public function render()
    {

        return view('livewire.satusehat.patient-index')->title('Patient');
    }
}
