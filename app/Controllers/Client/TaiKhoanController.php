<?php

namespace HotelBooking\Controllers\Client;

use HotelBooking\Models\TaiKhoan;
use HotelBooking\Models\HoaDon;
use HotelBooking\Models\HoaDonPhong;
use HotelBooking\Models\DanhGia;
use HotelBooking\Models\Phong;
use HotelBooking\Enums\TrangThaiHoaDon;
use Exception;

class TaiKhoanController
{
    /**
     * Kiểm tra đăng nhập
     */
    private function checkAuth()
    {
        if (!isset($_SESSION['user_id'])) {
            flash_error('Vui lòng đăng nhập để tiếp tục');
            redirect('/login');
            return false;
        }
        return true;
    }

    /**
     * Trang chính tài khoản
     */
    public function show()
    {
        if (!$this->checkAuth()) return;

        $taiKhoan = TaiKhoan::find($_SESSION['user_id']);
        if (!$taiKhoan) {
            flash_error('Tài khoản không tồn tại');
            redirect('/login');
            return;
        }

        // Thống kê đơn giản
        $stats = $this->getUserStats($_SESSION['user_id']);

        view('Client.TaiKhoan.show', [
            'taiKhoan' => $taiKhoan,
            'stats' => $stats
        ]);
    }

    /**
     * Lịch sử đặt phòng
     */
    public function bookingHistory()
    {
        if (!$this->checkAuth()) return;

        $sql = "
            SELECT 
                hdt.*,
                hdp.check_in,
                hdp.check_out,
                hdp.gia as gia_phong,
                p.ten_phong,
                p.ma_phong,
                lp.ten as loai_phong
            FROM hoa_don_tong hdt
            LEFT JOIN hoa_don_phong hdp ON hdt.ma_hoa_don = hdp.ma_hoa_don
            LEFT JOIN phong p ON hdp.ma_phong = p.ma_phong
            LEFT JOIN loai_phong lp ON p.ma_loai_phong = lp.ma_loai_phong
            WHERE hdt.ma_khach_hang = ?
            ORDER BY hdt.thoi_gian_dat DESC
        ";

        $bookings = \HotelBooking\Facades\DB::query($sql, [$_SESSION['user_id']]);

        view('Client.TaiKhoan.booking-history', [
            'bookings' => $bookings
        ]);
    }

    /**
     * Lịch sử đánh giá
     */
    public function reviewHistory()
    {
        if (!$this->checkAuth()) return;

        $sql = "
            SELECT 
                dg.*,
                p.ten_phong,
                lp.ten as loai_phong
            FROM danh_gia dg
            LEFT JOIN phong p ON dg.ma_phong = p.ma_phong
            LEFT JOIN loai_phong lp ON p.ma_loai_phong = lp.ma_loai_phong
            WHERE dg.ma_tai_khoan = ?
            ORDER BY dg.ngay_tao DESC
        ";

        $reviews = \HotelBooking\Facades\DB::query($sql, [$_SESSION['user_id']]);

        view('Client.TaiKhoan.review-history', [
            'reviews' => $reviews
        ]);
    }

    /**
     * Gửi đánh giá
     */
    public function submitReview()
    {
        if (!$this->checkAuth()) return;

        $data = [
            'ma_phong' => post('ma_phong'),
            'ma_hoa_don' => post('ma_hoa_don'),
            'diem_so' => (int)post('diem_so'),
            'noi_dung' => post('noi_dung', ''),
        ];

        // Validation
        $errors = $this->validateReviewData($data);
        if (isNotEmpty($errors)) {
            flash_error(implode('<br>', $errors));
            back();
            return;
        }

        try {
            // Kiểm tra đã đánh giá chưa
            $existingReview = DanhGia::where('ma_khach_hang', $_SESSION['user_id'])
                ->where('ma_phong', $data['ma_phong'])
                ->first();

            if ($existingReview) {
                flash_error('Bạn đã đánh giá cho đặt phòng này rồi');
                back();
                return;
            }

            // Kiểm tra quyền đánh giá (phải là khách đã ở)
            if (!$this->canReview($_SESSION['user_id'], $data['ma_hoa_don'], $data['ma_phong'])) {
                flash_error('Bạn chỉ có thể đánh giá sau khi hoàn thành lưu trú');
                back();
                return;
            }

            // Tạo đánh giá
            $result = DanhGia::create([
                'ma_tai_khoan' => $_SESSION['user_id'],
                'ma_phong' => $data['ma_phong'],
                'ma_hoa_don' => $data['ma_hoa_don'],
                'diem_so' => $data['diem_so'],
                'noi_dung' => $data['noi_dung'],
                'ngay_tao' => date('Y-m-d H:i:s')
            ]);

            if ($result) {
                flash_success('Cảm ơn bạn đã đánh giá!');
                redirect('/tai-khoan/lich-su-danh-gia');
            } else {
                flash_error('Có lỗi xảy ra khi gửi đánh giá');
                back();
            }

        } catch (Exception $e) {
            flash_error('Có lỗi xảy ra: ' . $e->getMessage());
            back();
        }
    }

