<?php

namespace HotelBooking\Controllers;

class NguoiDungController
{
    public function index()
    {
        // Lấy danh sách người dùng
        $danhSachNguoiDung = \HotelBooking\Models\NguoiDung::all();

        // Trả về view danh sách người dùng
        return view('nguoi_dung.index', ['danhSachNguoiDung' => $danhSachNguoiDung]);
    }

    public function show($id)
    {

    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit($id)
    {
    }

    public function update($id)
    {
    }

    public function destroy($id)
    {
    }

}
