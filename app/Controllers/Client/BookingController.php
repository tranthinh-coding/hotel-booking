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
        $user = user();
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

        // Convert to arrays for JSON encoding
        $phongsArray = [];
        if ($phongs && count($phongs) > 0) {
            foreach ($phongs as $p) {
                $phongsArray[] = [
                    'ma_phong' => $p->ma_phong,
                    'ten_phong' => $p->ten_phong,
                    'gia' => floatval($p->gia ?? 0)
                ];
            }
        } else {
            // Sample data for testing if no rooms in database
            $phongsArray = [
                ['ma_phong' => 'P001', 'ten_phong' => 'Phòng Standard 001', 'gia' => 500000],
                ['ma_phong' => 'P002', 'ten_phong' => 'Phòng Deluxe 002', 'gia' => 800000],
                ['ma_phong' => 'P003', 'ten_phong' => 'Phòng Suite 003', 'gia' => 1200000]
            ];
        }

        $dichVusArray = [];
        if ($dichVus && count($dichVus) > 0) {
            foreach ($dichVus as $dv) {
                $dichVusArray[] = [
                    'ma_dich_vu' => $dv->ma_dich_vu,
                    'ten_dich_vu' => $dv->ten_dich_vu,
                    'gia' => floatval($dv->gia ?? 0)
                ];
            }
        } else {
            // Sample data for testing if no services in database
            $dichVusArray = [
                ['ma_dich_vu' => 'DV001', 'ten_dich_vu' => 'Massage thư giãn', 'gia' => 300000],
                ['ma_dich_vu' => 'DV002', 'ten_dich_vu' => 'Dịch vụ giặt ủi', 'gia' => 50000],
                ['ma_dich_vu' => 'DV003', 'ten_dich_vu' => 'Ăn sáng buffet', 'gia' => 200000]
            ];
        }

        // Ưu tiên lấy dữ liệu phòng từ session nếu có lỗi submit trước đó
        $oldPhongs = isset($_SESSION['old_phongs']) ? $_SESSION['old_phongs'] : null;

        // Get booking details from GET params if provided
        $bookingData = [
            'phong_id' => $phongId,
            'ngay_nhan_phong' => get('ngay_nhan_phong'),
            'ngay_tra_phong' => get('ngay_tra_phong'),
            'so_nguoi' => get('so_nguoi', 1)
        ];

        view('Client.Booking.checkout', [
            'phong' => $phong,
            'loaiPhong' => $loaiPhong,
            'phongs' => $phongs,
            'dichVus' => $dichVus,
            'phongsArray' => $phongsArray,
            'dichVusArray' => $dichVusArray,
            'bookingData' => $bookingData,
            'user' => $user,
            'oldPhongs' => $oldPhongs
        ]);
    }

    /**
     * Xử lý đặt phòng từ checkout (phiên bản mới)
     */
    public function processCheckout()
    {
        // Debug mode để xem dữ liệu được gửi
        if (isset($_GET['debug'])) {
            echo "<pre style='background:#000;color:#0f0;padding:20px;'>";
            echo "=== FORM DATA DEBUG ===\n";
            echo "POST Data:\n";
            print_r($_POST);
            echo "\nDịch vụ chung:\n";
            print_r(post('dich_vu_chung', []));
            echo "</pre>";
            die();
        }

        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            flash_error('Vui lòng đăng nhập để đặt phòng');
            redirect('/login');
            return;
        }

        // Xử lý dữ liệu phòng - hỗ trợ cả form đơn và form array
        $phongs = post('phongs', []);
        
        // Nếu không có phongs array, tạo từ dữ liệu đơn
        if (isEmpty($phongs)) {
            $maPhong = post('ma_phong');
            $ngayNhanPhong = post('ngay_nhan_phong');
            $ngayTraPhong = post('ngay_tra_phong');
            
            if ($maPhong && $ngayNhanPhong && $ngayTraPhong) {
                $phongs = [
                    [
                        'ma_phong' => $maPhong,
                        'check_in' => $ngayNhanPhong,
                        'check_out' => $ngayTraPhong,
                        'dich_vu' => [] // Sẽ xử lý sau
                    ]
                ];
            }
        }
        
        $dichVuChung = post('dich_vu_chung', []);

        // Validation
        $errors = $this->validateNewCheckoutData($phongs);
        if (isNotEmpty($errors)) {
            // Lưu lại thông tin phòng để điền lại khi reload form
            set_old_input();
            if (!isEmpty($phongs) && is_array($phongs)) {
                $_SESSION['old_phongs'] = $phongs;
            }
            flash_error(implode('<br>', $errors));
            back();
            return;
        }

        try {
            // Tạo hóa đơn
            $hoaDon = new HoaDon();
            $hoaDon->ma_khach_hang = $_SESSION['user_id'];
            $hoaDon->thoi_gian_dat = date('Y-m-d H:i:s');
            $hoaDon->trang_thai = TrangThaiHoaDon::CHO_XAC_NHAN;
            $hoaDon->ghi_chu = post('ghi_chu', '');
            // Note: ho_ten, so_dien_thoai, email không có trong schema của hoa_don_tong
            // Có thể cần lưu trong bảng khác hoặc thêm vào schema
            
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
                    throw new Exception('Phòng ' . $phong->ten_phong . ' đã được đặt trong thời gian từ ' . date('d/m/Y H:i', strtotime($phongData['check_in'])) . ' đến ' . date('d/m/Y H:i', strtotime($phongData['check_out'])));
                }

                // Tính tiền phòng theo giờ thập phân chính xác
                $checkin = new DateTime($phongData['check_in']);
                $checkout = new DateTime($phongData['check_out']);
                $timeDiffSeconds = $checkout->getTimestamp() - $checkin->getTimestamp();
                $hoursExact = max(1, $timeDiffSeconds / 3600); // Giờ chính xác (thập phân)
                $tienPhong = round($phong->gia * $hoursExact); // Làm tròn số tiền

                // Tạo record hóa đơn phòng
                $hoaDonPhong = new HoaDonPhong();
                $hoaDonPhong->ma_hoa_don = $hoaDon->ma_hoa_don;
                $hoaDonPhong->ma_phong = $phongData['ma_phong'];
                $hoaDonPhong->check_in = $phongData['check_in'];
                $hoaDonPhong->check_out = $phongData['check_out'];
                $hoaDonPhong->gia = $phong->gia;

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
                        $hoaDonDichVu->ma_hd_phong = $hoaDonPhong->ma_hd_phong; // Sử dụng ID từ record vừa tạo
                        $hoaDonDichVu->so_luong = $soLuong;
                        $hoaDonDichVu->gia = $dichVu->gia;
                        $hoaDonDichVu->thoi_gian = date('Y-m-d H:i:s');

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

                    try {
                        $hoaDonDichVu = new HoaDonDichVu();
                        $hoaDonDichVu->ma_hoa_don = $hoaDon->ma_hoa_don;
                        $hoaDonDichVu->ma_dich_vu = $dichVuData['ma_dich_vu'];
                        // Không set ma_hd_phong để để nó NULL (dịch vụ chung)
                        $hoaDonDichVu->so_luong = $soLuong;
                        $hoaDonDichVu->gia = $dichVu->gia;
                        $hoaDonDichVu->thoi_gian = date('Y-m-d H:i:s');

                        if ($hoaDonDichVu->save()) {
                            $tongTien += $thanhTien;
                        } else {
                            throw new Exception('Không thể lưu dịch vụ chung: ' . $dichVu->ten_dich_vu);
                        }
                    } catch (Exception $e) {
                        throw new Exception('Lỗi khi lưu dịch vụ chung "' . $dichVu->ten_dich_vu . '": ' . $e->getMessage());
                    }
                }
            }

            // Cập nhật tổng tiền hóa đơn
            $hoaDon->tong_tien = $tongTien;
            $hoaDon->save();

            flash_success('Đặt phòng thành công! Hóa đơn #' . $hoaDon->ma_hoa_don . ' đã được tạo.');
            redirect('/booking/success?invoice=' . $hoaDon->ma_hoa_don);

        } catch (Exception $e) {
            // Hiển thị lỗi rõ ràng cho user
            $errorMessage = $e->getMessage();
            set_old_input();
            if (!isEmpty($phongs) && is_array($phongs)) {
                $_SESSION['old_phongs'] = $phongs;
            }
            flash_error($errorMessage);
            back();
        }
    }

    /**
     * Validate dữ liệu checkout mới
     */
    private function validateNewCheckoutData($phongs)
    {
        $errors = [];

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
