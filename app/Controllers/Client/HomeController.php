<?php

namespace HotelBooking\Controllers\Client;

use HotelBooking\Models\DanhGia;
use HotelBooking\Models\Phong;
use HotelBooking\Models\LoaiPhong;
use HotelBooking\Models\LienHe;
use HotelBooking\Facades\DB;
use Exception;

class HomeController
{
    public function index()
    {
        // Get data for homepage
        $danhGias = DanhGia::all();
        $phongs = Phong::all();
        $loaiPhongs = LoaiPhong::all();

        view('Client.Home.home', [
            'danhGias' => $danhGias,
            'phongs' => $phongs,
            'loaiPhongs' => $loaiPhongs
        ]);
    }

    public function searchRooms()
    {
        $checkin = post('checkin', '');
        $checkout = post('checkout', '');
        $guests = post('guests', 1);
        $room_type = post('room_type', '');

        // Basic room search logic
        $availableRooms = Phong::searchAvailable($checkin, $checkout, $guests, $room_type);

        view('Client.Phong.search_results', [
            'rooms' => $availableRooms,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'guests' => $guests,
            'room_type' => $room_type
        ]);
    }

    public function about()
    {
        view('Client.Home.about');
    }

    public function showSearchForm()
    {
        $loaiPhongs = LoaiPhong::all();
        view('Client.Phong.search-form', [
            'loaiPhongs' => $loaiPhongs
        ]);
    }

    public function contact()
    {
        view('Client.Home.contact');
    }

    public function sendContact()
    {
        $ho_ten = post('ho_ten', '');
        $email = post('email', ''); 
        $so_dien_thoai = post('so_dien_thoai', '');
        $chu_de = post('chu_de', '');
        $noi_dung = post('noi_dung', '');

        // Basic validation
        if (empty($ho_ten) || empty($email) || empty($noi_dung)) {
            flash_error('Vui lòng nhập đầy đủ thông tin bắt buộc');
            set_old_input();
            back();
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            flash_error('Email không hợp lệ');
            set_old_input();
            back();
            return;
        }

        try {
            // Save to database using direct query with UTF-8 support
            $conn = DB::connect();
            
            $sql = "INSERT INTO lien_he (ho_ten, email, so_dien_thoai, chu_de, noi_dung, trang_thai, ngay_gui) 
                    VALUES (?, ?, ?, ?, ?, ?, NOW())";
            
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $trang_thai = LienHe::TRANG_THAI_MOI;
                $stmt->bind_param('ssssss', $ho_ten, $email, $so_dien_thoai, $chu_de, $noi_dung, $trang_thai);
                
                if ($stmt->execute()) {
                    flash_success('Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.');
                    clear_old_input();
                } else {
                    flash_error('Có lỗi xảy ra. Vui lòng thử lại.');
                    set_old_input();
                }
                
                $stmt->close();
            } else {
                flash_error('Có lỗi xảy ra. Vui lòng thử lại.');
                set_old_input();
            }
            
            DB::close();
            
        } catch (Exception $e) {
            flash_error('Có lỗi xảy ra: ' . $e->getMessage());
            set_old_input();
        }

        redirect('/contact');
    }
}
