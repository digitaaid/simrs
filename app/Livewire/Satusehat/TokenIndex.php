<?php

namespace App\Livewire\Satusehat;

use App\Http\Controllers\SatuSehatController;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class TokenIndex extends Component
{
    public $token;

    public function generateToken()
    {
        $api = new SatuSehatController();
        $response = $api->token_generate();
        $token = Cache::get('satusehat_access_token');
        $this->token = $token;
    }

    public function render()
    {
        $token = Cache::get('satusehat_access_token');
        $this->token = $token;
        // dd($token);
        // $api = Integration::where('name', 'Satu Sehat')->first();
        // $url = $api->base_url . "/Patient?identifier=https://fhir.kemkes.go.id/id/nik|9104025209000006";
        // $response = Http::withToken($token)->get($url);
        // $data =  $response->json();

        return view('livewire.satusehat.token-index');
    }
}
