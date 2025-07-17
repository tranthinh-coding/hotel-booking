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
        return HoaDon::find($this->ma_hoa_don);
    }

    /**
     * Lấy danh sách dịch vụ của hóa đơn với thông tin chi tiết (tối ưu)
     */
    public static function getServicesByInvoice($maHoaDon)
    {
        $sql = "
            SELECT 
                hdv.*,
                dv.ten_dich_vu,
                dv.mo_ta as mo_ta_dich_vu,
                (hdv.gia * hdv.so_luong) as thanh_tien
            FROM hoa_don_dich_vu hdv
            LEFT JOIN dich_vu dv ON hdv.ma_dich_vu = dv.ma_dich_vu
            WHERE hdv.ma_hoa_don = ?
            ORDER BY hdv.thoi_gian DESC
        ";
        
        return \HotelBooking\Facades\DB::query($sql, [$maHoaDon]);
    }

    /**
     * Tính tổng tiền dịch vụ của hóa đơn (tối ưu)
     */
    public static function getTotalServiceCost($maHoaDon)
    {
        $sql = "
            SELECT SUM(gia * so_luong) as total_cost
            FROM hoa_don_dich_vu
            WHERE ma_hoa_don = ?
        ";
        
        $result = \HotelBooking\Facades\DB::queryOne($sql, [$maHoaDon]);
        return (float) ($result['total_cost'] ?? 0);
    }

    /**
     * Lấy danh sách dịch vụ theo phòng
     */
    public static function getServicesByRoom($maHdPhong)
    {
        $sql = "
            SELECT 
                hdv.*,
                dv.ten_dich_vu,
                dv.mo_ta as mo_ta_dich_vu,
                (hdv.gia * hdv.so_luong) as thanh_tien
            FROM hoa_don_dich_vu hdv
            LEFT JOIN dich_vu dv ON hdv.ma_dich_vu = dv.ma_dich_vu
            WHERE hdv.ma_hd_phong = ?
            ORDER BY hdv.thoi_gian DESC
        ";
        
        return \HotelBooking\Facades\DB::query($sql, [$maHdPhong]);
    }

    /**
     * Bulk insert cho nhiều dịch vụ (tối ưu)
     */
    public static function bulkInsertServices($services)
    {
        if (isEmpty($services)) return false;
        
        $values = [];
        $params = [];
        
        foreach ($services as $service) {
            $values[] = "(?, ?, ?, ?, ?, ?)";

            $params[] = $service['ma_dich_vu'] ?? null;
            $params[] = $service['gia'] ?? 0;
            $params[] = $service['ma_hd_phong'] ?? null;
            $params[] = $service['ma_hoa_don'] ?? null;
            $params[] = $service['so_luong'] ?? 1;
            $params[] = $service['thoi_gian'] ?? date('Y-m-d H:i:s');
        }
        
        $sql = "
            INSERT INTO hoa_don_dich_vu 
            (ma_dich_vu, gia, ma_hd_phong, ma_hoa_don, so_luong, thoi_gian) 
            VALUES " . implode(',', $values);
        
        $conn = \HotelBooking\Facades\DB::connect();
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
            $result = $stmt->execute();
            $stmt->close();
            \HotelBooking\Facades\DB::close();
            return $result;
        }
        
        \HotelBooking\Facades\DB::close();
        return false;
    }
}
