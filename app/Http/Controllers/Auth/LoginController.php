<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ], [
            'captcha.required' => 'Harap masukkan kode CAPTCHA.',
            'captcha.captcha' => 'Kode CAPTCHA tidak valid atau salah.',
        ]);
        $ip = $request->ip();
        $agent = new Agent();
        $agent->setUserAgent($request->header('User-Agent'));
        $browser = $agent->browser();
        $browser_version = $agent->version($browser);
        $platform = $agent->platform();
        $platform_version = $agent->version($platform);
        $device = $agent->device();
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user = User::where('username', $request->email)
            ->orWhere('email', $request->email)->first();
        if ($user) {
        } else {
            // Log aktivitas login gagal karena user tidak ditemukan
            ActivityLog::create([
                'user_id' => '0',
                'activity' => 'Login User Salah',
                'description' => 'Username/Email Tidak Ditemukan (' . $request->email . ')',
                'ip_address' => $ip,
                'user_agent' => $request->header('User-Agent'),
                'device' => $device,
                'browser' => $browser . ' ' . $browser_version,
                'platform' => $platform . ' ' . $platform_version,
            ]);
            return redirect()->route('login')->withErrors('Username / Email Tidak Ditemukan');
        }
        if (auth()->attempt([$fieldType => $input['email'], 'password' => $input['password']])) {
            // Log aktivitas login berhasil
            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'activity' => 'Login Berhasil',
                'description' => auth()->user()->name . ' login pada waktu ' . now(),
                'ip_address' => $ip,
                'user_agent' => $request->header('User-Agent'),
                'device' => $device,
                'browser' => $browser . ' ' . $browser_version,
                'platform' => $platform . ' ' . $platform_version,
            ]);
            return redirect()->route('home');
        } else {
            // Log aktivitas login gagal karena password salah
            ActivityLog::create([
                'user_id' => '0',
                'activity' => 'Login Password Salah',
                'description' => 'Username/Email & Password Salah (' . $request->email . ')',
                'ip_address' => $ip,
                'user_agent' => $request->header('User-Agent'),
                'device' => $device,
                'browser' => $browser . ' ' . $browser_version,
                'platform' => $platform . ' ' . $platform_version,
            ]);
            return redirect()->route('login')->withErrors('Username / Email dan Password Salah');
        }
    }
}
