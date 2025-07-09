<?php

namespace HotelBooking\Controllers\Client;

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

        view('Client.Home.home_new', [
            'danhGias' => $danhGias,
            'phongs' => $phongs,
            'danhMucPhongs' => $danhMucPhongs
        ]);
    }

    public function searchRooms()
    {
        $checkin = post('checkin', '');
        $checkout = post('checkout', '');
        $guests = post('guests', 1);
        $room_type = post('room_type', '');

        // Basic room search logic
        $availableRooms = Phong::searchAvailable($checkin, $checkout, $guests, $room_type);

        view('Client.Phong.search_results', [
            'rooms' => $availableRooms,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'guests' => $guests,
            'room_type' => $room_type
        ]);
    }

    public function about()
    {
        view('Client.Home.about');
    }

    public function showSearchForm()
    {
        $danhMucPhongs = DanhMucPhong::all();
        view('Client.Phong.search-form', [
            'danhMucPhongs' => $danhMucPhongs
        ]);
    }

    public function contact()
    {
        view('Client.Home.contact');
    }

    public function sendContact()
    {
        $name = post('name', '');
        $email = post('email', '');
        $message = post('message', '');

        // Basic validation
        if (empty($name) || empty($email) || empty($message)) {
            flash_error('Vui lòng nhập đầy đủ thông tin');
            set_old_input();
            back();
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            flash_error('Email không hợp lệ');
            set_old_input();
            back();
            return;
        }

        // Here you would normally send email or save to database
        // For now, just show success message
        flash_success('Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.');
        clear_old_input();
        redirect('/contact');
    }
}
