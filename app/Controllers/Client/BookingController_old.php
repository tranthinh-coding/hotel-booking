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
        if ($phong && !empty($phong->ma_loai_phong)) {
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
     * Hiển thị form đặt phòng (legacy)
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
                if (empty($phongData['ma_phong']) || empty($phongData['check_in']) || empty($phongData['check_out'])) {
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
                        if (empty($dichVuData['ma_dich_vu'])) continue;

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
                    if (empty($dichVuData['ma_dich_vu'])) continue;

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
        if (empty($customerData['ho_ten'])) {
            $errors[] = 'Vui lòng nhập họ tên';
        }

        if (empty($customerData['so_dien_thoai'])) {
            $errors[] = 'Vui lòng nhập số điện thoại';
        } elseif (!preg_match('/^[0-9]{10,11}$/', $customerData['so_dien_thoai'])) {
            $errors[] = 'Số điện thoại không hợp lệ';
        }

        if (empty($customerData['email'])) {
            $errors[] = 'Vui lòng nhập email';
        } elseif (!filter_var($customerData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email không hợp lệ';
        }

        // Validate rooms
        if (empty($phongs) || !is_array($phongs)) {
            $errors[] = 'Vui lòng chọn ít nhất một phòng';
        } else {
            foreach ($phongs as $index => $phong) {
                if (empty($phong['ma_phong'])) {
                    $errors[] = 'Vui lòng chọn phòng cho phòng thứ ' . ($index + 1);
                    continue;
                }

                if (empty($phong['check_in'])) {
                    $errors[] = 'Vui lòng chọn thời gian check-in cho phòng thứ ' . ($index + 1);
                }

                if (empty($phong['check_out'])) {
                    $errors[] = 'Vui lòng chọn thời gian check-out cho phòng thứ ' . ($index + 1);
                }

                if (!empty($phong['check_in']) && !empty($phong['check_out'])) {
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
                back();
                return;
            }

            // Tính số giờ và tổng tiền
            $checkinTime = new \DateTime($data['ngay_nhan_phong']);
            $checkoutTime = new \DateTime($data['ngay_tra_phong']);
            $interval = $checkinTime->diff($checkoutTime);
            $hours = ($interval->days * 24) + $interval->h + ($interval->i > 0 ? 1 : 0);
            $hours = max($hours, 2); // Minimum 2 hours

            $tongTien = $hours * $phong->gia;

            // Tạo hóa đơn
            $hoaDon = new HoaDon();
            $hoaDon->ma_tai_khoan = $_SESSION['user_id'];
            $hoaDon->ngay_tao = date('Y-m-d H:i:s');
            $hoaDon->tong_tien = $tongTien;
            $hoaDon->trang_thai = TrangThaiHoaDon::CHO_XAC_NHAN;
            $hoaDon->ghi_chu = $data['ghi_chu'];
            
            if (!$hoaDon->save()) {
                throw new Exception('Không thể tạo hóa đơn');
            }

            // Tạo chi tiết hóa đơn phòng
            $hoaDonPhong = new HoaDonPhong();
            $hoaDonPhong->ma_hoa_don = $hoaDon->ma_hoa_don;
            $hoaDonPhong->ma_phong = $data['ma_phong'];
            $hoaDonPhong->ngay_nhan_phong = $data['ngay_nhan_phong'];
            $hoaDonPhong->ngay_tra_phong = $data['ngay_tra_phong'];
            $hoaDonPhong->so_luong_khach = $data['so_nguoi'];
            $hoaDonPhong->gia_phong = $phong->gia;
            $hoaDonPhong->thanh_tien = $tongTien;

            if (!$hoaDonPhong->save()) {
                // Rollback hóa đơn nếu lỗi
                $hoaDon->delete();
                throw new Exception('Không thể tạo chi tiết đặt phòng');
            }

            clear_old_input();
            flash_success('Đặt phòng thành công! Mã đặt phòng: #' . $hoaDon->ma_hoa_don);
            redirect('/booking/success?id=' . $hoaDon->ma_hoa_don);

        } catch (Exception $e) {
            flash_error('Có lỗi xảy ra: ' . $e->getMessage());
            set_old_input();
            back();
        }
    }

    /**
     * Validate checkout data
     */
    private function validateCheckoutData($data)
    {
        $errors = [];

        if (isEmpty($data['ho_ten'])) {
            $errors[] = 'Vui lòng nhập họ và tên';
        }

        if (isEmpty($data['so_dien_thoai'])) {
            $errors[] = 'Vui lòng nhập số điện thoại';
        } elseif (!preg_match('/^[0-9]{10,11}$/', $data['so_dien_thoai'])) {
            $errors[] = 'Số điện thoại không hợp lệ';
        }

        if (isEmpty($data['email'])) {
            $errors[] = 'Vui lòng nhập email';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email không hợp lệ';
        }

        if (isEmpty($data['ma_phong'])) {
            $errors[] = 'Vui lòng chọn phòng';
        }

        if (isEmpty($data['ngay_nhan_phong'])) {
            $errors[] = 'Vui lòng chọn thời gian nhận phòng';
        }

        if (isEmpty($data['ngay_tra_phong'])) {
            $errors[] = 'Vui lòng chọn thời gian trả phòng';
        }

        if (!isEmpty($data['ngay_nhan_phong']) && !isEmpty($data['ngay_tra_phong'])) {
            $checkin = new \DateTime($data['ngay_nhan_phong']);
            $checkout = new \DateTime($data['ngay_tra_phong']);
            $now = new \DateTime();

            if ($checkin < $now) {
                $errors[] = 'Thời gian nhận phòng phải sau thời điểm hiện tại';
            }

            if ($checkout <= $checkin) {
                $errors[] = 'Thời gian trả phòng phải sau thời gian nhận phòng';
            }
        }

        if (!is_numeric($data['so_nguoi']) || $data['so_nguoi'] < 1) {
            $errors[] = 'Số khách không hợp lệ';
        }

        return $errors;
    }

    /**
     * Xử lý đặt phòng (legacy)
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

    /**
     * Hiển thị trang thành công
     */
    public function success()
    {
        $hoaDonId = get('id');
        if (!$hoaDonId) {
            flash_error('Không tìm thấy thông tin đặt phòng');
            redirect('/');
            return;
        }

        // Kiểm tra đăng nhập và quyền xem hóa đơn
        if (!isset($_SESSION['user_id'])) {
            flash_error('Vui lòng đăng nhập để xem thông tin đặt phòng');
            redirect('/login');
            return;
        }

        $hoaDon = HoaDon::find($hoaDonId);
        if (!$hoaDon || $hoaDon->ma_tai_khoan != $_SESSION['user_id']) {
            flash_error('Không tìm thấy thông tin đặt phòng hoặc bạn không có quyền xem');
            redirect('/');
            return;
        }

        // Lấy chi tiết hóa đơn phòng
        $hoaDonPhong = HoaDonPhong::where('ma_hoa_don', '=', $hoaDonId)->first();
        
        // Lấy thông tin phòng
        $phong = null;
        $loaiPhong = null;
        if ($hoaDonPhong) {
            $phong = Phong::find($hoaDonPhong->ma_phong);
            if ($phong && !empty($phong->ma_loai_phong)) {
                $loaiPhong = LoaiPhong::find($phong->ma_loai_phong);
            }
        }

        view('Client.Booking.success', [
            'hoaDon' => $hoaDon,
            'hoaDonPhong' => $hoaDonPhong,
            'phong' => $phong,
            'loaiPhong' => $loaiPhong
        ]);
    }
}
