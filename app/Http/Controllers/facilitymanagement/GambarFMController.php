<?php

namespace App\Http\Controllers\facilitymanagement;

use App\Http\Controllers\Controller;
use App\Models\GambarFM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GambarFMController extends Controller
{
    public function index()
    {
        $gambarFM = GambarFM::first(); // Ambil data pertama atau satu-satunya
        return view('admin.facilitymanagement.gambarFM', compact('gambarFM'));
    }

    public function store(Request $request)
    {
        $gambarFM = GambarFM::firstOrNew();
        $gambarType = $request->input('gambarType');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gambarFM', 'public');
            $gambarFM->$gambarType = $imagePath;
        }

        $gambarFM->save();

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $gambarFM = GambarFM::findOrFail($id);
        $gambarType = $request->input('gambarType');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($gambarFM->$gambarType) {
                Storage::delete('public/' . $gambarFM->$gambarType);
            }
            $imagePath = $request->file('image')->store('gambarFM', 'public');
            $gambarFM->$gambarType = $imagePath;
        }

        $gambarFM->save();

        return response()->json(['success' => true]);
    }

    public function destroy(Request $request, $id)
    {
        $gambarFM = GambarFM::findOrFail($id);
        $gambar = $request->input('gambar');

        if ($gambarFM->$gambar) {
            Storage::delete('public/' . $gambarFM->$gambar);
            $gambarFM->$gambar = null;
            $gambarFM->save();
        }

        return response()->json(['success' => true]);
    }
}
