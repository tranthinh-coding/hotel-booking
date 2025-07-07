<?php

namespace HotelBooking\Models;

/**
 * @property string $ma_nguoi_dung
 * @property string $ten_nguoi_dung
 */
class NguoiDung extends Model
{
    protected $table = 'nguoi_dung';

    protected $attributes = [
        'ma_nguoi_dung',
        'ten_nguoi_dung',
    ];

}
