<?php

namespace HotelBooking\Controllers;

use HotelBooking\Models\DanhGia;
use HotelBooking\Models\Phong;
use HotelBooking\Models\TaiKhoan;

class DanhGiaController
{
    public function index()
    {
        $danhGias = DanhGia::all();
        view('DanhGia.index', ['danhGias' => $danhGias]);
    }

    public function create()
    {
        $phongs = Phong::all();
        $khachHangs = TaiKhoan::all(); // You might want to filter by phan_quyen = 'khach_hang'
        view('DanhGia.create', ['phongs' => $phongs, 'khachHangs' => $khachHangs]);
    }

    public function store()
    {
        $data = [
            'ma_phong' => post('ma_phong'),
            'ma_khach_hang' => post('ma_khach_hang'),
            'noi_dung' => post('noi_dung'),
            'diem_danh_gia' => post('diem_danh_gia'),
            'ngay_gui' => date('Y-m-d H:i:s')
        ];

        $danhGia = new DanhGia();
        $danhGia->create($data);

        flash_set('success', 'Thêm đánh giá thành công');
        redirect('/danh-gia');
    }

    public function show($id)
    {
        $danhGia = DanhGia::find($id);
        if (!$danhGia) {
            http_response_code(404);
            echo "Đánh giá không tồn tại";
            return;
        }
        view('DanhGia.show', ['danhGia' => $danhGia]);
    }

    public function edit($id)
    {
        $danhGia = DanhGia::find($id);
        if (!$danhGia) {
            http_response_code(404);
            echo "Đánh giá không tồn tại";
            return;
        }
        $phongs = Phong::all();
        $khachHangs = TaiKhoan::all();
        view('DanhGia.edit', ['danhGia' => $danhGia, 'phongs' => $phongs, 'khachHangs' => $khachHangs]);
    }

    public function update($id)
    {
        $danhGia = DanhGia::find($id);
        if (!$danhGia) {
            http_response_code(404);
            echo "Đánh giá không tồn tại";
            return;
        }

        $data = [
            'ma_phong' => post('ma_phong'),
            'ma_khach_hang' => post('ma_khach_hang'),
            'noi_dung' => post('noi_dung'),
            'diem_danh_gia' => post('diem_danh_gia')
        ];

        $danhGia->update($data);

        flash_set('success', 'Cập nhật đánh giá thành công');
        redirect('/danh-gia');
    }

    public function destroy($id)
    {
        $danhGia = DanhGia::find($id);
        if ($danhGia) {
            $danhGia->delete();
            flash_set('success', 'Xóa đánh giá thành công');
        }

        redirect('/danh-gia');
    }
}
