<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Quiz_answer;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;

class JawabanController extends Controller
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
        return view('siswa.kuis.main', compact('mapels'));
    }
    public function show($id)
    {
        $data = Quiz::where('id_kuis', $id)->get();
        $room = Ruangan::select('id', 'mapel')->where('id', $id)->first();
        return view('siswa.kuis.index', compact('room', 'data'));
    }
    public function store(Request $request, $id)
    {
        // Mengambil user_id berdasarkan user yang sedang login
        $user_id = User::select('id')->where('name', auth()->user()->name)->first()->id;

        // Ambil atau buat entri Quiz_answer untuk pengguna ini dan kuis ini
        $quizAnswer = Quiz_answer::firstOrNew(
            [
                'id_siswa' => $user_id, // Kondisi untuk memeriksa keberadaan data
                'id_soal' => $id,
            ]
        );

        // Jika ini adalah entri baru, set nilai chance ke 4
        if (!$quizAnswer->exists) {
            $quizAnswer->chance = 4; // Set default chance ke 4 untuk entri baru
        } elseif ($quizAnswer->chance <= 1) {
            // Jika pengguna sudah tidak punya kesempatan, beri pesan error dan alihkan kembali
            return redirect()->back()->with('error', 'Anda telah mencapai batas maksimal submit.');
        } else {
            // Kurangi kesempatan submit jika data sudah ada
            $quizAnswer->chance--;
        }

        $elapsedTimeInSeconds = $request->input('elapsed_time'); // Waktu dalam detik
        $jawabanUser = $request->input('jawaban'); // Mengambil jawaban dari form
        $jumlahBenar = 0;

        $totalSoal = Quiz::count(); // Menghitung jumlah soal dari tabel Quiz
        $totalNilaiMaks = 100; // Misalnya, total nilai maksimum adalah 100 poin
        $nilaiPerSoal = $totalNilaiMaks / $totalSoal; // Nilai per soal

        foreach ($jawabanUser as $idSoal => $jawaban) {
            $quiz = Quiz::find($idSoal);

            if ($quiz && $quiz->kunci === $jawaban) {
                $jumlahBenar++;
            }
        }

        $totalNilai = $jumlahBenar * $nilaiPerSoal;

        // Konversi detik ke menit, dengan pembulatan
        $menit = round($elapsedTimeInSeconds / 60);

        // Simpan jawaban ke model QuizAnswer
        $quizAnswer->jumlah_benar = $jumlahBenar;
        $quizAnswer->nilai = number_format($totalNilai, 2); // Nilai yang akan diperbarui atau dibuat
        $quizAnswer->lama = $menit; // Waktu pengerjaan dalam menit

        // Simpan data ke database
        $quizAnswer->save();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', [
            'Jumlah jawaban benar' => $jumlahBenar,
            'Total nilai' => number_format($totalNilai, 2),
            'Waktu pengerjaan kuis (menit)' => $menit,
            'Kesempatan submit tersisa' => $quizAnswer->chance,
        ]);
    }

}