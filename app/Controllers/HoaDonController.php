<?php

namespace HotelBooking\Controllers;

use HotelBooking\Models\HoaDon;
use HotelBooking\Models\TaiKhoan;

class HoaDonController
{
    public function index()
    {
        $hoaDons = HoaDon::all();
        view('HoaDon.index', ['hoaDons' => $hoaDons]);
    }

    public function create()
    {
        $nhanViens = TaiKhoan::all(); // You might want to filter by phan_quyen = 'nhan_vien'
        $khachHangs = TaiKhoan::all(); // You might want to filter by phan_quyen = 'khach_hang'
        view('HoaDon.create', ['nhanViens' => $nhanViens, 'khachHangs' => $khachHangs]);
    }

    public function store()
    {
        $data = [
            'ma_nhan_vien' => $_POST['ma_nhan_vien'],
            'ma_khach_hang' => $_POST['ma_khach_hang'],
            'thoi_gian_dat' => $_POST['thoi_gian_dat'] ?? date('Y-m-d H:i:s')
        ];

        $hoaDon = new HoaDon();
        $hoaDon->create($data);

        header('Location: /hoa-don');
        exit;
    }

    public function show($id)
    {
        $hoaDon = HoaDon::find($id);
        if (!$hoaDon) {
            http_response_code(404);
            echo "Hóa đơn không tồn tại";
            return;
        }
        view('HoaDon.show', ['hoaDon' => $hoaDon]);
    }

    public function edit($id)
    {
        $hoaDon = HoaDon::find($id);
        if (!$hoaDon) {
            http_response_code(404);
            echo "Hóa đơn không tồn tại";
            return;
        }
        $nhanViens = TaiKhoan::all();
        $khachHangs = TaiKhoan::all();
        view('HoaDon.edit', ['hoaDon' => $hoaDon, 'nhanViens' => $nhanViens, 'khachHangs' => $khachHangs]);
    }

    public function update($id)
    {
        $hoaDon = HoaDon::find($id);
        if (!$hoaDon) {
            http_response_code(404);
            echo "Hóa đơn không tồn tại";
            return;
        }

        $data = [
            'ma_nhan_vien' => $_POST['ma_nhan_vien'],
            'ma_khach_hang' => $_POST['ma_khach_hang'],
            'thoi_gian_dat' => $_POST['thoi_gian_dat']
        ];

        $hoaDon->update($data);

        header('Location: /hoa-don');
        exit;
    }

    public function destroy($id)
    {
        $hoaDon = HoaDon::find($id);
        if ($hoaDon) {
            $hoaDon->delete();
        }

        header('Location: /hoa-don');
        exit;
    }
}
