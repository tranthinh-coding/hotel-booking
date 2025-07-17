<?php

namespace HotelBooking\Models;

use HotelBooking\Enums\TrangThaiHoaDon;

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
     * @param int $maPhong ID phòng cần kiểm tra
     * @param string $checkin Ngày checkin muốn đặt
     * @param string $checkout Ngày checkout muốn đặt
     * @param int|null $excludeId ID booking cần loại trừ (dùng cho update)
     * @return bool
     */
    public static function hasConflictForRoom($maPhong, $checkin, $checkout, $excludeId = null)
    {
        $sql = "
            SELECT COUNT(*) as conflicts
            FROM hoa_don_phong hdp
            JOIN hoa_don_tong hdt ON hdp.ma_hoa_don = hdt.ma_hoa_don
            WHERE hdp.ma_phong = ? 
            AND hdp.check_in < ? 
            AND hdp.check_out > ?
            AND hdt.trang_thai != ?
        ";
        
        $params = [$maPhong, $checkout, $checkin, TrangThaiHoaDon::DA_HUY];
        
        if ($excludeId) {
            $sql .= " AND hdp.ma_hd_phong != ?";
            $params[] = $excludeId;
        }
        
        $result = \HotelBooking\Facades\DB::queryOne($sql, $params);
        return isset($result['conflicts']) && $result['conflicts'] > 0;
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

    /**
     * Lấy danh sách phòng của hóa đơn (tối ưu)
     */
    public static function getRoomsByInvoice($maHoaDon)
    {
        $sql = "
            SELECT 
                hdp.*,
                p.ten_phong,
                p.trang_thai as trang_thai_phong,
                CEIL(TIMESTAMPDIFF(SECOND, hdp.check_in, hdp.check_out) / 3600) as so_gio
            FROM hoa_don_phong hdp
            LEFT JOIN phong p ON hdp.ma_phong = p.ma_phong
            WHERE hdp.ma_hoa_don = ?
            ORDER BY hdp.check_in
        ";
        
        return \HotelBooking\Facades\DB::query($sql, [$maHoaDon]);
    }

    /**
     * Tối ưu truy vấn conflict check cho nhiều phòng
     */
    public static function checkMultipleRoomConflicts($roomBookings, $excludeInvoiceId = null)
    {
        if (isEmpty($roomBookings)) return [];
        
        $conflicts = [];
        $placeholders = [];
        $params = [];
        
        foreach ($roomBookings as $index => $booking) {
            $placeholders[] = "(?, ?, ?)";
            $params[] = $booking['ma_phong'];
            $params[] = $booking['check_out'];
            $params[] = $booking['check_in'];
        }
        
        $sql = "
            SELECT DISTINCT hdp.ma_phong, hdp.check_in, hdp.check_out
            FROM hoa_don_phong hdp
            WHERE EXISTS (
                SELECT 1 FROM (VALUES " . implode(',', $placeholders) . ") AS v(ma_phong, checkout, checkin)
                WHERE hdp.ma_phong = v.ma_phong 
                AND hdp.check_in < v.checkout 
                AND hdp.check_out > v.checkin
        ";
        
        if ($excludeInvoiceId) {
            $sql .= " AND hdp.ma_hoa_don != ?";
            $params[] = $excludeInvoiceId;
        }
        
        $sql .= ")";
        
        return \HotelBooking\Facades\DB::query($sql, $params);
    }
}
