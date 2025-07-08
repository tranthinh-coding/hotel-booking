<?php

namespace HotelBooking\Controllers;

use HotelBooking\Models\Phong;

class PhongController
{
    public function index()
    {
        $phongs = Phong::all();
        view('Phong.index', ['phongs' => $phongs]);
    }

    public function create()
    {
        view('Phong.create');
    }

    public function store()
    {
        $data = [
            'ten_phong' => $_POST['ten_phong'],
            'mo_ta' => $_POST['mo_ta'],
            'trang_thai' => $_POST['trang_thai'],
            'gia' => $_POST['gia']
        ];

        $phong = new Phong();
        $phong->create($data);

        flash_set('success', 'Thêm phòng thành công');
        redirect('/phong');
    }

    public function show($id)
    {
        $phong = Phong::find($id);
        if (!$phong) {
            http_response_code(404);
            echo "Phòng không tồn tại";
            return;
        }
        view('Phong.show', ['phong' => $phong]);
    }

    public function edit($id)
    {
        $phong = Phong::find($id);
        if (!$phong) {
            http_response_code(404);
            echo "Phòng không tồn tại";
            return;
        }
        view('Phong.edit', ['phong' => $phong]);
    }

    public function update($id)
    {
        $phong = Phong::find($id);
        if (!$phong) {
            http_response_code(404);
            echo "Phòng không tồn tại";
            return;
        }

        $data = [
            'ten_phong' => $_POST['ten_phong'],
            'mo_ta' => $_POST['mo_ta'],
            'trang_thai' => $_POST['trang_thai'],
            'gia' => $_POST['gia']
        ];

        $phong->update($data);

        flash_set('success', 'Cập nhật phòng thành công');
        redirect('/phong');
    }

    public function destroy($id)
    {
        $phong = Phong::find($id);
        if ($phong) {
            $phong->delete();
            flash_set('success', 'Xóa phòng thành công');
        }

        redirect('/phong');
    }
}
