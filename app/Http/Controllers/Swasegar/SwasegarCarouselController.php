<?php

namespace App\Http\Controllers\swasegar;

use App\Http\Controllers\Controller;
use App\Models\SwasegarCarousel;
use Illuminate\Http\Request;

class SwasegarCarouselController extends Controller
{
    public function index()
    {
        $carousels = SwasegarCarousel::all();
        return view('admin.swasegar.carousel', compact('carousels'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $path = $request->file('image')->store('images', 'public');

        $carousel = SwasegarCarousel::create([
            'title' => $request->title,
            'image' => $path,
            'description' => $request->description,
        ]);

        return response()->json(['success' => true, 'message' => 'Carousel item added successfully!', 'carousel' => $carousel]);
    }

    public function update(Request $request, $id)
    {
        $carousel = SwasegarCarousel::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $carousel->image = $path;
        }

        $carousel->title = $request->title;
        $carousel->description = $request->description;
        $carousel->save();

        return response()->json(['success' => true, 'message' => 'Carousel item updated successfully!', 'carousel' => $carousel]);
    }

    public function destroy($id)
    {
        $carousel = SwasegarCarousel::findOrFail($id);
        $carousel->delete();

        return response()->json(['success' => true, 'message' => 'Carousel item deleted successfully!']);
    }
}

