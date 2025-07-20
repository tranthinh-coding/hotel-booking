<?php

namespace HotelBooking\Models;

use HotelBooking\Enums\TrangThaiPhong;
use HotelBooking\Enums\TrangThaiLoaiPhong;

class LoaiPhong extends Model
{
    protected $table = 'loai_phong';
    protected $primaryKey = 'ma_loai_phong';

    protected $attributes = [
        'ma_loai_phong',
        'ten',
        'mo_ta', 
        'hinh_anh',
        'trang_thai'
    ];

    /**
     * Get all rooms of this type
     */
    public function phongs()
    {
        return Phong::where('ma_loai_phong', $this->ma_loai_phong);
    }

    /**
     * Count rooms of this type
     */
    public function countPhongs()
    {
        $phongs = $this->phongs()->get();
        return count($phongs);
    }

    /**
     * Get available rooms of this type
     */
    public function getAvailableRooms()
    {
        return $this->phongs()->where('trang_thai', '=', TrangThaiPhong::DANG_HOAT_DONG)->get();
    }

    /**
     * Get occupied rooms of this type
     */
    public function getOccupiedRooms()
    {
        return $this->phongs()->where('trang_thai', '=', TrangThaiPhong::DANG_DON_DEP)->get();
    }

    /**
     * Get maintenance rooms of this type
     */
    public function getMaintenanceRooms()
    {
        return $this->phongs()->where('trang_thai', '=', TrangThaiPhong::BAO_TRI)->get();
    }

    /**
     * Get deactivated rooms of this type
     */
    public function getDeactivatedRooms()
    {
        return $this->phongs()->where('trang_thai', '=', TrangThaiPhong::NGUNG_HOAT_DONG)->get();
    }

    /**
     * Get rooms with pagination
     */
    public function getPhongsPaginated($page = 1, $perPage = 25)
    {
        $allRooms = $this->phongs()->get();
        $total = count($allRooms);
        $offset = ($page - 1) * $perPage;
        $rooms = array_slice($allRooms, $offset, $perPage);
        
        return [
            'data' => $rooms,
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => ceil($total / $perPage),
            'has_more' => $offset + $perPage < $total
        ];
    }
}