<?php

namespace HotelBooking\Controllers\Client;

use HotelBooking\Facades\DB;
use HotelBooking\Models\Phong;
use HotelBooking\Models\LoaiPhong;
use HotelBooking\Models\HinhAnh;
use HotelBooking\Models\HoaDon;

class PhongController
{
    public function index()
    {
        // Get search parameters
        $checkin = $_GET['checkin'] ?? '';
        $checkout = $_GET['checkout'] ?? '';
        $guests = $_GET['guests'] ?? 1;
        $roomType = $_GET['room_type'] ?? '';

        // Get available rooms based on search criteria
        if (isNotEmpty($checkin) && isNotEmpty($checkout)) {
            $phongs = Phong::searchAvailable($checkin, $checkout, $guests, $roomType);
        } else {
            // If no search criteria, show all active rooms (exclude deactivated)
            $query = Phong::newQuery();
            if (isNotEmpty($roomType)) {
                $query = $query->where('ma_loai_phong', '=', $roomType);
            }
            // Exclude deactivated rooms from client view
            $query = $query->where('trang_thai', '!=', \HotelBooking\Enums\TrangThaiPhong::NGUNG_HOAT_DONG);
            $phongs = $query->get();
        }

        // Get all room types for filter dropdown
        $loaiPhongs = LoaiPhong::all();

        view('Client.Phong.index', [
            'phongs' => $phongs,
            'loaiPhongs' => $loaiPhongs,
            'searchParams' => [
                'checkin' => $checkin,
                'checkout' => $checkout,
                'guests' => $guests,
                'room_type' => $roomType
            ]
        ]);
    }

    public function show()
    {
        $id = get('id');
        if (!$id) {
            redirect('/phong?error=missing_id');
        }

        $phong = Phong::find($id);
        if (!$phong) {
            http_response_code(404);
            echo "Phòng không tồn tại";
            return;
        }

        // Get room images
        $hinhAnhPhong = HinhAnh::getByPhong($id);
        
        // Get room type info
        $loaiPhong = null;
        if (isNotEmpty($phong->ma_loai_phong)) {
            $loaiPhong = LoaiPhong::find($phong->ma_loai_phong);
        }

        // Lấy danh sách đánh giá phòng
        $danhGias = \HotelBooking\Models\DanhGia::where('ma_phong', $id)->orderBy('ngay_gui', 'desc')->get();

        // Kiểm tra khách có thể đánh giá không (đã trả phòng)
        $canReview = false;
        if (auth_check()) {
            $userId = user()->ma_tai_khoan;
            $hasInvoice = DB::query(
                "SELECT * FROM hoa_don_tong
                JOIN hoa_don_phong ON hoa_don_tong.ma_hoa_don = hoa_don_phong.ma_hoa_don
                WHERE hoa_don_tong.ma_khach_hang = ? AND hoa_don_phong.ma_phong = ? AND hoa_don_tong.trang_thai = ?",
                [$userId, $id, \HotelBooking\Enums\TrangThaiHoaDon::DA_TRA_PHONG]
            );

            $hasReviewed = \HotelBooking\Models\DanhGia::where('ma_phong', $id)
                ->where('ma_khach_hang', $userId)
                ->first();
            if ($hasInvoice && !$hasReviewed) {
                $canReview = true;
            }
        }

        view('Client.Phong.show', [
            'phong' => $phong,
            'hinhAnhPhong' => $hinhAnhPhong,
            'loaiPhong' => $loaiPhong,
            'danhGias' => $danhGias,
            'canReview' => $canReview
        ]);
    }

    // Trang đánh giá phòng
    public function danhgia()
    {
        $id = get('phong_id');
        if (!$id) {
            redirect('/phong?error=missing_id');
        }

        $phong = Phong::find($id);
        if (!$phong) {
            http_response_code(404);
            echo "Phòng không tồn tại";
            return;
        }

        // Xử lý gửi đánh giá
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!auth_check()) {
                redirect('/login');
            }
            $userId = user()->ma_tai_khoan;
            $diem = (int)post('rating');
            $nhanXet = trim(post('comment'));
            // Kiểm tra hợp lệ
            $hasInvoice = \HotelBooking\Models\HoaDonPhong::where('ma_phong', $id)
                ->where('ma_tai_khoan', $userId)
                ->where('trang_thai', \HotelBooking\Enums\TrangThaiHoaDon::DA_TRA_PHONG)
                ->first();
            $hasReviewed = \HotelBooking\Models\DanhGia::where('ma_phong', $id)
                ->where('ma_khach_hang', $userId)
                ->first();
            if ($hasInvoice && !$hasReviewed && $diem >= 1 && $diem <= 5 && isNotEmpty($nhanXet)) {
                // Truyền đúng thứ tự: ma_hoa_don, ma_phong, ma_khach_hang, diem, nhanXet
                \HotelBooking\Models\DanhGia::createReview($hasInvoice->ma_hoa_don, $id, $userId, $diem, $nhanXet);
                redirect('/phong/danhgia?phong_id=' . $id . '&success=reviewed');
            } else {
                redirect('/phong/danhgia?phong_id=' . $id . '&error=invalid');
            }
        }

        // Lấy danh sách đánh giá phòng
        $danhGias = \HotelBooking\Models\DanhGia::where('ma_phong', $id)->orderBy('ngay_gui', 'desc')->get();

        // Kiểm tra khách có thể đánh giá không (đã trả phòng)
        $canReview = false;
        if (auth_check()) {
            $userId = user()->ma_tai_khoan;
            $hasInvoice = \HotelBooking\Models\HoaDonPhong::where('ma_phong', $id)
                ->where('ma_tai_khoan', $userId)
                ->where('trang_thai', \HotelBooking\Enums\TrangThaiHoaDon::DA_TRA_PHONG)
                ->first();
            $hasReviewed = \HotelBooking\Models\DanhGia::where('ma_phong', $id)
                ->where('ma_khach_hang', $userId)
                ->first();
            if ($hasInvoice && !$hasReviewed) {
                $canReview = true;
            }
        }

        view('Client.Phong.danhgia', [
            'phong' => $phong,
            'danhGias' => $danhGias,
            'canReview' => $canReview
        ]);
    }
}
