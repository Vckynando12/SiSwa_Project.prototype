<?php

namespace App\Http\Controllers\swasegar;

use App\Http\Controllers\Controller;
use App\Models\GambarSS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GambarSSController extends Controller
{
    public function index()
    {
        $gambarSS = GambarSS::first(); // Ambil data pertama atau satu-satunya
        return view('admin.swasegar.gambarSS', compact('gambarSS'));
    }

    public function store(Request $request)
    {
        $gambarSS = GambarSS::firstOrNew();
        $gambarType = $request->input('gambarType');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gambarSS', 'public');
            $gambarSS->$gambarType = $imagePath;
        }

        $gambarSS->save();

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $gambarSS = GambarSS::findOrFail($id);
        $gambarType = $request->input('gambarType');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($gambarSS->$gambarType) {
                Storage::delete('public/' . $gambarSS->$gambarType);
            }
            $imagePath = $request->file('image')->store('gambarSS', 'public');
            $gambarSS->$gambarType = $imagePath;
        }

        $gambarSS->save();

        return response()->json(['success' => true]);
    }

    public function destroy(Request $request, $id)
    {
        $gambarSS = GambarSS::findOrFail($id);
        $gambar = $request->input('gambar');

        if ($gambarSS->$gambar) {
            Storage::delete('public/' . $gambarSS->$gambar);
            $gambarSS->$gambar = null;
            $gambarSS->save();
        }

        return response()->json(['success' => true]);
    }
}