<?php

namespace App\Http\Controllers\Digitalsolution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Textds;

class TextdsController extends Controller
{
    public function index()
    {
        $texts = Textds::all();
        return view('admin.digitalsolution.textds', compact('texts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        Textds::create($request->all());

        return redirect()->back()->with('success', 'Text berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $text = Textds::findOrFail($id);
        $text->update($request->all());

        return redirect()->back()->with('success', 'Text berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $text = Textds::findOrFail($id);
        $text->delete();

        return redirect()->back()->with('success', 'Text berhasil dihapus.');
    }
}