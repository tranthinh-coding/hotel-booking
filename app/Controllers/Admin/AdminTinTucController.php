<?php

namespace HotelBooking\Controllers\Admin;

use HotelBooking\Models\TinTuc;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Enums\PhanQuyen;

class AdminTinTucController
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

    public function index()
    {
        $tinTucs = TinTuc::all();
        view('Admin.TinTuc.index', ['tinTucs' => $tinTucs]);
    }

    public function create()
    {
        $taiKhoans = TaiKhoan::all();
        view('Admin.TinTuc.create', ['taiKhoans' => $taiKhoans]);
    }

    public function store()
    {
        $data = [
            'tieu_de' => post('tieu_de', ''),
            'noi_dung' => post('noi_dung', ''),
            'ma_tai_khoan' => post('ma_tai_khoan', null),
            'ngay_dang' => date('Y-m-d H:i:s'),
            'trang_thai' => post('trang_thai', 'draft'
        )];

        TinTuc::create($data);
        redirect('/admin/tin-tuc?success=created');
    }

    public function edit($id)
    {
        $tinTuc = TinTuc::find($id);
        $taiKhoans = TaiKhoan::all();
        
        if (!$tinTuc) {
            redirect('/admin/tin-tuc?error=notfound');
        }

        view('Admin.TinTuc.edit', ['tinTuc' => $tinTuc, 'taiKhoans' => $taiKhoans]);
    }

    public function update($id)
    {
        $tinTuc = TinTuc::find($id);
        if (!$tinTuc) {
            redirect('/admin/tin-tuc?error=notfound');
        }

        $data = [
            'tieu_de' => post('tieu_de', $tinTuc->tieu_de),
            'noi_dung' => post('noi_dung', $tinTuc->noi_dung),
            'ma_tai_khoan' => post('ma_tai_khoan', $tinTuc->ma_tai_khoan),
            'trang_thai' => post('trang_thai', $tinTuc->trang_thai
        )];

        $tinTuc->update($data);
        redirect('/admin/tin-tuc?success=updated');
    }

    public function destroy($id)
    {
        $tinTuc = TinTuc::find($id);
        if (!$tinTuc) {
            redirect('/admin/tin-tuc?error=notfound');
        }

        $tinTuc->delete();
        redirect('/admin/tin-tuc?success=deleted');
    }

    public function publish($id)
    {
        $tinTuc = TinTuc::find($id);
        if ($tinTuc) {
            $tinTuc->update(['trang_thai' => 'published']);
        }

        redirect('/admin/tin-tuc?success=published');
    }

    public function unpublish($id)
    {
        $tinTuc = TinTuc::find($id);
        if ($tinTuc) {
            $tinTuc->update(['trang_thai' => 'draft']);
        }

        redirect('/admin/tin-tuc?success=unpublished');
    }
}



