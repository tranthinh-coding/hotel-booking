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
            $loaiPhongs = LoaiPhong::where('ten', 'LIKE', '%' . get('search', '') . '%')->get();

            // Xử lý đường dẫn ảnh
            foreach ($loaiPhongs as $loaiPhong) {
                $loaiPhong->hinh_anh = getFileUrl($loaiPhong->hinh_anh);
            }

            // Get statistics for room types using SQL queries
            $stats = [
                'total' => LoaiPhong::newQuery()->count(),
                'active' => LoaiPhong::where('trang_thai', 'hoat_dong')->count(),
                'inactive' => LoaiPhong::where('trang_thai', 'ngung_hoat_dong')->count(),
                'total_rooms' => Phong::newQuery()->count(),
                'empty_types' => 0
            ];

            // For empty_types, count room types with zero rooms
            // This is acceptable since room types are typically not many
            $allLoaiPhongs = LoaiPhong::all();
            foreach ($allLoaiPhongs as $loaiPhong) {
                $roomCount = Phong::where('ma_loai_phong', $loaiPhong->ma_loai_phong)->count();
                if ($roomCount === 0) {
                    $stats['empty_types']++;
                }
            }

            view('Admin.LoaiPhong.index', [
                'loaiPhongs' => $loaiPhongs, 
                'stats' => $stats
            ]);
        } catch (Exception $e) {
            // Default stats if error occurs
            $stats = [
                'total' => 0,
                'active' => 0,
                'inactive' => 0,
                'total_rooms' => 0,
                'empty_types' => 0
            ];
            view('Admin.LoaiPhong.index', [
                'loaiPhongs' => [],
                'stats' => $stats
            ]);
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
            'mo_ta' => post('mo_ta', ''),
            'trang_thai' => post('trang_thai', \HotelBooking\Enums\TrangThaiLoaiPhong::HOAT_DONG)
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
            'mo_ta' => post('mo_ta', $loaiPhong->mo_ta ?? ''),
            'trang_thai' => post('trang_thai', $loaiPhong->trang_thai ?? \HotelBooking\Enums\TrangThaiLoaiPhong::HOAT_DONG)
        ];

        $oldImage = $loaiPhong->hinh_anh; // Lưu tên ảnh cũ

        // Kiểm tra nếu người dùng muốn xóa ảnh hiện tại
        if (post('remove_current_image') === '1') {
            $data['hinh_anh'] = null;
            if (isNotEmpty($oldImage)) {
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
            if (isset($data['hinh_anh']) && isNotEmpty($oldImage) && $data['hinh_anh'] !== null) {
                deleteFile($oldImage);
            }

            redirect('/admin/loai-phong/show?id=' . $id . '&success=updated');
        } catch (Exception $e) {
            // Nếu có lỗi khi update record, xóa file mới đã upload
            if (isset($data['hinh_anh']) && $data['hinh_anh'] !== null) {
                deleteFile($data['hinh_anh']);
            }

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
        if (isNotEmpty($phongs)) {
            redirect('/admin/loai-phong?error=hasrooms');
            return;
        }

        try {
            // Lưu tên ảnh để xóa sau khi xóa record thành công
            $imageName = $loaiPhong->hinh_anh;

            // Xóa record
            $loaiPhong->delete();

            // Xóa ảnh nếu có
            if (isNotEmpty($imageName)) {
                deleteFile($imageName);
            }

            redirect('/admin/loai-phong?success=deleted');
        } catch (Exception $e) {
            redirect('/admin/loai-phong?error=deletefailed');
        }
    }

    public function show()
    {
        $id = get('id');
        if (!$id) {
            redirect('/admin/loai-phong?error=notfound');
        }

        $loaiPhong = LoaiPhong::find($id);
        if (!$loaiPhong) {
            redirect('/admin/loai-phong?error=notfound');
        }

        // Xử lý đường dẫn ảnh
        $loaiPhong->hinh_anh = getFileUrl($loaiPhong->hinh_anh);

        // Get paginated rooms
        $page = (int)(get('page') ?: 1);
        $rooms = $loaiPhong->getPhongsPaginated($page, 25);
        $totalRooms = $loaiPhong->countPhongs();

        // Get statistics for this room type using SQL queries
        $stats = [
            'total' => Phong::where('ma_loai_phong', $id)->count(),
            'available' => Phong::where('ma_loai_phong', $id)->where('trang_thai', \HotelBooking\Enums\TrangThaiPhong::DANG_HOAT_DONG)->count(),
            'cleaning' => Phong::where('ma_loai_phong', $id)->where('trang_thai', \HotelBooking\Enums\TrangThaiPhong::DANG_DON_DEP)->count(),
            'maintenance' => Phong::where('ma_loai_phong', $id)->where('trang_thai', \HotelBooking\Enums\TrangThaiPhong::BAO_TRI)->count(),
            'deactivated' => Phong::where('ma_loai_phong', $id)->where('trang_thai', \HotelBooking\Enums\TrangThaiPhong::NGUNG_HOAT_DONG)->count()
        ];

        // Get available rooms for adding (all rooms) with room type names
        $availableRooms = Phong::all();
        
        // Get all room types in one query to avoid N+1 problem
        $allRoomTypes = [];
        $roomTypeData = LoaiPhong::all();
        foreach ($roomTypeData as $roomType) {
            $allRoomTypes[$roomType->ma_loai_phong] = $roomType->ten;
        }
        
        // Assign room type names using the lookup array
        foreach ($availableRooms as $room) {
            $room->loaiPhongName = $room->ma_loai_phong ? ($allRoomTypes[$room->ma_loai_phong] ?? null) : null;
        }

        view('Admin.LoaiPhong.show', [
            'loaiPhong' => $loaiPhong,
            'rooms' => $rooms,
            'totalRooms' => $totalRooms,
            'availableRooms' => $availableRooms,
            'stats' => $stats
        ]);
    }

    public function deactivate()
    {
        $id = post('id');
        if (!$id) {
            redirect('/admin/loai-phong?error=notfound');
        }

        $loaiPhong = LoaiPhong::find($id);
        if (!$loaiPhong) {
            redirect('/admin/loai-phong?error=notfound');
        }

        // Update status to deactivated
        $data = ['trang_thai' => \HotelBooking\Enums\TrangThaiLoaiPhong::NGUNG_HOAT_DONG];
        if ($loaiPhong->update($data)) {
            redirect('/admin/loai-phong?success=deactivated');
        } else {
            redirect('/admin/loai-phong?error=deactivate_failed');
        }
    }

    public function reactivate()
    {
        $id = post('id');
        if (!$id) {
            redirect('/admin/loai-phong?error=notfound');
        }

        $loaiPhong = LoaiPhong::find($id);
        if (!$loaiPhong) {
            redirect('/admin/loai-phong?error=notfound');
        }

        // Update status to active
        $data = ['trang_thai' => \HotelBooking\Enums\TrangThaiLoaiPhong::HOAT_DONG];
        if ($loaiPhong->update($data)) {
            redirect('/admin/loai-phong?success=reactivated');
        } else {
            redirect('/admin/loai-phong?error=reactivate_failed');
        }
    }

    public function addRoom()
    {
        $loaiPhongId = post('loai_phong_id');
        $phongId = post('phong_id');

        if (!$loaiPhongId || !$phongId) {
            redirect('/admin/loai-phong?error=missing_data');
        }

        $loaiPhong = LoaiPhong::find($loaiPhongId);
        $phong = Phong::find($phongId);

        if (!$loaiPhong || !$phong) {
            redirect('/admin/loai-phong/show?id=' . $loaiPhongId . '&error=room_not_found');
        }

        // Update room's room type
        $data = ['ma_loai_phong' => $loaiPhongId];
        if ($phong->update($data)) {
            redirect('/admin/loai-phong/show?id=' . $loaiPhongId . '&success=room_added');
        } else {
            redirect('/admin/loai-phong/show?id=' . $loaiPhongId . '&error=operation_failed');
        }
    }

    public function removeRoom()
    {
        $loaiPhongId = post('loai_phong_id');
        $phongId = post('phong_id');

        if (!$loaiPhongId || !$phongId) {
            redirect('/admin/loai-phong?error=missing_data');
        }

        $phong = Phong::find($phongId);
        if (!$phong) {
            redirect('/admin/loai-phong/show?id=' . $loaiPhongId . '&error=room_not_found');
        }

        // Remove room from room type (set to null)
        $data = ['ma_loai_phong' => null];
        if ($phong->update($data)) {
            redirect('/admin/loai-phong/show?id=' . $loaiPhongId . '&success=room_removed');
        } else {
            redirect('/admin/loai-phong/show?id=' . $loaiPhongId . '&error=operation_failed');
        }
    }
}



