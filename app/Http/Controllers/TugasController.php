<?php

namespace App\Http\Controllers;

use App\Models\Examp;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        $data = Ruangan::where('guru', auth()->user()->name)->get();
        return view('guru.tugas.main', compact('data'));

    }
    public function show($id)
    {
        $data = Examp::where('id_tugas', $id)->get();
        $room = Ruangan::select('id', 'mapel')->where('id', $id)->first();
        return view('guru.tugas.index', compact('room', 'data'));
    }
    public function create($id)
    {
        $room = Ruangan::select('id', 'mapel')->where('id', $id)->first();
        return view('guru.tugas.create', compact('room'));
    }
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required',
            'file' => 'required|max:2048',
            'deadline' => 'required',
            'kkm' => 'required',
        ]);

        // Handle file upload manually
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Move the file to the 'files/tugas/' directory
            $file->move(public_path('files/tugas/'), $fileName);

            // Only store the file name in the database, not the full path
        } else {
            $fileName = null; // Or handle this scenario differently if needed
        }

        Examp::create([
            'judul' => $request->judul,
            'file' => $fileName, // Store only the filename
            'deadline' => $request->deadline,
            'kkm' => $request->kkm,
            'id_tugas' => $id,
        ]);

        return redirect('tugas/show/' . $id)->with('success', 'Tugas Berhasil ditambahkan');
    }
    public function edit($id, $tugas_id)
    {
        $room = Ruangan::select('id', 'mapel')->where('id', $tugas_id)->first();
        $data = Examp::findOrFail($id);
        return view('guru.tugas.edit', compact('room', 'data'));
    }
    public function update(Request $request, $id, $tugas_id)
    {
        // Validate input data
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf|max:2048',
            'deadline' => 'required|date',
            'kkm' => 'required|numeric|min:0',
        ]);

        // Find the tugas by ID
        $tugas = Examp::findOrFail($id);

        // Prepare data to update
        $updateData = [
            'judul' => $request->input('judul'),
            'deadline' => $request->input('deadline'),
            'kkm' => $request->input('kkm'),
        ];

        // Check if a new file is uploaded
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            // Delete old file if exists
            if ($tugas->file) {
                $oldFilePath = public_path('files/tugas/' . $tugas->file);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Save new file
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('files/tugas'), $fileName);

            // Add the new file name to the update data
            $updateData['file'] = $fileName;
        }

        // Update the tugas in the database
        $tugas->update($updateData);

        // Redirect back to the tugas list with success message
        return redirect('tugas/show/' . $tugas_id)->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy($id, $tugas_id)
    {
        // Find the Materi record by its ID
        $tugas = Examp::findOrFail($id);

        // Check if there is an associated file and delete it
        if ($tugas->file) {
            $filePath = public_path('files/tugas/' . $tugas->file);
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }
        }

        // Delete the Materi record from the database
        $tugas->delete();

        // Redirect back to the materi list with a success message
        return redirect('materi/show/' . $tugas_id)->with('success', 'Materi berhasil dihapus.');
    }

}