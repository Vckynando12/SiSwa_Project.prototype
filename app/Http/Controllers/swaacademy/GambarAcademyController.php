<?php

namespace App\Http\Controllers\swaacademy;

use App\Http\Controllers\Controller;
use App\Models\GambarAcademy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GambarAcademyController extends Controller
{
    public function index()
    {
        $gambarAcademy = GambarAcademy::first(); // Ambil data pertama atau satu-satunya
        return view('admin.swaacademy.gambarAcademy', compact('gambarAcademy'));
    }

    public function store(Request $request)
    {
        $gambarAcademy = GambarAcademy::firstOrNew();
        // Validasi input
        $request->validate([
            'gambarType' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menyimpan gambar
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/gambarAcademy', $imageName); // Ganti folder ke gambarAcademy
            
            // Simpan nama gambar ke database
            if ($request->gambarType === 'gambar1') {
                $gambarAcademy->gambar1 = $imageName;
            } else {
                $gambarAcademy->gambar2 = $imageName;
            }
        }

        $gambarAcademy->save();

        return response()->json(['success' => 'Image added successfully.']);
    }

    public function update(Request $request, $id)
    {
        $gambarAcademy = GambarAcademy::findOrFail($id);
        $gambarType = $request->input('gambarType');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($gambarAcademy->$gambarType) {
                Storage::delete('public/gambarAcademy/' . $gambarAcademy->$gambarType); // Ganti folder ke gambarAcademy
            }
            $imagePath = $request->file('image')->store('gambarAcademy', 'public'); // Ganti folder ke gambarAcademy
            $gambarAcademy->$gambarType = $imagePath;
        }

        $gambarAcademy->save();

        return response()->json(['success' => true]);
    }

    public function destroy(Request $request, $id)
    {
        $gambarAcademy = GambarAcademy::findOrFail($id);
        $gambar = $request->input('gambar');

        if ($gambarAcademy->$gambar) {
            Storage::delete('public/gambarAcademy/' . $gambarAcademy->$gambar); // Ganti folder ke gambarAcademy
            $gambarAcademy->$gambar = null;
            $gambarAcademy->save();
        }

        return response()->json(['success' => true]);
    }
}