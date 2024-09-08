<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MateriController extends Controller
{
    public function index()
    {
        $data = Ruangan::where('guru', auth()->user()->name)->get();
        return view('guru.materi.index', compact('data'));
    }
    public function show($id)
    {
        $data = Materi::where('id_materi', $id)->get();
        $room = Ruangan::select('id', 'mapel')->where('id', $id)->first();
        return view('guru.materi.main', compact('room', 'data'));
    }

    public function create($id)
    {
        $room = Ruangan::select('id', 'mapel')->where('id', $id)->first();
        return view('guru.materi.create', compact('room'));
    }
    public function store(Request $request, $id)
    {
        // Validasi data form
        $this->validate($request, [
            'materi.*' => 'required|string',
            'pertanyaan.*' => 'required|string',
            'pilihan_a.*' => 'required|string',
            'pilihan_b.*' => 'required|string',
            'pilihan_c.*' => 'required|string',
            'pilihan_d.*' => 'required|string',
            'pilihan_e.*' => 'nullable|string',
            'kunci_jawaban.*' => 'required|string',
        ]);

        // Iterasi untuk menyimpan materi dan kuis
        $materiData = $request->only([
            'materi',
            'pertanyaan',
            'pilihan_a',
            'pilihan_b',
            'pilihan_c',
            'pilihan_d',
            'pilihan_e',
            'kunci_jawaban',
        ]);

        $materiCount = count($materiData['materi']);

        for ($i = 0; $i < $materiCount; $i++) {
            DB::table('materis')->insert([
                'id_materi' => $id, // Pastikan ini adalah ID yang sesuai
                'materi' => $materiData['materi'][$i],
                'pertanyaan' => $materiData['pertanyaan'][$i],
                'pilihan_a' => $materiData['pilihan_a'][$i],
                'pilihan_b' => $materiData['pilihan_b'][$i],
                'pilihan_c' => $materiData['pilihan_c'][$i],
                'pilihan_d' => $materiData['pilihan_d'][$i],
                'pilihan_e' => $materiData['pilihan_e'][$i] ?? null, // Optional
                'kunci_jawaban' => $materiData['kunci_jawaban'][$i],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Redirect to the show page with a success message
        return redirect('materi/show/' . $id)->with('success', 'Materi Ditambahkan');
    }

    public function edit($id, $materi_id)
    {
        $data = Materi::findOrFail($id);
        $room = Ruangan::select('id', 'mapel')->where('id', $materi_id)->first();
        return view('guru.materi.edit', compact('data', 'room'));
    }
    public function update(Request $request, $id, $materi_id)
    {
        // Validate form data
        $this->validate($request, [
            'materi' => 'required|string',
            'pertanyaan' => 'nullable|string',
            'pilihan_a' => 'nullable|string',
            'pilihan_b' => 'nullable|string',
            'pilihan_c' => 'nullable|string',
            'pilihan_d' => 'nullable|string',
            'pilihan_e' => 'nullable|string',
            'kunci_jawaban' => 'nullable|string',
        ]);

        // Find the Materi record by its ID
        $materi = Materi::findOrFail($id);

        // Prepare the update data
        $updateData = [
            'materi' => $request->input('materi'),
            'pertanyaan' => $request->input('pertanyaan'),
            'pilihan_a' => $request->input('pilihan_a'),
            'pilihan_b' => $request->input('pilihan_b'),
            'pilihan_c' => $request->input('pilihan_c'),
            'pilihan_d' => $request->input('pilihan_d'),
            'pilihan_e' => $request->input('pilihan_e'),
            'kunci_jawaban' => $request->input('kunci_jawaban'),
        ];

        // Update the Materi record with new data
        $materi->update($updateData);

        // Redirect back
        return redirect()->route('materi.show', ['id' => $materi_id])->with('success', 'Materi Diubah');
    }

    public function destroy($id, $materi_id)
    {
        // Find the Materi record by its ID
        $materi = Materi::findOrFail($id);

        // Delete the Materi record from the database
        $materi->delete();

        // Redirect back to the materi list with a success message
        return redirect()->route('materi.show', ['id' => $materi_id])->with('success', 'Materi berhasil dihapus.');
    }

}
