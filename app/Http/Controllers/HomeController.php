<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $guru = User::where('role', 'guru')->count(); // Menghitung jumlah pengguna dengan peran 'guru'
        $siswa = User::where('role', 'siswa')->count(); // Menghitung jumlah pengguna dengan peran 'siswa'
        $kelas = Kelas::count(); // Menghitung jumlah kelas

        return view('siswa.dashboard.index', compact('guru', 'siswa', 'kelas')); // Menyertakan 'kelas' ke dalam compact
    }

    public function admin()
    {
        $guru = User::where('role', 'guru')->count(); // Menghitung jumlah pengguna dengan peran 'guru'
        $siswa = User::where('role', 'siswa')->count(); // Menghitung jumlah pengguna dengan peran 'siswa'
        $kelas = Kelas::count(); // Menghitung jumlah kelas

        return view('admin.dashboard.index', compact('guru', 'siswa', 'kelas'));
    }
    public function guru()
    {
        $guru = User::where('role', 'guru')->count(); // Menghitung jumlah pengguna dengan peran 'guru'
        $siswa = User::where('role', 'siswa')->count(); // Menghitung jumlah pengguna dengan peran 'siswa'
        $kelas = Kelas::count();
        return view('guru.dashboard.index', compact('guru', 'siswa', 'kelas'));
    }
}