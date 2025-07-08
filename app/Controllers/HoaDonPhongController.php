<?php

namespace HotelBooking\Controllers;

use HotelBooking\Models\HoaDonPhong;
use HotelBooking\Models\Phong;
use HotelBooking\Models\HoaDon;

class HoaDonPhongController
{
    public function index()
    {
        $hoaDonPhongs = HoaDonPhong::all();
        view('HoaDonPhong.index', ['hoaDonPhongs' => $hoaDonPhongs]);
    }

    public function create()
    {
        $phongs = Phong::all();
        $hoaDons = HoaDon::all();
        view('HoaDonPhong.create', ['phongs' => $phongs, 'hoaDons' => $hoaDons]);
    }

    public function store()
    {
        $data = [
            'check_in' => $_POST['check_in'],
            'check_out' => $_POST['check_out'],
            'ma_phong' => $_POST['ma_phong'],
            'gia' => $_POST['gia'],
            'ma_hoa_don' => $_POST['ma_hoa_don']
        ];

        $hoaDonPhong = new HoaDonPhong();
        $hoaDonPhong->create($data);

        header('Location: /hoa-don-phong');
        exit;
    }

    public function show($id)
    {
        $hoaDonPhong = HoaDonPhong::find($id);
        if (!$hoaDonPhong) {
            http_response_code(404);
            echo "Hóa đơn phòng không tồn tại";
            return;
        }
        view('HoaDonPhong.show', ['hoaDonPhong' => $hoaDonPhong]);
    }

    public function edit($id)
    {
        $hoaDonPhong = HoaDonPhong::find($id);
        if (!$hoaDonPhong) {
            http_response_code(404);
            echo "Hóa đơn phòng không tồn tại";
            return;
        }
        $phongs = Phong::all();
        $hoaDons = HoaDon::all();
        view('HoaDonPhong.edit', ['hoaDonPhong' => $hoaDonPhong, 'phongs' => $phongs, 'hoaDons' => $hoaDons]);
    }

    public function update($id)
    {
        $hoaDonPhong = HoaDonPhong::find($id);
        if (!$hoaDonPhong) {
            http_response_code(404);
            echo "Hóa đơn phòng không tồn tại";
            return;
        }

        $data = [
            'check_in' => $_POST['check_in'],
            'check_out' => $_POST['check_out'],
            'ma_phong' => $_POST['ma_phong'],
            'gia' => $_POST['gia'],
            'ma_hoa_don' => $_POST['ma_hoa_don']
        ];

        $hoaDonPhong->update($data);

        header('Location: /hoa-don-phong');
        exit;
    }

    public function destroy($id)
    {
        $hoaDonPhong = HoaDonPhong::find($id);
        if ($hoaDonPhong) {
            $hoaDonPhong->delete();
        }

        header('Location: /hoa-don-phong');
        exit;
    }
}
