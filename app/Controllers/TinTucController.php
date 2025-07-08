<?php

namespace HotelBooking\Controllers;

use HotelBooking\Models\TinTuc;
use HotelBooking\Models\TaiKhoan;

class TinTucController
{
    public function index()
    {
        $tinTucs = TinTuc::all();
        view('TinTuc.index', ['tinTucs' => $tinTucs]);
    }

    public function create()
    {
        $taiKhoans = TaiKhoan::all();
        view('TinTuc.create', ['taiKhoans' => $taiKhoans]);
    }

    public function store()
    {
        $data = [
            'ma_tai_khoan' => $_POST['ma_tai_khoan'],
            'noi_dung' => $_POST['noi_dung'],
            'ngay_dang' => date('Y-m-d H:i:s'),
            'trang_thai' => $_POST['trang_thai'] ?? 'draft'
        ];

        $tinTuc = new TinTuc();
        $tinTuc->create($data);

        header('Location: /tin-tuc');
        exit;
    }

    public function show($id)
    {
        $tinTuc = TinTuc::find($id);
        if (!$tinTuc) {
            http_response_code(404);
            echo "Tin tức không tồn tại";
            return;
        }
        view('TinTuc.show', ['tinTuc' => $tinTuc]);
    }

    public function edit($id)
    {
        $tinTuc = TinTuc::find($id);
        if (!$tinTuc) {
            http_response_code(404);
            echo "Tin tức không tồn tại";
            return;
        }
        $taiKhoans = TaiKhoan::all();
        view('TinTuc.edit', ['tinTuc' => $tinTuc, 'taiKhoans' => $taiKhoans]);
    }

    public function update($id)
    {
        $tinTuc = TinTuc::find($id);
        if (!$tinTuc) {
            http_response_code(404);
            echo "Tin tức không tồn tại";
            return;
        }

        $data = [
            'ma_tai_khoan' => $_POST['ma_tai_khoan'],
            'noi_dung' => $_POST['noi_dung'],
            'trang_thai' => $_POST['trang_thai']
        ];

        $tinTuc->update($data);

        header('Location: /tin-tuc');
        exit;
    }

    public function destroy($id)
    {
        $tinTuc = TinTuc::find($id);
        if ($tinTuc) {
            $tinTuc->delete();
        }

        header('Location: /tin-tuc');
        exit;
    }

    public function publish($id)
    {
        $tinTuc = TinTuc::find($id);
        if ($tinTuc) {
            $tinTuc->update(['trang_thai' => 'published']);
        }

        header('Location: /tin-tuc');
        exit;
    }

    public function unpublish($id)
    {
        $tinTuc = TinTuc::find($id);
        if ($tinTuc) {
            $tinTuc->update(['trang_thai' => 'draft']);
        }

        header('Location: /tin-tuc');
        exit;
    }
}
