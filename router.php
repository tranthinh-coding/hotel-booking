<?php

use HotelBooking\Controllers\Admin\AdminController;
use HotelBooking\Facades\Route;
use HotelBooking\Controllers\HomeController;
use HotelBooking\Controllers\TaiKhoanController;
use HotelBooking\Controllers\PhongController;
use HotelBooking\Controllers\DichVuController;
use HotelBooking\Controllers\DanhGiaController;
use HotelBooking\Controllers\DanhMucController;
use HotelBooking\Controllers\HoaDonController;
use HotelBooking\Controllers\TinTucController;
use HotelBooking\Controllers\HinhAnhController;
use HotelBooking\Controllers\DanhMucPhongController;
use HotelBooking\Controllers\HoaDonPhongController;
use HotelBooking\Controllers\AuthController;

// ===== ROUTES CHÍNH =====

// Trang chủ
Route::get('/', 'HotelBooking\Controllers\HomeController', 'index');
Route::get('/home', 'HotelBooking\Controllers\HomeController', 'index');

// ===== AUTHENTICATION ROUTES =====

// Đăng nhập & Đăng ký
Route::get('/login', 'HotelBooking\Controllers\AuthController', 'showLoginForm');
Route::post('/login', 'HotelBooking\Controllers\AuthController', 'login');
Route::get('/register', 'HotelBooking\Controllers\AuthController', 'showRegisterForm');
Route::post('/register', 'HotelBooking\Controllers\AuthController', 'register');
Route::post('/logout', 'HotelBooking\Controllers\AuthController', 'logout');

// Profile & Đổi mật khẩu
Route::get('/profile', 'HotelBooking\Controllers\AuthController', 'profile');
Route::post('/profile', 'HotelBooking\Controllers\AuthController', 'updateProfile');
Route::get('/change-password', 'HotelBooking\Controllers\AuthController', 'showChangePasswordForm');
Route::post('/change-password', 'HotelBooking\Controllers\AuthController', 'changePassword');

// Quên mật khẩu & Đặt lại mật khẩu
Route::get('/forgot-password', 'HotelBooking\Controllers\AuthController', 'showForgotPassword');
Route::post('/forgot-password', 'HotelBooking\Controllers\AuthController', 'forgotPassword');
Route::get('/reset-password', 'HotelBooking\Controllers\AuthController', 'showResetPassword');
Route::post('/reset-password', 'HotelBooking\Controllers\AuthController', 'resetPassword');

// ===== PHÒNG ROUTES =====

Route::get('/phong', 'HotelBooking\Controllers\PhongController', 'index');
Route::get('/phong/create', 'HotelBooking\Controllers\PhongController', 'create');
Route::post('/phong', 'HotelBooking\Controllers\PhongController', 'store');
Route::get('/phong/{id}', 'HotelBooking\Controllers\PhongController', 'show');
Route::get('/phong/{id}/edit', 'HotelBooking\Controllers\PhongController', 'edit');
Route::put('/phong/{id}', 'HotelBooking\Controllers\PhongController', 'update');
Route::delete('/phong/{id}', 'HotelBooking\Controllers\PhongController', 'destroy');

// ===== DỊCH VỤ ROUTES =====

Route::get('/dich-vu', 'HotelBooking\Controllers\DichVuController', 'index');
Route::get('/dich-vu/create', 'HotelBooking\Controllers\DichVuController', 'create');
Route::post('/dich-vu', 'HotelBooking\Controllers\DichVuController', 'store');
Route::get('/dich-vu/{id}', 'HotelBooking\Controllers\DichVuController', 'show');
Route::get('/dich-vu/{id}/edit', 'HotelBooking\Controllers\DichVuController', 'edit');
Route::put('/dich-vu/{id}', 'HotelBooking\Controllers\DichVuController', 'update');
Route::delete('/dich-vu/{id}', 'HotelBooking\Controllers\DichVuController', 'destroy');

// ===== ĐÁNH GIÁ ROUTES =====

Route::get('/danh-gia', 'HotelBooking\Controllers\DanhGiaController', 'index');
Route::get('/danh-gia/create', 'HotelBooking\Controllers\DanhGiaController', 'create');
Route::post('/danh-gia', 'HotelBooking\Controllers\DanhGiaController', 'store');
Route::get('/danh-gia/{id}', 'HotelBooking\Controllers\DanhGiaController', 'show');
Route::get('/danh-gia/{id}/edit', 'HotelBooking\Controllers\DanhGiaController', 'edit');
Route::put('/danh-gia/{id}', 'HotelBooking\Controllers\DanhGiaController', 'update');
Route::delete('/danh-gia/{id}', 'HotelBooking\Controllers\DanhGiaController', 'destroy');

// ===== TÀI KHOẢN ROUTES =====

