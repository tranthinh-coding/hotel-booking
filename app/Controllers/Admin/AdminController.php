<?php

namespace HotelBooking\Controllers\Admin;

use HotelBooking\Models\Phong;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Models\DanhGia;
use HotelBooking\Models\HoaDon;
use HotelBooking\Models\DichVu;
use HotelBooking\Models\LoaiPhong;
use HotelBooking\Enums\PhanQuyen;
use HotelBooking\Enums\TrangThaiHoaDon;
use HotelBooking\Enums\TrangThaiPhong;
use Exception;

class AdminController
{
    public function dashboard()
    {
        // Check admin access
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }

        // Get dashboard statistics
        $today = date('Y-m-d');

        // Doanh thu hôm nay
        $todayRevenue = 0;
        try {
            $revenueResult = \HotelBooking\Facades\DB::query(
                "SELECT COALESCE(SUM(tong_tien), 0) as revenue FROM hoa_don_tong WHERE DATE(thoi_gian_dat) = ? AND trang_thai IN (?, ?)",
                [$today, TrangThaiHoaDon::DA_THANH_TOAN, TrangThaiHoaDon::DA_XAC_NHAN]
            );
            if (is_array($revenueResult) && isset($revenueResult[0]['revenue'])) {
                $todayRevenue = (int)$revenueResult[0]['revenue'];
            }
        } catch (Exception $e) {
            $todayRevenue = 0;
        }

        // Tổng đặt phòng hôm nay
        $totalBookings = 0;
        try {
            $bookingsResult = \HotelBooking\Facades\DB::query(
                "SELECT COUNT(*) as count FROM hoa_don_tong WHERE DATE(thoi_gian_dat) = ?",
                [$today]
            );
            if (is_array($bookingsResult) && isset($bookingsResult[0]['count'])) {
                $totalBookings = (int)$bookingsResult[0]['count'];
            }
        } catch (Exception $e) {
            $totalBookings = 0;
        }

        // Tổng số phòng
        $totalRooms = 0;
        try {
            $roomsResult = \HotelBooking\Facades\DB::query(
                "SELECT COUNT(*) as count FROM phong WHERE trang_thai != ?",
                [TrangThaiPhong::NGUNG_HOAT_DONG]
            );
            if (is_array($roomsResult) && isset($roomsResult[0]['count'])) {
                $totalRooms = (int)$roomsResult[0]['count'];
            }
        } catch (Exception $e) {
            $totalRooms = 0;
        }

        // Tổng khách hàng
        $totalUsers = 0;
        try {
            $usersResult = \HotelBooking\Facades\DB::query(
                "SELECT COUNT(*) as count FROM tai_khoan WHERE phan_quyen = ?",
                [PhanQuyen::KHACH_HANG]
            );
            if (is_array($usersResult) && isset($usersResult[0]['count'])) {
                $totalUsers = (int)$usersResult[0]['count'];
            }
        } catch (Exception $e) {
            $totalUsers = 0;
        }

        // Phòng trống
        $availableRooms = 0;
        try {
            $availableResult = \HotelBooking\Facades\DB::query(
                "SELECT COUNT(*) as count FROM phong WHERE trang_thai = ?",
                [TrangThaiPhong::CON_TRONG]
            );
            if (is_array($availableResult) && isset($availableResult[0]['count'])) {
                $availableRooms = (int)$availableResult[0]['count'];
            }
        } catch (Exception $e) {
            $availableRooms = 0;
        }

        // Phòng đã đặt (tối ưu hóa query)
        $bookedRooms = 0;
        try {
            $bookedResult = \HotelBooking\Facades\DB::query(
                "SELECT COUNT(DISTINCT hdp.ma_phong) as count 
                 FROM hoa_don_phong hdp 
                 JOIN hoa_don_tong hdt ON hdp.ma_hoa_don = hdt.ma_hoa_don 
                 WHERE hdt.trang_thai IN (?, ?) 
                 AND DATE(hdp.check_in) <= CURDATE() 
                 AND DATE(hdp.check_out) >= CURDATE()",
                [TrangThaiHoaDon::DA_XAC_NHAN, TrangThaiHoaDon::DA_THANH_TOAN]
            );
            if (is_array($bookedResult) && isset($bookedResult[0]['count'])) {
                $bookedRooms = (int)$bookedResult[0]['count'];
            }
        } catch (Exception $e) {
            $bookedRooms = 0;
        }

