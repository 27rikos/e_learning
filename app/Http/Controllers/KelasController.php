<?php

namespace App\Http\Controllers;

use App\Imports\Room;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kelas::all();
        return view('admin.kelas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kelas' => 'required',
            'keterangan' => 'required',
        ]);
        $data = Kelas::create($request->all());
        $data->save();
        return redirect()->route('kelas.index')->with('success', 'Kelas Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Kelas::findOrFail($id);
        return view('admin.kelas.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Kelas::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('kelas.index')->with('success', 'Kelas Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kelas::findOrFail($id);
        $data->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas Dihapus');
    }

    public function imports(Request $request)
    {
        // Validate the uploaded file
        $this->validate($request, rules: [
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ],
            messages: [
                'file.required' => 'file belum di upload',
                'file.mimes' => 'format file harus Excel',
                'file.max' => 'Ukuran Maksimal file 2MB',

            ]
        );

        // Handle the uploaded file
        $file = $request->file('file');

        // Move the file to a temporary location (optional)
        $filePath = $file->storeAs('temp', $file->getClientOriginalName());

        // Import the data from the Excel file
        Excel::import(new Room, $filePath);

        return redirect()->back()->with('toast_success', 'Data imported successfully.');
    }
}