Route::get('/tai-khoan', 'HotelBooking\Controllers\TaiKhoanController', 'index');
Route::get('/tai-khoan/create', 'HotelBooking\Controllers\TaiKhoanController', 'create');
Route::post('/tai-khoan', 'HotelBooking\Controllers\TaiKhoanController', 'store');
Route::get('/tai-khoan/{id}', 'HotelBooking\Controllers\TaiKhoanController', 'show');
Route::get('/tai-khoan/{id}/edit', 'HotelBooking\Controllers\TaiKhoanController', 'edit');
Route::put('/tai-khoan/{id}', 'HotelBooking\Controllers\TaiKhoanController', 'update');
Route::delete('/tai-khoan/{id}', 'HotelBooking\Controllers\TaiKhoanController', 'destroy');

// ===== DANH MỤC ROUTES =====

Route::get('/danh-muc', 'HotelBooking\Controllers\DanhMucController', 'index');
Route::get('/danh-muc/create', 'HotelBooking\Controllers\DanhMucController', 'create');
Route::post('/danh-muc', 'HotelBooking\Controllers\DanhMucController', 'store');
Route::get('/danh-muc/{id}', 'HotelBooking\Controllers\DanhMucController', 'show');
Route::get('/danh-muc/{id}/edit', 'HotelBooking\Controllers\DanhMucController', 'edit');
Route::put('/danh-muc/{id}', 'HotelBooking\Controllers\DanhMucController', 'update');
Route::delete('/danh-muc/{id}', 'HotelBooking\Controllers\DanhMucController', 'destroy');

// ===== HÓA ĐƠN ROUTES =====

Route::get('/hoa-don', 'HotelBooking\Controllers\HoaDonController', 'index');
Route::get('/hoa-don/create', 'HotelBooking\Controllers\HoaDonController', 'create');
Route::post('/hoa-don', 'HotelBooking\Controllers\HoaDonController', 'store');
Route::get('/hoa-don/{id}', 'HotelBooking\Controllers\HoaDonController', 'show');
Route::get('/hoa-don/{id}/edit', 'HotelBooking\Controllers\HoaDonController', 'edit');
Route::put('/hoa-don/{id}', 'HotelBooking\Controllers\HoaDonController', 'update');
Route::delete('/hoa-don/{id}', 'HotelBooking\Controllers\HoaDonController', 'destroy');

// ===== TIN TỨC ROUTES =====

Route::get('/tin-tuc', 'HotelBooking\Controllers\TinTucController', 'index');
Route::get('/tin-tuc/create', 'HotelBooking\Controllers\TinTucController', 'create');
Route::post('/tin-tuc', 'HotelBooking\Controllers\TinTucController', 'store');
Route::get('/tin-tuc/{id}', 'HotelBooking\Controllers\TinTucController', 'show');
Route::get('/tin-tuc/{id}/edit', 'HotelBooking\Controllers\TinTucController', 'edit');
Route::put('/tin-tuc/{id}', 'HotelBooking\Controllers\TinTucController', 'update');
Route::delete('/tin-tuc/{id}', 'HotelBooking\Controllers\TinTucController', 'destroy');

// ===== HÌNH ẢNH ROUTES =====

Route::get('/hinh-anh', 'HotelBooking\Controllers\HinhAnhController', 'index');
Route::get('/hinh-anh/create', 'HotelBooking\Controllers\HinhAnhController', 'create');
Route::post('/hinh-anh', 'HotelBooking\Controllers\HinhAnhController', 'store');
Route::get('/hinh-anh/{id}', 'HotelBooking\Controllers\HinhAnhController', 'show');
Route::get('/hinh-anh/{id}/edit', 'HotelBooking\Controllers\HinhAnhController', 'edit');
Route::put('/hinh-anh/{id}', 'HotelBooking\Controllers\HinhAnhController', 'update');
Route::delete('/hinh-anh/{id}', 'HotelBooking\Controllers\HinhAnhController', 'destroy');

// ===== DANH MỤC PHÒNG ROUTES =====

Route::get('/danh-muc-phong', 'HotelBooking\Controllers\DanhMucPhongController', 'index');
Route::get('/danh-muc-phong/create', 'HotelBooking\Controllers\DanhMucPhongController', 'create');
Route::post('/danh-muc-phong', 'HotelBooking\Controllers\DanhMucPhongController', 'store');
Route::get('/danh-muc-phong/{id}', 'HotelBooking\Controllers\DanhMucPhongController', 'show');
Route::get('/danh-muc-phong/{id}/edit', 'HotelBooking\Controllers\DanhMucPhongController', 'edit');
Route::put('/danh-muc-phong/{id}', 'HotelBooking\Controllers\DanhMucPhongController', 'update');
Route::delete('/danh-muc-phong/{id}', 'HotelBooking\Controllers\DanhMucPhongController', 'destroy');

// ===== HÓA ĐƠN PHÒNG ROUTES =====

