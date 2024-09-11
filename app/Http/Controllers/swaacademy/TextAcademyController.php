<?php

namespace App\Http\Controllers\swaacademy;

use App\Http\Controllers\Controller;
use App\Models\TextAcademy;
use Illuminate\Http\Request;

class TextAcademyController extends Controller
{
    public function index()
    {
        $texts = TextAcademy::all();
        return view('admin.swaacademy.textacademy', compact('texts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        TextAcademy::create([
            'text' => $request->text,
        ]);

        return redirect()->route('textacademy.index')->with('success', 'Text added successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $text = TextAcademy::findOrFail($id);
        $text->update([
            'text' => $request->text,
        ]);

        return redirect()->route('textacademy.index')->with('success', 'Text updated successfully');
    }

    public function destroy($id)
    {
        $text = TextAcademy::findOrFail($id);
        $text->delete();

        return redirect()->route('textacademy.index')->with('success', 'Text deleted successfully');
    }
}
