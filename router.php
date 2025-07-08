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

// Trang chủ và tìm kiếm
Route::get('/', 'HotelBooking\Controllers\HomeController', 'index');
Route::get('/home', 'HotelBooking\Controllers\HomeController', 'index');
Route::get('/search-rooms', 'HotelBooking\Controllers\HomeController', 'showSearchForm');
Route::post('/search-rooms', 'HotelBooking\Controllers\HomeController', 'searchRooms');

// Trang thông tin
Route::get('/about', 'HotelBooking\Controllers\HomeController', 'about');
Route::get('/contact', 'HotelBooking\Controllers\HomeController', 'contact');

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
Route::get('/forgot-password', 'HotelBooking\Controllers\AuthController', 'showForgotPasswordForm');
Route::post('/forgot-password', 'HotelBooking\Controllers\AuthController', 'forgotPassword');
Route::get('/reset-password', 'HotelBooking\Controllers\AuthController', 'showResetPasswordForm');
Route::post('/reset-password', 'HotelBooking\Controllers\AuthController', 'resetPassword');

// ===== PHÒNG ROUTES (CHỈ XEM) =====

Route::get('/phong', 'HotelBooking\Controllers\PhongController', 'index');
Route::get('/phong/{id}', 'HotelBooking\Controllers\PhongController', 'show');

// ===== DỊCH VỤ ROUTES (CHỈ XEM) =====

Route::get('/dich-vu', 'HotelBooking\Controllers\DichVuController', 'index');
Route::get('/dich-vu/{id}', 'HotelBooking\Controllers\DichVuController', 'show');

// ===== ĐÁNH GIÁ ROUTES (KHÁCH HÀNG CÓ THỂ ĐÁNH GIÁ) =====

Route::get('/danh-gia', 'HotelBooking\Controllers\DanhGiaController', 'index');
Route::get('/danh-gia/create', 'HotelBooking\Controllers\DanhGiaController', 'create');
Route::post('/danh-gia', 'HotelBooking\Controllers\DanhGiaController', 'store');
Route::get('/danh-gia/{id}', 'HotelBooking\Controllers\DanhGiaController', 'show');

// ===== TIN TỨC ROUTES (CHỈ XEM) =====

Route::get('/tin-tuc', 'HotelBooking\Controllers\TinTucController', 'index');
Route::get('/tin-tuc/{id}', 'HotelBooking\Controllers\TinTucController', 'show');

// ===== ĐẶT PHÒNG (KHÁCH HÀNG) =====

Route::get('/dat-phong', 'HotelBooking\Controllers\HoaDonController', 'create');
Route::post('/dat-phong', 'HotelBooking\Controllers\HoaDonController', 'store');
Route::get('/dat-phong/{id}', 'HotelBooking\Controllers\HoaDonController', 'show');

// ===== TRANG THÔNG TIN =====

Route::get('/about', 'HotelBooking\Controllers\HomeController', 'about');
Route::get('/contact', 'HotelBooking\Controllers\HomeController', 'contact');
Route::post('/contact', 'HotelBooking\Controllers\HomeController', 'sendContact');

// ===== ADMIN ROUTES =====

Route::get('/admin', 'HotelBooking\Controllers\Admin\AdminController', 'dashboard');
Route::get('/admin/dashboard', 'HotelBooking\Controllers\Admin\AdminController', 'dashboard');

// Admin - Quản lý phòng  
Route::get('/admin/phong', 'HotelBooking\Controllers\Admin\AdminPhongController', 'index');
Route::get('/admin/phong/create', 'HotelBooking\Controllers\Admin\AdminPhongController', 'create');
Route::post('/admin/phong', 'HotelBooking\Controllers\Admin\AdminPhongController', 'store');
Route::get('/admin/phong/{id}/edit', 'HotelBooking\Controllers\Admin\AdminPhongController', 'edit');
Route::put('/admin/phong/{id}', 'HotelBooking\Controllers\Admin\AdminPhongController', 'update');
Route::post('/admin/phong/{id}/delete', 'HotelBooking\Controllers\Admin\AdminPhongController', 'destroy');

// Admin - Quản lý danh mục phòng
Route::get('/admin/danh-muc-phong', 'HotelBooking\Controllers\Admin\AdminController', 'danhMucPhongIndex');
Route::get('/admin/danh-muc-phong/create', 'HotelBooking\Controllers\Admin\AdminController', 'danhMucPhongCreate');
Route::post('/admin/danh-muc-phong', 'HotelBooking\Controllers\Admin\AdminController', 'danhMucPhongStore');

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

// Admin - Quản lý đánh giá
Route::get('/admin/danh-gia', 'HotelBooking\Controllers\Admin\AdminController', 'danhGiaIndex');
Route::get('/admin/danh-gia/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'danhGiaShow');
Route::put('/admin/danh-gia/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'danhGiaUpdate');
Route::delete('/admin/danh-gia/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'danhGiaDestroy');

// Admin - Quản lý tin tức
Route::get('/admin/tin-tuc', 'HotelBooking\Controllers\Admin\AdminController', 'tinTucIndex');
Route::get('/admin/tin-tuc/create', 'HotelBooking\Controllers\Admin\AdminController', 'tinTucCreate');
Route::post('/admin/tin-tuc', 'HotelBooking\Controllers\Admin\AdminController', 'tinTucStore');
Route::get('/admin/tin-tuc/{id}/edit', 'HotelBooking\Controllers\Admin\AdminController', 'tinTucEdit');
Route::put('/admin/tin-tuc/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'tinTucUpdate');
Route::delete('/admin/tin-tuc/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'tinTucDestroy');

// Admin - Quản lý hình ảnh
Route::get('/admin/hinh-anh', 'HotelBooking\Controllers\Admin\AdminController', 'hinhAnhIndex');
Route::get('/admin/hinh-anh/create', 'HotelBooking\Controllers\Admin\AdminController', 'hinhAnhCreate');
Route::post('/admin/hinh-anh', 'HotelBooking\Controllers\Admin\AdminController', 'hinhAnhStore');
Route::delete('/admin/hinh-anh/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'hinhAnhDestroy');

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

