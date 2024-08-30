<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Submit_examp;
use Illuminate\Http\Request;

class SubmitController extends Controller
{
    public function index()
    {
        $data = Ruangan::where('guru', auth()->user()->name)->get();
        return view('guru.submit.main', compact('data'));
    }

    public function show($id)
    {
        $data = Submit_examp::with('tugas', 'user')->where('id_tugas', $id)->get();
        $room = Ruangan::select('id', 'mapel')->where('id', $id)->first();
        return view('guru.submit.index', compact('room', 'data'));
    }

    public function update(Request $request, $id)
    {
        $data = Submit_examp::findOrFail($request->id);
        $data->update([
            'nilai' => $request->nilai,
        ]);
        return redirect('submit/show/' . $id)->with('success', 'Tugas Telah Dinilai');
    }

    public function destroy($id)
    {
        // Find the Materi record by its ID
        $data = Submit_examp::findOrFail($id);

        // Check if there is an associated file and delete it
        if ($data->file) {
            $filePath = public_path('files/submit_tugas/' . $data->file);
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }
        }
        // Delete the Materi record from the database
        $data->delete();

        // Redirect back to the data list with a success message
        return redirect()->back()->with('success', 'Materi berhasil dihapus.');
    }
}