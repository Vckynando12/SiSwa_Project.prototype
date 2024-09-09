<?php

namespace App\Http\Controllers\Digitalsolution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carouselds;

class CarouseldsController extends Controller
{
    public function index()
    {
        $carousels = Carouselds::all();
        return view('admin.digitalsolution.carouselds', compact('carousels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);

        Carouselds::create([
            'image' => $imageName,
        ]);

        return response()->json(['success' => true, 'message' => 'Image added successfully.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $carousel = Carouselds::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $carousel->image = $imageName;
        }

        $carousel->save();

        return response()->json(['success' => true, 'message' => 'Image updated successfully.']);
    }

    public function destroy($id)
    {
        $carousel = Carouselds::findOrFail($id);
        if (file_exists(public_path('images').'/'.$carousel->image)) {
            unlink(public_path('images').'/'.$carousel->image);
        }
        $carousel->delete();

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }
}
