<?php

namespace HotelBooking\Enums;

class PhanQuyen
{
    const QUAN_LY = 'Quản lý';
    const LE_TAN = 'Lễ tân';
    const KHACH_HANG = 'Khách hàng';
    
    public static function all()
    {
        return [
            self::QUAN_LY,
            self::LE_TAN,
            self::KHACH_HANG
        ];
    }
    
    public static function getLabel($role)
    {
        $labels = [
            self::QUAN_LY => 'Quản lý',
            self::LE_TAN => 'Lễ tân',
            self::KHACH_HANG => 'Khách hàng'
        ];
        
        return $labels[$role] ?? $role;
    }
    
    public static function isAdmin($role)
    {
        return in_array($role, [self::QUAN_LY, self::LE_TAN]);
    }
}
