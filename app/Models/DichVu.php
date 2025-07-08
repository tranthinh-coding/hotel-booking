<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_dich_vu
 * @property string $ten_dich_vu
 * @property int $gia
 */
class DichVu extends Model
{
    protected $table = 'dich_vu';
    protected $primaryKey = 'ma_dich_vu';

    protected $attributes = [
        'ma_dich_vu',
        'ten_dich_vu',
        'gia',
    ];
}
