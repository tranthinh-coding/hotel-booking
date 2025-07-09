<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_hd_phong
 * @property string $check_in
 * @property string $check_out
 * @property int $ma_phong
 * @property int $gia
 * @property int $ma_hoa_don
 */
class HoaDonPhong extends Model
{
    protected $table = 'hoa_don_phong';
    protected $primaryKey = 'ma_hd_phong';

    protected $attributes = [
        'ma_hd_phong',
        'check_in',
        'check_out',
        'ma_phong',
        'gia',
        'ma_hoa_don',
    ];

    /**
     * Lấy danh sách booking bị xung đột thời gian
     * 
     * Logic: Hai khoảng thời gian [A1, A2] và [B1, B2] bị overlap nếu:
     * - A1 < B2 AND A2 > B1
     * 
     * @param string $checkin Ngày checkin muốn đặt
     * @param string $checkout Ngày checkout muốn đặt  
     * @return array Danh sách booking bị xung đột
     */
    public static function getConflictingBookings($checkin, $checkout)
    {
        // Query để tìm các booking bị overlap với khoảng thời gian yêu cầu
        // Điều kiện: 
        // 1. check_in của booking hiện tại < checkout của request
        // 2. check_out của booking hiện tại > checkin của request
        return static::query()
            ->where('check_in', '<', $checkout)
            ->where('check_out', '>', $checkin)
            ->get();
    }

    /**
     * Kiểm tra phòng cụ thể có booking trong khoảng thời gian không
     * 
     * @param int $roomId ID phòng
     * @param string $checkin Ngày checkin
     * @param string $checkout Ngày checkout
     * @return bool
     */
    public static function hasConflictForRoom($roomId, $checkin, $checkout)
    {
        $count = static::query()
            ->where('ma_phong', '=', $roomId)
            ->where('check_in', '<', $checkout)
            ->where('check_out', '>', $checkin)
            ->count();
        
        return $count > 0;
    }

    /**
     * Lấy lịch booking của phòng trong khoảng thời gian
     * 
     * @param int $roomId ID phòng
     * @param string $fromDate Từ ngày
     * @param string $toDate Đến ngày
     * @return array
     */
    public static function getRoomBookings($roomId, $fromDate, $toDate)
    {
        // Đơn giản hóa: lấy tất cả booking của phòng, sau đó filter trong PHP
        $allBookings = static::query()
            ->where('ma_phong', '=', $roomId)
            ->get();
        
        $result = [];
        foreach ($allBookings as $booking) {
            $checkin = $booking['check_in'];
            $checkout = $booking['check_out'];
            
            // Kiểm tra overlap
            if ($checkin <= $toDate && $checkout >= $fromDate) {
                $result[] = $booking;
            }
        }
        
        return $result;
    }
}
