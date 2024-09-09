<?php

namespace App\Http\Controllers\Swasegar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SwasegarCarousel;
use App\Models\FotoLayanan;
use App\Models\GambarSS; // Add this import

class SwasegarController extends Controller
{
    public function index()
    {
        $carousels = SwasegarCarousel::all();
        $gambarSS = GambarSS::first(); // Use the correct model and get the first record
        return view('swasegar', compact('carousels', 'gambarSS')); // Include 'gambarSS' in the view
    }
}