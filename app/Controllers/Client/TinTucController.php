<?php

namespace HotelBooking\Controllers\Client;

use HotelBooking\Facades\DB;
use HotelBooking\Models\TinTuc;

class TinTucController
{
    public function index()
    {
        $tinTucs = DB::table('tin_tuc')
            ->where('trang_thai', '=', 'published')
            ->orWhere('trang_thai', '=', 'draft')
            ->get();

        // convert sang object
        $tinTucs = array_map(function ($item) {
            return (object) $item;
        }, $tinTucs);

        view('Client.TinTuc.index', ['tinTucs' => $tinTucs]);
    }

    public function show($id)
    {
        $tinTuc = TinTuc::find($id);
        if (!$tinTuc) {
            http_response_code(404);
            view('Client.TinTuc.show', ['tinTuc' => null, 'relatedNews' => []]);
            return;
        }
        
        // Increment view count
        $tinTuc->luot_xem = ($tinTuc->luot_xem ?? 0) + 1;
        $tinTuc->save();
        
        // Get related news (exclude current article)
        $allNews = TinTuc::all();
        $relatedNews = [];
        
        foreach ($allNews as $news) {
            if ($news->ma_tin_tuc != $id) {
                $relatedNews[] = $news;
                if (count($relatedNews) >= 5) {
                    break;
                }
            }
        }
        
        view('Client.TinTuc.show', [
            'tinTuc' => $tinTuc,
            'relatedNews' => $relatedNews
        ]);
    }
}
