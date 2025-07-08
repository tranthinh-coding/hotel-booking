<?php

namespace HotelBooking\Controllers;

require_once __DIR__ . '/../Functions/functions.php';

use HotelBooking\Models\DanhGia;
use HotelBooking\Models\Phong;
use HotelBooking\Models\DanhMucPhong;

class HomeController
{
    public function index()
    {
        // Get data for homepage
        $danhGias = DanhGia::all();
        $phongs = Phong::all();
        $danhMucPhongs = DanhMucPhong::all();
        
        view('home_new', [
            'danhGias' => $danhGias,
            'phongs' => $phongs,
            'danhMucPhongs' => $danhMucPhongs
        ]);
    }

    public function searchRooms()
    {
        $checkin = $_POST['checkin'] ?? '';
        $checkout = $_POST['checkout'] ?? '';
        $guests = $_POST['guests'] ?? 1;
        $room_type = $_POST['room_type'] ?? '';

        // Basic room search logic
        $availableRooms = Phong::searchAvailable($checkin, $checkout, $guests, $room_type);
        
        view('Phong/search_results', [
            'rooms' => $availableRooms,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'guests' => $guests,
            'room_type' => $room_type
        ]);
    }

    public function about()
    {
        view('about');
    }

    public function showSearchForm()
    {
        $danhMucPhongs = DanhMucPhong::all();
        view('search-form', [
            'danhMucPhongs' => $danhMucPhongs
        ]);
    }

    public function contact()
    {
        view('contact');
    }
}
