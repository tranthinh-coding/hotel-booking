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
            return [];
        }

        // Get booked room IDs for the period using SQL
        $bookedRoomIds = HoaDonPhong::query()
            ->select('ma_phong')
            ->where('check_in', '<', $checkoutDate)
            ->where('check_out', '>', $checkinDate)
            ->get();
        
        // Extract room IDs
        $bookedIds = [];
        foreach ($bookedRoomIds as $booking) {
            $bookedIds[] = $booking['ma_phong'];
        }

        // Get available rooms using NOT IN
        $query = static::query();
        
        if (!empty($bookedIds)) {
            $bookedIdsStr = implode(',', $bookedIds);
            $query = $query->whereRaw("ma_phong NOT IN ($bookedIdsStr)");
        }
        
        // Filter by room type if specified
        if (!empty($roomType)) {
            $query = $query->where('ma_loai_phong', '=', $roomType);
        }
        
        $availableRooms = $query->get();

        return $availableRooms;
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
}