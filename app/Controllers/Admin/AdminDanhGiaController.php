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
        // Get search parameters
        $search = get('search', '');
        $rating = get('rating', '');
        $sort = get('sort', 'ngay_danh_gia');

        // Get all reviews
        $allDanhGias = DanhGia::all();
        $danhGias = $allDanhGias;
        
        // Apply search filter
        if (!isEmpty($search)) {
            $danhGias = array_filter($danhGias, function($dg) use ($search) {
                return stripos($dg->noi_dung ?? '', $search) !== false;
            });
        }

        // Apply rating filter
        if (!isEmpty($rating)) {
            $danhGias = array_filter($danhGias, function($dg) use ($rating) {
                return $dg->diem_danh_gia == $rating;
            });
        }

        // Apply sorting
        usort($danhGias, function($a, $b) use ($sort) {
            if ($sort === 'diem_danh_gia') {
                return $b->diem_danh_gia - $a->diem_danh_gia;
            } elseif ($sort === 'noi_dung') {
                return strcmp($a->noi_dung ?? '', $b->noi_dung ?? '');
            } else {
                return strtotime($b->ngay_danh_gia ?? 'now') - strtotime($a->ngay_danh_gia ?? 'now');
            }
        });

        // Calculate statistics
        $totalReviews = count($allDanhGias);
        $avgRating = $totalReviews > 0 ? array_sum(array_column($allDanhGias, 'diem_danh_gia')) / $totalReviews : 0;
        
        $stats = [
            'total' => $totalReviews,
            'average_rating' => round($avgRating, 1),
            'five_star' => count(array_filter($allDanhGias, fn($dg) => $dg->diem_danh_gia == 5)),
            'four_star' => count(array_filter($allDanhGias, fn($dg) => $dg->diem_danh_gia == 4)),
        ];

        view('Admin.DanhGia.index', [
            'danhGias' => $danhGias,
            'stats' => $stats
        ]);
    }

    public function show()
    {
        $id = get('id');
        if (!$id) {
            redirect('/admin/danh-gia?error=missing_id');
        }

        $danhGia = DanhGia::find($id);
        
        if (!$danhGia) {
            redirect('/admin/danh-gia?error=notfound');
        }

        view('Admin.DanhGia.show', ['danhGia' => $danhGia]);
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
            'diem_danh_gia' => post('diem_danh_gia', 5),
            'noi_dung' => post('noi_dung', ''),
            'ngay_danh_gia' => date('Y-m-d H:i:s')
        ];

        DanhGia::create($data);
        redirect('/admin/danh-gia?success=created');
    }

    public function edit()
    {
        $id = get('id');
        if (!$id) {
            redirect('/admin/danh-gia?error=missing_id');
        }

        $danhGia = DanhGia::find($id);
        $taiKhoans = TaiKhoan::all();
        $phongs = Phong::all();
        
        if (!$danhGia) {
            redirect('/admin/danh-gia?error=notfound');
        }

        view('Admin.DanhGia.edit', ['danhGia' => $danhGia, 'taiKhoans' => $taiKhoans, 'phongs' => $phongs]);
    }

    public function update()
    {
        $id = get('id');
        if (!$id) {
            redirect('/admin/danh-gia?error=missing_id');
        }

        $danhGia = DanhGia::find($id);
        if (!$danhGia) {
            redirect('/admin/danh-gia?error=notfound');
        }

        $data = [
            'ma_tai_khoan' => post('ma_tai_khoan', $danhGia->ma_tai_khoan),
            'ma_phong' => post('ma_phong', $danhGia->ma_phong),
            'diem_danh_gia' => post('diem_danh_gia', $danhGia->diem_danh_gia),
            'noi_dung' => post('noi_dung', $danhGia->noi_dung)
        ];

        $danhGia->update($data);
        redirect('/admin/danh-gia?success=updated');
    }
}



