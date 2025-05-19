<?php

namespace App\Http\Controllers;

use App\Models\PengaturanWhatsapp;
use App\Models\WhatsappLog;
use App\Models\WhatsappQr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class WhatsappController extends Controller
{
    public $hari = ["MINGGU", "SENIN", "SELASA", "RABU", "KAMIS", "JUMAT", "SABTU"];
    public function whatsapp(Request $request)
    {
        $res = null;
        if ($request->message) {
            $request['number'] = "089529909036";
            $res = $this->send_message($request);
            // $request['number'] = "120363170262520539";
            // $res = $this->send_message_group($request);
            if ($res->status == "true") {
                $res = json_encode($res);
                Alert::success('Success', 'Pesan testing terkirim');
            } else {
                Alert::error('Error', 'Pesan testing gagal terkirim');
                $res = json_encode($res);
            }
        }
        return view('admin.whatsapp', compact(['request', 'res']));
        // return $response;
    }
    public function send_message(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'number' => 'required',
        ]);
        $pengaturan = PengaturanWhatsapp::first();
        $url = $pengaturan->baseUrl . "send-message";
        $response = Http::post($url, [
            'number' => $request->number,
            'message' => $request->message,
            'username' => $pengaturan->kode,
        ]);
        $response = json_decode($response->getBody());
        return $response;
    }
    public function send_message_group(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'number' => 'required',
        ]);
        $url = env('WHATASAPP_URL') . "send-message-group";
        $response = Http::post($url, [
            'group' => $request->number,
            'message' => $request->message,
            'username' => env('WHATASAPP_USERNAME'),
        ]);
        $response = json_decode($response->getBody());
        return $response;
    }
    public function send_notif(Request $request)
    {
        $url = env('WHATASAPP_URL') . "notif";
        $response = Http::post($url, [
            'message' => $request->notif,
            'username' => env('WHATASAPP_USERNAME'),
        ]);
        $response = json_decode($response->getBody());
        return $response;
    }
    public function send_button(Request $request)
    {
        $url = env('WHATASAPP_URL') . "send-button";
        $response = Http::post($url, [
            'number' => $request->number,
            'contenttext' => $request->contenttext,
            'footertext' => $request->footertext,
            'titletext' => $request->titletext,
            'buttontext' => $request->buttontext, // 'UMUM,BPJS'
            'username' => env('WHATASAPP_USERNAME'),
        ]);
        $response = json_decode($response->getBody());
        return $response;
    }
    public function send_list(Request $request)
    {
        $url = env('WHATASAPP_URL') . "send-list";
        $response = Http::post($url, [
            'number' => $request->number,
            'contenttext' => $request->contenttext,
            'footertext' => $request->footertext,
            'titletext' => $request->titletext,
            'buttontext' => $request->buttontext, #wajib
            'titlesection' => $request->titlesection,
            'rowtitle' => $request->rowtitle, #wajib
            'rowdescription' => $request->rowdescription,
            'username' => env('WHATASAPP_USERNAME'),
        ]);
        $response = json_decode($response->getBody());
        return $response;
    }
    public function send_image(Request $request)
    {
        $url = env('WHATASAPP_URL') . "send-media";
        $response = Http::post($url, [
            'number' => $request->number,
            'fileurl' => $request->fileurl,
            'caption' => $request->caption,
            'username' => env('WHATASAPP_USERNAME'),
        ]);
        $response = json_decode($response->getBody());
        return $response;
    }
    public function send_filepath(Request $request)
    {
        $url = env('WHATASAPP_URL') . "send-filepath";
        $response = Http::post($url, [
            'number' => $request->number,
            'filepath' => $request->filepath,
            'caption' => $request->caption,
            'username' => env('WHATASAPP_USERNAME'),
        ]);
        $response = json_decode($response->getBody());
        return $response;
    }
    public function webhook(Request $request)
    {
        if ($request->username == env('WHATASAPP_USERNAME')) {
            if ($request->type == "qr") {
                WhatsappQr::create([
                    'qr' => $request->qr,
                    'username' => $request->username,
                ]);
                Log::info('QR Whatsapp : ' . $request->qr);
            }
            if ($request->type == "message") {
                Log::info('Whatsapp Message: ' . $request->message);
            }
            WhatsappLog::create([
                'status' => $request->status,
                'type' => $request->type,
                'username' => $request->username,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'success ' . $request->status,
            ]);
        } else {
            Log::warning('Error Username Whatsapp : ' . $request->username);
        }
    }
}
