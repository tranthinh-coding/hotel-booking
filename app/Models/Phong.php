<?php

namespace HotelBooking\Models;

/**
 * @property string $ma_phong
 * @property string $ten_phong
 * @property string $loai_phong
 * @property float $gia_phong
 */
class Phong extends Model
{
    protected $table = 'phong';

    protected $attributes = [
        'ma_phong',
        'ten_phong',
        'loai_phong',
        'gia_phong',
    ];

}