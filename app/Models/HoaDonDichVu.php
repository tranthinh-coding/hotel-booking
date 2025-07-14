<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_hd_dich_vu
 * @property int $ma_dich_vu
 * @property int $gia
 * @property int $ma_hd_phong
 * @property int $ma_hoa_don
 * @property int $so_luong
 * @property string $thoi_gian
 */
class HoaDonDichVu extends Model
{
    protected $table = 'hoa_don_dich_vu';
    protected $primaryKey = 'ma_hd_dich_vu';

    protected $attributes = [
        'ma_hd_dich_vu',
        'ma_dich_vu',
        'gia',
        'ma_hd_phong',
        'ma_hoa_don',
        'so_luong',
        'thoi_gian',
    ];

    /**
     * Lấy thông tin dịch vụ
     */
    public function getDichVu()
    {
        return DichVu::query()->where('ma_dich_vu', '=', $this->ma_dich_vu)->first();
    }

    /**
     * Lấy thông tin hóa đơn phòng (nếu có)
     */
    public function getHoaDonPhong()
    {
        if ($this->ma_hd_phong) {
            return HoaDonPhong::query()->where('ma_hd_phong', '=', $this->ma_hd_phong)->first();
        }
        return null;
    }

    /**
     * Lấy thông tin hóa đơn chính
     */
    public function getHoaDon()
    {
        return HoaDon::query()->where('ma_hoa_don', '=', $this->ma_hoa_don)->first();
    }

    /**
     * Tính tổng tiền dịch vụ
     */
    public function getTotalAmount()
    {
        return $this->gia * ($this->so_luong ?? 1);
    }
}
