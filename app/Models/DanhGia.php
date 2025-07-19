<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_hoa_don
 * @property int $ma_danh_gia
 * @property int $ma_phong
 * @property int $ma_khach_hang
 * @property string $noi_dung
 * @property float $diem_danh_gia
 * @property string $ngay_gui
 */
class DanhGia extends Model
{
    protected $table = 'danh_gia';
    protected $primaryKey = 'ma_danh_gia';

    protected $attributes = [
        'ma_hoa_don',
        'ma_danh_gia',
        'ma_phong',
        'ma_khach_hang',
        'noi_dung',
        'diem_danh_gia',
        'ngay_gui',
    ];

    public static function createReview($hoaDonId, $phongId, $taiKhoanId, $diem, $nhanXet)
    {
        $data = [
            'ma_hoa_don' => $hoaDonId,
            'ma_phong' => $phongId,
            'ma_khach_hang' => $taiKhoanId,
            'diem_danh_gia' => $diem,
            'noi_dung' => $nhanXet,
            'ngay_gui' => date('Y-m-d H:i:s')
        ];
        return static::create($data);
    }
}
