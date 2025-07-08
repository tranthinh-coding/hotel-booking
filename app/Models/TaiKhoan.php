<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_tai_khoan
 * @property string $ho_ten
 * @property string $so_cccd
 * @property string $sdt
 * @property string $mail
 * @property string $mat_khau
 * @property string $phan_quyen
 */
class TaiKhoan extends Model
{
    protected $table = 'tai_khoan';
    protected $primaryKey = 'ma_tai_khoan';

    protected $attributes = [
        'ma_tai_khoan',
        'ho_ten',
        'so_cccd',
        'sdt',
        'mail',
        'mat_khau',
        'phan_quyen',
    ];
}
