<?php

namespace HotelBooking\Models;

// Add import for HinhAnh
use HotelBooking\Models\HinhAnh;

/**
 * @property string $ma_phong
 * @property string $ten_phong
 * @property string $loai_phong
 * @property float $gia_phong
 */
class Phong extends Model
{
    protected $table = 'phong';

    protected $primaryKey = 'ma_phong';

    protected $attributes = [
        'ma_phong',
        'ten_phong',
        'mo_ta',
        'gia',
        'ma_loai_phong',
        'trang_thai'
    ];

    /**
     * Tìm kiếm phòng khả dụng theo khoảng thời gian
     * 
     * @param string $checkin Ngày checkin (Y-m-d)
     * @param string $checkout Ngày checkout (Y-m-d) 
     * @param int $guests Số lượng khách (hiện tại chưa dùng)
     * @param string $roomType Loại phòng (tùy chọn)
     * @return array Danh sách phòng khả dụng
     */
    public static function searchAvailable($checkin, $checkout, $guests = 1, $roomType = '')
    {
        // Validate input dates
        if (empty($checkin) || empty($checkout)) {
            return static::all();
        }

        // Convert to proper date format
        $checkinDate = date('Y-m-d', strtotime($checkin));
        $checkoutDate = date('Y-m-d', strtotime($checkout));

        // Validate date range
        if ($checkinDate >= $checkoutDate) {
            return static::all();
        }

        // Query to find available rooms with room type and image info
        return static::whereRaw("
            ma_phong NOT IN (
                SELECT DISTINCT ma_phong 
                FROM hoa_don_phong 
                WHERE check_in < '$checkoutDate' 
                AND check_out > '$checkinDate'
            )
        " . ($roomType ? " AND ma_loai_phong = '$roomType'" : ""))->get();
    }

    /**
     * Lấy danh sách phòng trống (tối ưu)
     */
    public static function getAvailableRooms()
    {
        $sql = "
            SELECT 
                p.ma_phong,
                p.ten_phong,
                p.mo_ta,
                p.gia,
                p.ma_loai_phong,
                p.trang_thai,
                lp.ten as ten_loai_phong
            FROM phong p
            LEFT JOIN loai_phong lp ON p.ma_loai_phong = lp.ma_loai_phong
            WHERE p.trang_thai = ?
            ORDER BY p.ten_phong ASC
        ";
        
        return \HotelBooking\Facades\DB::query($sql, [\HotelBooking\Enums\TrangThaiPhong::CON_TRONG]);
    }

    /**
     * Lấy phòng với thông tin đầy đủ (tối ưu)
     */
    public static function getRoomWithDetails($maPhong)
    {
        $sql = "
            SELECT 
                p.*,
                lp.ten as ten_loai_phong,
                lp.mo_ta as mo_ta_loai_phong
            FROM phong p
            LEFT JOIN loai_phong lp ON p.ma_loai_phong = lp.ma_loai_phong
            WHERE p.ma_phong = ?
        ";
        
        return \HotelBooking\Facades\DB::queryOne($sql, [$maPhong]);
    }

    /**
     * Lấy danh sách phòng theo loại với thông tin thống kê (tối ưu)
     */
    public static function getRoomsByTypeWithStats()
    {
        $sql = "
            SELECT 
                lp.ma_loai_phong,
                lp.ten,
                COUNT(p.ma_phong) as total_rooms,
                SUM(CASE WHEN p.trang_thai = ? THEN 1 ELSE 0 END) as available_rooms,
                MIN(p.gia) as min_price,
                MAX(p.gia) as max_price,
                AVG(p.gia) as avg_price
            FROM loai_phong lp
            LEFT JOIN phong p ON lp.ma_loai_phong = p.ma_loai_phong
            GROUP BY lp.ma_loai_phong, lp.ten
            ORDER BY lp.ten ASC
        ";
        
        return \HotelBooking\Facades\DB::query($sql, [\HotelBooking\Enums\TrangThaiPhong::CON_TRONG]);
    }

    /**
     * Lấy giá phòng theo danh sách ID (tối ưu cho batch operations)
     */
    public static function getRoomsPricesByIds($roomIds)
    {
        if (empty($roomIds)) return [];
        
        $placeholders = str_repeat('?,', count($roomIds) - 1) . '?';
        $sql = "
            SELECT ma_phong, gia, trang_thai
            FROM phong 
            WHERE ma_phong IN ($placeholders)
        ";
        
        return \HotelBooking\Facades\DB::query($sql, $roomIds);
    }

    /**
     * Cập nhật trạng thái phòng (tối ưu)
     */
    public static function updateRoomStatus($maPhong, $trangThai)
    {
        $sql = "UPDATE phong SET trang_thai = ? WHERE ma_phong = ?";
        
        $conn = \HotelBooking\Facades\DB::connect();
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param('ss', $trangThai, $maPhong);
            $result = $stmt->execute();
            $stmt->close();
            \HotelBooking\Facades\DB::close();
            return $result;
        }
        
        \HotelBooking\Facades\DB::close();
        return false;
    }

