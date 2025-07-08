<?php

namespace HotelBooking\Controllers;

use HotelBooking\Models\TaiKhoan;

class AuthController
{
    public function showLoginForm()
    {
        if (auth_check()) {
            redirect('/dashboard');
            return;
        }
        
        view('Auth.login');
    }

    public function login()
    {
        $email = post('email');
        $password = post('password');

        if (!$email || !$password) {
            flash_set('error', 'Vui lòng nhập đầy đủ email và mật khẩu');
            set_old_input();
            back();
            return;
        }

        // Find user by email
        $users = TaiKhoan::all();
        $user = null;
        foreach ($users as $u) {
            if ($u->mail === $email) {
                $user = $u;
                break;
            }
        }

        if (!$user || !password_verify($password, $user->mat_khau)) {
            flash_set('error', 'Email hoặc mật khẩu không đúng');
            set_old_input();
            back();
            return;
        }

        auth_login($user);
        clear_old_input();
        flash_set('success', 'Đăng nhập thành công');
        
        // Redirect based on role
        if ($user->phan_quyen === 'admin' || $user->phan_quyen === 'nhan_vien') {
            redirect('/admin/dashboard');
        } else {
            redirect('/dashboard');
        }
    }

    public function showRegisterForm()
    {
        if (auth_check()) {
            redirect('/dashboard');
            return;
        }
        
        view('Auth.register');
    }

