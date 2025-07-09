<?php

namespace HotelBooking\Models;

use HotelBooking\Enums\TrangThaiPhong;

class LoaiPhong extends Model
{
    protected $table = 'loai_phong';
    protected $primaryKey = 'ma_loai_phong';
    
    protected $attributes = [
        'ma_loai_phong',
        'ten'
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
        $phongs = $this->phongs();
        return array_filter($phongs, function($phong) {
            return $phong->trang_thai === TrangThaiPhong::CON_TRONG;
        });
    }
    
    /**
     * Get occupied rooms of this type
     */
    public function getOccupiedRooms()
    {
        $phongs = $this->phongs();
        return array_filter($phongs, function($phong) {
            return $phong->trang_thai === TrangThaiPhong::DA_DAT;
        });
    }
    
    /**
     * Get maintenance rooms of this type
     */
    public function getMaintenanceRooms()
    {
        $phongs = $this->phongs();
        return array_filter($phongs, function($phong) {
            return $phong->trang_thai === TrangThaiPhong::BAO_TRI;
        });
    }
}