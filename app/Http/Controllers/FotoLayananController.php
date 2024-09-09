<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FotoLayanan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FotoLayananController extends Controller
{
    public function index()
    {
        $fotoLayanans = FotoLayanan::all();
        return view('admin.landingpage.foto_layanan', compact('fotoLayanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoLayanan = new FotoLayanan();

        if ($request->hasFile('image1')) {
            $fotoLayanan->image1 = $request->file('image1')->store('foto-layanan', 'public');
        }

        if ($request->hasFile('image2')) {
            $fotoLayanan->image2 = $request->file('image2')->store('foto-layanan', 'public');
        }

        $fotoLayanan->save();

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoLayanan = FotoLayanan::findOrFail($id);

        if ($request->hasFile('image1')) {
            if ($fotoLayanan->image1) {
                Storage::disk('public')->delete($fotoLayanan->image1);
            }
            $fotoLayanan->image1 = $request->file('image1')->store('foto-layanan', 'public');
        }

        if ($request->hasFile('image2')) {
            if ($fotoLayanan->image2) {
                Storage::disk('public')->delete($fotoLayanan->image2);
            }
            $fotoLayanan->image2 = $request->file('image2')->store('foto-layanan', 'public');
        }

        $fotoLayanan->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $fotoLayanan = FotoLayanan::findOrFail($id);

        if ($fotoLayanan->image1) {
            Storage::delete($fotoLayanan->image1);
        }

        if ($fotoLayanan->image2) {
            Storage::delete($fotoLayanan->image2);
        }

        $fotoLayanan->delete();

        return response()->json(['success' => true]);
    }
}
