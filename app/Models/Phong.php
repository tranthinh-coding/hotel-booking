<?php

namespace HotelBooking\Models;

use HotelBooking\Facades\DB;

/**
 * @property int $ma_phong
 * @property string $ten_phong
 * @property string $mo_ta
 * @property string $trang_thai
 * @property int $gia
 * @property int $ma_danh_muc
 * @property int $so_khach_toi_da
 */
class Phong extends Model
{
    protected $table = 'phong';
    protected $primaryKey = 'ma_phong';

    protected $attributes = [
        'ma_phong',
        'ten_phong',
        'mo_ta',
        'trang_thai',
        'gia',
        'ma_danh_muc',
        'so_khach_toi_da',
    ];

    public static function searchAvailable($checkin, $checkout, $guests, $room_type = null)
    {
        // Start with all available rooms
        $instance = new static();
        $queryBuilder = DB::table($instance->table)->where('trang_thai', '=', 'Còn trống');
        
        if ($guests) {
            $queryBuilder = $queryBuilder->where('so_khach_toi_da', '>=', intval($guests));
        }
        
        if ($room_type) {
            $queryBuilder = $queryBuilder->where('ma_danh_muc', '=', intval($room_type));
        }
        
        // Get the results
        $rows = $queryBuilder->get();
        
        $results = [];
        foreach ($rows as $row) {
            $model = new static();
            $model->data = $row;
            $results[] = $model;
        }
        
        return $results;
    }

    public function danhMucPhong()
    {
        return DanhMucPhong::find($this->ma_danh_muc);
    }
}