<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Integration;
use App\Models\JadwalDokter;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AntrianController extends ApiController
{
    public function displayantrian()
    {
        try {
            $jadwals = JadwalDokter::where('hari', now()->dayOfWeek)->get();
            return view('livewire.antrian.display-antrian', compact('jadwals'));
        } catch (\Throwable $th) {
            //throw $th;
            $jadwals = JadwalDokter::where('hari', now()->dayOfWeek)->get();
            return view('livewire.antrian.display-antrian', compact('jadwals'));
        }
    }
    public function displaynomor()
    {
        $antrian = Antrian::where('tanggalperiksa', now()->format('Y-m-d'))->where('kodepoli', '!=', 'FAR')->get(['kodebooking', 'nomorantrean', 'taskid', 'nama', 'namapoli', 'kodepoli']);
        $antrianpendaftaran = Antrian::where('tanggalperiksa', now()->format('Y-m-d'))->where('taskid', 2)->orderBy('updated_at', 'desc')->first();
        $antriandokter = Antrian::where('tanggalperiksa', now()->format('Y-m-d'))->where('taskid', 4)->orderBy('updated_at', 'desc')->first();
        $data = [
            "pendaftaran" => $antrianpendaftaran ?  substr($antrianpendaftaran->nomorantrean, 1) : "-",
            "pendaftaranhuruf" =>  $antrianpendaftaran ? substr($antrianpendaftaran->nomorantrean, 0, 1)  : "-",
            "pendaftarankodebooking" =>  $antrianpendaftaran ? $antrianpendaftaran->kodebooking : "-",
            "pendaftaranstatus" =>  $antrianpendaftaran ? $antrianpendaftaran->panggil : "-",
            "pendaftaranselanjutnya" => $antrian->where('taskid', 1)->pluck('kodebooking', 'nomorantrean'),

            "poliklinik" => $antriandokter ? substr($antriandokter->nomorantrean, 1) : "-",
            "poliklinikhuruf" => $antriandokter ? substr($antriandokter->nomorantrean, 0, 1) : "-",
            "poliklinikkode" => $antriandokter ?  $antriandokter->kodepoli : "-",
            "polikliniknama" => $antriandokter ?  $antriandokter->nama : "-",
            "poliklinikpoli" => $antriandokter ?  $antriandokter->namapoli : "",
            "poliklinikkodebooking" => $antriandokter ?  $antriandokter->kodebooking : "-",
            "poliklinikstatus" => $antriandokter ?  $antriandokter->panggil : "-",
            "poliklinikselanjutnya" => $antrian->where('taskid', 3),

            // "farmasi" => $antrian->where('taskid', 7)->first()->angkaantrean ?? "-",
            // "farmasistatus" => $antrian->where('taskid', 7)->first()->panggil ?? "-",
            // "farmasikodebooking" => $antrian->where('taskid', 7)->first()->kodebooking ?? "-",
            // "farmasiselanjutnya" => $antrian->where('taskid', 6)->first()->angkaantrean ?? "-",
        ];
        return $this->sendResponse($data, 200);
    }
    public function displayantrianfarmasi()
    {
        try {
            //code...
            $jadwals = JadwalDokter::where('hari', now()->dayOfWeek)->get();
            return view('livewire.antrian.display-antrian-farmasi', compact('jadwals'));
        } catch (\Throwable $th) {
            //throw $th;
            $jadwals = JadwalDokter::where('hari', now()->dayOfWeek)->get();
            return view('livewire.antrian.display-antrian-farmasi', compact('jadwals'));
        }
    }
    public function displaynomorfarmasi()
    {
        $antrian = Antrian::where('tanggalperiksa', now()->format('Y-m-d'))->where('kodepoli', '!=', 'FAR')->get(['kodebooking', 'nomorantrean', 'taskid', 'nama', 'namapoli', 'kodepoli']);
        $antrianpendaftaran = Antrian::where('tanggalperiksa', now()->format('Y-m-d'))->where('taskid', 2)->orderBy('updated_at', 'desc')->first();
        $antriandokter = Antrian::where('tanggalperiksa', now()->format('Y-m-d'))->where('taskid', 4)->orderBy('updated_at', 'desc')->first();
        $antrianfarmasi = Antrian::where('tanggalperiksa', now()->format('Y-m-d'))->where('taskid', 7)->orderBy('updated_at', 'desc')->first();
        $data = [
            // "pendaftaran" => $antrianpendaftaran ? substr($antrianpendaftaran->nomorantrean, 1) : "-",
            // "pendaftaranhuruf" => $antrianpendaftaran ? substr($antrianpendaftaran->nomorantrean, 0, 1) : "-",
            // "pendaftarankodebooking" => $antrianpendaftaran ? $antrianpendaftaran->kodebooking : "-",
            // "pendaftaranstatus" => $antrianpendaftaran ? $antrianpendaftaran->panggil : "-",
            // "pendaftaranselanjutnya" => $antrian->where('taskid', 1)->pluck('kodebooking', 'nomorantrean'),

            "poliklinik" => $antriandokter ? substr($antriandokter->nomorantrean, 1) : "-",
            "poliklinikhuruf" => $antriandokter ? substr($antriandokter->nomorantrean, 0, 1) : "-",
            "poliklinikkode" => $antriandokter ? $antriandokter->kodepoli : "-",
            "polikliniknama" => $antriandokter ? $antriandokter->namapoli : "-",
            "poliklinikkodebooking" => $antriandokter ? $antriandokter->kodebooking : "-",
            "poliklinikstatus" => $antriandokter ? $antriandokter->panggil : "-",
            "poliklinikselanjutnya" => $antrian->where('taskid', 3),

            "farmasi" => $antrianfarmasi ? substr($antrianfarmasi->nomorantrean, 1) : "-",
            "farmasihuruf" => $antrianfarmasi ? substr($antrianfarmasi->nomorantrean, 0, 1) : "-",
            "farmasistatus" => $antrianfarmasi ? $antrianfarmasi->panggil : "-",
            "farmasikodebooking" => $antrianfarmasi ? $antrianfarmasi->kodebooking : "-",
            "farmasiselanjutnya" => $antrian->where('taskid', '>=', 5)->where('taskid', '<=', 6),
        ];
        return $this->sendResponse($data, 200);
    }
    public function updatenomorantrean(Request $request)
    {
        $antrian = Antrian::where('kodebooking', $request->kodebooking)->first();
        if ($antrian) {
            $antrian->update([
                'panggil' => 1,
            ]);
            return $this->sendResponse('Antrian telah dipanggil', 200);
        } else {
            return $this->sendError('Antrian tidak ditemukan', 400);
        }
    }
    // API FUNCTION
    public function api()
    {
        $api = Integration::where('slug', 'antrian-bpjs')->first();
        $data['base_url'] =  $api->base_url;
        $data['user_id'] = $api->user_id;
        $data['user_key'] = $api->user_key;
        $data['secret_key'] = $api->secret_key;
        return json_decode(json_encode($data));
    }
    public function signature()
    {
        $api = Integration::where('slug', 'antrian-bpjs')->first();
        $cons_id = $api->user_id;
        $secretKey = $api->secret_key;
        $userkey = $api->user_key;
        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $cons_id . "&" . $tStamp, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $data['user_key'] =  $userkey;
        $data['x-cons-id'] = $cons_id;
        $data['x-timestamp'] = $tStamp;
        $data['x-signature'] = $encodedSignature;
        $data['decrypt_key'] = $cons_id . $secretKey . $tStamp;
        return $data;
    }
    public function stringDecrypt($key, $string)
    {
        $encrypt_method = 'AES-256-CBC';
        $key_hash = hex2bin(hash('sha256', $key));
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
        $output = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
        return $output;
    }
    public function response_decrypt($response, $signature)
    {
        $code = json_decode($response->body())->metadata->code;
        $message = json_decode($response->body())->metadata->message;
        if ($code == 200 || $code == 1) {
            $response = json_decode($response->body())->response ?? null;
            $decrypt = $this->stringDecrypt($signature['decrypt_key'], $response);
            $data = json_decode($decrypt);
            if ($code == 1)
                $code = 200;
            return $this->sendResponse($data, $code);
        } else {
            $response = json_decode($response);
            return json_decode(json_encode($response));
        }
    }
    public function response_no_decrypt($response)
    {
        $response = json_decode($response);
        return json_decode(json_encode($response));
    }
    // API BPJS
    public function ref_poli()
    {
        $url = $this->api()->base_url . "ref/poli";
        $signature = $this->signature();
        $response = Http::withHeaders($signature)->get($url);
        return $this->response_decrypt($response, $signature);
    }
    public function ref_dokter()
    {
        $url = $this->api()->base_url . "ref/dokter";
        $signature = $this->signature();
        $response = Http::withHeaders($signature)->get($url);
        return $this->response_decrypt($response, $signature);
    }
    public function ref_jadwal_dokter(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "kodepoli" => "required",
                "tanggal" => "required|date",
            ]);
            if ($validator->fails()) {
                return $this->sendError($validator->errors()->first(), 400);
            }
            $url = $this->api()->base_url . "jadwaldokter/kodepoli/" . $request->kodepoli . "/tanggal/" . $request->tanggal;
            $signature = $this->signature();
            $response = Http::withHeaders($signature)->get($url);
            return $this->response_decrypt($response, $signature);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage(), 500);
        }
    }
    public function ref_poli_fingerprint()
    {
        $url = $this->api()->base_url . "ref/poli/fp";
        $signature = $this->signature();
        $response = Http::withHeaders($signature)->get($url);
        return $this->response_decrypt($response, $signature);
    }
    public function update_jadwal_dokter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodepoli" =>  "required",
            "kodesubspesialis" =>  "required",
            "kodedokter" =>  "required",
            "jadwal" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),  400);
        }
        try {
            $url = $this->api()->base_url . "jadwaldokter/updatejadwaldokter";
            $signature = $this->signature();
            $response = Http::withHeaders($signature)->post(
                $url,
                $request->all()
            );
            return $this->response_decrypt($response, $signature);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage(), 500);
        }
    }
    public function ref_pasien_fingerprint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "identitas" => "required",
            "noidentitas" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),  400);
        }
        $url = $this->api()->base_url . "ref/pasien/fp/identitas/" . $request->identitas . "/noidentitas/" . $request->noidentitas;
        $signature = $this->signature();
        $response = Http::withHeaders($signature)->get($url);
        return $this->response_decrypt($response, $signature);
    }
    public function tambah_antrean(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodebooking" => "required",
            "jenispasien" =>  "required",
            "nomorkartu" =>  "required|digits:13|numeric",
            "nik" =>  "required|digits:16|numeric",
            "nohp" => "required|numeric",
            "kodepoli" =>  "required",
            "namapoli" =>  "required",
            "pasienbaru" =>  "required",
            "norm" =>  "required",
            "tanggalperiksa" =>  "required|date|date_format:Y-m-d",
            "kodedokter" =>  "required",
            "namadokter" =>  "required",
            "jampraktek" =>  "required",
            "jeniskunjungan" => "required",
            // "nomorreferensi" =>  "required",
            "nomorantrean" =>  "required",
            "angkaantrean" =>  "required",
            "estimasidilayani" =>  "required",
            "sisakuotajkn" =>  "required",
            "kuotajkn" => "required",
            "sisakuotanonjkn" => "required",
            "kuotanonjkn" => "required",
            "keterangan" =>  "required",
            "nama" =>  "required",

        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),  400);
        }
        try {
            $url =  $this->api()->base_url .  "antrean/add";
            $signature = $this->signature();
            $data =   [
                "kodebooking" => $request->kodebooking,
                "jenispasien" => $request->jenispasien,
                "nomorkartu" => $request->nomorkartu,
                "nik" => $request->nik,
                "nohp" => $request->nohp,
                "kodepoli" => $request->kodepoli,
                "namapoli" => $request->namapoli,
                "pasienbaru" => $request->pasienbaru,
                "norm" => $request->norm,
                "tanggalperiksa" => $request->tanggalperiksa,
                "kodedokter" => $request->kodedokter,
                "namadokter" => $request->namadokter,
                "jampraktek" => $request->jampraktek,
                "jeniskunjungan" => $request->jeniskunjungan,
                "nomorreferensi" => $request->nomorreferensi,
                "nomorantrean" => $request->nomorantrean,
                "angkaantrean" => $request->angkaantrean,
                "estimasidilayani" => $request->estimasidilayani,
                "sisakuotajkn" => $request->sisakuotajkn,
                "kuotajkn" => $request->kuotajkn,
                "sisakuotanonjkn" => $request->sisakuotanonjkn,
                "kuotanonjkn" => $request->kuotanonjkn,
                "keterangan" => $request->keterangan,
            ];
            $response = Http::withHeaders($signature)->post(
                $url,
                $data
            );
            return $this->response_decrypt($response, $signature);
        } catch (\Throwable $th) {
            return $this->sendError('Tidak terhubung ke jaringan ' . $th->getMessage(), 500);
        }
    }
    public function tambah_antrean_farmasi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodebooking" => "required",
            "jenisresep" =>  "required",
            "nomorantrean" =>  "required",
            "keterangan" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 400);
        }
        $url = $this->api()->base_url . "antrean/farmasi/add";
        $signature = $this->signature();
        $response = Http::withHeaders($signature)->post(
            $url,
            [
                "kodebooking" => $request->kodebooking,
                "jenisresep" => $request->jenisresep,
                "nomorantrean" => $request->nomorantrean,
                "keterangan" => $request->keterangan,
            ]
        );
        return $this->response_decrypt($response, $signature);
    }
    public function update_antrean(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodebooking" => "required",
            "taskid" =>  "required",
            "waktu" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),  400);
        }
        $url =  $this->api()->base_url .  "antrean/updatewaktu";
        $signature = $this->signature();
        $response = Http::withHeaders($signature)->post(
            $url,
            [
                "kodebooking" => $request->kodebooking,
                "taskid" => $request->taskid,
                "waktu" => $request->waktu,
                "jenisresep" => $request->jenisresep,
            ]
        );
        return $this->response_decrypt($response, $signature);
    }
    public function batal_antrean(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodebooking" => "required",
            "keterangan" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),  400);
        }
        $url =  $this->api()->base_url .  "antrean/batal";
        $signature = $this->signature();
        $response = Http::withHeaders($signature)->post(
            $url,
            [
                "kodebooking" => $request->kodebooking,
                "keterangan" => $request->keterangan,
            ]
        );
        return $this->response_decrypt($response, $signature);
    }
    public function taskid_antrean(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodebooking" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 400);
        }
        $url = $this->api()->base_url . "antrean/getlisttask";
        $signature = $this->signature();
        $response = Http::withHeaders($signature)->post(
            $url,
            [
                "kodebooking" => $request->kodebooking,
            ]
        );
        return $this->response_decrypt($response, $signature);
    }
    public function dashboard_tanggal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "tanggal" =>  "required|date|date_format:Y-m-d",
            "waktu" => "required|in:rs,server",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 400);
        }
        $url = $this->api()->base_url . "dashboard/waktutunggu/tanggal/" . $request->tanggal . "/waktu/" . $request->waktu;
        $signature = $this->signature();
        $response = Http::withHeaders($signature)->get($url);
        return $this->response_no_decrypt($response, $signature);
    }
    public function dashboard_bulan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "bulan" =>  "required|date_format:m",
            "tahun" =>  "required|date_format:Y",
            "waktu" => "required|in:rs,server",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 400);
        }
        $url = $this->api()->base_url . "dashboard/waktutunggu/bulan/" . $request->bulan . "/tahun/" . $request->tahun . "/waktu/" . $request->waktu;
        $signature = $this->signature();
        $response = Http::withHeaders($signature)->get($url);
        return $this->response_no_decrypt($response);
    }
    public function antrian_tanggal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "tanggal" =>  "required|date",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),  201);
        }
        $url = $this->api()->base_url . "antrean/pendaftaran/tanggal/" . $request->tanggal;
        $signature = $this->signature();
        $response = Http::withHeaders($signature)->get($url);
        return $this->response_decrypt($response, $signature);
    }
    public function antrian_kodebooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodebooking" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),  201);
        }
        $url = $this->api()->base_url . "antrean/pendaftaran/kodebooking/" . $request->kodebooking;
        $signature = $this->signature();
        $response = Http::withHeaders($signature)->get($url);
        return $this->response_decrypt($response, $signature);
    }
    public function antrian_belum_dilayani(Request $request)
    {
        $url = $this->api()->base_url . "antrean/pendaftaran/aktif";
        $signature = $this->signature();
        $response = Http::withHeaders($signature)->get($url);
        return $this->response_decrypt($response, $signature);
    }
    public function antrian_poliklinik(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodepoli" =>  "required",
            "kodedokter" =>  "required",
            "hari" =>  "required",
            "jampraktek" =>  "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),  201);
        }
        $url = $this->api()->base_url . "antrean/pendaftaran/kodepoli/" . $request->kodepoli . "/kodedokter/" . $request->kodedokter . "/hari/" . $request->hari . "/jampraktek/" . $request->jampraktek;
        $signature = $this->signature();
        $response = Http::withHeaders($signature)->get($url);
        return $this->response_decrypt($response, $signature);
    }
    // WS BPJS
    public function token(Request $request)
    {
        if (Auth::attempt(['username' => $request->header('x-username'), 'password' => $request->header('x-password')])) {
            $user = Auth::user();
            $data['token'] =  $user->createToken('MyApp')->plainTextToken;
            return $this->sendResponse($data, 200);
        } else {
            return $this->sendError("Unauthorized (Username dan Password Salah)",  201);
        }
    }
    public function status_antrian(Request $request)
    {
        // validator
        $validator = Validator::make($request->all(), [
            "kodepoli" => "required",
            "kodedokter" => "required",
            "tanggalperiksa" => "required|date|date_format:Y-m-d",
            "jampraktek" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 201);
        }
        // check tanggal backdate
        $request['tanggal'] = $request->tanggalperiksa;
        if (Carbon::parse($request->tanggalperiksa)->endOfDay()->isPast()) {
            return $this->sendError("Tanggal periksa tidak berlaku", 201);
        }
        // get jadwal poliklinik dari simrs
        $jadwal = JadwalDokter::where("hari",  Carbon::parse($request->tanggalperiksa)->dayOfWeek)
            ->where("kodepoli", $request->kodepoli)
            ->where('kodedokter', $request->kodedokter)
            ->where("jampraktek", $request->jampraktek)
            ->first();
        // tidak ada jadwal
        if (!isset($jadwal)) {
            return $this->sendError("Jadwal dokter poliklinik tidak ditemukan", 201);
        }
        if ($jadwal->libur == 1) {
            return $this->sendError("Jadwal Dokter dihari tersebut sedang diliburkan.",  201);
        }
        if ($jadwal) {
            $jamPraktek = $jadwal->jampraktek; // Jadwal praktek poliklinik
            $tanggalPeriksa = $request->tanggalperiksa; // Tanggal periksa yang diminta
            list($jamMulai, $jamSelesai) = explode("-", $jamPraktek);
            $jamMulaiTimestamp = strtotime($tanggalPeriksa . " " . $jamMulai);
            $jamSelesaiTimestamp = strtotime($tanggalPeriksa . " " . $jamSelesai);
            $currentTimestamp = time();
            if ($currentTimestamp > $jamSelesaiTimestamp && Carbon::parse($tanggalPeriksa)->isToday()) {
                return $this->sendError("Pendaftaran jadwal Poliklinik " . $jadwal->namapoli    . " " . $jadwal->namadokter . " telah tutup jam " . $jamSelesai,  201);
            }
        }
        // get hitungan antrian
        $antrians = Antrian::where('tanggalperiksa', $request->tanggalperiksa)
            ->where('kodepoli', $request->kodepoli)
            ->where('kodedokter', $request->kodedokter)
            ->where('jampraktek', $request->jampraktek)
            ->where('taskid', '!=', 99)
            ->count();
        // cek kapasitas pasien
        if ($antrians >= $jadwal->kapasitas) {
            return $this->sendError("Kuota Dokter Telah Penuh",  201);
        }
        //  get nomor antrian
        $antreanpanggil =  Antrian::where('kodepoli', $request->kodepoli)
            ->where('tanggalperiksa', $request->tanggalperiksa)
            ->where('taskid', 4)
            ->first();
        // get jumlah antrian jkn dan non-jkn
        $antrianjkn = Antrian::where('kodepoli', $request->kodepoli)
            ->where('tanggalperiksa', $request->tanggalperiksa)
            ->where('taskid', '!=', 99)
            ->where('kodedokter', $request->kodedokter)
            ->where('jenispasien', "JKN")->count();
        $antriannonjkn = Antrian::where('kodepoli', $request->kodepoli)
            ->where('tanggalperiksa', $request->tanggalperiksa)
            ->where('tanggalperiksa', $request->tanggalperiksa)
            ->where('kodedokter', $request->kodedokter)
            ->where('taskid', '!=', 99)
            ->where('jenispasien', "NON-JKN")->count();
        $response = [
            "namapoli" => $jadwal->namapoli,
            "namadokter" => $jadwal->namadokter,
            "totalantrean" => $antrians,
            "sisaantrean" => $jadwal->kapasitas - $antrians,
            "antreanpanggil" => $antreanpanggil->nomorantrean ?? 0,
            "sisakuotajkn" => round($jadwal->kapasitas * 80 / 100) -  $antrianjkn,
            "kuotajkn" => round($jadwal->kapasitas * 80 / 100),
            "sisakuotanonjkn" => round($jadwal->kapasitas * 20 / 100) - $antriannonjkn,
            "kuotanonjkn" =>  round($jadwal->kapasitas * 20 / 100),
            "keterangan" => "Informasi antrian poliklinik",
            "jadwal_id" => $jadwal->id,
        ];
        return $this->sendResponse($response, 200);
    }
    public function ambil_antrian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nomorkartu" => "required|numeric|digits:13",
            "nik" => "required|numeric|digits:16",
            "nohp" => "required",
            "kodepoli" => "required",
            // "norm" => "required",
            "tanggalperiksa" => "required",
            "kodedokter" => "required",
            "jampraktek" => "required",
            "jeniskunjungan" => "required|numeric",
            // "nomorreferensi" => "numeric",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 400);
        }
        // check tanggal backdate
        if (Carbon::parse($request->tanggalperiksa)->endOfDay()->isPast()) {
            return $this->sendError("Tanggal periksa sudah terlewat", 400);
        }
        // cek pasien baru
        $pasien = Pasien::where('nomorkartu',  $request->nomorkartu)->first();
        if (empty($pasien)) {
            return $this->sendError("Data pasien ini tidak ditemukan. Silahkan melakukan registrasi pasien baru",  202);
        }
        // cek no kartu sesuai tidak
        if ($pasien->nik != $request->nik) {
            return $this->sendError("NIK anda yang terdaftar di BPJS dengan berbeda. Silahkan perbaiki melalui pendaftaran offline",  201);
        }
        $statusantrian = $this->status_antrian($request);
        if ($statusantrian->metadata->code == 200) {
            $request['sisakuotajkn']  = $statusantrian->response->sisakuotajkn;
            $request['kuotajkn']  = $statusantrian->response->kuotajkn;
            $request['sisakuotanonjkn']  = $statusantrian->response->sisakuotanonjkn;
            $request['kuotanonjkn']  = $statusantrian->response->kuotanonjkn;
            $request['namapoli']  = $statusantrian->response->namapoli;
            $request['namadokter']  = $statusantrian->response->namadokter;
            $request['jadwal_id']  = $statusantrian->response->jadwal_id;
        } else {
            return $this->sendError($statusantrian->metadata->message, 400);
        }
        $request['kodebooking'] = strtoupper(uniqid());
        $antiranhari = Antrian::where('tanggalperiksa', $request->tanggalperiksa)
            ->where('jadwal_id', $request->jadwal_id)
            ->count();
        $request['nomorantrean'] = 'A' . $antiranhari + 1;
        $request['angkaantrean'] =  $antiranhari + 1;
        $timestamp = $request->tanggalperiksa . ' ' . explode('-', $request->jampraktek)[0] . ':00';
        $jadwal_estimasi = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'Asia/Jakarta')->addMinutes(5 * ($antiranhari + 1));
        $request['estimasidilayani'] = $jadwal_estimasi->timestamp * 1000;
        $request['jenispasien'] =  $request->nomorreferensi  ? "JKN" : "NON-JKN";
        $request['keterangan'] = 'Silahkan datang 1 jam sebelum jadwal dokter untuk checkin fingerprint atau face-recognition. Terimkasih.';
        $request['pasienbaru'] =  $pasien ? 0 : 1;
        $request['nama'] =  $pasien ? $pasien->nama : 'Pasien Baru';
        $request['norm'] = $pasien->norm;
        $request['method'] =  $request->method ??  'Mobile JKN';
        // cek duplikasi nik antrian
        $antrian_sama = Antrian::where('tanggalperiksa', $request->tanggalperiksa)
            ->where('nik', $request->nik)
            ->where('nomorkartu', $request->nomorkartu)
            ->where('nomorreferensi', $request->nomorreferensi)
            ->where('kodedokter', $request->kodedokter)
            ->where('kodepoli', $request->kodepoli)
            ->where('taskid', '<=', 5)
            ->first();
        if ($antrian_sama) {
            $data = [
                'nomorantrean' => $antrian_sama->nomorantrean,
                'angkaantrean' => $antrian_sama->angkaantrean,
                'kodebooking' => $antrian_sama->kodebooking,
                'norm' => $antrian_sama->norm,
                'namapoli' => $antrian_sama->namapoli,
                'namadokter' => $antrian_sama->namadokter,
                'estimasidilayani' => $antrian_sama->estimasidilayani,
                'sisakuotajkn' => $request->sisakuotajkn,
                'kuotajkn' => $request->kuotajkn,
                'sisakuotanonjkn' => $request->sisakuotanonjkn,
                'kuotanonjkn' => $request->kuotanonjkn,
                'keterangan' => $antrian_sama->keterangan,
                'taskid' => $antrian_sama->taskid,
            ];
            return $this->sendResponse($data, 200);
        }
        // cek duplikasi nik antrian
        $antrian_nik = Antrian::where('tanggalperiksa', $request->tanggalperiksa)
            ->where('nik', $request->nik)
            ->where('taskid', '<=', 5)
            ->first();
        if ($antrian_nik) {
            return $this->sendError("Terdapat Antrian (" . $antrian_nik->kodebooking . ") dengan nomor NIK yang sama pada tanggal tersebut yang belum selesai. Silahkan batalkan terlebih dahulu jika ingin mendaftarkan lagi.",  409);
        }
        $res = $this->tambah_antrean($request);
        if ($res->metadata->code == 200) {
            $request['status'] = 1;
            $antrian = Antrian::create($request->all());
            $data = [
                'nomorantrean' => $request->nomorantrean,
                'angkaantrean' => $request->angkaantrean,
                'kodebooking' => $request->kodebooking,
                'norm' => $request->norm,
                'namapoli' => $request->namapoli,
                'namadokter' => $request->namadokter,
                'estimasidilayani' => $request->estimasidilayani,
                'sisakuotajkn' => $request->sisakuotajkn,
                'kuotajkn' => $request->kuotajkn,
                'sisakuotanonjkn' => $request->sisakuotanonjkn,
                'kuotanonjkn' => $request->kuotanonjkn,
                'keterangan' => $request->keterangan,
            ];
            try {
                $wa = new WhatsappController();
                $request['number'] = $antrian->nohp;
                $request['message'] = "Antrian berhasil melalui *" . $antrian->method . "*\nNama : *" . $antrian->nama . "* \nKodebooking : " . $antrian->kodebooking . "\nNomor : " . $antrian->nomorantrean . "\nTanggal : " . $antrian->tanggalperiksa . "\nDokter : " . $antrian->namadokter . "\nJam Praktek : " . $antrian->jampraktek;
                $wa->send_message($request);
                $request['number'] = "120363344588087064@g.us";
                $request['message'] = "Antrian berhasil melalui *" . $antrian->method . "*\nNama : *" . $antrian->nama . "* \nKodebooking : " . $antrian->kodebooking . "\nNomor : " . $antrian->nomorantrean . "\nTanggal : " . $antrian->tanggalperiksa . "\nDokter : " . $antrian->namadokter . "\nJam Praktek : " . $antrian->jampraktek;
                $wa->send_message_group($request);
            } catch (\Throwable $th) {
                //throw $th;
            }
            if ($request->method == "Mobile JKN") {
                return $this->sendAntrian($data, "Berhasil daftar antrian");
            }
            return $this->sendResponse($data, 200);
        } else {
            return $this->sendError($res->metadata->message, 400);
        }
    }
    public function sisa_antrian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodebooking" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 400);
        }
        $antrian = Antrian::where('kodebooking', $request->kodebooking)->first();
        if (!$antrian) {
            return $this->sendError("Kodebooking antrian tidak ditemukan", 201);
        }
        $sisaantrian = Antrian::where('tanggalperiksa', $antrian->tanggalperiksa)->where('taskid', "<=", 3)->count();
        $antreanpanggil = Antrian::where('tanggalperiksa', $antrian->tanggalperiksa)->where('taskid', 4)->first()->nomorantrean ?? '-';
        $waktutunggu = 300 +  300 * ($sisaantrian - 1);
        $data = [
            'nomorantrean' => $antrian->nomorantrean,
            'namapoli' => $antrian->namapoli,
            'namadokter' => $antrian->namadokter,
            'sisaantrean' => $sisaantrian,
            'antreanpanggil' => $antreanpanggil,
            'waktutunggu' => $waktutunggu,
            'keterangan' => $antrian->keterangan,
        ];
        return $this->sendResponse($data, 200);
    }
    public function batal_antrian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodebooking" => "required",
            "keterangan" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 400);
        }
        $antrian = Antrian::firstWhere('kodebooking', $request->kodebooking);
        if (isset($antrian)) {
            if ($antrian->taskid == 99) {
                return $this->sendError('Antrian sudah dibatalkan sebelumnya', 201);
            }
            if ($antrian->taskid >= 5) {
                return $this->sendError('Pasien sudah dilayani, antrian tidak bisa dibatalkan', 201);
            }
            $response = $this->batal_antrean($request);
            if ($response->metadata->code = 200) {
                $antrian->update([
                    "taskid" => 99,
                    "keterangan" => $request->keterangan,
                ]);
                try {
                    $wa = new WhatsappController();
                    $request['number'] = $antrian->nohp;
                    $request['message'] = "Antrian atas nama pasien " . $antrian->nama . " dengan kode booking " . $antrian->kodebooking . " telah dibatalkan dengan keterangan " . $request->keterangan . ". Terimakasih.";
                    $wa->send_message($request);
                    $request['number'] = "120363344588087064@g.us";
                    $wa->send_message_group($request);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            return $this->sendError($response->metadata->message, 200);
        } else {
            return $this->sendError('Antrian tidak ditemukan',  201);
        }
    }
    public $asalRujukan;
    public $noRujukan;
    public $tglRujukan;
    public $ppkRujukan;
    public $noSurat;
    public $tujuan;
    public $dpjpLayan;
    public $diagAwal;
    public $tujuanKunj;
    public $flagProcedure;
    public $kdPenunjang;
    public $assesmentPel;
    public function checkin_antrian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodebooking" => "required",
            "waktu" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),  201);
        }
        $antrian =  Antrian::firstWhere('kodebooking', $request->kodebooking);
        $now = now();
        if ($antrian) {
            // crate sep
            $api = new VclaimController();
            if ($antrian->jeniskunjungan == 3) {
                $this->tujuanKunj = "2";
                $this->flagProcedure = "";
                $this->kdPenunjang = "";
                $this->assesmentPel = "2";
                $request = new Request([
                    "noSuratKontrol" => $antrian->nomorreferensi,
                ]);
                $res = $api->suratkontrol_nomor($request);
                if ($res->metadata->code == 200) {
                    $this->diagAwal =  explode(' - ', $res->response->sep->diagnosa)[0];
                    $rujukan = $res->response->sep->provPerujuk;
                    $this->asalRujukan = $rujukan->asalRujukan;
                    $this->noRujukan = $rujukan->noRujukan;
                    $this->tglRujukan = $rujukan->tglRujukan;
                    $this->ppkRujukan = $rujukan->kdProviderPerujuk;
                } else {
                    return $this->sendError($res->metadata->message, 400);
                }
                $this->noSurat = $antrian->nomorreferensi;
            } else {
                $this->noRujukan = $antrian->nomorreferensi;
                $request = new Request([
                    "nomorrujukan" => $this->noRujukan,
                ]);
                if ($antrian->jeniskunjungan == 1) {
                    $res = $api->rujukan_nomor($request);
                    $this->asalRujukan = 1;
                } else {
                    $res = $api->rujukan_rs_nomor($request);
                    $this->asalRujukan = 2;
                }
                if ($res->metadata->code == 200) {
                    $rujukan = $res->response->rujukan;
                    $this->asalRujukan = $this->asalRujukan;
                    $this->noRujukan = $rujukan->noKunjungan;
                    $this->tglRujukan = $rujukan->tglKunjungan;
                    $this->ppkRujukan = $rujukan->provPerujuk->kode;
                } else {
                    return $this->sendError($res->metadata->message, 400);
                }
                $this->tujuanKunj = "0";
                $this->flagProcedure = "";
                $this->kdPenunjang = "";
                $this->assesmentPel = "";
                $this->diagAwal =  $res->response->rujukan->diagnosa->kode;
            }
            $this->tujuan = $antrian->kodepoli;
            $this->dpjpLayan = $antrian->kodedokter;
            $request = new Request([
                "noKartu" => $antrian->nomorkartu,
                "tglSep" => $antrian->tanggalperiksa,
                "nama" => $antrian->nama,
                "noMR" => $antrian->norm,
                "noTelp" => $antrian->nohp,
                'noRujukan' => $this->noRujukan,
                'asalRujukan' => $this->asalRujukan,
                'tglRujukan' => $this->tglRujukan,
                'ppkRujukan' => $this->ppkRujukan,
                'noSurat' => $this->noSurat,
                "jnsPelayanan" => 2,
                "tujuan" => $this->tujuan,
                "dpjpLayan" => $this->dpjpLayan,
                "diagAwal" => $this->diagAwal,
                "catatan" => 'SEP Anjungan Pelayanan Mandiri',
                "tujuanKunj" => $this->tujuanKunj,
                "flagProcedure" => $this->flagProcedure,
                "kdPenunjang" => $this->kdPenunjang,
                "assesmentPel" => $this->assesmentPel,
                "eksekutif" =>  0,
                "ppkPelayanan" => "0125S007",
                "klsRawatHak" => "3",
                "user" => 'Briding Antrian',
            ]);
            $res = $api->sep_insert($request);
            if ($res->metadata->code != 200) {
                return $this->sendError($res->metadata->message, 400);
            }
            $antrian->sep = $res->response->sep->noSep ?? null;
            $antrian->sep = $antrian->sep;
            // crate kunjungan
            $counter = Kunjungan::where('norm', $antrian->norm)->first()?->counter ?? 1;
            $kunjungan = new Kunjungan();
            $kunjungan->kode = $antrian->kodebooking;
            $kunjungan->counter = $counter;
            $kunjungan->tgl_masuk = now();
            $kunjungan->jaminan = "00003";
            $kunjungan->nomorkartu = $antrian->nomorkartu;
            $kunjungan->norm = $antrian->norm;
            $kunjungan->nama = $antrian->nama;
            $kunjungan->tgl_lahir = $antrian->tgl_lahir ?? "1998-05-09";
            $kunjungan->gender = $antrian->gender ?? "P";
            $kunjungan->kelas = $antrian->hakkelas ?? "3";
            $kunjungan->penjamin = $antrian->jenispeserta ?? "000001";
            $kunjungan->unit = $antrian->kodesubspesialis ?? "INT";
            $kunjungan->dokter = $antrian->kodedokter;
            $kunjungan->jeniskunjungan = $antrian->jeniskunjungan;
            $kunjungan->nomorreferensi = $antrian->nomorreferensi;
            $kunjungan->sep = $antrian->sep;
            $kunjungan->diagnosa_awal = $antrian->diagAwal;
            $kunjungan->cara_masuk = "gnp";
            $kunjungan->status = 1;
            $kunjungan->user1 = 1;
            $kunjungan->save();
            // update antrian
            $antrian->kunjungan_id = $kunjungan->id;
            $antrian->kodekunjungan = $kunjungan->kode;
            $antrian->save();
            if ($antrian->taskid <= 1) {
                if (env('ANTRIAN_REALTIME')) {
                    $request['kodebooking'] = $antrian->kodebooking;
                    $request['taskid'] = 3;
                    $request['waktu'] = $now;
                    $res = $this->update_antrean($request);
                    if ($res->metadata->code != 200) {
                        return $this->sendError($res->metadata->message, 201);
                    }
                }
                $antrian->update([
                    'taskid' => 3,
                    'taskid1' => $now,
                    'user1' => 'Mobile JKN',
                    'keterangan' => 'Telah checkin pada ' . $now . ' Silahkan lakukan proses selanjutnya',
                ]);
                return $this->sendError("Ok", 200);
            } else {
                return $this->sendError("Pasien sudah mendapatkan pelayanan", 405);
            }
        } else {
            return $this->sendError("Kodebooking tidak ditemukan.", 404);
        }
    }
    public function info_pasien_baru(Request $request)
    {
        // return $this->sendError("Anda belum memiliki No RM (Pasien Baru). Silahkan daftar secara langsung ditempat.", 400);
        $validator = Validator::make($request->all(), [
            'nomorkartu' => 'required|numeric|digits:13',
            'nik' => 'required|numeric|digits:16',
            'nomorkk' => 'required|numeric',
            'nama' => 'required',
            'jeniskelamin' => 'required',
            'tanggallahir' => 'required|date|date_format:Y-m-d|before_or_equal:today',
            'nohp' => 'required',
            'alamat' => 'required',
            'kodeprop' => 'required',
            'namaprop' => 'required',
            'kodedati2' => 'required',
            'namadati2' => 'required',
            'kodekec' => 'required',
            'namakec' => 'required',
            'kodekel' => 'required',
            'namakel' => 'required',
            'rw' => 'required',
            'rt' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),  201);
        }
        $pasienlama = Pasien::where('nik', $request->nik)->first();
        if (!$pasienlama) {
            $pasien = new Pasien();
            $pasiensebelumnya  = Pasien::latest()->first()?->norm;
            if ($pasiensebelumnya) {
                $norm = sprintf("%06d", $pasiensebelumnya + 1);
            } else {
                $norm = "000001";
            }
            $pasien->norm = $norm;
            $pasien->nomorkartu = $request->nomorkartu;
            $pasien->nik = $request->nik;
            $pasien->nama = $request->nama;
            $pasien->nohp = $request->nohp;
            $pasien->gender = $request->jeniskelamin;
            $pasien->tgl_lahir = $request->tanggallahir;
            $pasien->alamat = $request->alamat;
            $pasien->desa_id = $request->namakel;
            $pasien->kecamatan_id = $request->namakec;
            $pasien->kabupaten_id = $request->namadati2;
            $pasien->provinsi_id = $request->namaprop;
            $pasien->status = 1;
            $pasien->user = 1;
            $pasien->pic = 'Mobile JKN';
            $pasien->updated_at = now();
            $pasien->save();
            $data = [
                'norm' => $norm,
            ];
            return $this->sendResponse($data, 200);
        } else {
            return $this->sendError("Data Peserta Sudah Pernah Dientrikan", 201);
        }
    }
    public function ambil_antrian_farmasi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodebooking" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 400);
        }
        $antrian = Antrian::firstWhere('kodebooking', $request->kodebooking);
        if (empty($antrian)) {
            return $this->sendError("Kode booking tidak ditemukan",  201);
        }
        $request['nomorantrean'] = $antrian->angkaantrean;
        $request['keterangan'] = "resep sistem antrian";
        $request['jenisresep'] = "Racikan/Non Racikan";
        $res = $this->tambah_antrean_farmasi($request);
        $responses = [
            "jenisresep" => $request->jenisresep,
            "nomorantrean" => $request->nomorantrean,
            "keterangan" => $request->keterangan,
        ];
        return $res;
    }
    public function status_antrian_farmasi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodebooking" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 400);
        }
        $antrian = Antrian::firstWhere('kodebooking', $request->kodebooking);
        if (empty($antrian)) {
            return $this->sendError("Kode booking tidak ditemukan",  201);
        }
        $totalantrean = Antrian::whereDate('tanggalperiksa', $antrian->tanggalperiksa)
            ->where('taskid', '!=', 99)
            ->count();
        $antreanpanggil = Antrian::whereDate('tanggalperiksa', $antrian->tanggalperiksa)
            ->whereIn('taskid', [4, 6])
            ->first();
        $antreansudah = Antrian::whereDate('tanggalperiksa', $antrian->tanggalperiksa)
            ->count();
        $request['totalantrean'] = $totalantrean ?? 0;
        $request['sisaantrean'] = $totalantrean - $antreansudah ?? 0;
        $request['antreanpanggil'] = $antreanpanggil->angkaantrean ?? 0;
        $request['keterangan'] = $antrian->keterangan;
        $request['jenisresep'] = "Racikan/Non Racikan";
        $responses = [
            "jenisresep" => $request->jenisresep,
            "totalantrean" => $request->totalantrean,
            "sisaantrean" => $request->sisaantrean,
            "antreanpanggil" => $request->antreanpanggil,
            "keterangan" => $request->keterangan,
        ];
        return $this->sendResponse($responses, 200);
    }
}
