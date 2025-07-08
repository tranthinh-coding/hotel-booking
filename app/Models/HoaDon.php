<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_hoa_don
 * @property int $ma_nhan_vien
 * @property int $ma_khach_hang
 * @property string $thoi_gian_dat
 */
class HoaDon extends Model
{
    protected $table = 'hoa_don';
    protected $primaryKey = 'ma_hoa_don';

    protected $attributes = [
        'ma_hoa_don',
        'ma_nhan_vien',
        'ma_khach_hang',
        'thoi_gian_dat',
    ];
}
