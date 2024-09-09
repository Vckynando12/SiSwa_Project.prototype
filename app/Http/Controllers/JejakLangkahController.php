<?php

namespace App\Http\Controllers;

use App\Models\JejakLangkah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JejakLangkahController extends Controller
{
    public function index()
    {
        $jejakLangkah = JejakLangkah::first();
        return view('admin.landingpage.jejaklangkah', compact('jejakLangkah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        JejakLangkah::create([
            'image' => $imagePath,
        ]);

        return response()->json(['success' => true, 'message' => 'Jejak Langkah created successfully.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $jejakLangkah = JejakLangkah::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($jejakLangkah->image) {
                Storage::disk('public')->delete($jejakLangkah->image);
            }

            $imagePath = $request->file('image')->store('images', 'public');
            $jejakLangkah->image = $imagePath;
        }

        $jejakLangkah->save();

        return response()->json(['success' => true, 'message' => 'Jejak Langkah updated successfully.']);
    }

    public function destroy($id)
    {
        $jejakLangkah = JejakLangkah::findOrFail($id);

        // Delete image from storage
        if ($jejakLangkah->image) {
            Storage::disk('public')->delete($jejakLangkah->image);
        }

        $jejakLangkah->delete();

        return response()->json(['success' => true, 'message' => 'Jejak Langkah deleted successfully.']);
    }
}
