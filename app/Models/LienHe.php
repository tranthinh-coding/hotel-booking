<?php

namespace HotelBooking\Models;

/**
 * @property int $ma_lien_he
 * @property string $ho_ten
 * @property string $email
 * @property string $so_dien_thoai
 * @property string $chu_de
 * @property string $noi_dung
 * @property string $trang_thai
 * @property string $ngay_gui
 * @property string $ngay_phan_hoi
 * @property string $noi_dung_phan_hoi
 * @property int $ma_nhan_vien_phan_hoi
 */
class LienHe extends Model
{
    protected $table = 'lien_he';
    protected $primaryKey = 'ma_lien_he';

    protected $attributes = [
        'ma_lien_he',
        'ho_ten',
        'email',
        'so_dien_thoai',
        'chu_de',
        'noi_dung',
        'trang_thai',
        'ngay_gui',
        'ngay_phan_hoi',
        'noi_dung_phan_hoi',
        'ma_nhan_vien_phan_hoi'
    ];

    // Trạng thái liên hệ
    const TRANG_THAI_MOI = 'moi';
    const TRANG_THAI_DANG_XU_LY = 'dang_xu_ly';
    const TRANG_THAI_DA_PHAN_HOI = 'da_phan_hoi';
    const TRANG_THAI_DA_DONG = 'da_dong';

    /**
     * Lấy thống kê liên hệ
     */
    public static function getStatistics()
    {
        $sql = "
            SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN trang_thai = '" . self::TRANG_THAI_MOI . "' THEN 1 ELSE 0 END) as new_messages,
                SUM(CASE WHEN trang_thai = '" . self::TRANG_THAI_DANG_XU_LY . "' THEN 1 ELSE 0 END) as processing,
                SUM(CASE WHEN trang_thai = '" . self::TRANG_THAI_DA_PHAN_HOI . "' THEN 1 ELSE 0 END) as replied,
                SUM(CASE WHEN DATE(ngay_gui) = CURDATE() THEN 1 ELSE 0 END) as today_messages
            FROM lien_he
        ";
        
        $result = \HotelBooking\Facades\DB::query($sql);
        return $result[0] ?? [
            'total' => 0,
            'new_messages' => 0,
            'processing' => 0,
            'replied' => 0,
            'today_messages' => 0
        ];
    }

    /**
     * Tìm kiếm liên hệ với filter
     */
    public static function searchWithFilters($search = '', $status = '', $date = '')
    {
        $sql = "
            SELECT 
                lh.*,
                COALESCE(tk.ho_ten, 'Hệ thống') as ten_nhan_vien_phan_hoi
            FROM lien_he lh
            LEFT JOIN tai_khoan tk ON lh.ma_nhan_vien_phan_hoi = tk.ma_tai_khoan
            WHERE 1=1
        ";
        
        $params = [];
        
        if (isNotEmpty($search)) {
            $sql .= " AND (lh.ho_ten LIKE ? OR lh.email LIKE ? OR lh.chu_de LIKE ? OR lh.noi_dung LIKE ?)";
            $searchTerm = "%$search%";
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }
        
        if (isNotEmpty($status)) {
            $sql .= " AND lh.trang_thai = ?";
            $params[] = $status;
        }
        
        if (isNotEmpty($date)) {
            $sql .= " AND DATE(lh.ngay_gui) = ?";
            $params[] = $date;
        }
        
        $sql .= " ORDER BY lh.ngay_gui DESC";
        
        return \HotelBooking\Facades\DB::query($sql, $params);
    }

    /**
     * Lấy tất cả liên hệ với thông tin nhân viên phản hồi
     */
    public static function getAllWithStaff()
    {
        $sql = "
            SELECT 
                lh.*,
                COALESCE(tk.ho_ten, 'Hệ thống') as ten_nhan_vien_phan_hoi
            FROM lien_he lh
            LEFT JOIN tai_khoan tk ON lh.ma_nhan_vien_phan_hoi = tk.ma_tai_khoan
            ORDER BY lh.ngay_gui DESC
        ";
        
        return \HotelBooking\Facades\DB::query($sql);
    }

    /**
     * Cập nhật trạng thái liên hệ
     */
    public function updateStatus($status, $adminId = null)
    {
        $conn = \HotelBooking\Facades\DB::connect();
        
        $sql = "UPDATE lien_he SET trang_thai = ?";
        $params = [$status];
        $types = 's';
        
        if ($status === self::TRANG_THAI_DA_PHAN_HOI && $adminId) {
            $sql .= ", ma_nhan_vien_phan_hoi = ?, ngay_phan_hoi = NOW()";
            $params[] = $adminId;
            $types .= 'i';
        }
        
        $sql .= " WHERE ma_lien_he = ?";
        $params[] = $this->ma_lien_he;
        $types .= 'i';
        
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param($types, ...$params);
            $result = $stmt->execute();
            $stmt->close();
            \HotelBooking\Facades\DB::close();
            return $result;
        }
        
        \HotelBooking\Facades\DB::close();
        return false;
    }

    /**
     * Thêm phản hồi
     */
    public function addReply($noiDung, $adminId)
    {
        $conn = \HotelBooking\Facades\DB::connect();
        
        $sql = "UPDATE lien_he SET noi_dung_phan_hoi = ?, ma_nhan_vien_phan_hoi = ?, ngay_phan_hoi = NOW(), trang_thai = ? WHERE ma_lien_he = ?";
        
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $trangThai = self::TRANG_THAI_DA_PHAN_HOI;
            $stmt->bind_param('sisi', $noiDung, $adminId, $trangThai, $this->ma_lien_he);
            $result = $stmt->execute();
            $stmt->close();
            \HotelBooking\Facades\DB::close();
            return $result;
        }
        
        \HotelBooking\Facades\DB::close();
        return false;
    }

    /**
     * Lấy label trạng thái
     */
    public static function getStatusLabel($status)
    {
        $labels = [
            self::TRANG_THAI_MOI => 'Tin nhắn mới',
            self::TRANG_THAI_DANG_XU_LY => 'Đang xử lý',
            self::TRANG_THAI_DA_PHAN_HOI => 'Đã phản hồi',
            self::TRANG_THAI_DA_DONG => 'Đã đóng'
        ];
        
        return $labels[$status] ?? 'Không xác định';
    }

    /**
     * Lấy màu trạng thái
     */
    public static function getStatusColor($status)
    {
        $colors = [
            self::TRANG_THAI_MOI => 'blue',
            self::TRANG_THAI_DANG_XU_LY => 'yellow',
            self::TRANG_THAI_DA_PHAN_HOI => 'green',
            self::TRANG_THAI_DA_DONG => 'gray'
        ];
        
        return $colors[$status] ?? 'gray';
    }

    /**
     * Lấy nhân viên phản hồi
     */
    public function getNhanVienPhanHoi()
    {
        if (!$this->ma_nhan_vien_phan_hoi) return null;
        return TaiKhoan::find($this->ma_nhan_vien_phan_hoi);
    }
}
