<?php

namespace HotelBooking\Enums;

class TrangThaiLoaiPhong
{
    const HOAT_DONG = 'hoat_dong';
    const NGUNG_HOAT_DONG = 'ngung_hoat_dong';
    
    public static function all()
    {
        return [
            self::HOAT_DONG,
            self::NGUNG_HOAT_DONG
        ];
    }
    
    public static function getLabel($status)
    {
        $labels = [
            self::HOAT_DONG => 'Hoạt động',
            self::NGUNG_HOAT_DONG => 'Ngừng hoạt động'
        ];
        
        return $labels[$status] ?? 'Không xác định';
    }
    
    public static function getColor($status)
    {
        $colors = [
            self::HOAT_DONG => 'bg-green-100 text-green-800',
            self::NGUNG_HOAT_DONG => 'bg-red-100 text-red-800'
        ];
        
        return $colors[$status] ?? 'bg-gray-100 text-gray-800';
    }
}
