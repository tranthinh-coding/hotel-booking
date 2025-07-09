<?php

namespace HotelBooking\Controllers\Admin;

use HotelBooking\Models\Phong;
use HotelBooking\Models\LoaiPhong;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Enums\PhanQuyen;

class AdminPhongController
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
        $phongs = Phong::all();
        view('Admin.Phong/index', ['phongs' => $phongs]);
    }

    public function create()
    {
        $loaiPhongs = LoaiPhong::all();
        view('Admin.Phong/create', ['loaiPhongs' => $loaiPhongs]);
    }

    public function store()
    {
        $data = [
            'ten_phong' => post('ten_phong', ''),
            'mo_ta' => post('mo_ta', ''),
            'gia' => post('gia', 0),
            'ma_loai_phong' => post('ma_loai_phong', null),
            'so_khach_toi_da' => post('so_khach_toi_da', 2),
            'trang_thai' => post('trang_thai', \HotelBooking\Enums\TrangThaiPhong::CON_TRONG
        )];

        Phong::create($data);
        redirect('/admin/phong?success=created');
    }

    public function edit($id)
    {
        $phong = Phong::find($id);
        $loaiPhongs = LoaiPhong::all();
        
        if (!$phong) {
            redirect('/admin/phong?error=notfound');
        }

        view('Admin.Phong/edit', ['phong' => $phong, 'loaiPhongs' => $loaiPhongs]);
    }

    public function update($id)
    {
        $phong = Phong::find($id);
        if (!$phong) {
            redirect('/admin/phong?error=notfound');
        }

        $data = [
            'ten_phong' => post('ten_phong', $phong->ten_phong),
            'mo_ta' => post('mo_ta', $phong->mo_ta),
            'gia' => post('gia', $phong->gia),
            'ma_loai_phong' => post('ma_loai_phong', $phong->ma_loai_phong),
            'so_khach_toi_da' => post('so_khach_toi_da', $phong->so_khach_toi_da),
            'trang_thai' => post('trang_thai', $phong->trang_thai
        )];

        $phong->update($data);
        redirect('/admin/phong?success=updated');
    }

    public function destroy($id)
    {
        $phong = Phong::find($id);
        if (!$phong) {
            redirect('/admin/phong?error=notfound');
        }

        $phong->delete();
        redirect('/admin/phong?success=deleted');
    }
}



