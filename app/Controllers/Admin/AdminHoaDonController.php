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

        // Get optimized statistics in one query
        $stats = HoaDon::getStatistics();

        // Get all invoices with details using optimized JOIN query that includes calculated total
        if (isNotEmpty($search) || isNotEmpty($status) || isNotEmpty($date)) {
            $hoaDons = HoaDon::searchWithDetailsAndTotal($search, $status, $date);
        } else {
            $hoaDons = HoaDon::getAllWithDetailsAndTotal();
        }

        // Convert array results to objects for view compatibility
        $hoaDonObjects = [];
        foreach ($hoaDons as $hoaDon) {
            $hoaDonObjects[] = (object) $hoaDon;
        }

        view('Admin.HoaDon.index', [
            'hoaDons' => $hoaDonObjects,
            'stats' => $stats
        ]);
    }

    public function create()
    {
        // Get customers only using optimized query
        $khachHangs = TaiKhoan::getCustomersOnly();

        // Get available rooms using optimized query
        $phongs = Phong::getAvailableRooms();

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

        if (isEmpty($maKhachHang)) {
            redirect('/admin/hoa-don/create?error=missing_customer');
        }

        if (isEmpty($phongs)) {
            redirect('/admin/hoa-don/create?error=missing_room');
        }

        // Validate room bookings and check for conflicts
        foreach ($phongs as $index => $phongData) {
            if (isNotEmpty($phongData['ma_phong']) && isNotEmpty($phongData['check_in']) && isNotEmpty($phongData['check_out'])) {
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
                    if (isNotEmpty($phongs[$j]['ma_phong']) && $phongs[$j]['ma_phong'] == $maPhong) {
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

        // Add rooms to invoice - batch get room prices first
        $roomIds = [];
        foreach ($phongs as $phongData) {
            if (isNotEmpty($phongData['ma_phong'])) {
                $roomIds[] = $phongData['ma_phong'];
            }
        }
        
        // Get all room prices in one query
        $roomPrices = [];
        if (isNotEmpty($roomIds)) {
            $roomsData = Phong::getRoomsPricesByIds($roomIds);
            foreach ($roomsData as $room) {
                $roomPrices[$room['ma_phong']] = $room['gia'];
            }
        }

        foreach ($phongs as $phongData) {
            if (isNotEmpty($phongData['ma_phong']) && isNotEmpty($phongData['check_in']) && isNotEmpty($phongData['check_out'])) {
                // Get room price from cached data
                $gia = $roomPrices[$phongData['ma_phong']] ?? 0;

                $hoaDonPhongData = [
                    'ma_phong' => $phongData['ma_phong'],
                    'check_in' => $phongData['check_in'],
                    'check_out' => $phongData['check_out'],
                    'gia' => $gia,
                    'ma_hoa_don' => $maHoaDon
                ];

                $maHdPhong = HoaDonPhong::createAndReturnId($hoaDonPhongData);

                // Update room status - batch update later if needed
                if ($gia > 0) {
                    Phong::updateRoomStatus($phongData['ma_phong'], TrangThaiPhong::DANG_DON_DEP);
                }

                // Add services for this room
                if (isNotEmpty($phongData['dich_vus'])) {
                    $serviceData = [];
                    foreach ($phongData['dich_vus'] as $dichVuData) {
                        if (isNotEmpty($dichVuData['ma_dich_vu']) && isNotEmpty($dichVuData['so_luong'])) {
                            // Get service price - can be optimized later with batch query
                            $dichVu = DichVu::find($dichVuData['ma_dich_vu']);
                            $giaService = $dichVu ? $dichVu->gia : 0;

                            $serviceData[] = [
                                'ma_hd_phong' => $maHdPhong,
                                'ma_dich_vu' => $dichVuData['ma_dich_vu'],
                                'gia' => $giaService,
                                'so_luong' => $dichVuData['so_luong'],
                                'thoi_gian' => date('Y-m-d H:i:s')
                            ];
                        }
                    }
                    
                    // Bulk insert services if any
                    if (isNotEmpty($serviceData)) {
                        HoaDonDichVu::bulkInsertServices($serviceData);
                    }
                }
            }
        }

        // Add general services to invoice - batch get service prices first
        $dichVusChung = post('dich_vus_chung', []);
        if (isNotEmpty($dichVusChung)) {
            // Collect all service IDs first
            $serviceIds = [];
            foreach ($dichVusChung as $dichVuData) {
                if (isNotEmpty($dichVuData['ma_dich_vu']) && isNotEmpty($dichVuData['so_luong'])) {
                    $serviceIds[] = $dichVuData['ma_dich_vu'];
                }
            }
            
            // Batch get service prices
            $servicePrices = DichVu::getServicesPricesByIds($serviceIds);
            
            // Create service invoice entries
            $serviceData = [];
            foreach ($dichVusChung as $dichVuData) {
                if (isNotEmpty($dichVuData['ma_dich_vu']) && isNotEmpty($dichVuData['so_luong'])) {
                    $serviceId = $dichVuData['ma_dich_vu'];
                    $gia = isset($servicePrices[$serviceId]) ? $servicePrices[$serviceId] : 0;

                    $serviceData[] = [
                        'ma_hoa_don' => $maHoaDon,
                        'ma_dich_vu' => $serviceId,
                        'gia' => $gia,
                        'so_luong' => $dichVuData['so_luong'],
                        'thoi_gian' => date('Y-m-d H:i:s')
                    ];
                }
            }
            
            // Bulk insert services
            if (isNotEmpty($serviceData)) {
                HoaDonDichVu::bulkInsertServices($serviceData);
            }
        }

        // Calculate and update total amount using optimized method
        $totals = HoaDon::calculateTotalWithHours($maHoaDon);
        
        // Update invoice total
        $hoaDon = HoaDon::find($maHoaDon);
        if ($hoaDon) {
            $hoaDon->update(['tong_tien' => $totals['tong_tien']]);
        }

        redirect('/admin/hoa-don?success=created');
    }

    public function show()
    {
        $id = get('id');
        if (!$id) {
            redirect('/admin/hoa-don?error=missing_id');
        }

        // Get complete invoice details with related data in single query
        $hoaDonDetails = HoaDon::getInvoiceDetails($id);

        if (!$hoaDonDetails) {
            redirect('/admin/hoa-don?error=notfound');
        }

        view('Admin.HoaDon.show', ['hoaDon' => $hoaDonDetails]);
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

        // Update basic invoice information first
        $data = [
            'ma_nhan_vien' => post('ma_nhan_vien', $hoaDon->ma_nhan_vien),
            'ma_khach_hang' => post('ma_khach_hang', $hoaDon->ma_khach_hang),
            'trang_thai' => post('trang_thai', $hoaDon->trang_thai),
            'ghi_chu' => post('ghi_chu', $hoaDon->ghi_chu)
        ];

        $hoaDon->update($data);

        // Get room and service data
        $existingRooms = post('existing_rooms', []);
        $newRooms = post('new_rooms', []);
        $existingServices = post('existing_services', []);
        $newServices = post('new_services', []);
        
        // Check if there are any room/service changes
        $hasRoomServiceChanges = !isEmpty($existingRooms) || !isEmpty($newRooms) || 
                                !isEmpty($existingServices) || !isEmpty($newServices);

        // If no room/service changes, just redirect with success
        if (!$hasRoomServiceChanges) {
            redirect('/admin/hoa-don/show?id=' . $id . '&success=updated');
            return;
        }

        // Handle existing rooms - check for time changes that require conflict checking
        foreach ($existingRooms as $roomData) {
            if (isNotEmpty($roomData['ma_hd_phong'])) {
                $hdPhong = HoaDonPhong::find($roomData['ma_hd_phong']);
                if ($hdPhong) {
                    $checkin = $roomData['check_in'];
                    $checkout = $roomData['check_out'];

                    // Validate dates
                    if (strtotime($checkin) >= strtotime($checkout)) {
                        redirect('/admin/hoa-don/edit?id=' . $id . '&error=invalid_dates');
                    }

                    // Check if room or time has changed - only then check for conflicts
                    $roomChanged = $hdPhong->ma_phong != $roomData['ma_phong'];
                    $timeChanged = $hdPhong->check_in != $checkin || $hdPhong->check_out != $checkout;
                    
                    if ($roomChanged || $timeChanged) {
                        // Check for conflicts (excluding current booking)
                        if (HoaDonPhong::hasConflictForRoom($roomData['ma_phong'], $checkin, $checkout, $hdPhong->ma_hd_phong)) {
                            redirect('/admin/hoa-don/edit?id=' . $id . '&error=room_conflict');
                        }
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

        // Handle new rooms - always check for conflicts since these are new additions
        $newRooms = post('new_rooms', []);
        foreach ($newRooms as $roomData) {
            if (isNotEmpty($roomData['ma_phong']) && isNotEmpty($roomData['check_in']) && isNotEmpty($roomData['check_out'])) {
                $checkin = $roomData['check_in'];
                $checkout = $roomData['check_out'];

                // Validate dates
                if (strtotime($checkin) >= strtotime($checkout)) {
                    redirect('/admin/hoa-don/edit?id=' . $id . '&error=invalid_dates');
                }

                // Always check for conflicts when adding new rooms
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

        // Handle existing services - update without conflict checking
        $existingServices = post('existing_services', []);
        foreach ($existingServices as $serviceData) {
            if (isNotEmpty($serviceData['ma_hd_dich_vu'])) {
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

        // Handle new services - add new services
        $newServices = post('new_services', []);
        foreach ($newServices as $serviceData) {
            if (isNotEmpty($serviceData['ma_dich_vu']) && isNotEmpty($serviceData['so_luong'])) {
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

        // Recalculate total if there were room/service changes
        if ($hasRoomServiceChanges) {
            $totals = HoaDon::calculateTotalWithHours($id);

            // Update total
            $hoaDon = HoaDon::find($id);
            if ($hoaDon) {
                $hoaDon->update(['tong_tien' => $totals['tong_tien']]);
            }
        }

        redirect('/admin/hoa-don/show?id=' . $id . '&success=updated');
    }
}



