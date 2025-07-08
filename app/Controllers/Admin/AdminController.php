<?php

namespace HotelBooking\Controllers\Admin;

require_once __DIR__ . '/../../Functions/functions.php';

use HotelBooking\Models\Phong;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Models\DanhGia;

class AdminController
{
    public function dashboard()
    {
        // Check admin access
        session_start_if_not_started();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !in_array($user->phan_quyen, ['Quản lý', 'Lễ tân'])) {
            header('Location: /');
            exit;
        }

        // Get dashboard statistics
        $totalRooms = count(Phong::all());
        $totalUsers = count(TaiKhoan::all());
        $totalReviews = count(DanhGia::all());
        $totalBookings = 0; // TODO: Implement when HoaDon model is ready

        view('admin/dashboard', [
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
        session_start_if_not_started();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !in_array($user->phan_quyen, ['Quản lý', 'Lễ tân'])) {
            header('Location: /');
            exit;
        }

        $taiKhoans = TaiKhoan::all();
        view('admin/tai-khoan/index', ['taiKhoans' => $taiKhoans]);
    }

    public function taiKhoanCreate()
    {
        session_start_if_not_started();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !in_array($user->phan_quyen, ['Quản lý', 'Lễ tân'])) {
            header('Location: /');
            exit;
        }

        view('admin/tai-khoan/create', []);
    }

    public function taiKhoanStore()
    {
        session_start_if_not_started();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !in_array($user->phan_quyen, ['Quản lý', 'Lễ tân'])) {
            header('Location: /');
            exit;
        }

        $data = [
            'ho_ten' => $_POST['ho_ten'] ?? '',
            'mail' => $_POST['mail'] ?? '',
            'so_cccd' => $_POST['so_cccd'] ?? '',
            'sdt' => $_POST['sdt'] ?? '',
            'phan_quyen' => $_POST['phan_quyen'] ?? 'Khách hàng'
        ];

        if (!empty($_POST['mat_khau'])) {
            $data['mat_khau'] = password_hash($_POST['mat_khau'], PASSWORD_DEFAULT);
        }

        TaiKhoan::create($data);
        flash_set('success', 'Tài khoản đã được tạo thành công!');
        redirect('/admin/tai-khoan');
    }

    public function taiKhoanEdit($id)
    {
        session_start_if_not_started();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !in_array($user->phan_quyen, ['Quản lý', 'Lễ tân'])) {
            header('Location: /');
            exit;
        }

        $taiKhoan = TaiKhoan::find($id);
        view('admin/tai-khoan/edit', ['taiKhoan' => $taiKhoan]);
    }

    public function taiKhoanUpdate($id)
    {
        session_start_if_not_started();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !in_array($user->phan_quyen, ['Quản lý', 'Lễ tân'])) {
            header('Location: /');
            exit;
        }

        $taiKhoan = TaiKhoan::find($id);
        $data = [
            'ho_ten' => $_POST['ho_ten'] ?? $taiKhoan->ho_ten,
            'mail' => $_POST['mail'] ?? $taiKhoan->mail,
            'so_cccd' => $_POST['so_cccd'] ?? $taiKhoan->so_cccd,
            'sdt' => $_POST['sdt'] ?? $taiKhoan->sdt,
            'phan_quyen' => $_POST['phan_quyen'] ?? $taiKhoan->phan_quyen
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
        session_start_if_not_started();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !in_array($user->phan_quyen, ['Quản lý', 'Lễ tân'])) {
            header('Location: /');
            exit;
        }

        $taiKhoan = TaiKhoan::find($id);
        if ($taiKhoan) {
            $taiKhoan->delete();
            flash_set('success', 'Tài khoản đã được xóa thành công!');
        }
        redirect('/admin/tai-khoan');
    }
}