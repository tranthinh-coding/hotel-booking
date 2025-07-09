<?php

namespace HotelBooking\Controllers\Client;

use HotelBooking\Models\TaiKhoan;

class TaiKhoanController
{
    public function show($id)
    {
        $taiKhoan = TaiKhoan::find($id);
        if (!$taiKhoan) {
            http_response_code(404);
            echo "Tài khoản không tồn tại";
            return;
        }
        view('Client.TaiKhoan.show', ['taiKhoan' => $taiKhoan]);
    }
}
