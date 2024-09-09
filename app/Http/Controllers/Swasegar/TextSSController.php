<?php

namespace App\Http\Controllers\Swasegar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TextSS;

class TextSSController extends Controller
{
    public function index()
    {
        $texts = TextSS::all();
        return view('admin.swasegar.textss', compact('texts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $textSS = new TextSS();
        $textSS->text = $request->text;
        $textSS->save();

        return redirect()->back()->with('success', 'Text berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $textSS = TextSS::findOrFail($id);
        $textSS->text = $request->text;
        $textSS->save();

        return redirect()->back()->with('success', 'Text berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $textSS = TextSS::findOrFail($id);
        $textSS->delete();

        return redirect()->back()->with('success', 'Text berhasil dihapus.');
    }
}