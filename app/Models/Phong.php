<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_phong
 * @property string $ten_phong
 * @property string $mo_ta
 * @property string $trang_thai
 * @property int $gia
 */
class Phong extends Model
{
    protected $table = 'phong';
    protected $primaryKey = 'ma_phong';

    protected $attributes = [
        'ma_phong',
        'ten_phong',
        'mo_ta',
        'trang_thai',
        'gia',
    ];

}