        // Phòng bảo trì
        $maintenanceRooms = 0;
        try {
            $maintenanceResult = \HotelBooking\Facades\DB::query(
                "SELECT COUNT(*) as count FROM phong WHERE trang_thai = ?",
                [TrangThaiPhong::BAO_TRI]
            );
            if (is_array($maintenanceResult) && isset($maintenanceResult[0]['count'])) {
                $maintenanceRooms = (int)$maintenanceResult[0]['count'];
            }
        } catch (Exception $e) {
            $maintenanceRooms = 0;
        }

        // Hoạt động gần đây
        $recentActivities = [];
        try {
            $activitiesResult = \HotelBooking\Facades\DB::query(
                "SELECT hdt.ma_hoa_don, hdt.thoi_gian_dat, hdt.trang_thai, hdt.tong_tien, tk.ho_ten as khach_hang
                 FROM hoa_don_tong hdt
                 LEFT JOIN tai_khoan tk ON hdt.ma_khach_hang = tk.ma_tai_khoan
                 ORDER BY hdt.thoi_gian_dat DESC
                 LIMIT 5"
            );
            
            if (is_array($activitiesResult)) {
                $statusLabels = [
                    TrangThaiHoaDon::CHO_XAC_NHAN => 'Chờ xác nhận',
                    TrangThaiHoaDon::DA_XAC_NHAN => 'Đã xác nhận',
                    TrangThaiHoaDon::DA_THANH_TOAN => 'Đã thanh toán',
                    TrangThaiHoaDon::DA_HUY => 'Đã hủy'
                ];
                
                $statusColors = [
                    TrangThaiHoaDon::CHO_XAC_NHAN => 'yellow',
                    TrangThaiHoaDon::DA_XAC_NHAN => 'blue', 
                    TrangThaiHoaDon::DA_THANH_TOAN => 'green',
                    TrangThaiHoaDon::DA_HUY => 'red'
                ];

                foreach ($activitiesResult as $activity) {
                    $timeString = !isEmpty($activity['thoi_gian_dat']) ? date('d/m/Y H:i', strtotime($activity['thoi_gian_dat'])) : '';
                    $recentActivities[] = [
                        'title' => 'Đơn đặt phòng #' . $activity['ma_hoa_don'] . ' - ' . ($statusLabels[$activity['trang_thai']] ?? 'Không xác định'),
                        'subtitle' => 'Khách hàng: ' . ($activity['khach_hang'] ?? 'N/A') . ' - ' . number_format($activity['tong_tien']) . '₫',
                        'time' => $timeString,
                        'icon' => 'calendar-check',
                        'color' => $statusColors[$activity['trang_thai']] ?? 'gray',
                        'url' => '/admin/hoa-don/show?id=' . $activity['ma_hoa_don']
                    ];
                }
            }
        } catch (Exception $e) {
            $recentActivities = [];
        }

        // Doanh thu 7 ngày qua
        $revenue7DaysLabels = [];
        $revenue7DaysData = [];
        try {
            $result = \HotelBooking\Facades\DB::query(
                "SELECT DATE(thoi_gian_dat) as ngay, COALESCE(SUM(tong_tien),0) as revenue
                 FROM hoa_don_tong
                 WHERE thoi_gian_dat >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
                   AND trang_thai IN (?, ?)
                 GROUP BY DATE(thoi_gian_dat)
                 ORDER BY ngay ASC",
                [TrangThaiHoaDon::DA_THANH_TOAN, TrangThaiHoaDon::DA_XAC_NHAN]
            );
            // Tạo mảng đủ 7 ngày liên tục
            $map = [];
            foreach ($result as $row) {
                $map[$row['ngay']] = (int)$row['revenue'];
            }
            for ($i = 6; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-{$i} days"));
                $revenue7DaysLabels[] = date('d/m', strtotime($date));
                $revenue7DaysData[] = $map[$date] ?? 0;
            }
        } catch (Exception $e) {
            $revenue7DaysLabels = [];
            $revenue7DaysData = [];
        }