    public function register()
    {
        $data = [
            'ho_ten' => post('ho_ten'),
            'so_cccd' => post('so_cccd'),
            'sdt' => post('sdt'),
            'mail' => post('mail'),
            'mat_khau' => post('mat_khau'),
            'confirm_password' => post('confirm_password')
        ];

        // Validation
        $errors = [];

        if (empty($data['ho_ten'])) {
            $errors[] = 'Họ tên không được để trống';
        }

        if (empty($data['so_cccd'])) {
            $errors[] = 'Số CCCD không được để trống';
        }

        if (empty($data['sdt'])) {
            $errors[] = 'Số điện thoại không được để trống';
        }

        if (empty($data['mail'])) {
            $errors[] = 'Email không được để trống';
        } elseif (!filter_var($data['mail'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email không hợp lệ';
        }

        if (empty($data['mat_khau'])) {
            $errors[] = 'Mật khẩu không được để trống';
        } elseif (strlen($data['mat_khau']) < 6) {
            $errors[] = 'Mật khẩu phải có ít nhất 6 ký tự';
        }

        if ($data['mat_khau'] !== $data['confirm_password']) {
            $errors[] = 'Xác nhận mật khẩu không khớp';
        }

        // Check if email already exists
        $users = TaiKhoan::all();
        foreach ($users as $user) {
            if ($user->mail === $data['mail']) {
                $errors[] = 'Email này đã được sử dụng';
                break;
            }
        }

        if (!empty($errors)) {
            flash_set('error', implode('<br>', $errors));
            set_old_input();
            back();
            return;
        }

        // Create new user
        $userData = [
            'ho_ten' => $data['ho_ten'],
            'so_cccd' => $data['so_cccd'],
            'sdt' => $data['sdt'],
            'mail' => $data['mail'],
            'mat_khau' => password_hash($data['mat_khau'], PASSWORD_DEFAULT),
            'phan_quyen' => 'khach_hang' // Default role
        ];

        $taiKhoan = new TaiKhoan();
        $taiKhoan->create($userData);

        clear_old_input();
        flash_set('success', 'Đăng ký thành công! Vui lòng đăng nhập');
        redirect('/login');
    }

    public function logout()
    {
        auth_logout();
        flash_set('success', 'Đăng xuất thành công');
        redirect('/');
    }

    public function showChangePasswordForm()
    {
        if (auth_guest()) {
            flash_set('error', 'Vui lòng đăng nhập để tiếp tục');
            redirect('/login');
            return;
        }

        view('Auth.change-password');
    }

    public function changePassword()
    {
        if (auth_guest()) {
            flash_set('error', 'Vui lòng đăng nhập để tiếp tục');
            redirect('/login');
            return;
        }

        $currentPassword = post('current_password');
        $newPassword = post('new_password');
        $confirmPassword = post('confirm_password');

        $user = user();

        // Validation
        $errors = [];

        if (empty($currentPassword)) {
            $errors[] = 'Vui lòng nhập mật khẩu hiện tại';
        } elseif (!password_verify($currentPassword, $user->mat_khau)) {
            $errors[] = 'Mật khẩu hiện tại không đúng';
        }

        if (empty($newPassword)) {
            $errors[] = 'Vui lòng nhập mật khẩu mới';
        } elseif (strlen($newPassword) < 6) {
            $errors[] = 'Mật khẩu mới phải có ít nhất 6 ký tự';
        }

        if ($newPassword !== $confirmPassword) {
            $errors[] = 'Xác nhận mật khẩu mới không khớp';
        }

        if (!empty($errors)) {
            flash_set('error', implode('<br>', $errors));
            back();
            return;
        }

        // Update password
        $user->update(['mat_khau' => password_hash($newPassword, PASSWORD_DEFAULT)]);

        flash_set('success', 'Đổi mật khẩu thành công');
        redirect('/profile');
    }

    public function showForgotPasswordForm()
    {
        if (auth_check()) {
            redirect('/dashboard');
            return;
        }

        view('Auth.forgot-password');
    }

    public function forgotPassword()
    {
        $email = post('email');

        if (empty($email)) {
            flash_set('error', 'Vui lòng nhập email');
            back();
            return;
        }

        // Find user by email
        $users = TaiKhoan::all();
        $user = null;
        foreach ($users as $u) {
            if ($u->mail === $email) {
                $user = $u;
                break;
            }
        }

        if (!$user) {
            flash_set('error', 'Email không tồn tại trong hệ thống');
            back();
            return;
        }

        // Generate reset token
        $resetToken = bin2hex(random_bytes(32));
        $resetExpiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Store reset token in session (in real app, you'd store in database)
        session_set("reset_token_{$resetToken}", [
            'user_id' => $user->ma_tai_khoan,
            'expires_at' => $resetExpiry
        ]);

        // In a real application, you would send email here
        // For now, we'll just show the reset link
        flash_set('success', "Link reset mật khẩu: <a href='/reset-password?token={$resetToken}'>Click để reset</a>");
        back();
    }

    public function showResetPasswordForm()
    {
        $token = get('token');

        if (!$token) {
            flash_set('error', 'Token không hợp lệ');
            redirect('/forgot-password');
            return;
        }

        $resetData = session_get("reset_token_{$token}");
        if (!$resetData || strtotime($resetData['expires_at']) < time()) {
            flash_set('error', 'Token đã hết hạn hoặc không hợp lệ');
            redirect('/forgot-password');
            return;
        }

        view('Auth.reset-password', ['token' => $token]);
    }

    public function resetPassword()
    {
        $token = post('token');
        $newPassword = post('new_password');
        $confirmPassword = post('confirm_password');

        if (!$token) {
            flash_set('error', 'Token không hợp lệ');
            redirect('/forgot-password');
            return;
        }

        $resetData = session_get("reset_token_{$token}");
        if (!$resetData || strtotime($resetData['expires_at']) < time()) {
            flash_set('error', 'Token đã hết hạn hoặc không hợp lệ');
            redirect('/forgot-password');
            return;
        }

        // Validation
        $errors = [];

        if (empty($newPassword)) {
            $errors[] = 'Vui lòng nhập mật khẩu mới';
        } elseif (strlen($newPassword) < 6) {
            $errors[] = 'Mật khẩu mới phải có ít nhất 6 ký tự';
        }

        if ($newPassword !== $confirmPassword) {
            $errors[] = 'Xác nhận mật khẩu không khớp';
        }

        if (!empty($errors)) {
            flash_set('error', implode('<br>', $errors));
            back();
            return;
        }

        // Update password
        $user = TaiKhoan::find($resetData['user_id']);
        if ($user) {
            $user->update(['mat_khau' => password_hash($newPassword, PASSWORD_DEFAULT)]);
            
            // Remove reset token
            session_remove("reset_token_{$token}");
            
            flash_set('success', 'Đặt lại mật khẩu thành công! Vui lòng đăng nhập');
            redirect('/login');
        } else {
            flash_set('error', 'Có lỗi xảy ra, vui lòng thử lại');
            redirect('/forgot-password');
        }
    }

    public function profile()
    {
        if (auth_guest()) {
            flash_set('error', 'Vui lòng đăng nhập để tiếp tục');
            redirect('/login');
            return;
        }

        $user = user();
        view('Auth.profile', ['user' => $user]);
    }

    public function updateProfile()
    {
        if (auth_guest()) {
            flash_set('error', 'Vui lòng đăng nhập để tiếp tục');
            redirect('/login');
            return;
        }

        $user = user();
        $data = [
            'ho_ten' => post('ho_ten'),
            'so_cccd' => post('so_cccd'),
            'sdt' => post('sdt')
        ];

        // Validation
        $errors = [];

        if (empty($data['ho_ten'])) {
            $errors[] = 'Họ tên không được để trống';
        }

        if (empty($data['so_cccd'])) {
            $errors[] = 'Số CCCD không được để trống';
        }

        if (empty($data['sdt'])) {
            $errors[] = 'Số điện thoại không được để trống';
        }

        if (!empty($errors)) {
            flash_set('error', implode('<br>', $errors));
            set_old_input();
            back();
            return;
        }

        $user->update($data);
        clear_old_input();
        flash_set('success', 'Cập nhật thông tin thành công');
        redirect('/profile');
    }
}
