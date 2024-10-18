<?php

namespace App\Livewire\Wa;

use App\Http\Controllers\WhatsappController;
use App\Models\WhatsappLog;
use App\Models\WhatsappQr;
use Illuminate\Http\Request;
use Livewire\Component;

class WhatsappIndex extends Component
{
    public $number, $message, $qr, $logs;
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
        $this->qr = WhatsappQr::orderBy('created_at', 'desc')->limit(3)->get();
        $this->logs = WhatsappLog::orderBy('created_at', 'desc')->limit(10)->get();
        return view('livewire.wa.whatsapp-index')->title('Whatsapp');
    }
}
