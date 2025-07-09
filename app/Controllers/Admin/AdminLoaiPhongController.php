<?php

namespace HotelBooking\Controllers\Admin;

use HotelBooking\Models\LoaiPhong;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Enums\PhanQuyen;

class AdminLoaiPhongController
{
    public function __construct()
    {
        $this->checkAdminAccess();
    }

    private function checkAdminAccess()
    {
        if (auth_guest()) {
            redirect('/login');
        }

        $user = user();
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }
    }

    public function index()
    {
        $loaiPhongs = LoaiPhong::all();
        view('Admin.LoaiPhong/index', ['loaiPhongs' => $loaiPhongs]);
    }

    public function create()
    {
        view('Admin.LoaiPhong/create');
    }

    public function store()
    {
        $data = [
            'ten' => post('ten', '')
        ];

        LoaiPhong::create($data);
        redirect('/admin/loai-phong?success=created');
    }

    public function edit($id)
    {
        $loaiPhong = LoaiPhong::find($id);
        
        if (!$loaiPhong) {
            redirect('/admin/loai-phong?error=notfound');
        }

        view('Admin.LoaiPhong/edit', ['loaiPhong' => $loaiPhong]);
    }

    public function update($id)
    {
        $loaiPhong = LoaiPhong::find($id);
        if (!$loaiPhong) {
            redirect('/admin/loai-phong?error=notfound');
        }

        $data = [
            'ten' => post('ten', $loaiPhong->ten)
        ];

        $loaiPhong->update($data);
        redirect('/admin/loai-phong?success=updated');
    }

    public function destroy($id)
    {
        $loaiPhong = LoaiPhong::find($id);
        if (!$loaiPhong) {
            redirect('/admin/loai-phong?error=notfound');
        }

        $loaiPhong->delete();
        redirect('/admin/loai-phong?success=deleted');
    }
}



