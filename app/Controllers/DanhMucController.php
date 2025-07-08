<?php

namespace HotelBooking\Controllers;

use HotelBooking\Models\DanhMuc;

class DanhMucController
{
    public function index()
    {
        $danhMucs = DanhMuc::all();
        view('DanhMuc.index', ['danhMucs' => $danhMucs]);
    }

    public function create()
    {
        view('DanhMuc.create');
    }

    public function store()
    {
        $data = [
            'ten' => post('ten')
        ];

        $danhMuc = new DanhMuc();
        $danhMuc->create($data);

        flash_set('success', 'Thêm danh mục thành công');
        redirect('/danh-muc');
    }

    public function show($id)
    {
        $danhMuc = DanhMuc::find($id);
        if (!$danhMuc) {
            http_response_code(404);
            echo "Danh mục không tồn tại";
            return;
        }
        view('DanhMuc.show', ['danhMuc' => $danhMuc]);
    }

    public function edit($id)
    {
        $danhMuc = DanhMuc::find($id);
        if (!$danhMuc) {
            http_response_code(404);
            echo "Danh mục không tồn tại";
            return;
        }
        view('DanhMuc.edit', ['danhMuc' => $danhMuc]);
    }

    public function update($id)
    {
        $danhMuc = DanhMuc::find($id);
        if (!$danhMuc) {
            http_response_code(404);
            echo "Danh mục không tồn tại";
            return;
        }

        $data = [
            'ten' => post('ten')
        ];

        $danhMuc->update($data);

        flash_set('success', 'Cập nhật danh mục thành công');
        redirect('/danh-muc');
    }

    public function destroy($id)
    {
        $danhMuc = DanhMuc::find($id);
        if ($danhMuc) {
            $danhMuc->delete();
            flash_set('success', 'Xóa danh mục thành công');
        }

        redirect('/danh-muc');
    }
}
