<?php

namespace HotelBooking\Models;

use HotelBooking\Facades\DB;

/**
 * @property int $ma_nguoi_dung
 * @property string $ho_ten
 * @property string $email
 * @property string $mat_khau
 * @property string $so_dien_thoai
 * @property string $dia_chi
 * @property string $vai_tro
 * @property string $ngay_tao
 */
class NguoiDung extends Model
{
    protected $table = 'nguoi_dung';
    protected $primaryKey = 'ma_nguoi_dung';

    protected $attributes = [
        'ma_nguoi_dung',
        'ho_ten',
        'email',
        'mat_khau',
        'so_dien_thoai',
        'dia_chi',
        'vai_tro',
        'ngay_tao',
    ];

    public static function findByEmail($email)
    {
        $instance = new static();
        $row = DB::table($instance->table)
            ->where('email', '=', $email)
            ->first();
            
        if (!$row) {
            return null;
        }
        
        $instance->data = $row;
        return $instance;
    }

    public function isAdmin()
    {
        return in_array($this->vai_tro, ['Quản lý', 'Lễ tân']);
    }

    public function isCustomer()
    {
        return $this->vai_tro === 'Khách hàng';
    }
}
