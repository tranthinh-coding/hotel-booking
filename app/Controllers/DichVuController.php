<?php

namespace HotelBooking\Controllers;

use HotelBooking\Models\DichVu;

class DichVuController
{
    public function index()
    {
        $dichVus = DichVu::all();
        view('DichVu.index', ['dichVus' => $dichVus]);
    }

    public function create()
    {
        view('DichVu.create');
    }

    public function store()
    {
        $data = [
            'ten_dich_vu' => $_POST['ten_dich_vu'],
            'gia' => $_POST['gia']
        ];

        $dichVu = new DichVu();
        $dichVu->create($data);

        flash_set('success', 'Thêm dịch vụ thành công');
        redirect('/dich-vu');
    }

    public function show($id)
    {
        $dichVu = DichVu::find($id);
        if (!$dichVu) {
            http_response_code(404);
            echo "Dịch vụ không tồn tại";
            return;
        }
        view('DichVu.show', ['dichVu' => $dichVu]);
    }

    public function edit($id)
    {
        $dichVu = DichVu::find($id);
        if (!$dichVu) {
            http_response_code(404);
            echo "Dịch vụ không tồn tại";
            return;
        }
        view('DichVu.edit', ['dichVu' => $dichVu]);
    }

    public function update($id)
    {
        $dichVu = DichVu::find($id);
        if (!$dichVu) {
            http_response_code(404);
            echo "Dịch vụ không tồn tại";
            return;
        }

        $data = [
            'ten_dich_vu' => $_POST['ten_dich_vu'],
            'gia' => $_POST['gia']
        ];

        $dichVu->update($data);

        flash_set('success', 'Cập nhật dịch vụ thành công');
        redirect('/dich-vu');
    }

    public function destroy($id)
    {
        $dichVu = DichVu::find($id);
        if ($dichVu) {
            $dichVu->delete();
            flash_set('success', 'Xóa dịch vụ thành công');
        }

        redirect('/dich-vu');
    }
}
