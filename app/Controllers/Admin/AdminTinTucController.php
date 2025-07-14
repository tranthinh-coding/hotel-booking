<?php

namespace HotelBooking\Controllers\Admin;

use HotelBooking\Models\TinTuc;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Enums\PhanQuyen;

class AdminTinTucController
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
        // Lấy tất cả tin tức để tính thống kê
        $allTinTucs = TinTuc::all();
        
        // Thống kê tin tức
        $stats = [
            'total' => count($allTinTucs),
            'published' => 0,
            'draft' => 0,
            'total_views' => 0
        ];

        if (isNotEmpty($allTinTucs)) {
            foreach ($allTinTucs as $tinTuc) {
                // Thống kê theo trạng thái
                if ($tinTuc->trang_thai === 'published') {
                    $stats['published']++;
                } else {
                    $stats['draft']++;
                }
                
                // Tổng lượt xem
                $stats['total_views'] += $tinTuc->luot_xem ?? 0;
            }
        }

        // Xử lý tìm kiếm và lọc
        $query = TinTuc::newQuery();
        
        // Tìm kiếm theo tiêu đề
        $search = get('search', '');
        if (isNotEmpty($search)) {
            $query = $query->where('tieu_de', 'LIKE', '%' . $search . '%');
        }

        // Lọc theo trạng thái
        $trangThai = get('trang_thai', '');
        if (isNotEmpty($trangThai)) {
            $query = $query->where('trang_thai', $trangThai);
        }

        // Sắp xếp
        $sort = get('sort', 'ngay_dang');
        $allowedSorts = ['tieu_de', 'ngay_dang', 'luot_xem', 'ma_tin_tuc'];
        if (in_array($sort, $allowedSorts)) {
            $query = $query->whereRaw("1=1 ORDER BY {$sort} DESC");
        }

        $tinTucs = $query->get();
        
        view('Admin.TinTuc.index', [
            'tinTucs' => $tinTucs,
            'stats' => $stats
        ]);
    }

    public function create()
    {
        view('Admin.TinTuc.create');
    }

    public function store()
    {
        $data = [
            'tieu_de' => post('tieu_de', ''),
            'noi_dung' => post('noi_dung', ''),
            'ma_tai_khoan' => user()->ma_tai_khoan,
            'ngay_dang' => date('Y-m-d H:i:s'),
            'trang_thai' => post('trang_thai', 'draft'),
            'luot_xem' => 0
        ];

        // Handle image upload
        if (isset($_FILES['anh_dai_dien']) && $_FILES['anh_dai_dien']['size'] > 0) {
            $validation = validateImageFile($_FILES['anh_dai_dien']);
            if (!$validation['valid']) {
                redirect('/admin/tin-tuc/create?error=' . urlencode($validation['error']));
                return;
            }

            $fileName = saveFile($_FILES['anh_dai_dien']);
            if ($fileName) {
                $data['anh_dai_dien'] = $fileName;
            }
        }

        TinTuc::create($data);
        redirect('/admin/tin-tuc?success=created');
    }

    public function edit()
    {
        $id = get('id');
        if (!$id) {
            redirect('/admin/tin-tuc?error=missing_id');
            return;
        }

        $tinTuc = TinTuc::find($id);
        if (!$tinTuc) {
            redirect('/admin/tin-tuc?error=notfound');
        }

        view('Admin.TinTuc.edit', ['tinTuc' => $tinTuc]);
    }

    public function update()
    {
        $id = post('id');
        if (!$id) {
            redirect('/admin/tin-tuc?error=missing_id');
            return;
        }

        $tinTuc = TinTuc::find($id);
        if (!$tinTuc) {
            redirect('/admin/tin-tuc?error=notfound');
        }

        $data = [
            'tieu_de' => post('tieu_de', $tinTuc->tieu_de),
            'noi_dung' => post('noi_dung', $tinTuc->noi_dung),
            'trang_thai' => post('trang_thai', $tinTuc->trang_thai)
        ];

        // Handle remove current image
        if (post('remove_current_image') === '1' && isNotEmpty($tinTuc->anh_dai_dien)) {
            deleteFile($tinTuc->anh_dai_dien);
            $data['anh_dai_dien'] = null;
        }

        // Handle new image upload
        if (isset($_FILES['anh_dai_dien']) && $_FILES['anh_dai_dien']['size'] > 0) {
            $validation = validateImageFile($_FILES['anh_dai_dien']);
            if (!$validation['valid']) {
                redirect('/admin/tin-tuc/edit?id=' . $id . '&error=' . urlencode($validation['error']));
                return;
            }

            $fileName = saveFile($_FILES['anh_dai_dien']);
            if ($fileName) {
                // Delete old image if exists
                if (isNotEmpty($tinTuc->anh_dai_dien)) {
                    deleteFile($tinTuc->anh_dai_dien);
                }
                $data['anh_dai_dien'] = $fileName;
            }
        }

        $tinTuc->update($data);
        redirect('/admin/tin-tuc/show?id=' . $id . '&success=updated');
    }

    public function show()
    {
        $id = get('id');
        if (!$id) {
            redirect('/admin/tin-tuc?error=missing_id');
            return;
        }

        $tinTuc = TinTuc::find($id);
        if (!$tinTuc) {
            redirect('/admin/tin-tuc?error=notfound');
        }

        view('Admin.TinTuc.show', ['tinTuc' => $tinTuc]);
    }
}



