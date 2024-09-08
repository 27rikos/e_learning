<?php

namespace App\Http\Controllers;

use App\Imports\MataPelajaran;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mapel::all();
        return view('admin.mapel.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.mapel.create');
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
            'mapel' => 'required',
            'keterangan' => 'required',
        ]);
        $data = Mapel::create($request->all());
        $data->save();
        return redirect()->route('mapel.index')->with('success', 'Data Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Mapel::findOrFail($id);
        return view('admin.mapel.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Mapel::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('mapel.index')->with('success', 'Data Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Mapel::findOrFail($id);
        $data->delete();
        return redirect()->route('mapel.index')->with('success', 'Data Dihapus');
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
        Excel::import(new MataPelajaran, $filePath);

        return redirect()->back()->with('toast_success', 'Data imported successfully.');
    }
}
