<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_tin_tuc
 * @property int $ma_tai_khoan
 * @property string $noi_dung
 * @property string $ngay_dang
 * @property string $trang_thai
 */
class TinTuc extends Model
{
    protected $table = 'tin_tuc';
    protected $primaryKey = 'ma_tin_tuc';

    protected $attributes = [
        'ma_tin_tuc',
        'ma_tai_khoan',
        'noi_dung',
        'ngay_dang',
        'trang_thai',
    ];
}
