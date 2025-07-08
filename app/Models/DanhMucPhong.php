<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_danh_muc
 * @property int $ma_phong
 */
class DanhMucPhong extends Model
{
    protected $table = 'danh_muc_phong';
    protected $primaryKey = ['ma_danh_muc', 'ma_phong']; // Composite primary key

    protected $attributes = [
        'ma_danh_muc',
        'ma_phong',
    ];
}