    /**
     * Cập nhật trạng thái nhiều phòng cùng lúc (batch update)
     */
    public static function batchUpdateRoomStatus($roomStatusPairs)
    {
        if (empty($roomStatusPairs)) return false;
        
        $cases = [];
        $roomIds = [];
        
        foreach ($roomStatusPairs as $maPhong => $trangThai) {
            $cases[] = "WHEN ? THEN ?";
            $roomIds[] = $maPhong;
            $roomIds[] = $trangThai;
        }
        
        $allRoomIds = array_keys($roomStatusPairs);
        $placeholders = str_repeat('?,', count($allRoomIds) - 1) . '?';
        
        $sql = "
            UPDATE phong 
            SET trang_thai = CASE ma_phong " . implode(' ', $cases) . " END
            WHERE ma_phong IN ($placeholders)
        ";
        
        $params = array_merge($roomIds, $allRoomIds);
        
        $conn = \HotelBooking\Facades\DB::connect();
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
            $result = $stmt->execute();
            $stmt->close();
            \HotelBooking\Facades\DB::close();
            return $result;
        }
        
        \HotelBooking\Facades\DB::close();
        return false;
    }

    /**
     * Kiểm tra phòng có khả dụng trong khoảng thời gian không
     * 
     * @param int $roomId ID phòng
     * @param string $checkin Ngày checkin 
     * @param string $checkout Ngày checkout
     * @return bool
     */
    public static function isAvailable($roomId, $checkin, $checkout)
    {
        $checkinDate = date('Y-m-d', strtotime($checkin));
        $checkoutDate = date('Y-m-d', strtotime($checkout));
        
        $conflictingBookings = HoaDonPhong::getConflictingBookings($checkinDate, $checkoutDate);
        $bookedRoomIds = array_column($conflictingBookings, 'ma_phong');
        
        return !in_array($roomId, $bookedRoomIds);
    }

    /**
     * Get all images for this room
     */
    public function hinhAnhs()
    {
        return HinhAnh::where('ma_phong', '=', $this->ma_phong)->get();
    }

    /**
     * Get main image for this room
     */
    public function getMainImage()
    {
        return HinhAnh::getMainImage($this->ma_phong);
    }

    /**
     * Get main image URL for this room
     */
    public function getMainImageUrl()
    {
        $mainImage = $this->getMainImage();
        return $mainImage ? $mainImage->getImageUrl() : null;
    }
    
    /**
     * Tìm kiếm phòng với thông tin loại phòng
     * @param string $search Từ khóa tìm kiếm
     * @param string $loaiPhong ID loại phòng
     * @param string $trangThai Trạng thái phòng
     * @param string $sort Cột sắp xếp
     * @return array
     */
    public static function searchWithRoomType($search = '', $loaiPhong = '', $trangThai = '', $sort = 'ten_phong')
    {
        $sql = "
            SELECT 
                p.*,
                lp.ten as ten_loai_phong,
                lp.mo_ta as mo_ta_loai_phong,
                COUNT(ha.ma_hinh_anh) as so_hinh_anh
            FROM phong p
            LEFT JOIN loai_phong lp ON p.ma_loai_phong = lp.ma_loai_phong
            LEFT JOIN hinh_anh ha ON p.ma_phong = ha.ma_phong
            WHERE 1=1
        ";
        
        $params = [];
        
        // Add search condition
        if (isNotEmpty($search)) {
            $sql .= " AND (p.ten_phong LIKE ? OR p.mo_ta LIKE ? OR lp.ten LIKE ?)";
            $searchTerm = "%$search%";
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }
        
        // Add room type filter
        if (isNotEmpty($loaiPhong)) {
            $sql .= " AND p.ma_loai_phong = ?";
            $params[] = $loaiPhong;
        }
        
        // Add status filter
        if (isNotEmpty($trangThai)) {
            $sql .= " AND p.trang_thai = ?";
            $params[] = $trangThai;
        }
        
        $sql .= " GROUP BY p.ma_phong";
        
        // Add sorting
        $allowedSorts = ['ten_phong', 'gia', 'trang_thai', 'ten_loai_phong'];
        if (in_array($sort, $allowedSorts)) {
            if ($sort === 'ten_loai_phong') {
                $sql .= " ORDER BY lp.ten";
            } else {
                $sql .= " ORDER BY p.$sort";
            }
        } else {
            $sql .= " ORDER BY p.ten_phong";
        }
        
        return \HotelBooking\Facades\DB::query($sql, $params);
    }
    
    /**
     * Lấy thống kê phòng theo trạng thái
     * @return array
     */
    public static function getRoomStatistics()
    {
        $sql = "
            SELECT 
                trang_thai,
                COUNT(*) as so_luong,
                AVG(gia) as gia_trung_binh
            FROM phong 
            GROUP BY trang_thai
        ";
        
        return \HotelBooking\Facades\DB::query($sql);
    }
}