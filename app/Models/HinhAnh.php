<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_hinh_anh
 * @property string $anh
 * @property int $ma_phong
 */
class HinhAnh extends Model
{
    protected $table = 'hinh_anh';
    protected $primaryKey = 'ma_hinh_anh';

    protected $attributes = [
        'ma_hinh_anh',
        'anh',
        'ma_phong',
    ];
}
