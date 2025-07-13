<?php

namespace HotelBooking\Controllers\Admin;

use HotelBooking\Models\DichVu;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Enums\PhanQuyen;

class AdminDichVuController
{
    public function __construct()
    {
        $this->checkAdminAccess();
    }

    private function checkAdminAccess()
    {
        if (auth_guest()) {
            redirect('/login');
        }

        $user = user();
        if (!$user || !PhanQuyen::isAdmin($user->phan_quyen)) {
            redirect('/');
        }
    }

    public function index()
    {
        $dichVus = DichVu::all();
        view('Admin.DichVu.index', ['dichVus' => $dichVus]);
    }

    public function create()
    {
        view('Admin.DichVu.create');
    }

    public function store()
    {
        $data = [
            'ten_dich_vu' => post('ten_dich_vu', ''),
            'gia' => post('gia', 0
        )];

        DichVu::create($data);
        redirect('/admin/dich-vu?success=created');
    }

    public function edit($id)
    {
        $dichVu = DichVu::find($id);
        
        if (!$dichVu) {
            redirect('/admin/dich-vu?error=notfound');
        }

        view('Admin.DichVu.edit', ['dichVu' => $dichVu]);
    }

    public function update($id)
    {
        $dichVu = DichVu::find($id);
        if (!$dichVu) {
            redirect('/admin/dich-vu?error=notfound');
        }

        $data = [
            'ten_dich_vu' => post('ten_dich_vu', $dichVu->ten_dich_vu),
            'gia' => post('gia', $dichVu->gia
        )];

        $dichVu->update($data);
        redirect('/admin/dich-vu?success=updated');
    }

    public function destroy($id)
    {
        $dichVu = DichVu::find($id);
        if (!$dichVu) {
            redirect('/admin/dich-vu?error=notfound');
        }

        $dichVu->delete();
        redirect('/admin/dich-vu?success=deleted');
    }
}



