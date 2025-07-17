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
        if (empty($hoTen)) $errors[] = 'Vui lòng nhập họ tên.';
        if (empty($email)) $errors[] = 'Vui lòng nhập email.';
        if (empty($chuDe)) $errors[] = 'Vui lòng chọn chủ đề.';
        if (empty($noiDung)) $errors[] = 'Vui lòng nhập nội dung.';
        if (empty($dongY)) $errors[] = 'Bạn cần đồng ý với chính sách.';

        if (!empty($errors)) {
            set_old_input();
            flash_error(implode('<br>', $errors));
            back();
            return;
        }

        // Xử lý lưu thông tin liên hệ (ví dụ: lưu vào DB hoặc gửi email)
        // ...
        // Ví dụ: chỉ hiển thị thông báo thành công
        flash_success('Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.');
        redirect('/contact');
    }
}
