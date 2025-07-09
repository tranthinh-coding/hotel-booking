<?php

namespace HotelBooking\Controllers\Admin;

use HotelBooking\Models\HoaDon;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Enums\PhanQuyen;

class AdminHoaDonController
{
    public function __construct()
    {
        $this->checkAdminAccess();
    }

    private function checkAdminAccess()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }
    }

    public function index()
    {
        $hoaDons = HoaDon::all();
        view('Admin.HoaDon/index', ['hoaDons' => $hoaDons]);
    }

    public function create()
    {
        $taiKhoans = TaiKhoan::all();
        view('Admin.HoaDon/create', ['taiKhoans' => $taiKhoans]);
    }

    public function store()
    {
        $data = [
            'ma_nhan_vien' => post('ma_nhan_vien', null),
            'ma_khach_hang' => post('ma_khach_hang', null),
            'thoi_gian_dat' => post('thoi_gian_dat', date('Y-m-d H:i:s')
        )];

        HoaDon::create($data);
        redirect('/admin/hoa-don?success=created');
    }

    public function show($id)
    {
        $hoaDon = HoaDon::find($id);
        
        if (!$hoaDon) {
            redirect('/admin/hoa-don?error=notfound');
        }

        view('Admin.HoaDon/show', ['hoaDon' => $hoaDon]);
    }

    public function edit($id)
    {
        $hoaDon = HoaDon::find($id);
        $taiKhoans = TaiKhoan::all();
        
        if (!$hoaDon) {
            redirect('/admin/hoa-don?error=notfound');
        }

        view('Admin.HoaDon/edit', ['hoaDon' => $hoaDon, 'taiKhoans' => $taiKhoans]);
    }

    public function update($id)
    {
        $hoaDon = HoaDon::find($id);
        if (!$hoaDon) {
            redirect('/admin/hoa-don?error=notfound');
        }

        $data = [
            'ma_nhan_vien' => post('ma_nhan_vien', $hoaDon->ma_nhan_vien),
            'ma_khach_hang' => post('ma_khach_hang', $hoaDon->ma_khach_hang),
            'thoi_gian_dat' => post('thoi_gian_dat', $hoaDon->thoi_gian_dat
        )];

        $hoaDon->update($data);
        redirect('/admin/hoa-don?success=updated');
    }

    public function destroy($id)
    {
        $hoaDon = HoaDon::find($id);
        if (!$hoaDon) {
            redirect('/admin/hoa-don?error=notfound');
        }

        $hoaDon->delete();
        redirect('/admin/hoa-don?success=deleted');
    }
}



