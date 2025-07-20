<?php

namespace HotelBooking\Models;

use HotelBooking\Enums\TrangThaiHoaDon;

/**
 * @property int $ma_hoa_don
 * @property int $ma_nhan_vien
 * @property int $ma_khach_hang
 * @property string $thoi_gian_dat
 * @property string $trang_thai
 * @property float $tong_tien
 * @property string $ghi_chu
 */
class HoaDon extends Model
{
    protected $table = 'hoa_don_tong';
    protected $primaryKey = 'ma_hoa_don';

    protected $attributes = [
        'ma_hoa_don',
        'ma_nhan_vien',
        'ma_khach_hang',
        'thoi_gian_dat',
        'trang_thai',
        'tong_tien',
        'ghi_chu'
    ];

    /**
     * Lấy thông tin nhân viên
     */
    public function getNhanVien()
    {
        if (!$this->ma_nhan_vien) return null;
        return TaiKhoan::find($this->ma_nhan_vien);
    }

    /**
     * Lấy thông tin khách hàng
     */
    public function getKhachHang()
    {
        if (!$this->ma_khach_hang) return null;
        return TaiKhoan::find($this->ma_khach_hang);
    }

    /**
     * Lấy danh sách phòng trong hóa đơn
     */
    public function getPhongs()
    {
        return HoaDonPhong::where('ma_hoa_don', $this->ma_hoa_don)->get();
    }

    /**
     * Lấy danh sách dịch vụ trong hóa đơn
     */
    public function getDichVus()
    {
        return HoaDonDichVu::where('ma_hoa_don', $this->ma_hoa_don)->get();
    }

    /**
     * Lấy tất cả hóa đơn với thông tin khách hàng và phòng (tối ưu JOIN)
     */
    public static function getAllWithDetails()
    {
        $sql = "
            SELECT 
                hdt.ma_hoa_don,
                hdt.ma_nhan_vien,
                hdt.ma_khach_hang,
                hdt.thoi_gian_dat,
                hdt.trang_thai,
                hdt.tong_tien,
                hdt.ghi_chu,
                tk.ho_ten as ten_khach_hang,
                GROUP_CONCAT(DISTINCT p.ten_phong ORDER BY p.ten_phong SEPARATOR ', ') as so_phong
            FROM hoa_don_tong hdt
            LEFT JOIN tai_khoan tk ON hdt.ma_khach_hang = tk.ma_tai_khoan
            LEFT JOIN hoa_don_phong hdp ON hdt.ma_hoa_don = hdp.ma_hoa_don
            LEFT JOIN phong p ON hdp.ma_phong = p.ma_phong
            GROUP BY hdt.ma_hoa_don, hdt.ma_nhan_vien, hdt.ma_khach_hang, 
                     hdt.thoi_gian_dat, hdt.trang_thai, hdt.tong_tien, hdt.ghi_chu, tk.ho_ten
            ORDER BY hdt.thoi_gian_dat DESC
        ";
        
        return \HotelBooking\Facades\DB::query($sql);
    }

