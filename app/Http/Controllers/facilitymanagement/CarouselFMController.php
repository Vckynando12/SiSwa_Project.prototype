<?php

namespace App\Http\Controllers\FacilityManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarouselFM;

class CarouselFMController extends Controller
{
    public function index()
    {
        $carousels = CarouselFM::all();
        return view('admin.facilitymanagement.carouselFM', compact('carousels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);

        CarouselFM::create([
            'image' => $imageName,
        ]);

        return response()->json(['success' => true, 'message' => 'Image added successfully.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $carousel = CarouselFM::findOrFail($id);

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
        $carousel = CarouselFM::findOrFail($id);
        if (file_exists(public_path('images').'/'.$carousel->image)) {
            unlink(public_path('images').'/'.$carousel->image);
        }
        $carousel->delete();

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }
}
