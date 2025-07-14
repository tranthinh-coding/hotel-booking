<?php

namespace HotelBooking\Controllers\Admin;

use HotelBooking\Models\Phong;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Models\DanhGia;
use HotelBooking\Enums\PhanQuyen;

class AdminController
{
    public function dashboard()
    {
        // Check admin access
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }

        // Get dashboard statistics
        $totalRooms = count(Phong::all());
        $totalUsers = count(TaiKhoan::all());
        $totalReviews = count(DanhGia::all());
        $totalBookings = 0; // TODO: Implement when HoaDon model is ready

        view('Admin.Dashboard.index', [
            'totalRooms' => $totalRooms,
            'totalUsers' => $totalUsers,
            'totalReviews' => $totalReviews,
            'totalBookings' => $totalBookings,
            'user' => $user
        ]);
    }

    // Quản lý tài khoản
    public function taiKhoanIndex()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }

        $taiKhoans = TaiKhoan::all();
        view('Admin.TaiKhoan.index', ['taiKhoans' => $taiKhoans]);
    }

    public function taiKhoanCreate()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }

        view('Admin.TaiKhoan.create', []);
    }

    public function taiKhoanStore()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }

        $data = [
            'ho_ten' => post('ho_ten', ''),
            'mail' => post('mail', ''),
            'so_cccd' => post('so_cccd', ''),
            'sdt' => post('sdt', ''),
            'phan_quyen' => post(
                'phan_quyen',
                PhanQuyen::KHACH_HANG
            )
        ];

        if (!$_POST['mat_khau']) {
            $data['mat_khau'] = password_hash($_POST['mat_khau'], PASSWORD_DEFAULT);
        }

        TaiKhoan::create($data);
        flash_set('success', 'Tài khoản đã được tạo thành công!');
        redirect('/admin/tai-khoan');
    }

    public function taiKhoanEdit($id)
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }

        $taiKhoan = TaiKhoan::find($id);
        view('Admin.TaiKhoan.edit', ['taiKhoan' => $taiKhoan]);
    }

    public function taiKhoanUpdate($id)
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }

        $taiKhoan = TaiKhoan::find($id);
        $data = [
            'ho_ten' => post('ho_ten', $taiKhoan->ho_ten),
            'mail' => post('mail', $taiKhoan->mail),
            'so_cccd' => post('so_cccd', $taiKhoan->so_cccd),
            'sdt' => post('sdt', $taiKhoan->sdt),
            'phan_quyen' => post(
                'phan_quyen',
                $taiKhoan->phan_quyen
            )
        ];

        if (!empty($_POST['mat_khau'])) {
            $data['mat_khau'] = password_hash($_POST['mat_khau'], PASSWORD_DEFAULT);
        }

        $taiKhoan->update($data);
        flash_set('success', 'Tài khoản đã được cập nhật thành công!');
        redirect('/admin/tai-khoan');
    }

    public function taiKhoanDestroy($id)
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }

        $taiKhoan = TaiKhoan::find($id);
        if ($taiKhoan) {
            $taiKhoan->delete();
            flash_set('success', 'Tài khoản đã được xóa thành công!');
        }
        redirect('/admin/tai-khoan');
    }
}


