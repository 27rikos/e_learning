<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Ruangan;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Ruangan::all();
        return view('admin.ruangan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahun = TahunAjaran::select('tahun')->get();
        $guru = User::select('name')->where('role', 'guru')->get();
        $mapel = Mapel::select('mapel')->get();
        $kelas = Kelas::select('kelas')->get();
        return view('admin.ruangan.create', compact('tahun', 'guru', 'mapel', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'tahun' => 'required',
            'guru' => 'required',
            'mapel' => 'required',
            'kelas' => 'required|array|min:1',
        ]);

        // Create a new Ruangan instance and save the data
        $ruangan = new Ruangan();
        $ruangan->tahun = $request->tahun;
        $ruangan->guru = $request->guru;
        $ruangan->mapel = $request->mapel;
        $ruangan->kelas = implode(', ', $request->kelas); // Convert the array of kelas to a string
        $ruangan->save();

        // Redirect back with a success message
        return redirect()->route('room.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function show(Ruangan $ruangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Ruangan::findOrFail($id);
        $tahun = TahunAjaran::select('tahun')->get();
        $guru = User::select('name')->where('role', 'guru')->get();
        $mapel = Mapel::select('mapel')->get();
        $kelas = Kelas::select('kelas')->get();
        return view('admin.ruangan.edit', compact('tahun', 'guru', 'mapel', 'kelas', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'tahun' => 'required|string',
            'guru' => 'required|string',
            'mapel' => 'required|string',
            'kelas' => 'required|array', // Ensure 'kelas' is an array
            'kelas.*' => 'string', // Each item in 'kelas' array should be a string
        ]);

        // Find the record by ID
        $ruangan = Ruangan::findOrFail($id);

        // Update the record with the new data
        $ruangan->tahun = $request->input('tahun');
        $ruangan->guru = $request->input('guru');
        $ruangan->mapel = $request->input('mapel');
        $ruangan->kelas = implode(', ', $request->input('kelas')); // Convert array to comma-separated string

        // Save the changes
        $ruangan->save();

        // Redirect or return response
        return redirect()->route('room.index')->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruangan $ruangan)
    {
        //
    }
}