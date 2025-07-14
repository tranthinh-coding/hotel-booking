<?php

namespace HotelBooking\Controllers\Admin;

use HotelBooking\Models\Phong;
use HotelBooking\Models\LoaiPhong;
use HotelBooking\Models\HinhAnh;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Enums\PhanQuyen;
use Exception;

class AdminPhongController
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
        // Get filter parameters
        $search = get('search', '');
        $loaiPhong = get('loai_phong', '');
        $trangThai = get('trang_thai', '');
        $sort = get('sort', 'ten_phong');
        
        // Build base query
        $phongs = Phong::all();
        
        // Apply filters manually since we don't have advanced query builder
        if (!empty($search) || !empty($loaiPhong) || !empty($trangThai)) {
            $filteredPhongs = [];
            foreach ($phongs as $phong) {
                $include = true;
                
                if (!empty($search) && stripos($phong->ten_phong, $search) === false) {
                    $include = false;
                }
                
                if (!empty($loaiPhong) && $phong->ma_loai_phong != $loaiPhong) {
                    $include = false;
                }
                
                if (!empty($trangThai) && $phong->trang_thai !== $trangThai) {
                    $include = false;
                }
                
                if ($include) {
                    $filteredPhongs[] = $phong;
                }
            }
            $phongs = $filteredPhongs;
        }
        
        // Apply sorting
        usort($phongs, function($a, $b) use ($sort) {
            switch ($sort) {
                case 'gia':
                    return $a->gia <=> $b->gia;
                case 'ma_phong':
                    return $a->ma_phong <=> $b->ma_phong;
                default:
                    return strcmp($a->ten_phong, $b->ten_phong);
            }
        });
        
        // Get statistics
        $allPhongs = Phong::all();
        $stats = [
            'total' => count($allPhongs),
            'available' => 0,
            'cleaning' => 0,
            'maintenance' => 0,
            'deactivated' => 0
        ];
        
        foreach ($allPhongs as $phong) {
            switch ($phong->trang_thai) {
                case \HotelBooking\Enums\TrangThaiPhong::CON_TRONG:
                    $stats['available']++;
                    break;
                case \HotelBooking\Enums\TrangThaiPhong::BAO_TRI:
                    $stats['maintenance']++;
                    break;
                case \HotelBooking\Enums\TrangThaiPhong::DANG_DON_DEP:
                    $stats['cleaning']++;
                    break;
                case \HotelBooking\Enums\TrangThaiPhong::NGUNG_HOAT_DONG:
                    $stats['deactivated']++;
                    break;
            }
        }
        
        // Get room types for filter
        $loaiPhongs = LoaiPhong::all();
        
        view('Admin.Phong.index', [
            'phongs' => $phongs,
            'stats' => $stats,
            'loaiPhongs' => $loaiPhongs
        ]);
    }

    public function create()
    {
        $loaiPhongs = LoaiPhong::all();
        view('Admin.Phong.create', ['loaiPhongs' => $loaiPhongs]);
    }

    public function store()
    {
        // Validation
        $errors = [];
        
        $tenPhong = trim(post('ten_phong', ''));
        $maLoaiPhong = post('ma_loai_phong', null);
        $gia = post('gia', 0);
        
        // Debug - Log received data
        error_log("Received data: ten_phong=" . $tenPhong . ", ma_loai_phong=" . $maLoaiPhong . ", gia=" . $gia);
        
        if (empty($tenPhong)) {
            $errors[] = 'Tên phòng không được để trống';
        }
        
        if (empty($maLoaiPhong)) {
            $errors[] = 'Vui lòng chọn loại phòng';
        } else {
            // Kiểm tra loại phòng có tồn tại không
            $loaiPhong = LoaiPhong::find($maLoaiPhong);
            if (!$loaiPhong) {
                $errors[] = 'Loại phòng không tồn tại';
            }
        }
        
        // Kiểm tra tên phòng đã tồn tại
        $existingRoom = Phong::where('ten_phong', '=', $tenPhong)->get();
        if (count($existingRoom) > 0) {
            $errors[] = 'Tên phòng đã tồn tại';
        }
        
        if (!empty($errors)) {
            $errorMessage = implode(', ', $errors);
            redirect('/admin/phong/create?error=validation&message=' . urlencode($errorMessage));
            return;
        }

        $data = [
            'ten_phong' => $tenPhong,
            'mo_ta' => post('mo_ta', ''),
            'gia' => (int)$gia,
            'ma_loai_phong' => (int)$maLoaiPhong,
            'trang_thai' => post('trang_thai', \HotelBooking\Enums\TrangThaiPhong::CON_TRONG)
        ];

        try {
            // Tạo phòng trước
            $phong = Phong::create($data);
            $maPhong = $phong->ma_phong;

            // Debug - Log the room ID
            error_log("Created room with ID: " . $maPhong);

            // Xử lý upload nhiều ảnh
            if (isset($_FILES['hinh_anh']) && is_array($_FILES['hinh_anh']['name'])) {
                $uploadedImages = [];
                $fileCount = count($_FILES['hinh_anh']['name']);
                
                for ($i = 0; $i < $fileCount; $i++) {
                    if ($_FILES['hinh_anh']['size'][$i] > 0) {
                        // Tạo file array cho từng ảnh
                        $fileArray = [
                            'name' => $_FILES['hinh_anh']['name'][$i],
                            'type' => $_FILES['hinh_anh']['type'][$i],
                            'tmp_name' => $_FILES['hinh_anh']['tmp_name'][$i],
                            'error' => $_FILES['hinh_anh']['error'][$i],
                            'size' => $_FILES['hinh_anh']['size'][$i]
                        ];
                        
                        $validation = validateImageFile($fileArray);
                        if (!$validation['valid']) {
                            // Nếu có lỗi ảnh, xóa phòng đã tạo và các ảnh đã upload
                            $phong->delete();
                            foreach ($uploadedImages as $uploadedFile) {
                                deleteFile($uploadedFile);
                            }
                            redirect('/admin/phong/create?error=' . urlencode($validation['error']));
                            return;
                        }

                        $fileName = saveFile($fileArray);
                        if ($fileName) {
                            $uploadedImages[] = $fileName;
                            
                            // Debug - Log before inserting image
                            error_log("Inserting image for room ID: " . $maPhong . ", filename: " . $fileName);
                            
                            // Lưu vào bảng hinh_anh
                            HinhAnh::create([
                                'ma_phong' => (int)$maPhong,
                                'anh' => $fileName
                            ]);
                        }
                    }
                }
            }

            redirect('/admin/phong?success=created');
        } catch (Exception $e) {
            // Nếu có lỗi, xóa phòng và các file đã upload
            if (isset($phong)) {
                $phong->delete();
            }
            if (isset($uploadedImages)) {
                foreach ($uploadedImages as $uploadedFile) {
                    deleteFile($uploadedFile);
                }
            }

            error_log("Error creating room: " . $e->getMessage());
            redirect('/admin/phong/create?error=' . urlencode('Có lỗi xảy ra khi tạo phòng: ' . $e->getMessage()));
        }
    }

    public function edit()
    {
        $id = get('id');
        if (!$id) {
            redirect('/admin/phong?error=missing_id');
        }

        $phong = Phong::find($id);
        if (!$phong) {
            redirect('/admin/phong?error=notfound');
        }

        $loaiPhongs = LoaiPhong::all();
        
        view('Admin.Phong.edit', [
            'phong' => $phong, 
            'loaiPhongs' => $loaiPhongs
        ]);
    }

    public function update()
    {
        $id = post('id') ?: get('id');
        if (!$id) {
            redirect('/admin/phong?error=missing_id');
        }

        $phong = Phong::find($id);
        if (!$phong) {
            redirect('/admin/phong?error=notfound');
        }

        $data = [
            'ten_phong' => post('ten_phong', $phong->ten_phong),
            'mo_ta' => post('mo_ta', $phong->mo_ta),
            'gia' => post('gia', $phong->gia),
            'ma_loai_phong' => post('ma_loai_phong', $phong->ma_loai_phong),
            'trang_thai' => post('trang_thai', $phong->trang_thai)
        ];

        $phong->update($data);
        redirect('/admin/phong?success=updated');
    }

    public function show()
    {
        $id = get('id');
        if (!$id) {
            redirect('/admin/phong?error=missing_id');
        }

        $phong = Phong::find($id);
        if (!$phong) {
            redirect('/admin/phong?error=notfound');
        }

        $loaiPhong = null;
        if ($phong->ma_loai_phong) {
            $loaiPhong = LoaiPhong::find($phong->ma_loai_phong);
        }

        // Get images using HinhAnh model directly
        $hinhAnhs = HinhAnh::getByPhong($phong->ma_phong);

        view('Admin.Phong.show', [
            'phong' => $phong, 
            'loaiPhong' => $loaiPhong,
            'hinhAnhs' => $hinhAnhs
        ]);
    }

    public function updateStatus()
    {
        $id = post('id') ?: get('id');
        if (!$id) {
            redirect('/admin/phong?error=missing_id');
        }

        $phong = Phong::find($id);
        if (!$phong) {
            redirect('/admin/phong?error=notfound');
        }

        $trangThai = post('trang_thai');
        if (empty($trangThai)) {
            redirect('/admin/phong?error=validation');
            return;
        }

        // Validate status
        $validStatuses = \HotelBooking\Enums\TrangThaiPhong::all();
        if (!in_array($trangThai, $validStatuses)) {
            redirect('/admin/phong?error=validation');
            return;
        }

        $phong->update(['trang_thai' => $trangThai]);
        redirect('/admin/phong?success=updated');
    }

    public function deactivate()
    {
        $id = post('id') ?: get('id');
        if (!$id) {
            redirect('/admin/phong?error=missing_id');
        }
        
        $phong = Phong::find($id);
        if (!$phong) {
            redirect('/admin/phong?error=notfound');
            return;
        }

        try {
            // Update room status to "Ngừng hoạt động" instead of deleting
            $phong->update(['trang_thai' => \HotelBooking\Enums\TrangThaiPhong::NGUNG_HOAT_DONG]);
            
            redirect('/admin/phong?success=deactivated');
        } catch (Exception $e) {
            error_log("Error deactivating room: " . $e->getMessage());
            redirect('/admin/phong?error=deactivate_failed');
        }
    }

    /**
     * Reactivate a room (set status back to available)
     */
    public function reactivate()
    {
        $id = post('id') ?: get('id');
        if (!$id) {
            redirect('/admin/phong?error=missing_id');
        }
        
        $phong = Phong::find($id);
        if (!$phong) {
            redirect('/admin/phong?error=notfound');
            return;
        }

        try {
            // Set room status back to "Còn trống"
            $phong->update(['trang_thai' => \HotelBooking\Enums\TrangThaiPhong::CON_TRONG]);
            
            redirect('/admin/phong?success=reactivated');
        } catch (Exception $e) {
            error_log("Error reactivating room: " . $e->getMessage());
            redirect('/admin/phong?error=reactivate_failed');
        }
    }
}