    /**
     * Cập nhật đánh giá
     */
    public function updateReview()
    {
        if (!$this->checkAuth()) return;

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/tai-khoan/lich-su-danh-gia');
            return;
        }

        $maDanhGia = post('ma_danh_gia');
        $diemSo = post('diem_so');
        $noiDung = post('noi_dung', '');

        // Validation
        if (isEmpty($maDanhGia) || isEmpty($diemSo) || isEmpty($noiDung)) {
            flash_error('Vui lòng điền đầy đủ thông tin');
            back();
            return;
        }

        if (!in_array($diemSo, [1, 2, 3, 4, 5])) {
            flash_error('Điểm số phải từ 1 đến 5');
            back();
            return;
        }

        try {
            $review = DanhGia::find($maDanhGia);
            if (!$review) {
                flash_error('Đánh giá không tồn tại');
                back();
                return;
            }

            // Kiểm tra quyền sở hữu
            if ($review->ma_tai_khoan != $_SESSION['user_id']) {
                flash_error('Bạn không có quyền sửa đánh giá này');
                back();
                return;
            }

            // Cập nhật đánh giá
            $review->diem_so = $diemSo;
            $review->noi_dung = $noiDung;
            $review->ngay_cap_nhat = date('Y-m-d H:i:s');
            $review->save();

            flash_success('Cập nhật đánh giá thành công');
            redirect('/tai-khoan/lich-su-danh-gia');
        } catch (Exception $e) {
            flash_error('Có lỗi xảy ra: ' . $e->getMessage());
            back();
        }
    }

    /**
     * Xóa đánh giá
     */
    public function deleteReview()
    {
        if (!$this->checkAuth()) return;

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/tai-khoan/lich-su-danh-gia');
            return;
        }

        $maDanhGia = post('ma_danh_gia');

        try {
            $review = DanhGia::find($maDanhGia);
            if (!$review) {
                flash_error('Đánh giá không tồn tại');
                back();
                return;
            }

            // Kiểm tra quyền sở hữu
            if ($review->ma_tai_khoan != $_SESSION['user_id']) {
                flash_error('Bạn không có quyền xóa đánh giá này');
                back();
                return;
            }

            // Xóa đánh giá
            $review->delete();

            flash_success('Xóa đánh giá thành công');
            redirect('/tai-khoan/lich-su-danh-gia');
        } catch (Exception $e) {
            flash_error('Có lỗi xảy ra: ' . $e->getMessage());
            back();
        }
    }

    /**
     * Lấy thống kê người dùng
     */
    private function getUserStats($userId)
    {
        $sql = "
            SELECT 
                COUNT(CASE WHEN hdt.trang_thai = ? THEN 1 END) as cho_xac_nhan,
                COUNT(CASE WHEN hdt.trang_thai = ? THEN 1 END) as da_xac_nhan,
                COUNT(CASE WHEN hdt.trang_thai = ? THEN 1 END) as da_thanh_toan,
                COUNT(CASE WHEN hdt.trang_thai = ? THEN 1 END) as da_huy,
                COUNT(*) as tong_dat_phong,
                COALESCE(SUM(CASE WHEN hdt.trang_thai = ? THEN hdt.tong_tien ELSE 0 END), 0) as tong_chi_tieu
            FROM hoa_don_tong hdt
            WHERE hdt.ma_khach_hang = ?
        ";

        $result = \HotelBooking\Facades\DB::query($sql, [
            TrangThaiHoaDon::CHO_XAC_NHAN,
            TrangThaiHoaDon::DA_XAC_NHAN,
            TrangThaiHoaDon::DA_THANH_TOAN,
            TrangThaiHoaDon::DA_HUY,
            TrangThaiHoaDon::DA_THANH_TOAN,
            $userId
        ]);

        return $result && count($result) > 0 ? $result[0] : (object)[
            'cho_xac_nhan' => 0,
            'da_xac_nhan' => 0, 
            'da_thanh_toan' => 0,
            'da_huy' => 0,
            'tong_dat_phong' => 0,
            'tong_chi_tieu' => 0
        ];
    }

    /**
     * Kiểm tra có thể đánh giá không
     */
    private function canReview($userId, $maHoaDon, $maPhong)
    {
        $sql = "
            SELECT COUNT(*) as count
            FROM hoa_don_tong hdt
            JOIN hoa_don_phong hdp ON hdt.ma_hoa_don = hdp.ma_hoa_don
            WHERE hdt.ma_khach_hang = ?
            AND hdt.ma_hoa_don = ?
            AND hdp.ma_phong = ?
            AND hdt.trang_thai = ?
            AND hdp.check_out < NOW()
        ";

        try {
            $result = \HotelBooking\Facades\DB::query($sql, [
                $userId, 
                $maHoaDon, 
                $maPhong, 
                TrangThaiHoaDon::DA_THANH_TOAN
            ]);

            if (!$result || !is_array($result) || count($result) === 0) {
                return false;
            }

            $row = $result[0];
            if (!is_object($row)) {
                return false;
            }

            return isset($row->count) && $row->count > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Validate dữ liệu đánh giá
     */
    private function validateReviewData($data)
    {
        $errors = [];

        if (isEmpty($data['ma_phong'])) {
            $errors[] = 'Thiếu thông tin phòng';
        }

        if (isEmpty($data['ma_hoa_don'])) {
            $errors[] = 'Thiếu thông tin hóa đơn';
        }

        if (!in_array($data['diem_so'], [1, 2, 3, 4, 5])) {
            $errors[] = 'Điểm số phải từ 1 đến 5';
        }

        if (isEmpty($data['noi_dung'])) {
            $errors[] = 'Vui lòng nhập nội dung đánh giá';
        }

        if (mb_strlen($data['noi_dung'], 'UTF-8') < 10) {
            $errors[] = 'Nội dung đánh giá phải ít nhất 10 ký tự';
        }

        return $errors;
    }

    /**
     * Lấy chi tiết đặt phòng (API endpoint)
     */
    public function getBookingDetails()
    {
        if (!$this->checkAuth()) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        $maHoaDon = get('id');
        if (!$maHoaDon) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Missing invoice ID']);
            return;
        }

        // Lấy chi tiết hóa đơn từ Model
        $hoaDonDetails = HoaDon::getInvoiceDetails($maHoaDon);
        
        if (!$hoaDonDetails) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Invoice not found']);
            return;
        }

        // Kiểm tra quyền truy cập - chỉ chủ hóa đơn mới được xem
        if ($hoaDonDetails['ma_khach_hang'] != $_SESSION['user_id']) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Access denied']);
            return;
        }

        // Tính toán thêm thông tin cần thiết
        $tongTienPhong = 0;
        if (isNotEmpty($hoaDonDetails['rooms_data'])) {
            foreach ($hoaDonDetails['rooms_data'] as &$room) {
                $checkInTime = strtotime($room['check_in']);
                $checkOutTime = strtotime($room['check_out']);
                $timeDiffSeconds = $checkOutTime - $checkInTime;
                $soGioChinhXac = max(1, $timeDiffSeconds / 3600);
                $room['so_gio'] = round($soGioChinhXac, 1);
                $room['tien_phong'] = round($room['gia_hien_tai'] * $soGioChinhXac);
                $tongTienPhong += $room['tien_phong'];
                
                // Format dates for display
                $room['check_in_formatted'] = date('d/m/Y H:i', strtotime($room['check_in']));
                $room['check_out_formatted'] = date('d/m/Y H:i', strtotime($room['check_out']));
            }
        }

        $tongTienDichVu = 0;
        if (isNotEmpty($hoaDonDetails['services_data'])) {
            foreach ($hoaDonDetails['services_data'] as &$service) {
                $service['thanh_tien'] = $service['gia_hien_tai'] * ($service['so_luong'] ?? 1);
                $tongTienDichVu += $service['thanh_tien'];
            }
        }

        $result = [
            'success' => true,
            'data' => [
                'ma_hoa_don' => $hoaDonDetails['ma_hoa_don'],
                'thoi_gian_dat' => $hoaDonDetails['thoi_gian_dat'],
                'trang_thai' => $hoaDonDetails['trang_thai'],
                'tong_tien' => $hoaDonDetails['tong_tien'],
                'ghi_chu' => $hoaDonDetails['ghi_chu'],
                'ten_khach_hang' => $hoaDonDetails['ten_khach_hang'],
                'email_khach_hang' => $hoaDonDetails['email_khach_hang'],
                'sdt_khach_hang' => $hoaDonDetails['sdt_khach_hang'],
                'rooms_data' => $hoaDonDetails['rooms_data'],
                'services_data' => $hoaDonDetails['services_data'],
                'tong_tien_phong' => $tongTienPhong,
                'tong_tien_dich_vu' => $tongTienDichVu
            ]
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