    /**
     * Lấy hóa đơn với tìm kiếm và lọc (tối ưu)
     */
    public static function searchWithDetails($search = '', $status = '', $date = '')
    {
        $conditions = [];
        $params = [];
        
        if (isNotEmpty($search)) {
            $conditions[] = "(hdt.ma_hoa_don LIKE ? OR tk.ho_ten LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }
        
        if (isNotEmpty($status)) {
            $conditions[] = "hdt.trang_thai = ?";
            $params[] = $status;
        }
        
        if (isNotEmpty($date)) {
            $conditions[] = "DATE(hdt.thoi_gian_dat) = ?";
            $params[] = $date;
        }
        
        $whereClause = isNotEmpty($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '';
        
        $sql = "
            SELECT 
                hdt.ma_hoa_don,
                hdt.ma_nhan_vien,
                hdt.ma_khach_hang,
                hdt.thoi_gian_dat,
                hdt.trang_thai,
                hdt.tong_tien,
                hdt.ghi_chu,
                COALESCE(tk.ho_ten, 'Không tìm thấy khách hàng') as ten_khach_hang,
                COALESCE(GROUP_CONCAT(DISTINCT p.ten_phong ORDER BY p.ten_phong SEPARATOR ', '), 'Chưa có phòng') as so_phong
            FROM hoa_don_tong hdt
            LEFT JOIN tai_khoan tk ON hdt.ma_khach_hang = tk.ma_tai_khoan
            LEFT JOIN hoa_don_phong hdp ON hdt.ma_hoa_don = hdp.ma_hoa_don
            LEFT JOIN phong p ON hdp.ma_phong = p.ma_phong
            $whereClause
            GROUP BY hdt.ma_hoa_don, hdt.ma_nhan_vien, hdt.ma_khach_hang, 
                     hdt.thoi_gian_dat, hdt.trang_thai, hdt.tong_tien, hdt.ghi_chu, tk.ho_ten
            ORDER BY hdt.thoi_gian_dat DESC
        ";
        
        return \HotelBooking\Facades\DB::query($sql, $params);
    }

    /**
     * Tính tổng tiền hóa đơn với giá theo giờ (tối ưu)
     */
    public static function calculateTotalWithHours($maHoaDon)
    {
        $sql = "
            SELECT 
                SUM(
                    CASE 
                        WHEN hdp.ma_hd_phong IS NOT NULL THEN 
                            hdp.gia * CEIL(TIMESTAMPDIFF(SECOND, hdp.check_in, hdp.check_out) / 3600)
                        ELSE 0 
                    END
                ) as tong_tien_phong,
                SUM(
                    CASE 
                        WHEN hdv.ma_hd_dich_vu IS NOT NULL THEN 
                            hdv.gia * hdv.so_luong
                        ELSE 0 
                    END
                ) as tong_tien_dich_vu
            FROM hoa_don_tong hdt
            LEFT JOIN hoa_don_phong hdp ON hdt.ma_hoa_don = hdp.ma_hoa_don
            LEFT JOIN hoa_don_dich_vu hdv ON hdt.ma_hoa_don = hdv.ma_hoa_don
            WHERE hdt.ma_hoa_don = ?
        ";
        
        $result = \HotelBooking\Facades\DB::queryOne($sql, [$maHoaDon]);
        
        if ($result) {
            return [
                'tong_tien_phong' => (float) ($result['tong_tien_phong'] ?? 0),
                'tong_tien_dich_vu' => (float) ($result['tong_tien_dich_vu'] ?? 0),
                'tong_tien' => (float) ($result['tong_tien_phong'] ?? 0) + (float) ($result['tong_tien_dich_vu'] ?? 0)
            ];
        }
        
        return ['tong_tien_phong' => 0, 'tong_tien_dich_vu' => 0, 'tong_tien' => 0];
    }

    /**
     * Lấy thống kê hóa đơn (tối ưu)
     */
    public static function getStatistics()
    {
        $sql = "
            SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN trang_thai = 'cho_xu_ly' OR trang_thai IS NULL THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN trang_thai = 'da_thanh_toan' THEN 1 ELSE 0 END) as paid,
                SUM(CASE 
                    WHEN trang_thai = 'da_thanh_toan' AND DATE(thoi_gian_dat) = CURDATE() 
                    THEN tong_tien 
                    ELSE 0 
                END) as revenue_today
            FROM hoa_don_tong
        ";
        
        $result = \HotelBooking\Facades\DB::queryOne($sql);
        
        return [
            'total' => (int) ($result['total'] ?? 0),
            'pending' => (int) ($result['pending'] ?? 0),
            'paid' => (int) ($result['paid'] ?? 0),
            'revenue_today' => (float) ($result['revenue_today'] ?? 0)
        ];
    }

    /**
     * Lấy tất cả hóa đơn với thông tin khách hàng, phòng và tổng tiền tính toán (tối ưu hơn)
     */
    public static function getAllWithDetailsAndTotal()
    {
        $sql = "
            SELECT 
                hdt.ma_hoa_don,
                hdt.ma_nhan_vien,
                hdt.ma_khach_hang,
                hdt.thoi_gian_dat,
                hdt.trang_thai,
                hdt.ghi_chu,
                COALESCE(tk.ho_ten, 'Không tìm thấy khách hàng') as ten_khach_hang,
                COALESCE(GROUP_CONCAT(DISTINCT p.ten_phong ORDER BY p.ten_phong SEPARATOR ', '), 'Chưa có phòng') as so_phong,
                COALESCE(
                    SUM(
                        CASE 
                            WHEN hdp.ma_hd_phong IS NOT NULL THEN 
                                hdp.gia * CEIL(TIMESTAMPDIFF(SECOND, hdp.check_in, hdp.check_out) / 3600)
                            ELSE 0 
                        END
                    ), 0
                ) + COALESCE(
                    (SELECT SUM(hdv.gia * hdv.so_luong) 
                     FROM hoa_don_dich_vu hdv 
                     WHERE hdv.ma_hoa_don = hdt.ma_hoa_don), 0
                ) as tong_tien
            FROM hoa_don_tong hdt
            LEFT JOIN tai_khoan tk ON hdt.ma_khach_hang = tk.ma_tai_khoan
            LEFT JOIN hoa_don_phong hdp ON hdt.ma_hoa_don = hdp.ma_hoa_don
            LEFT JOIN phong p ON hdp.ma_phong = p.ma_phong
            GROUP BY hdt.ma_hoa_don, hdt.ma_nhan_vien, hdt.ma_khach_hang, 
                     hdt.thoi_gian_dat, hdt.trang_thai, hdt.ghi_chu, tk.ho_ten
            ORDER BY hdt.thoi_gian_dat DESC
        ";
        
        return \HotelBooking\Facades\DB::query($sql);
    }

    /**
     * Lấy hóa đơn với tìm kiếm, lọc và tổng tiền tính toán (tối ưu hơn)
     */
    public static function searchWithDetailsAndTotal($search = '', $status = '', $date = '')
    {
        $conditions = [];
        $params = [];
        
        if (isNotEmpty($search)) {
            $conditions[] = "(hdt.ma_hoa_don LIKE ? OR tk.ho_ten LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }
        
        if (isNotEmpty($status)) {
            $conditions[] = "hdt.trang_thai = ?";
            $params[] = $status;
        }
        
        if (isNotEmpty($date)) {
            $conditions[] = "DATE(hdt.thoi_gian_dat) = ?";
            $params[] = $date;
        }
        
        $whereClause = isNotEmpty($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '';
        
        $sql = "
            SELECT 
                hdt.ma_hoa_don,
                hdt.ma_nhan_vien,
                hdt.ma_khach_hang,
                hdt.thoi_gian_dat,
                hdt.trang_thai,
                hdt.ghi_chu,
                COALESCE(tk.ho_ten, 'Không tìm thấy khách hàng') as ten_khach_hang,
                COALESCE(GROUP_CONCAT(DISTINCT p.ten_phong ORDER BY p.ten_phong SEPARATOR ', '), 'Chưa có phòng') as so_phong,
                COALESCE(
                    SUM(
                        CASE 
                            WHEN hdp.ma_hd_phong IS NOT NULL THEN 
                                hdp.gia * CEIL(TIMESTAMPDIFF(SECOND, hdp.check_in, hdp.check_out) / 3600)
                            ELSE 0 
                        END
                    ), 0
                ) + COALESCE(
                    (SELECT SUM(hdv.gia * hdv.so_luong) 
                     FROM hoa_don_dich_vu hdv 
                     WHERE hdv.ma_hoa_don = hdt.ma_hoa_don), 0
                ) as tong_tien
            FROM hoa_don_tong hdt
            LEFT JOIN tai_khoan tk ON hdt.ma_khach_hang = tk.ma_tai_khoan
            LEFT JOIN hoa_don_phong hdp ON hdt.ma_hoa_don = hdp.ma_hoa_don
            LEFT JOIN phong p ON hdp.ma_phong = p.ma_phong
            $whereClause
            GROUP BY hdt.ma_hoa_don, hdt.ma_nhan_vien, hdt.ma_khach_hang, 
                     hdt.thoi_gian_dat, hdt.trang_thai, hdt.ghi_chu, tk.ho_ten
            ORDER BY hdt.thoi_gian_dat DESC
        ";
        
        return \HotelBooking\Facades\DB::query($sql, $params);
    }

    /**
     * Tính tổng tiền hóa đơn
     */
    public function calculateTotal()
    {
        $total = 0;
        
        // Tính tiền phòng
        $hoaDonPhongs = $this->getPhongs();
        foreach ($hoaDonPhongs as $hdPhong) {
            $phong = Phong::find($hdPhong->ma_phong);
            if ($phong) {
                $soNgay = (strtotime($hdPhong->check_out) - strtotime($hdPhong->check_in)) / (60 * 60 * 24);
                $total += $phong->gia * $soNgay;
            }
        }
        
        // Tính tiền dịch vụ
        $dichVus = $this->getDichVus();
        foreach ($dichVus as $hdDichVu) {
            $dichVu = DichVu::find($hdDichVu->ma_dich_vu);
            if ($dichVu) {
                $total += $dichVu->gia * $hdDichVu->so_luong;
            }
        }
        
        return $total;
    }

    /**
     * Cập nhật tổng tiền
     */
    public function updateTotal()
    {
        $this->tong_tien = $this->calculateTotal();
        $this->save();
    }

    /**
     * Lấy chi tiết hóa đơn với tất cả thông tin liên quan
     * @param int $maHoaDon
     * @return array|null
     */
    public static function getInvoiceDetails($maHoaDon)
    {
        $sql = "
            SELECT 
                hd.*,
                nv.ho_ten as ten_nhan_vien,
                nv.mail as email_nhan_vien,
                kh.ho_ten as ten_khach_hang,
                kh.mail as email_khach_hang,
                kh.sdt as sdt_khach_hang,
                GROUP_CONCAT(DISTINCT CONCAT(p.ten_phong, '|', hdp.check_in, '|', hdp.check_out, '|', hdp.gia, '|', hdp.ma_hd_phong) SEPARATOR ';;') as phongs,
                GROUP_CONCAT(DISTINCT CONCAT(dv.ten_dich_vu, '|', hddv.so_luong, '|', hddv.gia, '|', hddv.thoi_gian, '|', hddv.ma_hd_phong) SEPARATOR ';;') as dich_vus
            FROM hoa_don_tong hd
            LEFT JOIN tai_khoan nv ON hd.ma_nhan_vien = nv.ma_tai_khoan
            LEFT JOIN tai_khoan kh ON hd.ma_khach_hang = kh.ma_tai_khoan
            LEFT JOIN hoa_don_phong hdp ON hd.ma_hoa_don = hdp.ma_hoa_don
            LEFT JOIN phong p ON hdp.ma_phong = p.ma_phong
            LEFT JOIN hoa_don_dich_vu hddv ON hd.ma_hoa_don = hddv.ma_hoa_don
            LEFT JOIN dich_vu dv ON hddv.ma_dich_vu = dv.ma_dich_vu
            WHERE hd.ma_hoa_don = ?
            GROUP BY hd.ma_hoa_don
        ";
        
        $result = \HotelBooking\Facades\DB::queryOne($sql, [$maHoaDon]);
        
        if ($result) {
            // Parse rooms data
            $result['rooms_data'] = [];
            if (isNotEmpty($result['phongs'])) {
                $roomsStr = explode(';;', $result['phongs']);
                foreach ($roomsStr as $roomStr) {
                    if (isNotEmpty($roomStr)) {
                        $parts = explode('|', $roomStr);
                        if (count($parts) >= 5) {
                            $result['rooms_data'][] = [
                                'ten_phong' => $parts[0],
                                'check_in' => $parts[1],
                                'check_out' => $parts[2],
                                'gia_hien_tai' => $parts[3],
                                'ma_hd_phong' => $parts[4]
                            ];
                        }
                    }
                }
            }

            // Parse services data
            $result['services_data'] = [];
            if (isNotEmpty($result['dich_vus'])) {
                $servicesStr = explode(';;', $result['dich_vus']);
                foreach ($servicesStr as $serviceStr) {
                    if (isNotEmpty($serviceStr)) {
                        $parts = explode('|', $serviceStr);
                        if (count($parts) >= 5) {
                            $result['services_data'][] = [
                                'ten_dich_vu' => $parts[0],
                                'so_luong' => $parts[1],
                                'gia_hien_tai' => $parts[2],
                                'thoi_gian' => $parts[3],
                                'ma_hd_phong' => $parts[4]
                            ];
                        }
                    }
                }
            }
        }
        
        return $result;
    }
}
