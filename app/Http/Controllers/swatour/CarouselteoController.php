<?php

namespace App\Http\Controllers\Swatour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carouselteo; // Jangan lupa buat modelnya jika belum ada

class CarouselteoController extends Controller
{
    public function index()
    {
        $carousels = Carouselteo::all();
        return view('admin.swatour.carouselteo', compact('carousels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/carousel'), $imageName);

        Carouselteo::create([
            'image' => $imageName,
        ]);

        return response()->json(['success' => true, 'message' => 'Image added successfully.']);
    }

    public function update(Request $request, $id)
    {
        $carousel = Carouselteo::find($id);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/carousel'), $imageName);
            $carousel->update([
                'image' => $imageName,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Image updated successfully.']);
    }

    public function destroy($id)
    {
        $carousel = Carouselteo::find($id);
        $carousel->delete();

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }
}
