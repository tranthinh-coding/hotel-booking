<?php

namespace HotelBooking\Enums;

class TrangThaiHoaDon 
{
    const CHO_XAC_NHAN = 'cho_xac_nhan';
    const CHO_XU_LY = 'cho_xu_ly';
    const DA_XAC_NHAN = 'da_xac_nhan';
    const DA_THANH_TOAN = 'da_thanh_toan';
    const DA_HUY = 'da_huy';

    public static function all()
    {
        return [
            self::CHO_XAC_NHAN,
            self::CHO_XU_LY,
            self::DA_XAC_NHAN,
            self::DA_THANH_TOAN,
            self::DA_HUY
        ];
    }

    public static function getLabel($status)
    {
        $labels = [
            self::CHO_XAC_NHAN => 'Chờ xác nhận',
            self::CHO_XU_LY => 'Chờ xử lý',
            self::DA_XAC_NHAN => 'Đã xác nhận',
            self::DA_THANH_TOAN => 'Đã thanh toán',
            self::DA_HUY => 'Đã hủy'
        ];

        return $labels[$status] ?? 'Không xác định';
    }

    public static function getColor($status)
    {
        $colors = [
            self::CHO_XU_LY => 'yellow',
            self::DA_XAC_NHAN => 'blue',
            self::DA_THANH_TOAN => 'green',
            self::DA_HUY => 'red'
        ];

        return $colors[$status] ?? 'gray';
    }
}
