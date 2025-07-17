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
        
        // Use optimized search with JOIN query
        $phongs = Phong::searchWithRoomType($search, $loaiPhong, $trangThai, $sort);
        
        // Get room statistics using optimized query
        $statsData = Phong::getRoomStatistics();
        
        // Format statistics data
        $stats = [
            'total' => 0,
            'available' => 0,
            'cleaning' => 0,
            'maintenance' => 0,
            'deactivated' => 0
        ];
        
        foreach ($statsData as $stat) {
            $stats['total'] += $stat['so_luong'];
            switch ($stat['trang_thai']) {
                case \HotelBooking\Enums\TrangThaiPhong::CON_TRONG:
                    $stats['available'] = $stat['so_luong'];
                    break;
                case \HotelBooking\Enums\TrangThaiPhong::DANG_DON_DEP:
                    $stats['cleaning'] = $stat['so_luong'];
                    break;
                case \HotelBooking\Enums\TrangThaiPhong::BAO_TRI:
                    $stats['maintenance'] = $stat['so_luong'];
                    break;
                case \HotelBooking\Enums\TrangThaiPhong::NGUNG_HOAT_DONG:
                    $stats['deactivated'] = $stat['so_luong'];
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
        
        if (isEmpty($tenPhong)) {
            $errors[] = 'Tên phòng không được để trống';
        }
        
        if (isEmpty($maLoaiPhong)) {
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
        
        if (isNotEmpty($errors)) {
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
            $phongId = Phong::createAndReturnId($data);
            $maPhong = $phongId;

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
                            $phong = Phong::find($phongId);
                            if ($phong) {
                                $phong->delete();
                            }
                            foreach ($uploadedImages as $uploadedFile) {
                                deleteFile($uploadedFile);
                            }
                            redirect('/admin/phong/create?error=' . urlencode($validation['error']));
                            return;
                        }

                        $fileName = saveFile($fileArray);
                        if ($fileName) {
                            $uploadedImages[] = $fileName;
                            
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
            'loaiPhongs' => $loaiPhongs ?: []
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
        redirect('/admin/phong/show?id=' . $id . '&success=updated');
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
        if (isEmpty($trangThai)) {
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
            redirect('/admin/phong?error=reactivate_failed');
        }
    }

    /**
     * Add images to room (support multiple files)
     */
    public function addImage()
    {
        try {
            $maPhong = post('ma_phong');
            
            if (!$maPhong) {
                redirect('/admin/phong?error=missing_id');
                return;
            }

            // Check if room exists
            $phong = Phong::find($maPhong);
            if (!$phong) {
                redirect('/admin/phong?error=notfound');
                return;
            }

            // Handle multiple file upload
            if (isset($_FILES['images']) && is_array($_FILES['images']['name'])) {
                $uploadedCount = 0;
                $errors = [];
                
                $fileCount = count($_FILES['images']['name']);
                
                for ($i = 0; $i < $fileCount; $i++) {
                    if ($_FILES['images']['size'][$i] > 0) {
                        // Create file array for each image
                        $fileArray = [
                            'name' => $_FILES['images']['name'][$i],
                            'type' => $_FILES['images']['type'][$i],
                            'tmp_name' => $_FILES['images']['tmp_name'][$i],
                            'error' => $_FILES['images']['error'][$i],
                            'size' => $_FILES['images']['size'][$i]
                        ];
                        
                        $validation = validateImageFile($fileArray);
                        if (!$validation['valid']) {
                            $errors[] = $validation['error'] . " (File: " . $fileArray['name'] . ")";
                            continue;
                        }

                        $fileName = saveFile($fileArray);
                        if ($fileName) {
                            // Create image record
                            HinhAnh::create([
                                'ma_phong' => $maPhong,
                                'anh' => $fileName
                            ]);
                            $uploadedCount++;
                        }
                    }
                }
                
                if ($uploadedCount > 0) {
                    $message = "Đã thêm {$uploadedCount} hình ảnh thành công";
                    if (isNotEmpty($errors)) {
                        $message .= ". Một số file có lỗi: " . implode(', ', array_slice($errors, 0, 3));
                    }
                    redirect("/admin/phong/show?id={$maPhong}&success=images_added&message=" . urlencode($message));
                } else {
                    $errorMessage = isNotEmpty($errors) ? implode(', ', $errors) : 'Không thể upload ảnh nào';
                    redirect("/admin/phong/show?id={$maPhong}&error=upload_failed&message=" . urlencode($errorMessage));
                }
            }
            // Handle single file upload (backward compatibility)
            else if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Validate and save file
                $fileName = saveFile($_FILES['image']);
                if (!$fileName) {
                    redirect("/admin/phong/show?id={$maPhong}&error=invalid_file");
                    return;
                }

                // Create image record
                HinhAnh::create([
                    'ma_phong' => $maPhong,
                    'anh' => $fileName
                ]);

                redirect("/admin/phong/show?id={$maPhong}&success=image_added");
            }
            else {
                redirect("/admin/phong/show?id={$maPhong}&error=upload_failed");
            }

        } catch (Exception $e) {
            $maPhong = post('ma_phong');
            redirect("/admin/phong/show?id={$maPhong}&error=add_image_failed");
        }
    }

    /**
     * Delete room image
     */
    public function deleteImage()
    {
        try {
            $imageId = post('image_id');
            $maPhong = post('ma_phong');
            
            if (!$imageId) {
                redirect("/admin/phong/show?id={$maPhong}&error=missing_image_id");
                return;
            }

            // Find the image
            /** @var HinhAnh $image */
            $image = HinhAnh::find($imageId);
            if (!$image) {
                redirect("/admin/phong/show?id={$maPhong}&error=image_not_found");
                return;
            }

            // Delete the image file and record
            $image->deleteWithFile();

            redirect("/admin/phong/show?id={$maPhong}&success=image_deleted");
        } catch (Exception $e) {
            $maPhong = post('ma_phong');
            redirect("/admin/phong/show?id={$maPhong}&error=delete_image_failed");
        }
    }
}



