<?php

namespace HotelBooking\Controllers\Admin;

require_once __DIR__ . '/../../Functions/functions.php';

use HotelBooking\Models\Phong;
use HotelBooking\Models\DanhMucPhong;
use HotelBooking\Models\TaiKhoan;

class AdminPhongController
{
    public function __construct()
    {
        $this->checkAdminAccess();
    }

    private function checkAdminAccess()
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
    }

    public function index()
    {
        $phongs = Phong::all();
        $title = 'Quản lý phòng - Ocean Pearl Hotel';
        
        // Capture the content
        ob_start();
        include __DIR__ . '/../../Views/admin/phong/index.php';
        $content = ob_get_clean();
        
        include __DIR__ . '/../../Views/layouts/admin.php';
    }

    public function create()
    {
        $danhMucPhongs = DanhMucPhong::all();
        $title = 'Thêm phòng mới - Ocean Pearl Hotel';
        
        // Capture the content
        ob_start();
        include __DIR__ . '/../../Views/admin/phong/create.php';
        $content = ob_get_clean();
        
        include __DIR__ . '/../../Views/layouts/admin.php';
    }

    public function store()
    {
        $data = [
            'ten_phong' => $_POST['ten_phong'] ?? '',
            'mo_ta' => $_POST['mo_ta'] ?? '',
            'gia' => $_POST['gia'] ?? 0,
            'ma_danh_muc' => $_POST['ma_danh_muc'] ?? null,
            'so_khach_toi_da' => $_POST['so_khach_toi_da'] ?? 2,
            'trang_thai' => $_POST['trang_thai'] ?? 'Còn trống'
        ];

        Phong::create($data);
        header('Location: /admin/phong?success=created');
        exit;
    }

    public function edit($id)
    {
        $phong = Phong::find($id);
        $danhMucPhongs = DanhMucPhong::all();
        
        if (!$phong) {
            header('Location: /admin/phong?error=notfound');
            exit;
        }

        $title = 'Chỉnh sửa phòng - Ocean Pearl Hotel';
        
        // Capture the content
        ob_start();
        include __DIR__ . '/../../Views/admin/phong/edit.php';
        $content = ob_get_clean();
        
        include __DIR__ . '/../../Views/layouts/admin.php';
    }

    public function update($id)
    {
        $phong = Phong::find($id);
        if (!$phong) {
            header('Location: /admin/phong?error=notfound');
            exit;
        }

        $data = [
            'ten_phong' => $_POST['ten_phong'] ?? $phong->ten_phong,
            'mo_ta' => $_POST['mo_ta'] ?? $phong->mo_ta,
            'gia' => $_POST['gia'] ?? $phong->gia,
            'ma_danh_muc' => $_POST['ma_danh_muc'] ?? $phong->ma_danh_muc,
            'so_khach_toi_da' => $_POST['so_khach_toi_da'] ?? $phong->so_khach_toi_da,
            'trang_thai' => $_POST['trang_thai'] ?? $phong->trang_thai
        ];

        $phong->update($data);
        header('Location: /admin/phong?success=updated');
        exit;
    }

    public function destroy($id)
    {
        $phong = Phong::find($id);
        if (!$phong) {
            header('Location: /admin/phong?error=notfound');
            exit;
        }

        $phong->delete();
        header('Location: /admin/phong?success=deleted');
        exit;
    }
}
