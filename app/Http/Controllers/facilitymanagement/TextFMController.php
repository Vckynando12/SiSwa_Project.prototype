<?php

namespace App\Http\Controllers\FacilityManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TextFM;

class TextFMController extends Controller
{
    public function index()
    {
        $texts = TextFM::all();
        return view('admin.facilitymanagement.textfm', compact('texts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $textFM = new TextFM();
        $textFM->text = $request->text;
        $textFM->save();

        return redirect()->back()->with('success', 'Text berhasil disimpan.');
        // return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $textFM = TextFM::findOrFail($id);
        $textFM->text = $request->text;
        $textFM->save();

        return redirect()->back()->with('success', 'Text berhasil diperbarui.');
        // return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $textFM = TextFM::findOrFail($id);
        $textFM->delete();

        return redirect()->back()->with('success', 'Text berhasil dihapus.');
        // return response()->json(['success' => true]);
    }
}
