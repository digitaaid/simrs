<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
        ]);
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user = User::where('username', $request->email)
            ->orWhere('email', $request->email)->first();
        if (isset($user)) {
            // if (empty($user->email_verified_at)) {
            //     return redirect()->route('login')->withErrors('Mohon maaf, akun anda belum diverifikasi');
            // }
        } else {
            ActivityLog::create([
                'user_id' => '0',
                'activity' => 'Login',
                'description' => 'Username/Email Tidak Ditemukan (' . $request->email . ')',
            ]);
            return redirect()->route('login')->withErrors('Username / Email Tidak Ditemukan');
        }
        if (auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password']))) {
            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'activity' => 'Login',
                'description' => auth()->user()->name . ' login pada waktu ' . now(),
            ]);
            return redirect()->route('home');
        } else {
            ActivityLog::create([
                'user_id' => '0',
                'activity' => 'Login',
                'description' => 'Username/Email & Password Salah (' . $request->email . ', ' . $request->password . ')',
            ]);
            return redirect()->route('login')->withErrors('Username / Email dan Password Salah');
        }
    }
}
