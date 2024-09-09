<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    // Menampilkan halaman utama
    public function landingpage()
    {
        $carousels = Carousel::all();
        return view('landingpage', compact('carousels'));
    }

    // Menampilkan dashboard admin dengan daftar carousel
    public function index()
    {
        // Mengirimkan daftar carousel ke view dashboard
        $carousels = Carousel::all();
        return view('admin.dashboard', compact('carousels'));
    }

    // Menampilkan halaman carousel CRUD
    public function showCarousel()
    {
        $carousels = Carousel::all();
        return view('admin.landingpage.carousel', compact('carousels'));
    }

    // Menyimpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('images', 'public');

        Carousel::create([
            'image' => $path,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json(['success' => true]);
    }

    // Memperbarui data yang ada di database
    public function update(Request $request, $id)
    {
        $carousel = Carousel::findOrFail($id);

        $carousel->title = $request->input('title');
        $carousel->description = $request->input('description');

        if ($request->hasFile('image')) {
            // Delete the old image
            if ($carousel->image) {
                Storage::delete('public/' . $carousel->image);
            }

            // Store the new image
            $path = $request->file('image')->store('carousels', 'public');
            $carousel->image = $path;
        }

        $carousel->save();

        return response()->json(['success' => true]);
    }

    // Menghapus data dari database
    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);

        // Hapus gambar dari storage
        Storage::disk('public')->delete($carousel->image);

        $carousel->delete();

        return response()->json(['success' => true]);
    }
}
