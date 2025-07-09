<?php

namespace HotelBooking\Models;

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
        'loai_phong',
        'mo_ta',
        'gia',
        'ma_loai_phong'
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

        // Get all rooms first
        $query = static::query();
        
        // Filter by room type if specified
        if (!empty($roomType)) {
            $query = $query->where('loai_phong', '=', $roomType);
        }
        
        $allRooms = $query->get();

        // Get all conflicting bookings for the requested period
        $conflictingBookings = HoaDonPhong::getConflictingBookings($checkinDate, $checkoutDate);
        
        // Get room IDs that are booked during the requested period
        $bookedRoomIds = [];
        foreach ($conflictingBookings as $booking) {
            $bookedRoomIds[] = $booking['ma_phong'];
        }
        
        // Filter out booked rooms
        $availableRooms = [];
        foreach ($allRooms as $room) {
            // Handle both array and object returns from query
            if (is_array($room)) {
                $roomId = $room['ma_phong'];
            } elseif (is_object($room) && isset($room->ma_phong)) {
                $roomId = $room->ma_phong;
            } elseif (is_object($room) && method_exists($room, '__get')) {
                $roomId = $room->__get('ma_phong');
            } else {
                continue; // Skip invalid entries
            }
            
            if (!in_array($roomId, $bookedRoomIds)) {
                $availableRooms[] = $room;
            }
        }

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
}