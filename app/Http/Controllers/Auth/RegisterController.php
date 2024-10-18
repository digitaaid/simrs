<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Tambahkan metode register untuk menangkap Request
    public function register(Request $request)
    {
        // Validasi input
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            // Ambil informasi IP dan User-Agent
            $ip = $request->ip();
            $agent = new Agent();
            $agent->setUserAgent($request->header('User-Agent'));

            $browser = $agent->browser();
            $browser_version = $agent->version($browser);
            $platform = $agent->platform();
            $platform_version = $agent->version($platform);
            $device = $agent->device();

            // Catat log aktivitas registrasi gagal
            ActivityLog::create([
                'user_id' => '0',
                'activity' => 'Register Gagal',
                'description' => 'Registrasi gagal untuk email: ' . $request->email,
                'ip_address' => $ip,
                'user_agent' => $request->header('User-Agent'),
                'device' => $device,
                'browser' => $browser . ' ' . $browser_version,
                'platform' => $platform . ' ' . $platform_version,
            ]);

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Buat pengguna baru
        $user = $this->create($request->all());

        // Ambil informasi IP dan User-Agent
        $ip = $request->ip();
        $agent = new Agent();
        $agent->setUserAgent($request->header('User-Agent'));

        $browser = $agent->browser();
        $browser_version = $agent->version($browser);
        $platform = $agent->platform();
        $platform_version = $agent->version($platform);
        $device = $agent->device();

        // Log aktivitas registrasi berhasil
        ActivityLog::create([
            'user_id' => $user->id,
            'activity' => 'Register Berhasil',
            'description' => 'User register (' . $user->name . ', ' . $user->phone . ', ' . $user->email . ')',
            'ip_address' => $ip,
            'user_agent' => $request->header('User-Agent'),
            'device' => $device,
            'browser' => $browser . ' ' . $browser_version,
            'platform' => $platform . ' ' . $platform_version,
        ]);

        // Login pengguna setelah registrasi (opsional)
        $this->guard()->login($user);

        // Redirect ke halaman yang ditentukan
        return redirect($this->redirectPath());
    }

    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'alpha_dash', 'max:16', 'min:3', 'unique:users'],
                'phone' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'captcha' => ['required', 'captcha'],
            ],
            [
                'captcha.required' => 'Harap masukkan kode CAPTCHA.',
                'captcha.captcha' => 'Kode CAPTCHA tidak valid atau salah.',
            ]
        );
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
