<?php

namespace HotelBooking\Controllers\Client;

use HotelBooking\Models\DichVu;

class DichVuController
{
    public function index()
    {
        $dichVus = DichVu::all();
        
        // Convert to array format for view
        $services = [];
        foreach ($dichVus as $dichVu) {
            $services[] = [
                'id' => $dichVu->ma_dich_vu,
                'ten_dich_vu' => $dichVu->ten_dich_vu,
                'mo_ta' => null, // Database doesn't have mo_ta field
                'gia' => $dichVu->gia,
                'hinh_anh' => $dichVu->hinh_anh,
                'trang_thai' => $dichVu->trang_thai ?? 'hoat_dong'
            ];
        }
        
        view('Client.DichVu.index', ['services' => $services, 'dichVus' => $dichVus]);
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



