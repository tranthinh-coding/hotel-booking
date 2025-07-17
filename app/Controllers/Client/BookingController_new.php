<?php

namespace HotelBooking\Controllers\Client;

use HotelBooking\Models\Phong;
use HotelBooking\Models\LoaiPhong;
use HotelBooking\Models\HoaDon;
use HotelBooking\Models\HoaDonPhong;
use HotelBooking\Models\HoaDonDichVu;
use HotelBooking\Models\DichVu;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Enums\TrangThaiHoaDon;
use Exception;
use DateTime;

class BookingController
{
    /**
     * Hiển thị trang checkout/đặt phòng
     */
    public function checkout()
    {
        $phongId = get('room_id') ?? get('phong_id');
        $phong = null;
        
        if ($phongId) {
            $phong = Phong::find($phongId);
            if (!$phong) {
                flash_error('Phòng không tồn tại');
                redirect('/phong');
                return;
            }
        }
        
        // Get room type info if room exists
        $loaiPhong = null;
        if ($phong && isNotEmpty($phong->ma_loai_phong)) {
            $loaiPhong = LoaiPhong::find($phong->ma_loai_phong);
        }
        
        // Get all rooms for selection
        $phongs = Phong::where('trang_thai', '!=', \HotelBooking\Enums\TrangThaiPhong::NGUNG_HOAT_DONG)->get();
        
        // Get all services for selection
        $dichVus = DichVu::where('trang_thai', '!=', \HotelBooking\Enums\TrangThaiDichVu::NGUNG_HOAT_DONG)->get();
        
        // Get booking details from GET params if provided
        $bookingData = [
            'phong_id' => $phongId,
            'ngay_nhan_phong' => get('ngay_nhan_phong'),
            'ngay_tra_phong' => get('ngay_tra_phong'),
            'so_nguoi' => get('so_nguoi', 1)
        ];
        
        view('Client.Booking.checkout_new', [
            'phong' => $phong,
            'loaiPhong' => $loaiPhong,
            'phongs' => $phongs,
            'dichVus' => $dichVus,
            'bookingData' => $bookingData
        ]);
    }

    /**
     * Xử lý đặt phòng từ checkout (phiên bản mới)
     */
    public function processCheckout()
    {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            flash_error('Vui lòng đăng nhập để đặt phòng');
            redirect('/login');
            return;
        }

        $customerData = [
            'ho_ten' => post('ho_ten'),
            'so_dien_thoai' => post('so_dien_thoai'),
            'email' => post('email'),
            'ghi_chu' => post('ghi_chu', ''),
        ];

        $phongs = post('phongs', []);
        $dichVuChung = post('dich_vu_chung', []);

        // Validation
        $errors = $this->validateNewCheckoutData($customerData, $phongs);
        if (isNotEmpty($errors)) {
            flash_error(implode('<br>', $errors));
            set_old_input();
            back();
            return;
        }

