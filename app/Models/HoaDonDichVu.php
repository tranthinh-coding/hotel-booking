<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_hd_dich_vu
 * @property int $ma_dich_vu
 * @property int $gia
 * @property int $ma_hd_phong
 * @property string $thoi_gian
 */
class HoaDonDichVu extends Model
{
    protected $table = 'hoa_don_dich_vu';
    protected $primaryKey = 'ma_hd_dich_vu';

    protected $attributes = [
        'ma_hd_dich_vu',
        'ma_dich_vu',
        'gia',
        'ma_hd_phong',
        'thoi_gian',
    ];
}
