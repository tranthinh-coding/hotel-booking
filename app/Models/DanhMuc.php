<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_danh_muc
 * @property string $ten
 */
class DanhMuc extends Model
{
    protected $table = 'danh_muc';
    protected $primaryKey = 'ma_danh_muc';

    protected $attributes = [
        'ma_danh_muc',
        'ten',
    ];
}
