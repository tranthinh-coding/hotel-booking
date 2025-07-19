<?php

namespace HotelBooking\Controllers\Admin;

use HotelBooking\Models\TaiKhoan;
use HotelBooking\Enums\PhanQuyen;
use HotelBooking\Enums\TrangThaiTaiKhoan;

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
        // Get search parameters
        $search = get('search', '');
        $role = get('role', '');
        $status = get('status', '');
        $sort = get('sort', 'ngay_tao');

        // Get all accounts
        $allTaiKhoans = TaiKhoan::all();
        $taiKhoans = $allTaiKhoans;
        
        // Apply search filter
        if (!isEmpty($search)) {
            $taiKhoans = array_filter($taiKhoans, function($tk) use ($search) {
                return stripos($tk->ho_ten, $search) !== false ||
                       stripos($tk->mail, $search) !== false ||
                       stripos($tk->sdt ?? '', $search) !== false;
            });
        }

        // Apply role filter
        if (!isEmpty($role)) {
            $taiKhoans = array_filter($taiKhoans, function($tk) use ($role) {
                return $tk->phan_quyen === $role;
            });
        }

        // Apply status filter
        if (!isEmpty($status)) {
            $taiKhoans = array_filter($taiKhoans, function($tk) use ($status) {
                return ($tk->trang_thai ?? TrangThaiTaiKhoan::HOAT_DONG) === $status;
            });
        }

        // Apply sorting
        usort($taiKhoans, function($a, $b) use ($sort) {
            if ($sort === 'ho_ten') {
                return strcmp($a->ho_ten, $b->ho_ten);
            } elseif ($sort === 'mail') {
                return strcmp($a->mail, $b->mail);
            } else {
                return strtotime($b->ngay_tao ?? 'now') - strtotime($a->ngay_tao ?? 'now');
            }
        });

        // Calculate statistics
        $stats = [
            'total' => count($allTaiKhoans),
            'active' => count(array_filter($allTaiKhoans, fn($tk) => ($tk->trang_thai ?? TrangThaiTaiKhoan::HOAT_DONG) === TrangThaiTaiKhoan::HOAT_DONG)),
            'suspended' => count(array_filter($allTaiKhoans, fn($tk) => ($tk->trang_thai ?? TrangThaiTaiKhoan::HOAT_DONG) === TrangThaiTaiKhoan::TAM_KHOA)),
            'blocked' => count(array_filter($allTaiKhoans, fn($tk) => ($tk->trang_thai ?? TrangThaiTaiKhoan::HOAT_DONG) === TrangThaiTaiKhoan::BI_KHOA)),
            'managers' => count(array_filter($allTaiKhoans, fn($tk) => $tk->phan_quyen === PhanQuyen::QUAN_LY)),
        ];

        view('Admin.TaiKhoan.index', [
            'taiKhoans' => $taiKhoans,
            'stats' => $stats
        ]);
    }

    public function show()
    {
        $id = get('id');
        if (!$id) {
            redirect('/admin/tai-khoan?error=missing_id');
        }

        $taiKhoan = TaiKhoan::find($id);
        
        if (!$taiKhoan) {
            redirect('/admin/tai-khoan?error=notfound');
        }

        view('Admin.TaiKhoan.show', ['taiKhoan' => $taiKhoan]);
    }

    public function create()
    {
        view('Admin.TaiKhoan.create');
    }

    public function store()
    {
        $user = TaiKhoan::find($_SESSION['user_id']);
        $phan_quyen = post('phan_quyen', PhanQuyen::KHACH_HANG);
        // Lễ tân chỉ được tạo tài khoản khách hàng
        if ($user->phan_quyen === PhanQuyen::LE_TAN && $phan_quyen !== PhanQuyen::KHACH_HANG) {
            redirect('/admin/tai-khoan?error=forbidden');
        }
        $data = [
            'ho_ten' => post('ho_ten', ''),
            'mail' => post('mail', ''),
            'so_cccd' => post('so_cccd', ''),
            'sdt' => post('sdt', ''),
            'phan_quyen' => $phan_quyen,
            'ngay_tao' => date('Y-m-d H:i:s')
        ];
        if (isNotEmpty($_POST['mat_khau'])) {
            $data['mat_khau'] = password_hash($_POST['mat_khau'], PASSWORD_DEFAULT);
        }
        TaiKhoan::create($data);
        redirect('/admin/tai-khoan?success=created');
    }

    public function edit()
    {
        $id = get('id');
        if (!$id) {
            redirect('/admin/tai-khoan?error=missing_id');
        }

        $taiKhoan = TaiKhoan::find($id);
        
        if (!$taiKhoan) {
            redirect('/admin/tai-khoan?error=notfound');
        }

        view('Admin.TaiKhoan.edit', ['taiKhoan' => $taiKhoan]);
    }

    public function update()
    {
        $user = TaiKhoan::find($_SESSION['user_id']);
        $id = get('id');
        if (!$id) {
            redirect('/admin/tai-khoan?error=missing_id');
        }
        $taiKhoan = TaiKhoan::find($id);
        if (!$taiKhoan) {
            redirect('/admin/tai-khoan?error=notfound');
        }
        $phan_quyen = post('phan_quyen', $taiKhoan->phan_quyen);
        // Lễ tân chỉ được cập nhật tài khoản khách hàng
        if ($user->phan_quyen === PhanQuyen::LE_TAN && $taiKhoan->phan_quyen !== PhanQuyen::KHACH_HANG) {
            redirect('/admin/tai-khoan?error=forbidden');
        }
        if ($user->phan_quyen === PhanQuyen::LE_TAN && $phan_quyen !== PhanQuyen::KHACH_HANG) {
            redirect('/admin/tai-khoan?error=forbidden');
        }
        $data = [
            'ho_ten' => post('ho_ten', $taiKhoan->ho_ten),
            'mail' => post('mail', $taiKhoan->mail),
            'so_cccd' => post('so_cccd', $taiKhoan->so_cccd),
            'sdt' => post('sdt', $taiKhoan->sdt),
            'phan_quyen' => $phan_quyen
        ];
        if (isNotEmpty($_POST['mat_khau'])) {
            $data['mat_khau'] = password_hash($_POST['mat_khau'], PASSWORD_DEFAULT);
        }
        $taiKhoan->update($data);
        redirect('/admin/tai-khoan?success=updated');
    }

    public function updateStatus()
    {
        $maTaiKhoan = post('ma_tai_khoan');
        $trangThai = post('trang_thai');

        if (isEmpty($maTaiKhoan) || isEmpty($trangThai)) {
            redirect('/admin/tai-khoan?error=missing_data');
        }

        $taiKhoan = TaiKhoan::find($maTaiKhoan);
        if (!$taiKhoan) {
            redirect('/admin/tai-khoan?error=notfound');
        }

        // Validate status
        if (!in_array($trangThai, TrangThaiTaiKhoan::all())) {
            redirect('/admin/tai-khoan?error=invalid_status');
        }

        // Update status
        $taiKhoan->update(['trang_thai' => $trangThai]);
        redirect('/admin/tai-khoan?success=status_updated');
    }
}



