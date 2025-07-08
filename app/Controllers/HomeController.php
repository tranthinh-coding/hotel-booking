<?php

namespace HotelBooking\Controllers;

require_once __DIR__ . '/../Functions/functions.php';

use HotelBooking\Models\DanhGia;

class HomeController
{
    public function index()
    {
        // Get some recent reviews for homepage
        $danhGias = DanhGia::all();
        
        view('home', [
            'danhGias' => $danhGias
        ]);
    }
}
