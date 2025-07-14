<?php

namespace HotelBooking\Controllers\Admin;

use Exception;
use HotelBooking\Models\HoaDon;
use HotelBooking\Models\HoaDonPhong;
use HotelBooking\Models\HoaDonDichVu;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Models\Phong;
use HotelBooking\Models\DichVu;
use HotelBooking\Enums\PhanQuyen;
use HotelBooking\Enums\TrangThaiHoaDon;
use HotelBooking\Enums\TrangThaiPhong;

class AdminHoaDonController
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
        $status = get('status', '');
        $date = get('date', '');

        // Get all invoices
        $allHoaDons = HoaDon::all();
        $hoaDons = $allHoaDons;

        // Apply search filter
        if (!empty($search)) {
            $hoaDons = array_filter($hoaDons, function ($hd) use ($search) {
                $khachHang = TaiKhoan::find($hd->ma_khach_hang);
                return stripos($hd->ma_hoa_don, $search) !== false ||
                    ($khachHang && stripos($khachHang->ho_ten, $search) !== false);
            });
        }

        // Apply status filter
        if (!empty($status)) {
            $hoaDons = array_filter($hoaDons, function ($hd) use ($status) {
                return ($hd->trang_thai ?? TrangThaiHoaDon::CHO_XU_LY) === $status;
            });
        }

        // Apply date filter
        if (!empty($date)) {
            $hoaDons = array_filter($hoaDons, function ($hd) use ($date) {
                return date('Y-m-d', strtotime($hd->thoi_gian_dat)) === $date;
            });
        }

        // Calculate statistics
        $stats = [
            'total' => count($allHoaDons),
            'pending' => count(array_filter($allHoaDons, fn($hd) => ($hd->trang_thai ?? TrangThaiHoaDon::CHO_XU_LY) === TrangThaiHoaDon::CHO_XU_LY)),
            'paid' => count(array_filter($allHoaDons, fn($hd) => ($hd->trang_thai ?? TrangThaiHoaDon::CHO_XU_LY) === TrangThaiHoaDon::DA_THANH_TOAN)),
            'revenue_today' => $this->getTodayRevenue($allHoaDons)
        ];

        // Add customer info to invoices
        foreach ($hoaDons as $hoaDon) {
            $khachHang = TaiKhoan::find($hoaDon->ma_khach_hang);
            $hoaDon->ten_khach_hang = $khachHang ? $khachHang->ho_ten : 'N/A';

            // Get room info and calculate correct total
            $hoaDonPhongs = HoaDonPhong::where('ma_hoa_don', $hoaDon->ma_hoa_don)->get();
            $phongNames = [];
            $tongTienPhong = 0;
            
            foreach ($hoaDonPhongs as $hdPhong) {
                $phong = Phong::find($hdPhong->ma_phong);
                if ($phong) {
                    $phongNames[] = $phong->ten_phong;
                    
                    // Calculate hours between check-in and check-out
                    $checkin = strtotime($hdPhong->check_in);
                    $checkout = strtotime($hdPhong->check_out);
                    $hours = ceil(($checkout - $checkin) / 3600); // Convert to hours and round up
                    
                    $tongTienPhong += $hdPhong->gia * $hours;
                }
            }
            
            // Get services total
            $hoaDonDichVus = HoaDonDichVu::where('ma_hoa_don', $hoaDon->ma_hoa_don)->get();
            $tongTienDichVu = 0;
            foreach ($hoaDonDichVus as $hdDichVu) {
                $tongTienDichVu += $hdDichVu->gia * $hdDichVu->so_luong;
            }
            
            $hoaDon->so_phong = implode(', ', $phongNames);
            $hoaDon->tong_tien = $tongTienPhong + $tongTienDichVu; // Update with correct total
        }

        view('Admin.HoaDon.index', [
            'hoaDons' => $hoaDons,
            'stats' => $stats
        ]);
    }

    private function getTodayRevenue($hoaDons)
    {
        $today = date('Y-m-d');
        $revenue = 0;

        foreach ($hoaDons as $hoaDon) {
            if (
                date('Y-m-d', strtotime($hoaDon->thoi_gian_dat)) === $today &&
                ($hoaDon->trang_thai ?? TrangThaiHoaDon::CHO_XU_LY) === TrangThaiHoaDon::DA_THANH_TOAN
            ) {
                $revenue += $hoaDon->tong_tien ?? 0;
            }
        }

        return $revenue;
    }

    public function create()
    {
        // Get customers only
        $khachHangs = array_filter(TaiKhoan::all(), function ($tk) {
            return $tk->phan_quyen === PhanQuyen::KHACH_HANG;
        });

        // Get available rooms
        $phongs = Phong::where('trang_thai', TrangThaiPhong::CON_TRONG)->get();

        // Get services
        $dichVus = DichVu::all();

        view('Admin.HoaDon.create', [
            'khachHangs' => $khachHangs,
            'phongs' => $phongs,
            'dichVus' => $dichVus
        ]);
    }

    public function store()
    {
        // Validate input
        $maKhachHang = post('ma_khach_hang');
        $phongs = post('phongs', []);

        if (empty($maKhachHang)) {
            redirect('/admin/hoa-don/create?error=missing_customer');
        }

        if (empty($phongs)) {
            redirect('/admin/hoa-don/create?error=missing_room');
        }

        // Validate room bookings and check for conflicts
        foreach ($phongs as $index => $phongData) {
            if (!empty($phongData['ma_phong']) && !empty($phongData['check_in']) && !empty($phongData['check_out'])) {
                $checkin = $phongData['check_in'];
                $checkout = $phongData['check_out'];
                $maPhong = $phongData['ma_phong'];

                // Validate dates
                if (strtotime($checkin) >= strtotime($checkout)) {
                    redirect('/admin/hoa-don/create?error=invalid_dates&room=' . ($index + 1));
                }

                // Check for room conflicts
                if (HoaDonPhong::hasConflictForRoom($maPhong, $checkin, $checkout)) {
                    redirect('/admin/hoa-don/create?error=room_conflict&room=' . ($index + 1));
                }

                // Check for internal conflicts within this booking
                for ($j = $index + 1; $j < count($phongs); $j++) {
                    if (!empty($phongs[$j]['ma_phong']) && $phongs[$j]['ma_phong'] == $maPhong) {
                        $otherCheckin = $phongs[$j]['check_in'];
                        $otherCheckout = $phongs[$j]['check_out'];

                        // Check overlap
                        if ($checkin < $otherCheckout && $checkout > $otherCheckin) {
                            redirect('/admin/hoa-don/create?error=internal_conflict&room=' . ($index + 1));
                        }
                    }
                }
            }
        }

        // Create main invoice
        try {
            // Check if user is logged in
            if (!isset($_SESSION['user_id'])) {
                redirect('/auth/login?error=session_expired');
            }

            $hoaDonData = [
                'ma_nhan_vien' => $_SESSION['user_id'],
                'ma_khach_hang' => $maKhachHang,
                'thoi_gian_dat' => date('Y-m-d H:i:s'),
                'trang_thai' => TrangThaiHoaDon::CHO_XU_LY,
                'tong_tien' => 0,
                'ghi_chu' => post('ghi_chu', '')
            ];

            $maHoaDon = HoaDon::createAndReturnId($hoaDonData);

            if (!$maHoaDon) {
                redirect('/admin/hoa-don/create?error=create_failed');
            }
        } catch (Exception $e) {
            redirect('/admin/hoa-don/create?error=create_failed');
        }

        // Add rooms to invoice
        foreach ($phongs as $phongData) {
            if (!empty($phongData['ma_phong']) && !empty($phongData['check_in']) && !empty($phongData['check_out'])) {
                // Get room price
                $phong = Phong::find($phongData['ma_phong']);
                $gia = $phong ? $phong->gia : 0;

                $hoaDonPhongData = [
                    'ma_phong' => $phongData['ma_phong'],
                    'check_in' => $phongData['check_in'],
                    'check_out' => $phongData['check_out'],
                    'gia' => $gia,
                    'ma_hoa_don' => $maHoaDon
                ];

                $maHdPhong = HoaDonPhong::createAndReturnId($hoaDonPhongData);

                // Update room status
                if ($phong) {
                    $phong->update(['trang_thai' => TrangThaiPhong::DANG_DON_DEP]);
                }

                // Add services for this room
                if (!empty($phongData['dich_vus'])) {
                    foreach ($phongData['dich_vus'] as $dichVuData) {
                        if (!empty($dichVuData['ma_dich_vu']) && !empty($dichVuData['so_luong'])) {
                            // Get service price
                            $dichVu = DichVu::find($dichVuData['ma_dich_vu']);
                            $gia = $dichVu ? $dichVu->gia : 0;

                            HoaDonDichVu::create([
                                'ma_hd_phong' => $maHdPhong,
                                'ma_dich_vu' => $dichVuData['ma_dich_vu'],
                                'gia' => $gia,
                                'so_luong' => $dichVuData['so_luong'],
                                'thoi_gian' => date('Y-m-d H:i:s')
                            ]);
                        }
                    }
                }
            }
        }

        // Add general services to invoice
        $dichVusChung = post('dich_vus_chung', []);
        if (!empty($dichVusChung)) {
            foreach ($dichVusChung as $dichVuData) {
                if (!empty($dichVuData['ma_dich_vu']) && !empty($dichVuData['so_luong'])) {
                    // Get service price
                    $dichVu = DichVu::find($dichVuData['ma_dich_vu']);
                    $gia = $dichVu ? $dichVu->gia : 0;

                    HoaDonDichVu::create([
                        'ma_hoa_don' => $maHoaDon,
                        'ma_dich_vu' => $dichVuData['ma_dich_vu'],
                        'gia' => $gia,
                        'so_luong' => $dichVuData['so_luong'],
                        'thoi_gian' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }

        // Calculate and update total amount
        $tongTien = 0;
        
        // Calculate room costs (per hour)
        $hoaDonPhongs = HoaDonPhong::where('ma_hoa_don', $maHoaDon)->get();
        foreach ($hoaDonPhongs as $hdPhong) {
            $checkin = strtotime($hdPhong->check_in);
            $checkout = strtotime($hdPhong->check_out);
            $hours = ceil(($checkout - $checkin) / 3600); // Convert to hours and round up
            $tongTien += $hdPhong->gia * $hours;
        }
        
        // Calculate service costs
        $hoaDonDichVus = HoaDonDichVu::where('ma_hoa_don', $maHoaDon)->get();
        foreach ($hoaDonDichVus as $hdDichVu) {
            $tongTien += $hdDichVu->gia * $hdDichVu->so_luong;
        }
        
        // Update invoice total
        $hoaDon = HoaDon::find($maHoaDon);
        if ($hoaDon) {
            $hoaDon->update(['tong_tien' => $tongTien]);
        }

        redirect('/admin/hoa-don?success=created');
    }

    public function show()
    {
        $id = get('id');
        if (!$id) {
            redirect('/admin/hoa-don?error=missing_id');
        }

        $hoaDon = HoaDon::find($id);

        if (!$hoaDon) {
            redirect('/admin/hoa-don?error=notfound');
        }

        view('Admin.HoaDon.show', ['hoaDon' => $hoaDon]);
    }

    public function edit()
    {
        $id = get('id');
        if (!$id) {
            redirect('/admin/hoa-don?error=missing_id');
        }

        $hoaDon = HoaDon::find($id);
        $taiKhoans = TaiKhoan::all();

        if (!$hoaDon) {
            redirect('/admin/hoa-don?error=notfound');
        }

        view('Admin.HoaDon.edit', ['hoaDon' => $hoaDon, 'taiKhoans' => $taiKhoans]);
    }

    public function update()
    {
        $id = post('id') ?: get('id');
        if (!$id) {
            redirect('/admin/hoa-don?error=missing_id');
        }

        $hoaDon = HoaDon::find($id);
        if (!$hoaDon) {
            redirect('/admin/hoa-don?error=notfound');
        }

        // Update basic invoice information
        $data = [
            'ma_nhan_vien' => post('ma_nhan_vien', $hoaDon->ma_nhan_vien),
            'ma_khach_hang' => post('ma_khach_hang', $hoaDon->ma_khach_hang),
            'trang_thai' => post('trang_thai', $hoaDon->trang_thai),
            'ghi_chu' => post('ghi_chu', $hoaDon->ghi_chu)
        ];

        $hoaDon->update($data);

        // Handle existing rooms
        $existingRooms = post('existing_rooms', []);
        foreach ($existingRooms as $roomData) {
            if (!empty($roomData['ma_hd_phong'])) {
                $hdPhong = HoaDonPhong::find($roomData['ma_hd_phong']);
                if ($hdPhong) {
                    $checkin = $roomData['check_in'];
                    $checkout = $roomData['check_out'];

                    // Validate dates
                    if (strtotime($checkin) >= strtotime($checkout)) {
                        redirect('/admin/hoa-don/edit?id=' . $id . '&error=invalid_dates');
                    }

                    // Check for conflicts (excluding current booking)
                    $conflictingBookings = HoaDonPhong::query()
                        ->where('ma_phong', '=', $roomData['ma_phong'])
                        ->where('check_in', '<', $checkout)
                        ->where('check_out', '>', $checkin)
                        ->where('ma_hd_phong', '!=', $hdPhong->ma_hd_phong)
                        ->count();

                    if ($conflictingBookings > 0) {
                        redirect('/admin/hoa-don/edit?id=' . $id . '&error=room_conflict');
                    }

                    // Get room price
                    $phong = Phong::find($roomData['ma_phong']);
                    $gia = $phong ? $phong->gia : 0;

                    $hdPhong->update([
                        'ma_phong' => $roomData['ma_phong'],
                        'check_in' => $checkin,
                        'check_out' => $checkout,
                        'gia' => $gia
                    ]);
                }
            }
        }

        // Handle new rooms
        $newRooms = post('new_rooms', []);
        foreach ($newRooms as $roomData) {
            if (!empty($roomData['ma_phong']) && !empty($roomData['check_in']) && !empty($roomData['check_out'])) {
                $checkin = $roomData['check_in'];
                $checkout = $roomData['check_out'];

                // Validate dates
                if (strtotime($checkin) >= strtotime($checkout)) {
                    redirect('/admin/hoa-don/edit?id=' . $id . '&error=invalid_dates');
                }

                // Check for conflicts
                if (HoaDonPhong::hasConflictForRoom($roomData['ma_phong'], $checkin, $checkout)) {
                    redirect('/admin/hoa-don/edit?id=' . $id . '&error=room_conflict');
                }

                // Get room price
                $phong = Phong::find($roomData['ma_phong']);
                $gia = $phong ? $phong->gia : 0;

                HoaDonPhong::create([
                    'ma_phong' => $roomData['ma_phong'],
                    'check_in' => $checkin,
                    'check_out' => $checkout,
                    'gia' => $gia,
                    'ma_hoa_don' => $id
                ]);
            }
        }

        // Handle existing services
        $existingServices = post('existing_services', []);
        foreach ($existingServices as $serviceData) {
            if (!empty($serviceData['ma_hd_dich_vu'])) {
                $hdDichVu = HoaDonDichVu::find($serviceData['ma_hd_dich_vu']);
                if ($hdDichVu) {
                    // Get service price
                    $dichVu = DichVu::find($serviceData['ma_dich_vu']);
                    $gia = $dichVu ? $dichVu->gia : 0;

                    $hdDichVu->update([
                        'ma_dich_vu' => $serviceData['ma_dich_vu'],
                        'gia' => $gia,
                        'so_luong' => $serviceData['so_luong'] ?? 1
                    ]);
                }
            }
        }

        // Handle new services
        $newServices = post('new_services', []);
        foreach ($newServices as $serviceData) {
            if (!empty($serviceData['ma_dich_vu']) && !empty($serviceData['so_luong'])) {
                // Get service price
                $dichVu = DichVu::find($serviceData['ma_dich_vu']);
                $gia = $dichVu ? $dichVu->gia : 0;

                HoaDonDichVu::create([
                    'ma_hoa_don' => $id,
                    'ma_dich_vu' => $serviceData['ma_dich_vu'],
                    'gia' => $gia,
                    'so_luong' => $serviceData['so_luong'],
                    'thoi_gian' => date('Y-m-d H:i:s')
                ]);
            }
        }

        // Recalculate total manually
        $totalAmount = 0;

        // Calculate room total (per hour)
        $rooms = HoaDonPhong::where('ma_hoa_don', $id)->get();
        foreach ($rooms as $room) {
            $soGio = ceil((strtotime($room->check_out) - strtotime($room->check_in)) / 3600);
            $totalAmount += ($room->gia ?? 0) * $soGio;
        }

        // Calculate service total
        $services = HoaDonDichVu::where('ma_hoa_don', $id)->get();
        foreach ($services as $service) {
            $totalAmount += ($service->gia ?? 0) * ($service->so_luong ?? 1);
        }

        // Update total
        $hoaDon = HoaDon::find($id);
        if ($hoaDon) {
            $hoaDon->update(['tong_tien' => $totalAmount]);
        }

        redirect('/admin/hoa-don/edit?id=' . $id . '&success=updated');
    }

    public function destroy()
    {
        $id = post('id') ?: get('id');
        if (!$id) {
            redirect('/admin/hoa-don?error=missing_id');
        }

        $hoaDon = HoaDon::find($id);
        if (!$hoaDon) {
            redirect('/admin/hoa-don?error=notfound');
        }

        $hoaDon->delete();
        redirect('/admin/hoa-don?success=deleted');
    }
}



