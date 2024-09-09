<?php

namespace App\Http\Controllers\Swatour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carouselteo; // Tambahkan import model yang diperlukan
use App\Models\Gambarteo; // Tambahkan import model yang diperlukan
use App\Models\Textteo; // Tambahkan import model yang diperlukan

class SwatourorganizerController extends Controller
{
    public function index()
    {
        $carousels = Carouselteo::all(); // Ambil semua data dari model Carouselteo
        $gambars = Gambarteo::all(); // Ambil semua data dari model Gambarteo
        $texts = Textteo::all(); // Ambil semua data dari model Textteo
        return view('swatour', compact('carousels', 'gambars', 'texts')); // Sertakan data dalam view
    }
}