        view('Admin.Dashboard.index', [
            'todayRevenue' => $todayRevenue,
            'totalBookings' => $totalBookings,
            'totalRooms' => $totalRooms,
            'totalUsers' => $totalUsers,
            'availableRooms' => $availableRooms,
            'bookedRooms' => $bookedRooms,
            'maintenanceRooms' => $maintenanceRooms,
            'recentActivities' => $recentActivities,
            'user' => $user,
            'revenue7DaysLabels' => $revenue7DaysLabels,
            'revenue7DaysData' => $revenue7DaysData
        ]);
    }

    // Quản lý tài khoản
    public function taiKhoanIndex()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }

        $taiKhoans = TaiKhoan::all();
        view('Admin.TaiKhoan.index', ['taiKhoans' => $taiKhoans]);
    }

    public function taiKhoanCreate()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }

        view('Admin.TaiKhoan.create', []);
    }

    public function taiKhoanStore()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }

        $data = [
            'ho_ten' => post('ho_ten', ''),
            'mail' => post('mail', ''),
            'so_cccd' => post('so_cccd', ''),
            'sdt' => post('sdt', ''),
            'phan_quyen' => post(
                'phan_quyen',
                PhanQuyen::KHACH_HANG
            )
        ];

        if (!$_POST['mat_khau']) {
            $data['mat_khau'] = password_hash($_POST['mat_khau'], PASSWORD_DEFAULT);
        }

        TaiKhoan::create($data);
        flash_set('success', 'Tài khoản đã được tạo thành công!');
        redirect('/admin/tai-khoan');
    }

    public function taiKhoanEdit($id)
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }

        $taiKhoan = TaiKhoan::find($id);
        view('Admin.TaiKhoan.edit', ['taiKhoan' => $taiKhoan]);
    }

    public function taiKhoanUpdate($id)
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }

        $taiKhoan = TaiKhoan::find($id);
        $data = [
            'ho_ten' => post('ho_ten', $taiKhoan->ho_ten),
            'mail' => post('mail', $taiKhoan->mail),
            'so_cccd' => post('so_cccd', $taiKhoan->so_cccd),
            'sdt' => post('sdt', $taiKhoan->sdt),
            'phan_quyen' => post(
                'phan_quyen',
                $taiKhoan->phan_quyen
            )
        ];

        if (isNotEmpty($_POST['mat_khau'])) {
            $data['mat_khau'] = password_hash($_POST['mat_khau'], PASSWORD_DEFAULT);
        }

        $taiKhoan->update($data);
        flash_set('success', 'Tài khoản đã được cập nhật thành công!');
        redirect('/admin/tai-khoan');
    }

    public function taiKhoanDestroy($id)
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }

        $taiKhoan = TaiKhoan::find($id);
        if ($taiKhoan) {
            $taiKhoan->delete();
            flash_set('success', 'Tài khoản đã được xóa thành công!');
        }
        redirect('/admin/tai-khoan');
    }

    public function thongKe()
    {
        // Check admin access
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }

        // Doanh thu theo tháng (12 tháng gần nhất)
        $monthlyRevenue = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = date('Y-m', strtotime("-$i months"));
            $monthName = date('m/Y', strtotime("-$i months"));
            
            try {
                $result = \HotelBooking\Facades\DB::query(
                    "SELECT COALESCE(SUM(tong_tien), 0) as revenue 
                     FROM hoa_don_tong 
                     WHERE DATE_FORMAT(thoi_gian_dat, '%Y-%m') = ? 
                     AND trang_thai IN (?, ?)",
                    [$month, TrangThaiHoaDon::DA_THANH_TOAN, TrangThaiHoaDon::DA_XAC_NHAN]
                );
                $revenue = is_array($result) && isset($result[0]['revenue']) ? (int)$result[0]['revenue'] : 0;
            } catch (Exception $e) {
                $revenue = 0;
            }
            
            $monthlyRevenue[] = [
                'month' => $monthName,
                'revenue' => $revenue
            ];
        }

        // Đặt phòng theo tháng (12 tháng gần nhất)
        $monthlyBookings = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = date('Y-m', strtotime("-$i months"));
            $monthName = date('m/Y', strtotime("-$i months"));
            
            try {
                $result = \HotelBooking\Facades\DB::query(
                    "SELECT COUNT(*) as count 
                     FROM hoa_don_tong 
                     WHERE DATE_FORMAT(thoi_gian_dat, '%Y-%m') = ?",
                    [$month]
                );
                $count = is_array($result) && isset($result[0]['count']) ? (int)$result[0]['count'] : 0;
            } catch (Exception $e) {
                $count = 0;
            }
            
            $monthlyBookings[] = [
                'month' => $monthName,
                'bookings' => $count
            ];
        }

        // Top loại phòng được đặt nhiều nhất
        $topRoomTypes = [];
        try {
            $result = \HotelBooking\Facades\DB::query(
                "SELECT lp.ten_loai_phong, COUNT(hdp.ma_phong) as so_lan_dat,
                        COALESCE(SUM(hdp.so_gio * lp.gia_gio), 0) as doanh_thu
                 FROM hoa_don_phong hdp
                 JOIN phong p ON hdp.ma_phong = p.ma_phong
                 JOIN loai_phong lp ON p.ma_loai_phong = lp.ma_loai_phong
                 JOIN hoa_don_tong hdt ON hdp.ma_hoa_don = hdt.ma_hoa_don
                 WHERE hdt.trang_thai IN (?, ?)
                 GROUP BY lp.ma_loai_phong, lp.ten_loai_phong
                 ORDER BY so_lan_dat DESC
                 LIMIT 5",
                [TrangThaiHoaDon::DA_XAC_NHAN, TrangThaiHoaDon::DA_THANH_TOAN]
            );
            
            if (is_array($result)) {
                $topRoomTypes = $result;
            }
        } catch (Exception $e) {
            $topRoomTypes = [];
        }

        // Dịch vụ được sử dụng nhiều nhất
        $topServices = [];
        try {
            $result = \HotelBooking\Facades\DB::query(
                "SELECT dv.ten_dich_vu, COUNT(hddv.ma_dich_vu) as so_lan_dung,
                        COALESCE(SUM(hddv.so_luong * dv.gia), 0) as doanh_thu
                 FROM hoa_don_dich_vu hddv
                 JOIN dich_vu dv ON hddv.ma_dich_vu = dv.ma_dich_vu
                 JOIN hoa_don_tong hdt ON hddv.ma_hoa_don = hdt.ma_hoa_don
                 WHERE hdt.trang_thai IN (?, ?)
                 GROUP BY dv.ma_dich_vu, dv.ten_dich_vu
                 ORDER BY so_lan_dung DESC
                 LIMIT 5",
                [TrangThaiHoaDon::DA_XAC_NHAN, TrangThaiHoaDon::DA_THANH_TOAN]
            );
            
            if (is_array($result)) {
                $topServices = $result;
            }
        } catch (Exception $e) {
            $topServices = [];
        }

        // Thống kê theo trạng thái đơn hàng
        $statusStats = [];
        $statuses = [
            TrangThaiHoaDon::CHO_XAC_NHAN => 'Chờ xác nhận',
            TrangThaiHoaDon::DA_XAC_NHAN => 'Đã xác nhận',
            TrangThaiHoaDon::DA_THANH_TOAN => 'Đã thanh toán',
            TrangThaiHoaDon::DA_HUY => 'Đã hủy'
        ];

        foreach ($statuses as $status => $label) {
            try {
                $result = \HotelBooking\Facades\DB::query(
                    "SELECT COUNT(*) as count, COALESCE(SUM(tong_tien), 0) as revenue
                     FROM hoa_don_tong 
                     WHERE trang_thai = ?",
                    [$status]
                );
                
                $count = is_array($result) && isset($result[0]['count']) ? (int)$result[0]['count'] : 0;
                $revenue = is_array($result) && isset($result[0]['revenue']) ? (int)$result[0]['revenue'] : 0;
            } catch (Exception $e) {
                $count = 0;
                $revenue = 0;
            }
            
            $statusStats[] = [
                'status' => $label,
                'count' => $count,
                'revenue' => $revenue
            ];
        }

        // Khách hàng đặt phòng nhiều nhất
        $topCustomers = [];
        try {
            $result = \HotelBooking\Facades\DB::query(
                "SELECT tk.ho_ten, tk.mail as email, COUNT(hdt.ma_hoa_don) as so_don_hang,
                        COALESCE(SUM(hdt.tong_tien), 0) as tong_chi_tieu
                 FROM hoa_don_tong hdt
                 JOIN tai_khoan tk ON hdt.ma_khach_hang = tk.ma_tai_khoan
                 WHERE hdt.trang_thai IN (?, ?)
                 GROUP BY tk.ma_tai_khoan, tk.ho_ten, tk.mail
                 ORDER BY so_don_hang DESC
                 LIMIT 10",
                [TrangThaiHoaDon::DA_XAC_NHAN, TrangThaiHoaDon::DA_THANH_TOAN]
            );
            
            if (is_array($result)) {
                $topCustomers = $result;
            }
        } catch (Exception $e) {
            $topCustomers = [];
        }

        view('Admin.ThongKe.index', [
            'monthlyRevenue' => $monthlyRevenue,
            'monthlyBookings' => $monthlyBookings,
            'topRoomTypes' => $topRoomTypes,
            'topServices' => $topServices,
            'statusStats' => $statusStats,
            'topCustomers' => $topCustomers,
            'user' => $user
        ]);
    }
}


