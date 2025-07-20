<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_hinh_anh
 * @property string $anh
 * @property int $ma_phong
 */
class HinhAnh extends Model
{
    protected $table = 'hinh_anh';
    protected $primaryKey = 'ma_hinh_anh';

    protected $attributes = [
        'ma_hinh_anh',
        'anh',
        'ma_phong',
    ];

    /**
     * Get phòng của hình ảnh này
     */
    public function phong()
    {
        return Phong::find($this->ma_phong);
    }

    /**
     * Get all images for a room
     */
    public static function getByPhong($maPhong)
    {
        return static::where('ma_phong', '=', $maPhong)->get();
    }

    /**
     * Delete image and file
     */
    public function deleteWithFile()
    {
        // Delete physical file
        if (isNotEmpty($this->anh)) {
            deleteFile($this->anh);
        }
        
        // Delete record
        return $this->delete();
    }

    /**
     * Get image URL
     */
    public function getImageUrl()
    {
        return isNotEmpty($this->anh) ? '/public/uploads/' . $this->anh : null;
    }
}
