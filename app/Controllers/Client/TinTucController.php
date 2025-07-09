<?php

namespace HotelBooking\Controllers\Client;

use HotelBooking\Models\TinTuc;

class TinTucController
{
    public function index()
    {
        $tinTucs = TinTuc::all();
        view('Client.TinTuc.index', ['tinTucs' => $tinTucs]);
    }

    public function show($id)
    {
        $tinTuc = TinTuc::find($id);
        if (!$tinTuc) {
            http_response_code(404);
            echo "Tin tức không tồn tại";
            return;
        }
        
        // Increment view count
        $tinTuc->luot_xem = ($tinTuc->luot_xem ?? 0) + 1;
        $tinTuc->save();
        
        view('Client.TinTuc.show', ['tinTuc' => $tinTuc]);
    }
}
