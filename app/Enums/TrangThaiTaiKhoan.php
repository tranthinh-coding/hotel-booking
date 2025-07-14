<?php

namespace HotelBooking\Enums;

class TrangThaiTaiKhoan 
{
    const HOAT_DONG = 'hoat_dong';
    const TAM_KHOA = 'tam_khoa';
    const BI_KHOA = 'bi_khoa';

    public static function all()
    {
        return [
            self::HOAT_DONG,
            self::TAM_KHOA,
            self::BI_KHOA
        ];
    }

    public static function getLabel($status)
    {
        $labels = [
            self::HOAT_DONG => 'Hoạt động',
            self::TAM_KHOA => 'Tạm khóa',
            self::BI_KHOA => 'Bị khóa'
        ];

        return $labels[$status] ?? 'Không xác định';
    }

    public static function getColor($status)
    {
        $colors = [
            self::HOAT_DONG => 'green',
            self::TAM_KHOA => 'yellow',
            self::BI_KHOA => 'red'
        ];

        return $colors[$status] ?? 'gray';
    }
}
