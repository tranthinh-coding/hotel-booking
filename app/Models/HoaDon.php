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
        $dichVus = [];
        
        // Lấy dịch vụ theo phòng
        $hoaDonPhongs = $this->getPhongs();
        foreach ($hoaDonPhongs as $hdPhong) {
            $hdDichVus = HoaDonDichVu::where('ma_hd_phong', $hdPhong->ma_hd_phong)->get();
            $dichVus = array_merge($dichVus, $hdDichVus);
        }
        
        // Lấy dịch vụ theo hóa đơn
        $hdDichVusInvoice = HoaDonDichVu::where('ma_hoa_don', $this->ma_hoa_don)->get();
        $dichVus = array_merge($dichVus, $hdDichVusInvoice);
        
        return $dichVus;
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
}
