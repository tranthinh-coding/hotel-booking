<?php
namespace HotelBooking\Controllers\Client;

use Exception;

class ContactController
{
    /**
     * Hiển thị trang liên hệ
     */
    public function show()
    {
        $user = user();
        view('Client.Home.contact', [
            'user' => $user
        ]);
    }

    /**
     * Xử lý submit form liên hệ
     */
    public function submit()
    {
        $hoTen = post('ho_ten');
        $email = post('email');
        $soDienThoai = post('so_dien_thoai');
        $chuDe = post('chu_de');
        $noiDung = post('noi_dung');
        $dongY = post('dong_y_xu_ly');

        // Validate
        $errors = [];
        if (isEmpty($hoTen)) $errors[] = 'Vui lòng nhập họ tên.';
        if (isEmpty($email)) $errors[] = 'Vui lòng nhập email.';
        if (isEmpty($chuDe)) $errors[] = 'Vui lòng chọn chủ đề.';
        if (isEmpty($noiDung)) $errors[] = 'Vui lòng nhập nội dung.';
        if (isEmpty($dongY)) $errors[] = 'Bạn cần đồng ý với chính sách.';

        if (!isEmpty($errors)) {
            set_old_input();
            flash_error(implode('<br>', $errors));
            back();
            return;
        }

        // Lưu thông tin liên hệ vào DB
        $lienHe = new \HotelBooking\Models\LienHe();
        $lienHe->ho_ten = $hoTen;
        $lienHe->email = $email;
        $lienHe->so_dien_thoai = $soDienThoai;
        $lienHe->chu_de = $chuDe;
        $lienHe->noi_dung = $noiDung;
        $lienHe->trang_thai = \HotelBooking\Models\LienHe::TRANG_THAI_MOI;
        $lienHe->ngay_gui = date('Y-m-d H:i:s');

        if ($lienHe->save()) {
            flash_success('Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.');
        } else {
            flash_error('Có lỗi xảy ra, vui lòng thử lại sau.');
        }
        redirect('/contact');
    }
}