        try {
            // Tạo hóa đơn
            $hoaDon = new HoaDon();
            $hoaDon->ma_tai_khoan = $_SESSION['user_id'];
            $hoaDon->ngay_tao = date('Y-m-d H:i:s');
            $hoaDon->trang_thai = TrangThaiHoaDon::CHO_XAC_NHAN;
            $hoaDon->ghi_chu = $customerData['ghi_chu'];
            $hoaDon->ho_ten = $customerData['ho_ten'];
            $hoaDon->so_dien_thoai = $customerData['so_dien_thoai'];
            $hoaDon->email = $customerData['email'];
            
            if (!$hoaDon->save()) {
                throw new Exception('Không thể tạo hóa đơn');
            }

            $tongTien = 0;

            // Xử lý từng phòng
            foreach ($phongs as $phongData) {
                if (isEmpty($phongData['ma_phong']) || isEmpty($phongData['check_in']) || isEmpty($phongData['check_out'])) {
                    continue;
                }

                // Kiểm tra phòng tồn tại
                $phong = Phong::find($phongData['ma_phong']);
                if (!$phong) {
                    throw new Exception('Phòng không tồn tại: ' . $phongData['ma_phong']);
                }

                // Kiểm tra xung đột lịch đặt
                $checkinDate = date('Y-m-d', strtotime($phongData['check_in']));
                $checkoutDate = date('Y-m-d', strtotime($phongData['check_out']));

                if (HoaDonPhong::hasConflictForRoom($phongData['ma_phong'], $checkinDate, $checkoutDate)) {
                    throw new Exception('Phòng ' . $phong->ten_phong . ' đã được đặt trong thời gian này');
                }

                // Tính tiền phòng
                $checkin = new DateTime($phongData['check_in']);
                $checkout = new DateTime($phongData['check_out']);
                $hours = max(1, ceil(($checkout->getTimestamp() - $checkin->getTimestamp()) / 3600));
                $tienPhong = $phong->gia * $hours;

                // Tạo record hóa đơn phòng
                $hoaDonPhong = new HoaDonPhong();
                $hoaDonPhong->ma_hoa_don = $hoaDon->ma_hoa_don;
                $hoaDonPhong->ma_phong = $phongData['ma_phong'];
                $hoaDonPhong->ngay_nhan_phong = $phongData['check_in'];
                $hoaDonPhong->ngay_tra_phong = $phongData['check_out'];
                $hoaDonPhong->gia_phong = $phong->gia;
                $hoaDonPhong->thanh_tien = $tienPhong;

                if (!$hoaDonPhong->save()) {
                    throw new Exception('Không thể lưu thông tin phòng');
                }

                $tongTien += $tienPhong;

                // Xử lý dịch vụ theo phòng
                if (isset($phongData['dich_vu']) && is_array($phongData['dich_vu'])) {
                    foreach ($phongData['dich_vu'] as $dichVuData) {
                        if (isEmpty($dichVuData['ma_dich_vu'])) continue;

                        $dichVu = DichVu::find($dichVuData['ma_dich_vu']);
                        if (!$dichVu) continue;

                        $soLuong = max(1, intval($dichVuData['so_luong'] ?? 1));
                        $thanhTien = $dichVu->gia * $soLuong;

                        $hoaDonDichVu = new HoaDonDichVu();
                        $hoaDonDichVu->ma_hoa_don = $hoaDon->ma_hoa_don;
                        $hoaDonDichVu->ma_dich_vu = $dichVuData['ma_dich_vu'];
                        $hoaDonDichVu->ma_phong = $phongData['ma_phong'];
                        $hoaDonDichVu->so_luong = $soLuong;
                        $hoaDonDichVu->gia_dich_vu = $dichVu->gia;
                        $hoaDonDichVu->thanh_tien = $thanhTien;

                        if ($hoaDonDichVu->save()) {
                            $tongTien += $thanhTien;
                        }
                    }
                }
            }

            // Xử lý dịch vụ chung
            if (is_array($dichVuChung)) {
                foreach ($dichVuChung as $dichVuData) {
                    if (isEmpty($dichVuData['ma_dich_vu'])) continue;

                    $dichVu = DichVu::find($dichVuData['ma_dich_vu']);
                    if (!$dichVu) continue;

                    $soLuong = max(1, intval($dichVuData['so_luong'] ?? 1));
                    $thanhTien = $dichVu->gia * $soLuong;

                    $hoaDonDichVu = new HoaDonDichVu();
                    $hoaDonDichVu->ma_hoa_don = $hoaDon->ma_hoa_don;
                    $hoaDonDichVu->ma_dich_vu = $dichVuData['ma_dich_vu'];
                    $hoaDonDichVu->ma_phong = null; // Dịch vụ chung không gắn với phòng cụ thể
                    $hoaDonDichVu->so_luong = $soLuong;
                    $hoaDonDichVu->gia_dich_vu = $dichVu->gia;
                    $hoaDonDichVu->thanh_tien = $thanhTien;

                    if ($hoaDonDichVu->save()) {
                        $tongTien += $thanhTien;
                    }
                }
            }

            // Cập nhật tổng tiền hóa đơn
            $hoaDon->tong_tien = $tongTien;
            $hoaDon->save();

            flash_success('Đặt phòng thành công! Hóa đơn #' . $hoaDon->ma_hoa_don . ' đã được tạo.');
            redirect('/booking/success?invoice=' . $hoaDon->ma_hoa_don);

        } catch (Exception $e) {
            flash_error('Có lỗi xảy ra: ' . $e->getMessage());
            set_old_input();
            back();
        }
    }

    /**
     * Validate dữ liệu checkout mới
     */
    private function validateNewCheckoutData($customerData, $phongs)
    {
        $errors = [];

        // Validate customer data
        if (isEmpty($customerData['ho_ten'])) {
            $errors[] = 'Vui lòng nhập họ tên';
        }

        if (isEmpty($customerData['so_dien_thoai'])) {
            $errors[] = 'Vui lòng nhập số điện thoại';
        } elseif (!preg_match('/^[0-9]{10,11}$/', $customerData['so_dien_thoai'])) {
            $errors[] = 'Số điện thoại không hợp lệ';
        }

        if (isEmpty($customerData['email'])) {
            $errors[] = 'Vui lòng nhập email';
        } elseif (!filter_var($customerData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email không hợp lệ';
        }

        // Validate rooms
        if (isEmpty($phongs) || !is_array($phongs)) {
            $errors[] = 'Vui lòng chọn ít nhất một phòng';
        } else {
            foreach ($phongs as $index => $phong) {
                if (isEmpty($phong['ma_phong'])) {
                    $errors[] = 'Vui lòng chọn phòng cho phòng thứ ' . ($index + 1);
                    continue;
                }

                if (isEmpty($phong['check_in'])) {
                    $errors[] = 'Vui lòng chọn thời gian check-in cho phòng thứ ' . ($index + 1);
                }

                if (isEmpty($phong['check_out'])) {
                    $errors[] = 'Vui lòng chọn thời gian check-out cho phòng thứ ' . ($index + 1);
                }

                if (isNotEmpty($phong['check_in']) && isNotEmpty($phong['check_out'])) {
                    $checkin = strtotime($phong['check_in']);
                    $checkout = strtotime($phong['check_out']);

                    if ($checkin >= $checkout) {
                        $errors[] = 'Thời gian check-out phải sau check-in cho phòng thứ ' . ($index + 1);
                    }

                    if ($checkin < time()) {
                        $errors[] = 'Thời gian check-in không thể trong quá khứ cho phòng thứ ' . ($index + 1);
                    }
                }
            }
        }

        return $errors;
    }

    /**
     * Hiển thị trang thành công
     */
    public function success()
    {
        $invoiceId = get('invoice');
        $hoaDon = null;
        
        if ($invoiceId) {
            $hoaDon = HoaDon::find($invoiceId);
            
            // Chỉ cho phép xem hóa đơn của chính mình
            if ($hoaDon && isset($_SESSION['user_id']) && $hoaDon->ma_tai_khoan != $_SESSION['user_id']) {
                $hoaDon = null;
            }
        }
        
        view('Client.Booking.success', [
            'hoaDon' => $hoaDon
        ]);
    }

    /**
     * Hiển thị form đặt phòng (legacy - giữ để tương thích)
     */
    public function showBookingForm($maPhong = null)
    {
        $phong = null;
        
        if ($maPhong) {
            $phong = Phong::find($maPhong);
            if (!$phong) {
                flash_error('Phòng không tồn tại');
                redirect('/phong');
                return;
            }
        }
        
        if (!$phong && isset($_GET['room_id'])) {
            $phong = Phong::find($_GET['room_id']);
            if (!$phong) {
                flash_error('Phòng không tồn tại');
                redirect('/phong');
                return;
            }
        }

        $loaiPhongs = LoaiPhong::all();
        $phongs = Phong::all();
        
        view('Client.Booking.form', [
            'phong' => $phong,
            'loaiPhongs' => $loaiPhongs,
            'phongs' => $phongs
        ]);
    }
}
