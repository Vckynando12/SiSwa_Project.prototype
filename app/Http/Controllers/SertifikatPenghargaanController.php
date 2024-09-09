<?php

namespace App\Http\Controllers;

use App\Models\SertifikatPenghargaan;
use Illuminate\Http\Request;

class SertifikatPenghargaanController extends Controller
{
    public function index()
    {
        $data = SertifikatPenghargaan::all();
        return view('admin.landingpage.sertifikat_penghargaan', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        SertifikatPenghargaan::create(['image' => $imageName]);

        return response()->json(['success' => true, 'message' => 'Sertifikat/Penghargaan berhasil ditambahkan']);
    }

    public function update(Request $request, $id)
    {
        $data = SertifikatPenghargaan::findOrFail($id);

        if ($request->hasFile('image')) {
            // Validasi gambar
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Hapus gambar lama jika ada
            $oldImagePath = public_path('images/' . $data->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Simpan gambar baru
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data->image = $imageName;
        }

        $data->save();

        return response()->json(['success' => true, 'message' => 'Sertifikat/Penghargaan berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $data = SertifikatPenghargaan::findOrFail($id);

        // Hapus file gambar
        $imagePath = public_path('images/' . $data->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $data->delete();

        return response()->json(['success' => true]);
    }
}