Route::get('/hoa-don-phong', 'HotelBooking\Controllers\HoaDonPhongController', 'index');
Route::get('/hoa-don-phong/create', 'HotelBooking\Controllers\HoaDonPhongController', 'create');
Route::post('/hoa-don-phong', 'HotelBooking\Controllers\HoaDonPhongController', 'store');
Route::get('/hoa-don-phong/{id}', 'HotelBooking\Controllers\HoaDonPhongController', 'show');
Route::get('/hoa-don-phong/{id}/edit', 'HotelBooking\Controllers\HoaDonPhongController', 'edit');
Route::put('/hoa-don-phong/{id}', 'HotelBooking\Controllers\HoaDonPhongController', 'update');
Route::delete('/hoa-don-phong/{id}', 'HotelBooking\Controllers\HoaDonPhongController', 'destroy');

// ===== TRANG THÔNG TIN =====

Route::get('/about', 'HotelBooking\Controllers\HomeController', 'about');
Route::get('/contact', 'HotelBooking\Controllers\HomeController', 'contact');
Route::post('/contact', 'HotelBooking\Controllers\HomeController', 'sendContact');

// ===== ADMIN ROUTES =====

Route::get('/admin', 'HotelBooking\Controllers\Admin\AdminController', 'dashboard');
Route::get('/admin/dashboard', 'HotelBooking\Controllers\Admin\AdminController', 'dashboard');

// Admin - Quản lý phòng
Route::get('/admin/phong', 'HotelBooking\Controllers\Admin\AdminController', 'phongIndex');
Route::get('/admin/phong/create', 'HotelBooking\Controllers\Admin\AdminController', 'phongCreate');
Route::post('/admin/phong', 'HotelBooking\Controllers\Admin\AdminController', 'phongStore');
Route::get('/admin/phong/{id}/edit', 'HotelBooking\Controllers\Admin\AdminController', 'phongEdit');
Route::put('/admin/phong/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'phongUpdate');
Route::delete('/admin/phong/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'phongDestroy');

// Admin - Quản lý dịch vụ
Route::get('/admin/dich-vu', 'HotelBooking\Controllers\Admin\AdminController', 'dichVuIndex');
Route::get('/admin/dich-vu/create', 'HotelBooking\Controllers\Admin\AdminController', 'dichVuCreate');
Route::post('/admin/dich-vu', 'HotelBooking\Controllers\Admin\AdminController', 'dichVuStore');
Route::get('/admin/dich-vu/{id}/edit', 'HotelBooking\Controllers\Admin\AdminController', 'dichVuEdit');
Route::put('/admin/dich-vu/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'dichVuUpdate');
Route::delete('/admin/dich-vu/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'dichVuDestroy');

// Admin - Quản lý tài khoản
Route::get('/admin/tai-khoan', 'HotelBooking\Controllers\Admin\AdminController', 'taiKhoanIndex');
Route::get('/admin/tai-khoan/create', 'HotelBooking\Controllers\Admin\AdminController', 'taiKhoanCreate');
Route::post('/admin/tai-khoan', 'HotelBooking\Controllers\Admin\AdminController', 'taiKhoanStore');
Route::get('/admin/tai-khoan/{id}/edit', 'HotelBooking\Controllers\Admin\AdminController', 'taiKhoanEdit');
Route::put('/admin/tai-khoan/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'taiKhoanUpdate');
Route::delete('/admin/tai-khoan/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'taiKhoanDestroy');

// Admin - Quản lý hóa đơn
Route::get('/admin/hoa-don', 'HotelBooking\Controllers\Admin\AdminController', 'hoaDonIndex');
Route::get('/admin/hoa-don/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'hoaDonShow');
Route::put('/admin/hoa-don/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'hoaDonUpdate');
Route::delete('/admin/hoa-don/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'hoaDonDestroy');

// ===== API ROUTES =====

// API cho tìm kiếm
Route::get('/api/phong/search', 'HotelBooking\Controllers\PhongController', 'search');
Route::get('/api/dich-vu/search', 'HotelBooking\Controllers\DichVuController', 'search');
Route::get('/api/tin-tuc/search', 'HotelBooking\Controllers\TinTucController', 'search');

// API cho upload hình ảnh
Route::post('/api/upload/image', 'HotelBooking\Controllers\HinhAnhController', 'upload');
Route::delete('/api/upload/image/{id}', 'HotelBooking\Controllers\HinhAnhController', 'deleteUpload');

// API cho báo cáo và thống kê
Route::get('/api/admin/stats', 'HotelBooking\Controllers\Admin\AdminController', 'getStats');
Route::get('/api/admin/revenue', 'HotelBooking\Controllers\Admin\AdminController', 'getRevenue');
Route::get('/api/admin/bookings', 'HotelBooking\Controllers\Admin\AdminController', 'getBookings');

