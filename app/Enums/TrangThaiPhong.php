<?php

namespace HotelBooking\Enums;

class TrangThaiPhong
{
    const CON_TRONG = 'Còn trống';
    const BAO_TRI = 'Bảo trì';
    const DANG_DON_DEP = 'Đang dọn dẹp';
    
    public static function all()
    {
        return [
            self::CON_TRONG,
            self::BAO_TRI,
            self::DANG_DON_DEP
        ];
    }
    
    public static function getLabel($status)
    {
        $labels = [
            self::CON_TRONG => 'Còn trống',
            self::BAO_TRI => 'Bảo trì',
            self::DANG_DON_DEP => 'Đang dọn dẹp'
        ];
        
        return $labels[$status] ?? $status;
    }
    
    public static function getColor($status)
    {
        $colors = [
            self::CON_TRONG => 'green',
            self::BAO_TRI => 'yellow',
            self::DANG_DON_DEP => 'blue'
        ];
        
        return $colors[$status] ?? 'gray';
    }
}
