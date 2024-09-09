<?php

namespace App\Http\Controllers;

use App\Models\VisiMisiBudaya;
use Illuminate\Http\Request;

class VisiMisiBudayaController extends Controller
{
    public function index()
    {
        $data = VisiMisiBudaya::all();
        return view('admin.landingpage.visimisi', compact('data'));
    }

    public function store(Request $request)
    {
        $data = new VisiMisiBudaya();

        if ($request->filled('visi')) {
            $data->visi = $request->visi;
        }
        if ($request->filled('misi')) {
            $data->misi = $request->misi;
        }
        if ($request->filled('budaya')) {
            $data->budaya = $request->budaya;
        }

        $data->save();

        return redirect()->back()->with('success', 'Data successfully added');
    }

    public function update(Request $request, $id)
    {
        $data = VisiMisiBudaya::findOrFail($id);

        if ($request->filled('visi')) {
            $data->visi = $request->visi;
        }
        if ($request->filled('misi')) {
            $data->misi = $request->misi;
        }
        if ($request->filled('budaya')) {
            $data->budaya = $request->budaya;
        }

        $data->save();

        return redirect()->back()->with('success', 'Data successfully updated');
    }

    public function destroy($id)
    {
        $data = VisiMisiBudaya::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Data successfully deleted');
    }
}
