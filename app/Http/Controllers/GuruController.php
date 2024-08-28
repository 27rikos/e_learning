<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('role', 'guru')->get();
        return view('admin.guru.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.guru.create');
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
            'nip' => 'required',
            'name' => 'required',
            'tempat_lhr' => 'required',
            'tanggal_lhr' => 'required',
            'jenkel' => 'required',
            'agama' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
            'email' => 'required',
            'file' => 'required|file|mimes:jpg,jpeg,png|max:2048', // Validation for file upload
            'password' => 'required',
        ]);
        $roles = 'guru';

        // Create a new teacher instance and fill it with the request data
        $teacher = new User([
            'nip' => $request->nip,
            'name' => $request->name,
            'tempat_lhr' => $request->tempat_lhr,
            'tanggal_lhr' => $request->tanggal_lhr,
            'jenkel' => $request->jenkel,
            'agama' => $request->agama,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'role' => $roles,
            'hp' => $request->hp,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password for security
        ]);

        // Check if a file is uploaded and handle the file upload
        if ($request->hasFile('file')) {
            // Move the uploaded file to the specified directory with the original name
            $request->file('file')->move('images/teachers/', $request->file('file')->getClientOriginalName());

            // Save the file name in the database
            $teacher->file = $request->file('file')->getClientOriginalName();
        }

        // Save the teacher data to the database
        $teacher->save();

        // Redirect to a specific page with a success message
        return redirect()->route('teacher.index')->with('success', 'Teacher successfully saved.');
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
        $data = User::findOrFail($id);
        return view('admin.guru.edit', compact('data'));
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
        $data = User::findOrFail($id);

        // Validate required fields
        $request->validate([
            'nip' => 'required',
            'name' => 'required',
            'tempat_lhr' => 'required',
            'tanggal_lhr' => 'required|date',
            'jenkel' => 'required',
            'agama' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
            'email' => 'required|email',
            'file' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Prepare data for update
        $updateData = [
            'nip' => $request->nip,
            'name' => $request->name,
            'tempat_lhr' => $request->tempat_lhr,
            'tanggal_lhr' => $request->tanggal_lhr,
            'jenkel' => $request->jenkel,
            'agama' => $request->agama,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'hp' => $request->hp,
            'email' => $request->email,
        ];

        // Check if a new file is uploaded
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            // Delete the old photo file if it exists
            if ($data->file) {
                $oldPhotoPath = public_path('images/teachers/' . $data->file);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Save the new file
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/teachers'), $fileName);

            // Add the new file name to the update data
            $updateData['file'] = $fileName;
        }

        // Update teacher data
        $data->update($updateData);

        return redirect()->route('teacher.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id); // Find the teacher by ID

        // Check if the teacher has an associated photo file
        if ($data->file) {
            $photoPath = public_path('images/teachers/' . $data->file);

            // Delete the photo file from the server if it exists
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        // Delete the teacher record from the database
        $data->delete();

        return redirect()->route('teacher.index')->with('success', 'Data deleted successfully');
    }
}