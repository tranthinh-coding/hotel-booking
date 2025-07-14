<?php

namespace HotelBooking\Enums;

class TrangThaiDichVu
{
    const HOAT_DONG = 'hoat_dong';
    const NGUNG_HOAT_DONG = 'ngung_hoat_dong';

    public static function all()
    {
        return [
            self::HOAT_DONG,
            self::NGUNG_HOAT_DONG,
        ];
    }

    public static function getLabel($status)
    {
        switch ($status) {
            case self::HOAT_DONG:
                return 'Hoạt động';
            case self::NGUNG_HOAT_DONG:
                return 'Ngừng hoạt động';
            default:
                return 'Không xác định';
        }
    }

    public static function getColor($status)
    {
        switch ($status) {
            case self::HOAT_DONG:
                return 'bg-green-100 text-green-800';
            case self::NGUNG_HOAT_DONG:
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }
}
