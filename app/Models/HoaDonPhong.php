<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_hd_phong
 * @property string $check_in
 * @property string $check_out
 * @property int $ma_phong
 * @property int $gia
 * @property int $ma_hoa_don
 */
class HoaDonPhong extends Model
{
    protected $table = 'hoa_don_phong';
    protected $primaryKey = 'ma_hd_phong';

    protected $attributes = [
        'ma_hd_phong',
        'check_in',
        'check_out',
        'ma_phong',
        'gia',
        'ma_hoa_don',
    ];
}
