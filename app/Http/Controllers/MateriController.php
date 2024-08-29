<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Ruangan;
use Illuminate\Http\Request;

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
        // Validate form data
        $this->validate($request, [
            'judul' => 'required',
            'tanggal' => 'required',
            'file' => 'required|file|mimes:pdf|max:2048', // Ensure the file is a PDF
        ]);

        // Initialize filename variable
        $fileName = null;

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Move the file to the 'files/materi/' directory
            $file->move(public_path('files/materi/'), $fileName);

            // Note: Do not store the full path in the database, only the filename
        }

        // Create a new Materi record
        Materi::create([
            'id_materi' => $id,
            'judul' => $request->input('judul'),
            'file' => $fileName,
            'tanggal' => $request->input('tanggal'),
        ]);

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
            'judul' => 'required',
            'tanggal' => 'required|date',
            'file' => 'nullable|file|mimes:pdf|max:2048', // File is optional and must be a PDF
        ]);

        // Find the Materi record by its ID
        $materi = Materi::findOrFail($id);

        // Prepare the update data
        $updateData = [
            'judul' => $request->input('judul'),
            'tanggal' => $request->input('tanggal'),
        ];

        // Check if a new file is uploaded and is valid
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            // Delete the old file if it exists
            if ($materi->file) {
                $oldFilePath = public_path('files/materi/' . $materi->file);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Store the new file
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('files/materi/'), $fileName);

            // Add the new file name to the update data
            $updateData['file'] = $fileName;
        }

        // Update the Materi record with new data
        $materi->update($updateData);
        // rredirect back
        return redirect('materi/show/' . $materi_id)->with('success', 'Materi Diubah');
    }

    public function destroy($id, $materi_id)
    {
        // Find the Materi record by its ID
        $materi = Materi::findOrFail($id);

        // Check if there is an associated file and delete it
        if ($materi->file) {
            $filePath = public_path('files/materi/' . $materi->file);
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }
        }
        // Delete the Materi record from the database
        $materi->delete();

        // Redirect back to the materi list with a success message
        return redirect('materi/show/' . $materi_id)->with('success', 'Materi berhasil dihapus.');
    }

}