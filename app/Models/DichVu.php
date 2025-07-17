<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_dich_vu
 * @property string $ten_dich_vu
 * @property int $gia
 * @property string $trang_thai
 * @property string $hinh_anh
 */
class DichVu extends Model
{
    protected $table = 'dich_vu';
    protected $primaryKey = 'ma_dich_vu';

    protected $attributes = [
        'ma_dich_vu',
        'ten_dich_vu',
        'gia',
        'trang_thai',
        'hinh_anh',
    ];
    
    /**
     * Lấy giá của nhiều dịch vụ cùng một lúc
     * @param array $serviceIds Mảng ID dịch vụ
     * @return array Mảng có key là ID dịch vụ, value là giá
     */
    public static function getServicesPricesByIds($serviceIds)
    {
        if (isEmpty($serviceIds)) {
            return [];
        }
        
        $placeholders = str_repeat('?,', count($serviceIds) - 1) . '?';
        $sql = "SELECT ma_dich_vu, gia FROM dich_vu WHERE ma_dich_vu IN ($placeholders)";
        
        $result = \HotelBooking\Facades\DB::query($sql, $serviceIds);
        
        $prices = [];
        foreach ($result as $row) {
            $prices[$row['ma_dich_vu']] = $row['gia'];
        }
        
        return $prices;
    }
    
    /**
     * Kiểm tra sự tồn tại của nhiều dịch vụ
     * @param array $serviceIds Mảng ID dịch vụ
     * @return array Mảng ID dịch vụ tồn tại
     */
    public static function getExistingServiceIds($serviceIds)
    {
        if (isEmpty($serviceIds)) {
            return [];
        }
        
        $placeholders = str_repeat('?,', count($serviceIds) - 1) . '?';
        $sql = "SELECT ma_dich_vu FROM dich_vu WHERE ma_dich_vu IN ($placeholders)";
        
        $result = \HotelBooking\Facades\DB::query($sql, $serviceIds);
        
        return array_column($result, 'ma_dich_vu');
    }
}
