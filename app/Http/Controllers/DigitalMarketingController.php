<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DigitalMarketingController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan dashboard digital marketing
        return view('admin.digitalmarketing'); // Pastikan file ini ada
    }
}
