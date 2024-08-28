<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('role', 'siswa')->get();
        return view('admin.siswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::select('kelas')->get();
        return view('admin.siswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Add validation for required fields
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'tempat_lhr' => 'required',
            'tanggal_lhr' => 'required|date',
            'jenkel' => 'required',
            'agama' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
            'email' => 'required|email',
            'file' => 'required|file',
            'password' => 'required',
        ]);

        // Process the file upload
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/students'), $fileName);

            $data['file'] = $fileName;
        }
        $roles = 'siswa';

        // Create new student
        $user = User::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'tempat_lhr' => $request->tempat_lhr,
            'tanggal_lhr' => $request->tanggal_lhr,
            'jenkel' => $request->jenkel,
            'agama' => $request->agama,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'hp' => $request->hp,
            'role' => $roles,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'file' => $fileName ?? null,
        ]);

        return redirect()->route('student.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelas = Kelas::select('kelas')->get();
        $data = User::findOrFail($id);
        return view('admin.siswa.edit', compact('data', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Add validation for required fields
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'tempat_lhr' => 'required',
            'tanggal_lhr' => 'required|date',
            'jenkel' => 'required',
            'agama' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
            'email' => 'required|email',
            'file' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048', // optional if file update is allowed
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Handle file upload if a new file is provided
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            // Remove old file if exists
            if ($user->file) {
                $oldFilePath = public_path('images/students/' . $user->file);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Store new file
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/students'), $fileName);
            $user->file = $fileName;
        }

        // Update user data
        $user->update([
            'nis' => $request->nis,
            'name' => $request->name,
            'tempat_lhr' => $request->tempat_lhr,
            'tanggal_lhr' => $request->tanggal_lhr,
            'jenkel' => $request->jenkel,
            'agama' => $request->agama,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'hp' => $request->hp,
            'email' => $request->email,
            'file' => $user->file, // Set the file if it's updated
        ]);

        return redirect()->route('student.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Check if the user has an associated file and delete it if it exists
        if ($user->file) {
            $filePath = public_path('images/students/' . $user->file);
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }
        }

        // Delete the user record from the database
        $user->delete();

        // Redirect back with a success message
        return redirect()->route('student.index')->with('success', 'Student deleted successfully.');
    }

}