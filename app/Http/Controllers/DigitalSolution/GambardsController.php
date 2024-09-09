<?php

// app/Http/Controllers/Digitalsolution/GambardsController.php

namespace App\Http\Controllers\Digitalsolution;

use App\Http\Controllers\Controller;
use App\Models\Gambards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GambardsController extends Controller
{
    public function index()
    {
        $gambards = Gambards::first(); // Ambil data pertama atau satu-satunya
        return view('admin.digitalsolution.gambards', compact('gambards'));
    }

    public function store(Request $request)
    {
        $gambards = Gambards::firstOrNew();
        $gambarType = $request->input('gambarType');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gambards', 'public');
            $gambards->$gambarType = $imagePath;
        }

        $gambards->save();

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $gambards = Gambards::findOrFail($id);
        $gambarType = $request->input('gambarType');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($gambards->$gambarType) {
                Storage::delete('public/' . $gambards->$gambarType);
            }
            $imagePath = $request->file('image')->store('gambards', 'public');
            $gambards->$gambarType = $imagePath;
        }

        $gambards->save();

        return response()->json(['success' => true]);
    }

    public function destroy(Request $request, $id)
    {
        $gambards = Gambards::findOrFail($id);
        $gambar = $request->input('gambar');

        if ($gambards->$gambar) {
            Storage::delete('public/' . $gambards->$gambar);
            $gambards->$gambar = null;
            $gambards->save();
        }

        return response()->json(['success' => true]);
    }
}
