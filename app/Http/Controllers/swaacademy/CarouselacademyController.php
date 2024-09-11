<?php

namespace App\Http\Controllers\swaacademy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarouselAcademy;

class CarouselAcademyController extends Controller
{
    public function index()
    {
        $carousels = CarouselAcademy::all();
        return view('admin.swaacademy.carouselacademy', compact('carousels'));
    }

    public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('image')) {
        // Dapatkan file gambar dari request
        $image = $request->file('image');

        // Buat nama unik untuk gambar
        $imageName = time().'.'.$image->getClientOriginalExtension();

        // Simpan gambar ke folder 'public/images/carousel'
        $image->move(public_path('images/carousel'), $imageName);

        // Simpan ke database
        CarouselAcademy::create([ // Changed Carousel to CarouselAcademy
            'image' => $imageName,
        ]);

        return response()->json(['success' => true]);
    } else {
        return response()->json(['error' => 'Image file not found'], 400);
    }
}

public function update(Request $request, $id)
{
    $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $carousel = CarouselAcademy::findOrFail($id); // Dapatkan data carousel berdasarkan ID

    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        $oldImage = public_path('images/carousel/' . $carousel->image);
        if (file_exists($oldImage)) {
            unlink($oldImage); // Hapus file dari folder
        }

        // Upload gambar baru
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images/carousel'), $imageName);

        // Update data di database dengan gambar baru
        $carousel->update([
            'image' => $imageName,
        ]);
    }

    return response()->json(['success' => true]);
}

    public function destroy($id)
    {
        $carousel = CarouselAcademy::find($id);
        $carousel->delete();

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }
}
