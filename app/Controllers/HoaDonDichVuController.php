<?php

namespace HotelBooking\Controllers;

use HotelBooking\Models\HoaDonDichVu;
use HotelBooking\Models\DichVu;
use HotelBooking\Models\HoaDonPhong;

class HoaDonDichVuController
{
    public function index()
    {
        $hoaDonDichVus = HoaDonDichVu::all();
        view('HoaDonDichVu.index', ['hoaDonDichVus' => $hoaDonDichVus]);
    }

    public function create()
    {
        $dichVus = DichVu::all();
        $hoaDonPhongs = HoaDonPhong::all();
        view('HoaDonDichVu.create', ['dichVus' => $dichVus, 'hoaDonPhongs' => $hoaDonPhongs]);
    }

    public function store()
    {
        $data = [
            'ma_dich_vu' => $_POST['ma_dich_vu'],
            'gia' => $_POST['gia'],
            'ma_hd_phong' => $_POST['ma_hd_phong'],
            'thoi_gian' => $_POST['thoi_gian'] ?? date('Y-m-d H:i:s')
        ];

        $hoaDonDichVu = new HoaDonDichVu();
        $hoaDonDichVu->create($data);

        header('Location: /hoa-don-dich-vu');
        exit;
    }

    public function show($id)
    {
        $hoaDonDichVu = HoaDonDichVu::find($id);
        if (!$hoaDonDichVu) {
            http_response_code(404);
            echo "Hóa đơn dịch vụ không tồn tại";
            return;
        }
        view('HoaDonDichVu.show', ['hoaDonDichVu' => $hoaDonDichVu]);
    }

    public function edit($id)
    {
        $hoaDonDichVu = HoaDonDichVu::find($id);
        if (!$hoaDonDichVu) {
            http_response_code(404);
            echo "Hóa đơn dịch vụ không tồn tại";
            return;
        }
        $dichVus = DichVu::all();
        $hoaDonPhongs = HoaDonPhong::all();
        view('HoaDonDichVu.edit', ['hoaDonDichVu' => $hoaDonDichVu, 'dichVus' => $dichVus, 'hoaDonPhongs' => $hoaDonPhongs]);
    }

    public function update($id)
    {
        $hoaDonDichVu = HoaDonDichVu::find($id);
        if (!$hoaDonDichVu) {
            http_response_code(404);
            echo "Hóa đơn dịch vụ không tồn tại";
            return;
        }

        $data = [
            'ma_dich_vu' => $_POST['ma_dich_vu'],
            'gia' => $_POST['gia'],
            'ma_hd_phong' => $_POST['ma_hd_phong'],
            'thoi_gian' => $_POST['thoi_gian']
        ];

        $hoaDonDichVu->update($data);

        header('Location: /hoa-don-dich-vu');
        exit;
    }

    public function destroy($id)
    {
        $hoaDonDichVu = HoaDonDichVu::find($id);
        if ($hoaDonDichVu) {
            $hoaDonDichVu->delete();
        }

        header('Location: /hoa-don-dich-vu');
        exit;
    }
}
