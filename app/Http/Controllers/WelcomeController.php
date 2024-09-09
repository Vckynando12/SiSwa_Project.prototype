<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\SekilasPerusahaan;
use App\Models\JejakLangkah;
use App\Models\SertifikatPenghargaan;
use App\Models\VisiMisiBudaya;
use App\Models\FotoLayanan;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        $sekilas = SekilasPerusahaan::all();
        $jejakLangkahs = JejakLangkah::all();
        $visiMisiBudaya = VisiMisiBudaya::all(); 
        $sertifikatPenghargaans = SertifikatPenghargaan::all();
        $fotoLayanans = FotoLayanan::all();

        return view('landingpage', compact('carousels', 'sekilas', 'jejakLangkahs', 'visiMisiBudaya', 'sertifikatPenghargaans', 'fotoLayanans'));
    }
}
