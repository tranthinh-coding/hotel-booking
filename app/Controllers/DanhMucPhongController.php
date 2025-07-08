<?php

namespace HotelBooking\Controllers;

use HotelBooking\Models\DanhMucPhong;
use HotelBooking\Models\DanhMuc;
use HotelBooking\Models\Phong;

class DanhMucPhongController
{
    public function index()
    {
        $danhMucPhongs = DanhMucPhong::all();
        view('DanhMucPhong.index', ['danhMucPhongs' => $danhMucPhongs]);
    }

    public function create()
    {
        $danhMucs = DanhMuc::all();
        $phongs = Phong::all();
        view('DanhMucPhong.create', ['danhMucs' => $danhMucs, 'phongs' => $phongs]);
    }

    public function store()
    {
        $data = [
            'ma_danh_muc' => post('ma_danh_muc'),
            'ma_phong' => post('ma_phong')
        ];

        $danhMucPhong = new DanhMucPhong();
        $danhMucPhong->create($data);

        flash_set('success', 'Thêm quan hệ danh mục phòng thành công');
        redirect('/danh-muc-phong');
    }

    public function show($danhMucId, $phongId)
    {
        // For composite key, this would need custom implementation
        // For now, we'll just show all records
        $danhMucPhongs = DanhMucPhong::all();
        view('DanhMucPhong.show', ['danhMucPhongs' => $danhMucPhongs]);
    }

    public function destroy($danhMucId, $phongId)
    {
        // For composite key deletion, this would need custom implementation
        // For now, we'll redirect back
        flash_set('info', 'Chức năng xóa sẽ được triển khai sau');
        redirect('/danh-muc-phong');
    }
}
