<?php

namespace App\Http\Controllers\Digitalsolution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carouselds;
use App\Models\Gambards;
use App\Models\Textds;

class DigitalSolutionController extends Controller
{
    // Contoh metode index untuk menampilkan data Digital Solution secara umum
    public function index()
    {
        $carousels = Carouselds::all();
        $gambards = Gambards::first();
        $texts = Textds::all();
        
        return view('digitalsolution', compact('carousels','gambards','texts'));
    }
}