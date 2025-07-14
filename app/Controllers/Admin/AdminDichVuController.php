<?php

namespace HotelBooking\Controllers\Admin;

use HotelBooking\Models\DichVu;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Enums\PhanQuyen;
use HotelBooking\Enums\TrangThaiDichVu;

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
        // Lấy tất cả dịch vụ để tính thống kê
        $allDichVus = DichVu::all();
        
        // Thống kê dịch vụ
        $stats = [
            'total' => count($allDichVus),
            'active' => 0,
            'inactive' => 0,
            'avg_price' => 0,
            'max_price' => 0
        ];

        if (isNotEmpty($allDichVus)) {
            $prices = [];
            foreach ($allDichVus as $dichVu) {
                // Thống kê theo trạng thái
                $status = $dichVu->trang_thai ?? TrangThaiDichVu::HOAT_DONG;
                if ($status === TrangThaiDichVu::HOAT_DONG) {
                    $stats['active']++;
                } else {
                    $stats['inactive']++;
                }
                
                // Thống kê giá
                if ($dichVu->gia > 0) {
                    $prices[] = $dichVu->gia;
                }
            }
            
            if (isNotEmpty($prices)) {
                $stats['avg_price'] = round(array_sum($prices) / count($prices));
                $stats['max_price'] = max($prices);
            }
        }

        // Xử lý tìm kiếm và lọc
        $query = DichVu::newQuery();
        
        // Tìm kiếm theo tên dịch vụ
        $search = get('search', '');
        if (isNotEmpty($search)) {
            $query = $query->where('ten_dich_vu', 'LIKE', '%' . $search . '%');
        }

        // Lọc theo trạng thái
        $trangThai = get('trang_thai', '');
        if (isNotEmpty($trangThai)) {
            $query = $query->where('trang_thai', $trangThai);
        }

        // Lọc theo khoảng giá
        $minPrice = get('min_price', '');
        if (isNotEmpty($minPrice) && is_numeric($minPrice)) {
            $query = $query->where('gia', '>=', (float)$minPrice);
        }

        $maxPrice = get('max_price', '');
        if (isNotEmpty($maxPrice) && is_numeric($maxPrice)) {
            $query = $query->where('gia', '<=', (float)$maxPrice);
        }

        // Sắp xếp
        $sort = get('sort', 'ten_dich_vu');
        $allowedSorts = ['ten_dich_vu', 'gia', 'ma_dich_vu'];
        if (in_array($sort, $allowedSorts)) {
            // Sử dụng raw SQL để order by
            $query = $query->whereRaw("1=1 ORDER BY {$sort}");
        }

        $dichVus = $query->get();
        
        view('Admin.DichVu.index', [
            'dichVus' => $dichVus,
            'stats' => $stats
        ]);
    }

    public function create()
    {
        view('Admin.DichVu.create');
    }

    public function store()
    {
        $data = [
            'ten_dich_vu' => post('ten_dich_vu', ''),
            'gia' => post('gia', 0),
            'trang_thai' => post('trang_thai', TrangThaiDichVu::HOAT_DONG)
        ];

        // Handle image upload
        if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['size'] > 0) {
            $validation = validateImageFile($_FILES['hinh_anh']);
            if (!$validation['valid']) {
                redirect('/admin/dich-vu/create?error=' . urlencode($validation['error']));
                return;
            }

            $fileName = saveFile($_FILES['hinh_anh']);
            if ($fileName) {
                $data['hinh_anh'] = $fileName;
            }
        }

        DichVu::create($data);
        redirect('/admin/dich-vu?success=created');
    }

    public function edit()
    {
        $id = get('id');
        if (!$id) {
            redirect('/admin/dich-vu?error=missing_id');
            return;
        }

        $dichVu = DichVu::find($id);
        if (!$dichVu) {
            redirect('/admin/dich-vu?error=notfound');
        }

        view('Admin.DichVu.edit', ['dichVu' => $dichVu]);
    }

    public function update()
    {
        $id = post('id');
        if (!$id) {
            redirect('/admin/dich-vu?error=missing_id');
            return;
        }

        $dichVu = DichVu::find($id);
        if (!$dichVu) {
            redirect('/admin/dich-vu?error=notfound');
        }

        $data = [
            'ten_dich_vu' => post('ten_dich_vu', $dichVu->ten_dich_vu),
            'gia' => post('gia', $dichVu->gia),
            'trang_thai' => post('trang_thai', $dichVu->trang_thai)
        ];

        // Handle remove current image
        if (post('remove_current_image') === '1' && isNotEmpty($dichVu->hinh_anh)) {
            deleteFile($dichVu->hinh_anh);
            $data['hinh_anh'] = null;
        }

        // Handle new image upload
        if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['size'] > 0) {
            $validation = validateImageFile($_FILES['hinh_anh']);
            if (!$validation['valid']) {
                redirect('/admin/dich-vu/edit?id=' . $id . '&error=' . urlencode($validation['error']));
                return;
            }

            $fileName = saveFile($_FILES['hinh_anh']);
            if ($fileName) {
                // Delete old image if exists
                if (isNotEmpty($dichVu->hinh_anh)) {
                    deleteFile($dichVu->hinh_anh);
                }
                $data['hinh_anh'] = $fileName;
            }
        }

        $dichVu->update($data);
        redirect('/admin/dich-vu/show?id=' . $id . '&success=updated');
    }

    public function show()
    {
        $id = get('id');
        if (!$id) {
            redirect('/admin/dich-vu?error=missing_id');
            return;
        }

        $dichVu = DichVu::find($id);
        if (!$dichVu) {
            redirect('/admin/dich-vu?error=notfound');
        }

        view('Admin.DichVu.show', ['dichVu' => $dichVu]);
    }
}



