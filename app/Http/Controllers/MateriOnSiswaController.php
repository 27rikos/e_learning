<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Ruangan;
use App\Models\User;

class MateriOnSiswaController extends Controller
{
    public function index()
    {
        // Retrieve the authenticated user's class
        $kelasSiswa = User::where('name', auth()->user()->name)->value('kelas');

        if (!$kelasSiswa) {
            return redirect()->back()->with('error', 'Class not found for the user.');
        }

        // Fetch all subjects that match the user's class using a database query
        $mapels = Ruangan::where('kelas', 'LIKE', "%{$kelasSiswa}%")->get();

        // Pass the filtered subjects to a view
        return view('siswa.materi.index', compact('mapels'));
    }
    public function show($id)
    {
        $data = Materi::where('id_materi', $id)->get();
        $room = Ruangan::select('id', 'mapel')->where('id', $id)->first();
        return view('siswa.materi.main', compact('room', 'data'));
    }

}
