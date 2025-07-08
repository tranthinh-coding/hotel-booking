<?php

namespace HotelBooking\Controllers;

use HotelBooking\Models\HinhAnh;
use HotelBooking\Models\Phong;

class HinhAnhController
{
    public function index()
    {
        $hinhAnhs = HinhAnh::all();
        view('HinhAnh.index', ['hinhAnhs' => $hinhAnhs]);
    }

    public function create()
    {
        $phongs = Phong::all();
        view('HinhAnh.create', ['phongs' => $phongs]);
    }

    public function store()
    {
        $uploadDir = 'uploads/images/';
        $fileName = '';
        
        // Handle file upload
        if (isset($_FILES['anh']) && $_FILES['anh']['error'] === UPLOAD_ERR_OK) {
            $fileName = time() . '_' . $_FILES['anh']['name'];
            $uploadPath = $uploadDir . $fileName;
            
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            move_uploaded_file($_FILES['anh']['tmp_name'], $uploadPath);
        }

        $data = [
            'anh' => $fileName,
            'ma_phong' => post('ma_phong')
        ];

        $hinhAnh = new HinhAnh();
        $hinhAnh->create($data);

        flash_set('success', 'Thêm hình ảnh thành công');
        redirect('/hinh-anh');
    }

    public function show($id)
    {
        $hinhAnh = HinhAnh::find($id);
        if (!$hinhAnh) {
            http_response_code(404);
            echo "Hình ảnh không tồn tại";
            return;
        }
        view('HinhAnh.show', ['hinhAnh' => $hinhAnh]);
    }

    public function edit($id)
    {
        $hinhAnh = HinhAnh::find($id);
        if (!$hinhAnh) {
            http_response_code(404);
            echo "Hình ảnh không tồn tại";
            return;
        }
        $phongs = Phong::all();
        view('HinhAnh.edit', ['hinhAnh' => $hinhAnh, 'phongs' => $phongs]);
    }

    public function update($id)
    {
        $hinhAnh = HinhAnh::find($id);
        if (!$hinhAnh) {
            http_response_code(404);
            echo "Hình ảnh không tồn tại";
            return;
        }

        $data = [
            'ma_phong' => post('ma_phong')
        ];

        // Handle new file upload
        if (isset($_FILES['anh']) && $_FILES['anh']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/images/';
            $fileName = time() . '_' . $_FILES['anh']['name'];
            $uploadPath = $uploadDir . $fileName;
            
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            move_uploaded_file($_FILES['anh']['tmp_name'], $uploadPath);
            $data['anh'] = $fileName;
        }

        $hinhAnh->update($data);

        flash_set('success', 'Cập nhật hình ảnh thành công');
        redirect('/hinh-anh');
    }

    public function destroy($id)
    {
        $hinhAnh = HinhAnh::find($id);
        if ($hinhAnh) {
            // Delete file if exists
            $filePath = 'uploads/images/' . $hinhAnh->anh;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $hinhAnh->delete();
            flash_set('success', 'Xóa hình ảnh thành công');
        }

        redirect('/hinh-anh');
    }
}
