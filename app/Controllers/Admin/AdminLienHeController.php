<?php

namespace HotelBooking\Controllers\Admin;

use Exception;
use HotelBooking\Models\LienHe;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Enums\PhanQuyen;

class AdminLienHeController
{
    public function __construct()
    {
        $this->checkAdminAccess();
    }

    private function checkAdminAccess()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }

        $user = TaiKhoan::find($_SESSION['user_id']);
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }
    }

    /**
     * Hiển thị danh sách liên hệ
     */
    public function index()
    {
        // Get search parameters
        $search = get('search', '');
        $status = get('status', '');
        $date = get('date', '');

        // Get statistics
        $stats = LienHe::getStatistics();

        // Get contacts with filters or all contacts
        if (isNotEmpty($search) || isNotEmpty($status) || isNotEmpty($date)) {
            $lienHes = LienHe::searchWithFilters($search, $status, $date);
        } else {
            $lienHes = LienHe::getAllWithStaff();
        }

        view('Admin.LienHe.index', [
            'lienHes' => $lienHes,
            'stats' => $stats
        ]);
    }

    /**
     * Hiển thị chi tiết liên hệ
     */
    public function show()
    {
        $id = get('id');
        
        if (isEmpty($id)) {
            redirect('/admin/lien-he?error=missing_id');
        }

        $lienHe = LienHe::find($id);
        
        if (!$lienHe) {
            redirect('/admin/lien-he?error=notfound');
        }

        // Tự động chuyển trạng thái từ "mới" sang "đang xử lý" khi xem
        if ($lienHe->trang_thai === LienHe::TRANG_THAI_MOI) {
            $lienHe->updateStatus(LienHe::TRANG_THAI_DANG_XU_LY, $_SESSION['user_id']);
            $lienHe->trang_thai = LienHe::TRANG_THAI_DANG_XU_LY;
        }

        view('Admin.LienHe.show', [
            'lienHe' => $lienHe
        ]);
    }

    /**
     * Phản hồi liên hệ
     */
    public function reply()
    {
        $id = post('id');
        $noiDung = post('noi_dung_phan_hoi');
        
        if (isEmpty($id) || isEmpty($noiDung)) {
            redirect('/admin/lien-he?error=missing_data');
        }

        $lienHe = LienHe::find($id);
        
        if (!$lienHe) {
            redirect('/admin/lien-he?error=notfound');
        }

        try {
            $lienHe->addReply($noiDung, $_SESSION['user_id']);
            redirect('/admin/lien-he/show?id=' . $id . '&success=replied');
        } catch (Exception $e) {
            redirect('/admin/lien-he/show?id=' . $id . '&error=reply_failed');
        }
    }

    /**
     * Cập nhật trạng thái liên hệ
     */
    public function updateStatus()
    {
        $id = post('id');
        $status = post('status');
        
        if (isEmpty($id) || isEmpty($status)) {
            redirect('/admin/lien-he?error=missing_data');
        }

        $lienHe = LienHe::find($id);
        
        if (!$lienHe) {
            redirect('/admin/lien-he?error=notfound');
        }

        try {
            $lienHe->updateStatus($status, $_SESSION['user_id']);
            redirect('/admin/lien-he/show?id=' . $id . '&success=status_updated');
        } catch (Exception $e) {
            redirect('/admin/lien-he/show?id=' . $id . '&error=status_failed');
        }
    }

    /**
     * Xóa liên hệ (chuyển sang trạng thái đã đóng)
     */
    public function close()
    {
        $id = post('id');
        
        if (isEmpty($id)) {
            redirect('/admin/lien-he?error=missing_id');
        }

        $lienHe = LienHe::find($id);
        
        if (!$lienHe) {
            redirect('/admin/lien-he?error=notfound');
        }

        try {
            $lienHe->updateStatus(LienHe::TRANG_THAI_DA_DONG, $_SESSION['user_id']);
            redirect('/admin/lien-he?success=closed');
        } catch (Exception $e) {
            redirect('/admin/lien-he?error=close_failed');
        }
    }
}
