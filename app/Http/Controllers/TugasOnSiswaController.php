<?php

namespace App\Http\Controllers;

use App\Models\Examp;
use App\Models\Ruangan;
use App\Models\Submit_examp;
use App\Models\User;
use Illuminate\Http\Request;

class TugasOnSiswaController extends Controller
{
    public function index()
    {
        // Retrieve the authenticated user's class
        $kelasSiswa = User::where('name', auth()->user()->name)->value('kelas');

        if (!$kelasSiswa) {
            return redirect()->back()->with('error', 'Class not found for the user.');
        }

        // Fetch ruangan IDs where the class matches the user's class
        $ruanganIds = Ruangan::where('kelas', 'LIKE', "%{$kelasSiswa}%")->pluck('id');

        // Fetch all exams related to those ruangan IDs with their related Ruangan (mapel)
        $data = Examp::whereIn('id_tugas', $ruanganIds)
            ->with('tugas') // Eager load the 'ruangan' relationship
            ->get();

        // Retrieve the authenticated user's details
        $examps = User::select('name', 'id')->where('name', auth()->user()->name)->first();

        return view('siswa.tugas.main', compact('data', 'examps'));
    }
    public function store(Request $request)
    {

        $this->validate($request, [
            'id_siswa' => 'required',
            'id_tugas' => 'required',
            'file' => 'required|max:2048|mimes:pdf',
        ]);

        // Initialize filename variable
        $fileName = null;

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Move the file to the 'files/materi/' directory
            $file->move(public_path('files/submit_tugas/'), $fileName);

            // Note: Do not store the full path in the database, only the filename
        }
        Submit_examp::create([
            'id_siswa' => $request->id_siswa,
            'id_tugas' => $request->id_tugas,
            'file' => $fileName,
            'tanggal' => now(),
        ]);
        return redirect()->route('tugas')->with('success', 'Tugas berhasil Diserahkan');
    }

}