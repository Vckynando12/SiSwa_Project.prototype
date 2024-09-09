<?php

namespace App\Http\Controllers;

use App\Models\Carousel;

class HomeController extends Controller
{
    public function landingpage()
    {
        $carousels = Carousel::all();
        return view('landingpage', compact('carousels'));
    }
}
