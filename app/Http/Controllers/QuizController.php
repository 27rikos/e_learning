<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Quiz_answer;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $data = Ruangan::where('guru', auth()->user()->name)->get();
        return view('guru.kuis.main', compact('data'));
    }
    public function show($id)
    {
        $data = Quiz::where('id_kuis', $id)->get();
        $room = Ruangan::select('id', 'mapel')->where('id', $id)->first();
        return view('guru.kuis.index', compact('room', 'data'));
    }
    public function create($id)
    {
        $room = Ruangan::select('id', 'mapel')->where('id', $id)->first();
        return view('guru.kuis.create', compact('room'));
    }
    public function store(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'pilihan_e' => 'required|string',
            'kunci' => 'required|string|in:A,B,C,D,E', // Assuming the answer is one of these options
        ]);

        // Create a new quiz
        $quiz = new Quiz();
        $quiz->id_kuis = $id; // Assuming you have a room_id column in the Quiz model
        $quiz->pertanyaan = $validatedData['pertanyaan'];
        $quiz->pilihan_a = $validatedData['pilihan_a'];
        $quiz->pilihan_b = $validatedData['pilihan_b'];
        $quiz->pilihan_c = $validatedData['pilihan_c'];
        $quiz->pilihan_d = $validatedData['pilihan_d'];
        $quiz->pilihan_e = $validatedData['pilihan_e'];
        $quiz->kunci = $validatedData['kunci'];

        // Save the quiz to the database
        $quiz->save();

        // Redirect or return a response
        return redirect('quiz/show/' . $id)->with('success', 'Quiz berhasil disimpan!');
    }
    public function edit($id, $kuis_id)
    {
        $room = Ruangan::select('id', 'mapel')->where('id', $kuis_id)->first();
        $data = Quiz::findOrFail($id);
        return view('guru.kuis.edit', compact('room', 'data'));
    }
    public function update(Request $request, $id, $kuis_id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'pilihan_e' => 'required|string',
            'kunci' => 'required|string|in:A,B,C,D,E', // Assuming the answer is one of these options
        ]);

        // Find the existing quiz by ID
        $quiz = Quiz::findOrFail($id);

        // Update the quiz with validated data
        $quiz->pertanyaan = $validatedData['pertanyaan'];
        $quiz->pilihan_a = $validatedData['pilihan_a'];
        $quiz->pilihan_b = $validatedData['pilihan_b'];
        $quiz->pilihan_c = $validatedData['pilihan_c'];
        $quiz->pilihan_d = $validatedData['pilihan_d'];
        $quiz->pilihan_e = $validatedData['pilihan_e'];
        $quiz->kunci = $validatedData['kunci'];

        // Save the updated quiz to the database
        $quiz->save();

        // Redirect or return a response
        return redirect('quiz/show/' . $kuis_id)->with('success', 'Quiz berhasil diperbarui!');
    }
    public function destroy($id, $kuis_id)
    {
        // Find the existing quiz by ID
        $quiz = Quiz::findOrFail($id);

        // Delete the quiz from the database
        $quiz->delete();

        // Redirect or return a response
        return redirect('quiz/show/' . $kuis_id)->with('success', 'Quiz berhasil dihapus!');
    }
    public function mapel()
    {
        $data = Ruangan::where('guru', auth()->user()->name)->get();
        return view('guru.kuis-answer.main', compact('data'));

    }
    public function check($id)
    {
        $data = Quiz_answer::with('user')->where('id_soal', $id)->get();
        $room = Ruangan::select('id', 'mapel')->where('id', $id)->first();
        return view('guru.kuis-answer.index', compact('data', 'room'));
    }
}