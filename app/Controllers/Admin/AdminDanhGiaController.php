<?php

namespace HotelBooking\Controllers\Admin;

use HotelBooking\Models\DanhGia;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Models\Phong;
use HotelBooking\Enums\PhanQuyen;

class AdminDanhGiaController
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
        $danhGias = DanhGia::all();
        view('Admin.DanhGia.index', ['danhGias' => $danhGias]);
    }

    public function create()
    {
        $taiKhoans = TaiKhoan::all();
        $phongs = Phong::all();
        view('Admin.DanhGia.create', ['taiKhoans' => $taiKhoans, 'phongs' => $phongs]);
    }

    public function store()
    {
        $data = [
            'ma_tai_khoan' => post('ma_tai_khoan'),
            'ma_phong' => post('ma_phong'),
            'diem_so' => post('diem_so', 5),
            'noi_dung' => post('noi_dung', ''),
            'ngay_danh_gia' => date('Y-m-d H:i:s')
        ];

        DanhGia::create($data);
        redirect('/admin/danh-gia?success=created');
    }

    public function show($id)
    {
        $danhGia = DanhGia::find($id);
        
        if (!$danhGia) {
            redirect('/admin/danh-gia?error=notfound');
        }

        view('Admin.DanhGia.show', ['danhGia' => $danhGia]);
    }

    public function edit($id)
    {
        $danhGia = DanhGia::find($id);
        $taiKhoans = TaiKhoan::all();
        $phongs = Phong::all();
        
        if (!$danhGia) {
            redirect('/admin/danh-gia?error=notfound');
        }

        view('Admin.DanhGia.edit', ['danhGia' => $danhGia, 'taiKhoans' => $taiKhoans, 'phongs' => $phongs]);
    }

    public function update($id)
    {
        $danhGia = DanhGia::find($id);
        if (!$danhGia) {
            redirect('/admin/danh-gia?error=notfound');
        }

        $data = [
            'ma_tai_khoan' => post('ma_tai_khoan', $danhGia->ma_tai_khoan),
            'ma_phong' => post('ma_phong', $danhGia->ma_phong),
            'diem_so' => post('diem_so', $danhGia->diem_so),
            'noi_dung' => post('noi_dung', $danhGia->noi_dung)
        ];

        $danhGia->update($data);
        redirect('/admin/danh-gia?success=updated');
    }

    public function destroy($id)
    {
        $danhGia = DanhGia::find($id);
        if (!$danhGia) {
            redirect('/admin/danh-gia?error=notfound');
        }

        $danhGia->delete();
        redirect('/admin/danh-gia?success=deleted');
    }
}



