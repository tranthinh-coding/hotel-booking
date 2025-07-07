<?php

namespace HotelBooking\Controllers;

class NguoiDungController
{
    public function index()
    {
        // Lấy danh sách người dùng
        $danhSachNguoiDung = \HotelBooking\Models\NguoiDung::all();

        // Trả về view danh sách người dùng
        return view('NguoiDung.index', compact('danhSachNguoiDung'));
    }

    public function show($id)
    {

    }

    public function create()
    {
        // Trả về view tạo người dùng mới
        return view('NguoiDung.create');
    }

    public function store()
    {

    }

    public function edit()
    {
        $id = get('id');

        // Lấy thông tin người dùng theo ID
        $nguoiDung = \HotelBooking\Models\NguoiDung::find($id);

        // Trả về view chỉnh sửa người dùng
        return view('NguoiDung.edit', ['nguoiDung' => $nguoiDung]);
    }

    public function update()
    {
    }

    public function destroy()
    {
        $id = get('id');

        // Xóa người dùng theo ID
        \HotelBooking\Models\NguoiDung::find($id)->delete();

        // Chuyển hướng về danh sách người dùng
        redirect('?controller=NguoiDungController&action=index');
    }

}
