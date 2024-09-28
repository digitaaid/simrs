<?php

namespace App\Livewire\Wa;

use App\Http\Controllers\WhatsappController;
use Illuminate\Http\Request;
use Livewire\Component;

class WhatsappIndex extends Component
{
    public $number, $message;
    public function kirim(Request $request)
    {
        $api = new WhatsappController();
        $request['number'] = $this->number;
        $request['message'] = $this->message;
        $res = $api->send_message($request);
        if ($res->status) {
            return flash('Berhasil mengirim pesan', 'success');
        } else {
            dd($res);
            return flash('Berhasil mengirim pesan', 'danger');
        }
    }
    public function mount()
    {
        $this->number = "089529909036";
        $this->message = "test";
    }
    public function render()
    {
        return view('livewire.wa.whatsapp-index')->title('Whatsapp');
    }
}
