<?php

namespace App\Http\Controllers\Swatour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gambarteo;
use Illuminate\Support\Facades\Storage;

class GambarteoController extends Controller
{
    public function index()
    {
        $gambar = Gambarteo::first();
        return view('admin.swatour.gambarteo', compact('gambar'));
    }

    public function store(Request $request)
    {
        $gambar = Gambarteo::firstOrNew();
        $gambarType = $request->input('gambarType');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gambarteo', 'public');
            $gambar->$gambarType = $imagePath;
        }

        $gambar->save();

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $gambar = Gambarteo::findOrFail($id);
        $gambarType = $request->input('gambarType');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($gambar->$gambarType) {
                Storage::delete('public/' . $gambar->$gambarType);
            }
            $imagePath = $request->file('image')->store('gambarteo', 'public');
            $gambar->$gambarType = $imagePath;
        }

        $gambar->save();

        return response()->json(['success' => true]);
    }

    public function destroy(Request $request, $id)
    {
        $gambar = Gambarteo::findOrFail($id);
        $gambarType = $request->input('gambarType');

        if ($gambar->$gambarType) {
            Storage::delete('public/' . $gambar->$gambarType);
            $gambar->$gambarType = null;
            $gambar->save();
        }

        return response()->json(['success' => true]);
    }
}
