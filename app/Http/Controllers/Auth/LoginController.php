<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    public function login(Request $request)
    {

        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']])) {
            $role = auth()->user()->role;

            $request->session()->regenerate();

            switch ($role) {
                case 'admin':
                    return redirect('/dashboard');
                case 'guru':
                    return redirect('/dashboard-guru');
                case 'siswa':
                    return redirect('/home');
                default:
                    auth()->logout();
                    return redirect()->route('login')->with('toast_info', 'Invalid role.');
            }
        } else {
            return redirect()->route('login')->with('toast_info', 'Login Gagal/Silahkan daftar jika belum memiliki akun');
        }

    }
}
