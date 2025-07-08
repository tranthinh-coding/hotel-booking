<?php

namespace HotelBooking\Controllers;

require_once __DIR__ . '/../Functions/functions.php';

use HotelBooking\Models\NguoiDung;

class NguoiDungController
{
    public function index()
    {
        $nguoiDungs = NguoiDung::all();
        view('NguoiDung/index', ['nguoiDungs' => $nguoiDungs]);
    }

    public function create()
    {
        view('NguoiDung/create');
    }

    public function store()
    {
        $data = [
            'ho_ten' => $_POST['ho_ten'] ?? '',
            'email' => $_POST['email'] ?? '',
            'mat_khau' => password_hash($_POST['mat_khau'] ?? '', PASSWORD_DEFAULT),
            'so_dien_thoai' => $_POST['so_dien_thoai'] ?? '',
            'dia_chi' => $_POST['dia_chi'] ?? '',
            'vai_tro' => $_POST['vai_tro'] ?? 'Khách hàng'
        ];

        NguoiDung::create($data);
        header('Location: /nguoi-dung');
        exit;
    }

    public function edit($id)
    {
        $nguoiDung = NguoiDung::find($id);
        view('NguoiDung/edit', ['nguoiDung' => $nguoiDung]);
    }

    public function update($id)
    {
        $nguoiDung = NguoiDung::find($id);
        $data = [
            'ho_ten' => $_POST['ho_ten'] ?? $nguoiDung->ho_ten,
            'email' => $_POST['email'] ?? $nguoiDung->email,
            'so_dien_thoai' => $_POST['so_dien_thoai'] ?? $nguoiDung->so_dien_thoai,
            'dia_chi' => $_POST['dia_chi'] ?? $nguoiDung->dia_chi,
            'vai_tro' => $_POST['vai_tro'] ?? $nguoiDung->vai_tro
        ];

        $nguoiDung->update($data);
        header('Location: /nguoi-dung');
        exit;
    }

    public function destroy($id)
    {
        $nguoiDung = NguoiDung::find($id);
        $nguoiDung->delete();
        header('Location: /nguoi-dung');
        exit;
    }
}