<?php

namespace App\Http\Controllers;

use App\Models\SekilasPerusahaan;
use Illuminate\Http\Request;

class SekilasPerusahaanController extends Controller
{
    public function index()
    {
        $data = SekilasPerusahaan::all();
        return view('admin.landingpage.sekilasperusahaan', compact('data'));
    }

    public function create()
    {
        return view('admin.landingpage.sekilas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'maintext' => 'required',
        ]);

        SekilasPerusahaan::create($request->all());
        return response()->json(['success' => true, 'message' => 'Data added successfully.']);
    }

    public function edit($id)
    {
        $sekilas = SekilasPerusahaan::findOrFail($id);
        return view('admin.landingpage.sekilas.edit', compact('sekilas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'maintext' => 'required',
        ]);

        $sekilas = SekilasPerusahaan::findOrFail($id);
        $sekilas->update($request->all());

        return response()->json(['success' => true, 'message' => 'Data updated successfully.']);
    }

    public function destroy($id)
    {
        $sekilas = SekilasPerusahaan::findOrFail($id);
        $sekilas->delete();
        return response()->json(['success' => true, 'message' => 'Data deleted successfully.']);
    }    
}
