<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_danh_muc
 * @property string $ten_danh_muc
 * @property string $mo_ta
 * @property int $gia_tham_khao
 */
class DanhMucPhong extends Model
{
    protected $table = 'danh_muc_phong';
    protected $primaryKey = 'ma_danh_muc';

    protected $attributes = [
        'ma_danh_muc',
        'ten_danh_muc',
        'mo_ta',
        'gia_tham_khao',
    ];

    public function phongs()
    {
        // For now, just return empty array
        // TODO: Implement proper relationship when needed
        return [];
    }
}
