<?php

namespace HotelBooking\Controllers\Client;

use HotelBooking\Models\Phong;

class PhongController
{
    public function index()
    {
        $phongs = Phong::all();
        view('Client.Phong.index', ['phongs' => $phongs]);
    }

    public function show($id)
    {
        $phong = Phong::find($id);
        if (!$phong) {
            http_response_code(404);
            echo "Phòng không tồn tại";
            return;
        }
        view('Client.Phong.show', ['phong' => $phong]);
    }
}
