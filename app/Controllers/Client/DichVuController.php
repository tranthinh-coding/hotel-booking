<?php

namespace HotelBooking\Controllers\Client;

use HotelBooking\Models\DichVu;

class DichVuController
{
    public function index()
    {
        $dichVus = DichVu::where('trang_thai', 'hoat_dong')->get();

        view('Client.DichVu.index', ['dichVus' => $dichVus]);
    }

    public function show($id)
    {
        $dichVu = DichVu::find($id);
        if (!$dichVu) {
            http_response_code(404);
            echo "D?ch v? kh�ng t?n t?i";
            return;
        }
        view('Client.DichVu.show', ['dichVu' => $dichVu]);
    }
}



