<?php

namespace HotelBooking\Controllers\Client;

use HotelBooking\Models\Phong;
use HotelBooking\Models\LoaiPhong;

class PhongController
{
    public function index()
    {
        // Get search parameters
        $checkin = $_GET['checkin'] ?? '';
        $checkout = $_GET['checkout'] ?? '';
        $guests = $_GET['guests'] ?? 1;
        $roomType = $_GET['room_type'] ?? '';

        // Get available rooms based on search criteria
        if (!empty($checkin) && !empty($checkout)) {
            $phongs = Phong::searchAvailable($checkin, $checkout, $guests, $roomType);
        } else {
            // If no search criteria, show all rooms
            $query = Phong::query();
            if (!empty($roomType)) {
                $query = $query->where('ma_loai_phong', '=', $roomType);
            }
            $phongs = $query->get();
        }

        // Get all room types for filter dropdown
        $loaiPhongs = LoaiPhong::all();

        view('Client.Phong.index', [
            'phongs' => $phongs,
            'loaiPhongs' => $loaiPhongs,
            'searchParams' => [
                'checkin' => $checkin,
                'checkout' => $checkout,
                'guests' => $guests,
                'room_type' => $roomType
            ]
        ]);
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
