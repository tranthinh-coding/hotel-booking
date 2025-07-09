<?php

namespace HotelBooking\Controllers\Admin;

use HotelBooking\Models\TaiKhoan;
use HotelBooking\Enums\PhanQuyen;

class AdminTaiKhoanController
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
        $taiKhoans = TaiKhoan::all();
        view('Admin.TaiKhoan/index', ['taiKhoans' => $taiKhoans]);
    }

    public function create()
    {
        view('Admin.TaiKhoan/create');
    }

    public function store()
    {
        $data = [
            'ho_ten' => post('ho_ten', ''),
            'mail' => post('mail', ''),
            'so_cccd' => post('so_cccd', ''),
            'sdt' => post('sdt', ''),
            'phan_quyen' => post('phan_quyen', PhanQuyen::KHACH_HANG
        )];

        if (!empty($_POST['mat_khau'])) {
            $data['mat_khau'] = password_hash($_POST['mat_khau'], PASSWORD_DEFAULT);
        }

        TaiKhoan::create($data);
        redirect('/admin/tai-khoan?success=created');
    }

    public function edit($id)
    {
        $taiKhoan = TaiKhoan::find($id);
        
        if (!$taiKhoan) {
            redirect('/admin/tai-khoan?error=notfound');
        }

        view('Admin.TaiKhoan/edit', ['taiKhoan' => $taiKhoan]);
    }

    public function update($id)
    {
        $taiKhoan = TaiKhoan::find($id);
        if (!$taiKhoan) {
            redirect('/admin/tai-khoan?error=notfound');
        }

        $data = [
            'ho_ten' => post('ho_ten', $taiKhoan->ho_ten),
            'mail' => post('mail', $taiKhoan->mail),
            'so_cccd' => post('so_cccd', $taiKhoan->so_cccd),
            'sdt' => post('sdt', $taiKhoan->sdt),
            'phan_quyen' => post('phan_quyen', $taiKhoan->phan_quyen
        )];

        if (!empty($_POST['mat_khau'])) {
            $data['mat_khau'] = password_hash($_POST['mat_khau'], PASSWORD_DEFAULT);
        }

        $taiKhoan->update($data);
        redirect('/admin/tai-khoan?success=updated');
    }

    public function destroy($id)
    {
        $taiKhoan = TaiKhoan::find($id);
        if (!$taiKhoan) {
            redirect('/admin/tai-khoan?error=notfound');
        }

        $taiKhoan->delete();
        redirect('/admin/tai-khoan?success=deleted');
    }
}



