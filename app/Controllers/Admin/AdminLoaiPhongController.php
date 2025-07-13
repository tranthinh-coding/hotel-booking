<?php

namespace HotelBooking\Controllers\Admin;

use HotelBooking\Models\LoaiPhong;
use HotelBooking\Models\TaiKhoan;
use HotelBooking\Models\Phong;
use HotelBooking\Enums\PhanQuyen;
use HotelBooking\Facades\DB;
use Exception;

class AdminLoaiPhongController
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
        try {
            // Lấy model instances trực tiếp (không cần chuyển đổi)
            $loaiPhongs = LoaiPhong::where('ten', 'LIKE', '%' . get('search', '') . '%')
                ->get();

            // Xử lý đường dẫn ảnh
            foreach ($loaiPhongs as $loaiPhong) {
                $loaiPhong->hinh_anh = getFileUrl($loaiPhong->hinh_anh);
            }
            view('Admin.LoaiPhong.index', ['loaiPhongs' => $loaiPhongs]);
        } catch (Exception $e) {
            dd($e->getMessage()); // Debugging line, remove in production
            error_log("Error in AdminLoaiPhongController::index: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            view('Admin.LoaiPhong.index', ['loaiPhongs' => []]);
        }
    }

    public function create()
    {
        view('Admin.LoaiPhong.create');
    }

    public function store()
    {
        $data = [
            'ten' => post('ten', ''),
            'mo_ta' => post('mo_ta', '')
        ];

        // Xử lý upload ảnh
        if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['size'] > 0) {
            $validation = validateImageFile($_FILES['hinh_anh']);

            if (!$validation['valid']) {
                redirect('/admin/loai-phong/create?error=' . urlencode($validation['error']));
                return;
            }

            $fileName = saveFile($_FILES['hinh_anh']);
            if ($fileName) {
                $data['hinh_anh'] = $fileName;
            } else {
                redirect('/admin/loai-phong/create?error=' . urlencode('Không thể lưu file ảnh'));
                return;
            }
        }

        try {
            LoaiPhong::create($data);
            redirect('/admin/loai-phong?success=created');
        } catch (Exception $e) {
            // Nếu có lỗi khi tạo record, xóa file đã upload
            if (isset($data['hinh_anh'])) {
                deleteFile($data['hinh_anh']);
            }

            error_log("Error creating room type: " . $e->getMessage());
            redirect('/admin/loai-phong/create?error=' . urlencode('Có lỗi xảy ra khi tạo loại phòng'));
        }
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            redirect('/admin/loai-phong?error=notfound');
            return;
        }

        $loaiPhong = LoaiPhong::find($id);

        if (!$loaiPhong) {
            redirect('/admin/loai-phong?error=notfound');
        }

        view('Admin.LoaiPhong.edit', ['loaiPhong' => $loaiPhong]);
    }

    public function update()
    {
        $id = post('id');
        if (!$id) {
            redirect('/admin/loai-phong?error=notfound');
            return;
        }

        $loaiPhong = LoaiPhong::find($id);
        if (!$loaiPhong) {
            redirect('/admin/loai-phong?error=notfound');
            return;
        }

        $data = [
            'ten' => post('ten', $loaiPhong->ten),
            'mo_ta' => post('mo_ta', $loaiPhong->mo_ta ?? '')
        ];

        $oldImage = $loaiPhong->hinh_anh; // Lưu tên ảnh cũ

        // Kiểm tra nếu người dùng muốn xóa ảnh hiện tại
        if (post('remove_current_image') === '1') {
            $data['hinh_anh'] = null;
            if (!empty($oldImage)) {
                deleteFile($oldImage);
            }
            $oldImage = null; // Đặt về null để không xóa lại
        }

        // Xử lý upload ảnh mới
        if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['size'] > 0) {
            $validation = validateImageFile($_FILES['hinh_anh']);

            if (!$validation['valid']) {
                redirect('/admin/loai-phong/edit?id=' . $id . '&error=' . urlencode($validation['error']));
                return;
            }

            $fileName = saveFile($_FILES['hinh_anh']);
            if ($fileName) {
                $data['hinh_anh'] = $fileName;
            } else {
                redirect('/admin/loai-phong/edit?id=' . $id . '&error=' . urlencode('Không thể lưu file ảnh'));
                return;
            }
        }

        try {
            $loaiPhong->update($data);

            // Nếu có ảnh mới và ảnh cũ tồn tại, xóa ảnh cũ
            if (isset($data['hinh_anh']) && !empty($oldImage) && $data['hinh_anh'] !== null) {
                deleteFile($oldImage);
            }

            redirect('/admin/loai-phong?success=updated');
        } catch (Exception $e) {
            // Nếu có lỗi khi update record, xóa file mới đã upload
            if (isset($data['hinh_anh']) && $data['hinh_anh'] !== null) {
                deleteFile($data['hinh_anh']);
            }

            error_log("Error updating room type: " . $e->getMessage());
            redirect('/admin/loai-phong/edit?id=' . $id . '&error=' . urlencode('Có lỗi xảy ra khi cập nhật loại phòng'));
        }
    }

    public function destroy()
    {
        $id = post('id');
        if (!$id) {
            redirect('/admin/loai-phong?error=notfound');
            return;
        }

        $loaiPhong = LoaiPhong::find($id);
        if (!$loaiPhong) {
            redirect('/admin/loai-phong?error=notfound');
            return;
        }

        // Kiểm tra xem có phòng nào đang sử dụng loại phòng này không
        $phongs = Phong::where('ma_loai_phong', $id)->get();
        if (!empty($phongs)) {
            redirect('/admin/loai-phong?error=hasrooms');
            return;
        }

        try {
            // Lưu tên ảnh để xóa sau khi xóa record thành công
            $imageName = $loaiPhong->hinh_anh;

            // Xóa record
            $loaiPhong->delete();

            // Xóa ảnh nếu có
            if (!empty($imageName)) {
                deleteFile($imageName);
            }

            redirect('/admin/loai-phong?success=deleted');
        } catch (Exception $e) {
            error_log("Error deleting room type: " . $e->getMessage());
            redirect('/admin/loai-phong?error=deletefailed');
        }
    }
}



