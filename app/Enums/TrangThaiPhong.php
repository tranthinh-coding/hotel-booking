<?php

namespace HotelBooking\Enums;

class TrangThaiPhong
{
    const DANG_HOAT_DONG = 'Đang hoạt động';
    const BAO_TRI = 'Bảo trì';
    const DANG_DON_DEP = 'Đang dọn dẹp';
    const NGUNG_HOAT_DONG = 'Ngừng hoạt động';
    
    public static function all()
    {
        return [
            self::DANG_HOAT_DONG,
            self::BAO_TRI,
            self::DANG_DON_DEP,
            self::NGUNG_HOAT_DONG
        ];
    }
    
    public static function getLabel($status)
    {
        $labels = [
            self::DANG_HOAT_DONG => 'Đang hoạt động',
            self::BAO_TRI => 'Bảo trì',
            self::DANG_DON_DEP => 'Đang dọn dẹp',
            self::NGUNG_HOAT_DONG => 'Ngừng hoạt động'
        ];
        
        return $labels[$status] ?? $status;
    }
    
    public static function getColor($status)
    {
        $colors = [
            self::DANG_HOAT_DONG => 'green',
            self::BAO_TRI => 'yellow',
            self::DANG_DON_DEP => 'blue',
            self::NGUNG_HOAT_DONG => 'red'
        ];
        
        return $colors[$status] ?? 'gray';
    }
}
