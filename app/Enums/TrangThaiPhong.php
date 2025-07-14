<?php

namespace HotelBooking\Enums;

class TrangThaiPhong
{
    const CON_TRONG = 'Còn trống';
    const BAO_TRI = 'Bảo trì';
    const DANG_DON_DEP = 'Đang dọn dẹp';
    const NGUNG_HOAT_DONG = 'Ngừng hoạt động';
    
    public static function all()
    {
        return [
            self::CON_TRONG,
            self::BAO_TRI,
            self::DANG_DON_DEP,
            self::NGUNG_HOAT_DONG
        ];
    }
    
    public static function getLabel($status)
    {
        $labels = [
            self::CON_TRONG => 'Còn trống',
            self::BAO_TRI => 'Bảo trì',
            self::DANG_DON_DEP => 'Đang dọn dẹp',
            self::NGUNG_HOAT_DONG => 'Ngừng hoạt động'
        ];
        
        return $labels[$status] ?? $status;
    }
    
    public static function getColor($status)
    {
        $colors = [
            self::CON_TRONG => 'green',
            self::BAO_TRI => 'yellow',
            self::DANG_DON_DEP => 'blue',
            self::NGUNG_HOAT_DONG => 'red'
        ];
        
        return $colors[$status] ?? 'gray';
    }
}
