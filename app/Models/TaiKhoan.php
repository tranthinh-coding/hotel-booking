<?php

namespace HotelBooking\Models;

use HotelBooking\Facades\DB;
use HotelBooking\Enums\PhanQuyen;

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

    public static function findByEmail($email)
    {
        $instance = new static();
        $row = DB::table($instance->table)
            ->where('mail', '=', $email)
            ->first();

        if (!$row) {
            return null;
        }

        $instance->data = $row;
        return $instance;
    }

    public function isAdmin()
    {
        return PhanQuyen::isAdmin($this->phan_quyen);
    }

    public function verifyPassword($password)
    {
        return password_verify($password, $this->mat_khau);
    }

    public function updatePassword($newPassword)
    {
        return $this->update(['mat_khau' => password_hash($newPassword, PASSWORD_DEFAULT)]);
    }

    public function isCustomer()
    {
        return $this->phan_quyen === PhanQuyen::KHACH_HANG;
    }

    public function isManager()
    {
        return $this->phan_quyen === PhanQuyen::QUAN_LY;
    }

    public function isReceptionist()
    {
        return $this->phan_quyen === PhanQuyen::LE_TAN;
    }

    public function getRoleLabel()
    {
        return PhanQuyen::getLabel($this->phan_quyen);
    }

    public static function createWithHashedPassword($data)
    {
        if (isset($data['mat_khau'])) {
            $data['mat_khau'] = password_hash($data['mat_khau'], PASSWORD_DEFAULT);
        }
        return static::create($data);
    }

    public static function emailExists($email)
    {
        $instance = new static();
        return DB::table($instance->table)
            ->where('mail', '=', $email)
            ->exists();
    }

    // Alias properties for backward compatibility
    public function __get($property)
    {
        switch ($property) {
            case 'id':
                return $this->ma_tai_khoan;
            case 'email':
                return $this->mail;
            case 'so_dien_thoai':
                return $this->sdt;
            case 'vai_tro':
                return $this->phan_quyen;
            default:
                return parent::__get($property);
        }
    }
}
