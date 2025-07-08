<?php

namespace HotelBooking\Controllers;

use HotelBooking\Models\TaiKhoan;

class TaiKhoanController
{
    public function index()
    {
        $taiKhoans = TaiKhoan::all();
        view('TaiKhoan/index', ['taiKhoans' => $taiKhoans]);
    }

    public function create()
    {
        view('TaiKhoan/create');
    }

    public function store()
    {
        $data = [
            'ho_ten' => $_POST['ho_ten'],
            'so_cccd' => $_POST['so_cccd'],
            'sdt' => $_POST['sdt'],
            'mail' => $_POST['mail'],
            'mat_khau' => password_hash($_POST['mat_khau'], PASSWORD_DEFAULT),
            'phan_quyen' => $_POST['phan_quyen']
        ];

        $taiKhoan = new TaiKhoan();
        $taiKhoan->create($data);

        flash_set('success', 'Thêm tài khoản thành công');
        redirect('/tai-khoan');
    }

    public function show($id)
    {
        $taiKhoan = TaiKhoan::find($id);
        if (!$taiKhoan) {
            http_response_code(404);
            echo "Tài khoản không tồn tại";
            return;
        }
        view('TaiKhoan.show', ['taiKhoan' => $taiKhoan]);
    }

    public function edit($id)
    {
        $taiKhoan = TaiKhoan::find($id);
        if (!$taiKhoan) {
            http_response_code(404);
            echo "Tài khoản không tồn tại";
            return;
        }
        view('TaiKhoan.edit', ['taiKhoan' => $taiKhoan]);
    }

    public function update($id)
    {
        $taiKhoan = TaiKhoan::find($id);
        if (!$taiKhoan) {
            http_response_code(404);
            echo "Tài khoản không tồn tại";
            return;
        }

        $data = [
            'ho_ten' => $_POST['ho_ten'],
            'so_cccd' => $_POST['so_cccd'],
            'sdt' => $_POST['sdt'],
            'mail' => $_POST['mail'],
            'phan_quyen' => $_POST['phan_quyen']
        ];

        // Only update password if provided
        if (!empty($_POST['mat_khau'])) {
            $data['mat_khau'] = password_hash($_POST['mat_khau'], PASSWORD_DEFAULT);
        }

        $taiKhoan->update($data);

        flash_set('success', 'Cập nhật tài khoản thành công');
        redirect('/tai-khoan');
    }

    public function destroy($id)
    {
        $taiKhoan = TaiKhoan::find($id);
        if ($taiKhoan) {
            $taiKhoan->delete();
            flash_set('success', 'Xóa tài khoản thành công');
        }

        redirect('/tai-khoan');
    }
}
