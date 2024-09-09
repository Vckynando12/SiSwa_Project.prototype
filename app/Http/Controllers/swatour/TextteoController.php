<?php

namespace App\Http\Controllers\Swatour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Textteo; // Jangan lupa buat modelnya jika belum ada

class TextteoController extends Controller
{
    public function index()
    {
        $texts = Textteo::all();
        return view('admin.swatour.textteo', compact('texts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Textteo::create([
            'content' => $request->content,
        ]);

        return redirect()->route('admin.swatour.textteo.index')->with('success', 'Text added successfully.');
    }

    public function update(Request $request, $id)
    {
        $text = Textteo::find($id);

        $request->validate([
            'content' => 'required|string',
        ]);

        $text->update([
            'content' => $request->content,
        ]);

        return redirect()->route('admin.swatour.textteo.index')->with('success', 'Text updated successfully.');
    }

    public function destroy($id)
    {
        $text = Textteo::find($id);
        $text->delete();

        return redirect()->route('admin.swatour.textteo.index')->with('success', 'Text deleted successfully.');
    }
}
