<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SdmController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan dashboard SDM
        return view('sdm.dashboard');
    }
}
