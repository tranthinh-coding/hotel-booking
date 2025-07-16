<?php

namespace HotelBooking\Controllers\Client;

use HotelBooking\Models\Phong;
use HotelBooking\Models\LoaiPhong;
use HotelBooking\Models\HoaDon;
use HotelBooking\Models\HoaDonPhong;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Enums\TrangThaiHoaDon;
use Exception;

class BookingController
{
    /**
     * Hiển thị form đặt phòng
     */
    public function showBookingForm($maPhong = null)
    {
        $phong = null;
        
        // Kiểm tra parameter từ URL path
        if ($maPhong) {
            $phong = Phong::find($maPhong);
            if (!$phong) {
                flash_error('Phòng không tồn tại');
                redirect('/phong');
                return;
            }
        }
        
        // Kiểm tra parameter từ GET query
        if (!$phong && isset($_GET['room_id'])) {
            $phong = Phong::find($_GET['room_id']);
            if (!$phong) {
                flash_error('Phòng không tồn tại');
                redirect('/phong');
                return;
            }
        }

        $loaiPhongs = LoaiPhong::all();
        
        // Lấy tất cả phòng để hiển thị trong form
        $phongs = Phong::all();
        
        view('Client.Booking.form', [
            'phong' => $phong,
            'loaiPhongs' => $loaiPhongs,
            'phongs' => $phongs
        ]);
    }

    /**
     * Xử lý đặt phòng
     */
    public function processBooking()
    {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            flash_error('Vui lòng đăng nhập để đặt phòng');
            redirect('/login');
            return;
        }

        $data = [
            'ma_phong' => post('ma_phong'),
            'check_in' => post('check_in'),
            'check_out' => post('check_out'),
            'so_khach' => post('so_khach', 1),
            'ghi_chu' => post('ghi_chu', ''),
        ];

        // Validation
        $errors = $this->validateBookingData($data);
        if (isNotEmpty($errors)) {
            flash_error(implode('<br>', $errors));
            set_old_input();
            back();
            return;
        }

        try {
            // Kiểm tra phòng có tồn tại không
            $phong = Phong::find($data['ma_phong']);
            if (!$phong) {
                flash_error('Phòng không tồn tại');
                redirect('/phong');
                return;
            }

            // Kiểm tra xung đột lịch đặt
            if (HoaDonPhong::hasConflictForRoom($data['ma_phong'], $data['check_in'], $data['check_out'])) {
                flash_error('Phòng đã được đặt trong thời gian này. Vui lòng chọn thời gian khác.');
                set_old_input();
                back();
                return;
            }

            // Tính số ngày và tổng tiền
            $checkIn = new \DateTime($data['check_in']);
            $checkOut = new \DateTime($data['check_out']);
            $soNgay = $checkIn->diff($checkOut)->days;
            $tongTien = $soNgay * $phong->gia;

            // Tạo hóa đơn
            $hoaDonId = HoaDon::create([
                'ma_tai_khoan' => $_SESSION['user_id'],
                'tong_tien' => $tongTien,
                'trang_thai' => TrangThaiHoaDon::CHO_XAC_NHAN,
                'ngay_tao' => date('Y-m-d H:i:s'),
                'ghi_chu' => $data['ghi_chu']
            ]);

            if (!$hoaDonId) {
                flash_error('Có lỗi xảy ra khi tạo hóa đơn');
                set_old_input();
                back();
                return;
            }

            // Tạo chi tiết đặt phòng
            $result = HoaDonPhong::create([
                'ma_hoa_don' => $hoaDonId,
                'ma_phong' => $data['ma_phong'],
                'check_in' => $data['check_in'],
                'check_out' => $data['check_out'],
                'gia' => $phong->gia,
                'so_khach' => $data['so_khach']
            ]);

            if ($result) {
                flash_success('Đặt phòng thành công! Vui lòng chờ xác nhận từ khách sạn.');
                redirect('/tai-khoan/lich-su-dat-phong');
            } else {
                // Xóa hóa đơn nếu tạo chi tiết thất bại
                $hoaDonToDelete = HoaDon::find($hoaDonId);
                if ($hoaDonToDelete) {
                    $hoaDonToDelete->delete();
                }
                flash_error('Có lỗi xảy ra khi đặt phòng');
                set_old_input();
                back();
            }

        } catch (Exception $e) {
            flash_error('Có lỗi xảy ra: ' . $e->getMessage());
            set_old_input();
            back();
        }
    }

    /**
     * Hủy đặt phòng
     */
    public function cancelBooking($maHoaDon)
    {
        if (!isset($_SESSION['user_id'])) {
            flash_error('Vui lòng đăng nhập');
            redirect('/login');
            return;
        }

        try {
            $hoaDon = HoaDon::find($maHoaDon);
            
            if (!$hoaDon || $hoaDon->ma_tai_khoan != $_SESSION['user_id']) {
                flash_error('Không tìm thấy đơn đặt phòng');
                redirect('/tai-khoan/lich-su-dat-phong');
                return;
            }

            // Chỉ cho phép hủy khi chưa xác nhận
            if ($hoaDon->trang_thai !== TrangThaiHoaDon::CHO_XAC_NHAN) {
                flash_error('Không thể hủy đơn đặt phòng này');
                redirect('/tai-khoan/lich-su-dat-phong');
                return;
            }

            // Cập nhật trạng thái
            $hoaDon->trang_thai = TrangThaiHoaDon::DA_HUY;
            $hoaDon->ngay_cap_nhat = date('Y-m-d H:i:s');
            $hoaDon->save();

            flash_success('Đã hủy đặt phòng thành công');
            redirect('/tai-khoan/lich-su-dat-phong');

        } catch (Exception $e) {
            flash_error('Có lỗi xảy ra: ' . $e->getMessage());
            redirect('/tai-khoan/lich-su-dat-phong');
        }
    }

    /**
     * Validate dữ liệu đặt phòng
     */
    private function validateBookingData($data)
    {
        $errors = [];

        if (empty($data['ma_phong'])) {
            $errors[] = 'Vui lòng chọn phòng';
        }

        if (empty($data['check_in'])) {
            $errors[] = 'Vui lòng chọn ngày nhận phòng';
        }

        if (empty($data['check_out'])) {
            $errors[] = 'Vui lòng chọn ngày trả phòng';
        }

        if (isNotEmpty($data['check_in']) && isNotEmpty($data['check_out'])) {
            $checkIn = new \DateTime($data['check_in']);
            $checkOut = new \DateTime($data['check_out']);
            $today = new \DateTime();
            $today->setTime(0, 0, 0);

            if ($checkIn < $today) {
                $errors[] = 'Ngày nhận phòng không thể trong quá khứ';
            }

            if ($checkOut <= $checkIn) {
                $errors[] = 'Ngày trả phòng phải sau ngày nhận phòng';
            }

            $diff = $checkIn->diff($checkOut);
            if ($diff->days > 30) {
                $errors[] = 'Thời gian đặt phòng không được quá 30 ngày';
            }
        }

        if (isNotEmpty($data['so_khach']) && ($data['so_khach'] < 1 || $data['so_khach'] > 10)) {
            $errors[] = 'Số khách phải từ 1 đến 10 người';
        }

        return $errors;
    }
}
