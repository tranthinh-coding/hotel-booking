<?php

use HotelBooking\Facades\Route;

// ===== ROUTES CHÍNH =====

// Trang chủ và tìm kiếm
Route::get('/', 'HotelBooking\Controllers\Client\HomeController', 'index');
Route::get('/home', 'HotelBooking\Controllers\Client\HomeController', 'index');
Route::get('/search-rooms', 'HotelBooking\Controllers\Client\HomeController', 'showSearchForm');
Route::post('/search-rooms', 'HotelBooking\Controllers\Client\HomeController', 'searchRooms');

// Trang thông tin
Route::get('/about', 'HotelBooking\Controllers\Client\HomeController', 'about');
Route::get('/contact', 'HotelBooking\Controllers\Client\HomeController', 'contact');
Route::post('/contact', 'HotelBooking\Controllers\Client\HomeController', 'sendContact');

// ===== AUTHENTICATION ROUTES =====

// Đăng nhập & Đăng ký
Route::get('/login', 'HotelBooking\Controllers\Auth\AuthController', 'showLoginForm');
Route::post('/login', 'HotelBooking\Controllers\Auth\AuthController', 'login');
Route::get('/register', 'HotelBooking\Controllers\Auth\AuthController', 'showRegisterForm');
Route::post('/register', 'HotelBooking\Controllers\Auth\AuthController', 'register');
Route::get('/logout', 'HotelBooking\Controllers\Auth\AuthController', 'logout');
Route::post('/logout', 'HotelBooking\Controllers\Auth\AuthController', 'logout');

// Profile & Đổi mật khẩu
Route::get('/profile', 'HotelBooking\Controllers\Auth\AuthController', 'profile');
Route::post('/profile', 'HotelBooking\Controllers\Auth\AuthController', 'updateProfile');
Route::get('/change-password', 'HotelBooking\Controllers\Auth\AuthController', 'showChangePasswordForm');
Route::post('/change-password', 'HotelBooking\Controllers\Auth\AuthController', 'changePassword');

// Quên mật khẩu & Đặt lại mật khẩu
Route::get('/forgot-password', 'HotelBooking\Controllers\Auth\AuthController', 'showForgotPasswordForm');
Route::post('/forgot-password', 'HotelBooking\Controllers\Auth\AuthController', 'forgotPassword');
Route::get('/reset-password', 'HotelBooking\Controllers\Auth\AuthController', 'showResetPasswordForm');
Route::post('/reset-password', 'HotelBooking\Controllers\Auth\AuthController', 'resetPassword');

// ===== CLIENT ROUTES (KHÁCH HÀNG) =====

// Phòng (chỉ xem)
Route::get('/phong', 'HotelBooking\Controllers\Client\PhongController', 'index');
Route::get('/phong/{id}', 'HotelBooking\Controllers\Client\PhongController', 'show');

// Dịch vụ (chỉ xem)
Route::get('/dich-vu', 'HotelBooking\Controllers\Client\DichVuController', 'index');
Route::get('/dich-vu/{id}', 'HotelBooking\Controllers\Client\DichVuController', 'show');

// Đánh giá (khách hàng có thể đánh giá)
Route::get('/danh-gia', 'HotelBooking\Controllers\Admin\AdminDanhGiaController', 'index');
Route::get('/danh-gia/create', 'HotelBooking\Controllers\Admin\AdminDanhGiaController', 'create');
Route::post('/danh-gia', 'HotelBooking\Controllers\Admin\AdminDanhGiaController', 'store');
Route::get('/danh-gia/{id}', 'HotelBooking\Controllers\Admin\AdminDanhGiaController', 'show');

// Tin tức (chỉ xem)
Route::get('/tin-tuc', 'HotelBooking\Controllers\Client\TinTucController', 'index');
Route::get('/tin-tuc/{id}', 'HotelBooking\Controllers\Client\TinTucController', 'show');

// Đặt phòng (khách hàng)
Route::get('/dat-phong', 'HotelBooking\Controllers\Admin\AdminHoaDonController', 'create');
Route::post('/dat-phong', 'HotelBooking\Controllers\Admin\AdminHoaDonController', 'store');
Route::get('/dat-phong/{id}', 'HotelBooking\Controllers\Admin\AdminHoaDonController', 'show');

// ===== ADMIN ROUTES =====

// Dashboard
Route::get('/admin', 'HotelBooking\Controllers\Admin\AdminController', 'dashboard');
Route::get('/admin/dashboard', 'HotelBooking\Controllers\Admin\AdminController', 'dashboard');

// Admin - Quản lý loại phòng
Route::get('/admin/loai-phong', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'index');
Route::get('/admin/loai-phong/create', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'create');
Route::post('/admin/loai-phong/store', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'store');
Route::get('/admin/loai-phong/edit', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'edit');
Route::post('/admin/loai-phong/update', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'update');
Route::post('/admin/loai-phong/delete', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'destroy');

// Admin - Quản lý phòng  
Route::get('/admin/phong', 'HotelBooking\Controllers\Admin\AdminPhongController', 'index');
Route::get('/admin/phong/create', 'HotelBooking\Controllers\Admin\AdminPhongController', 'create');
Route::post('/admin/phong/store', 'HotelBooking\Controllers\Admin\AdminPhongController', 'store');
Route::get('/admin/phong/{id}', 'HotelBooking\Controllers\Admin\AdminPhongController', 'show');
Route::get('/admin/phong/{id}/edit', 'HotelBooking\Controllers\Admin\AdminPhongController', 'edit');
Route::post('/admin/phong/{id}/update', 'HotelBooking\Controllers\Admin\AdminPhongController', 'update');
Route::post('/admin/phong/{id}/update-status', 'HotelBooking\Controllers\Admin\AdminPhongController', 'updateStatus');
Route::post('/admin/phong/{id}/delete', 'HotelBooking\Controllers\Admin\AdminPhongController', 'destroy');

// Admin - Quản lý tài khoản
Route::get('/admin/tai-khoan', 'HotelBooking\Controllers\Admin\AdminTaiKhoanController', 'index');
Route::get('/admin/tai-khoan/create', 'HotelBooking\Controllers\Admin\AdminTaiKhoanController', 'create');
Route::post('/admin/tai-khoan/store', 'HotelBooking\Controllers\Admin\AdminTaiKhoanController', 'store');
Route::get('/admin/tai-khoan/edit', 'HotelBooking\Controllers\Admin\AdminTaiKhoanController', 'edit');
Route::post('/admin/tai-khoan/update', 'HotelBooking\Controllers\Admin\AdminTaiKhoanController', 'update');
Route::post('/admin/tai-khoan/delete', 'HotelBooking\Controllers\Admin\AdminTaiKhoanController', 'destroy');

// Admin - Quản lý dịch vụ
Route::get('/admin/dich-vu', 'HotelBooking\Controllers\Admin\AdminDichVuController', 'index');
Route::get('/admin/dich-vu/create', 'HotelBooking\Controllers\Admin\AdminDichVuController', 'create');
Route::post('/admin/dich-vu/store', 'HotelBooking\Controllers\Admin\AdminDichVuController', 'store');
Route::get('/admin/dich-vu/edit', 'HotelBooking\Controllers\Admin\AdminDichVuController', 'edit');
Route::post('/admin/dich-vu/update', 'HotelBooking\Controllers\Admin\AdminDichVuController', 'update');
Route::post('/admin/dich-vu/delete', 'HotelBooking\Controllers\Admin\AdminDichVuController', 'destroy');

// Admin - Quản lý hóa đơn
Route::get('/admin/hoa-don', 'HotelBooking\Controllers\Admin\AdminHoaDonController', 'index');
Route::get('/admin/hoa-don/{id}', 'HotelBooking\Controllers\Admin\AdminHoaDonController', 'show');
Route::put('/admin/hoa-don/{id}', 'HotelBooking\Controllers\Admin\AdminHoaDonController', 'update');
Route::delete('/admin/hoa-don/{id}', 'HotelBooking\Controllers\Admin\AdminHoaDonController', 'destroy');

// Admin - Quản lý đánh giá
Route::get('/admin/danh-gia', 'HotelBooking\Controllers\Admin\AdminDanhGiaController', 'index');
Route::get('/admin/danh-gia/{id}', 'HotelBooking\Controllers\Admin\AdminDanhGiaController', 'show');
Route::put('/admin/danh-gia/{id}', 'HotelBooking\Controllers\Admin\AdminDanhGiaController', 'update');
Route::delete('/admin/danh-gia/{id}', 'HotelBooking\Controllers\Admin\AdminDanhGiaController', 'destroy');

// Admin - Quản lý tin tức
Route::get('/admin/tin-tuc', 'HotelBooking\Controllers\Admin\AdminTinTucController', 'index');
Route::get('/admin/tin-tuc/create', 'HotelBooking\Controllers\Admin\AdminTinTucController', 'create');
Route::post('/admin/tin-tuc', 'HotelBooking\Controllers\Admin\AdminTinTucController', 'store');
Route::get('/admin/tin-tuc/{id}/edit', 'HotelBooking\Controllers\Admin\AdminTinTucController', 'edit');
Route::put('/admin/tin-tuc/{id}', 'HotelBooking\Controllers\Admin\AdminTinTucController', 'update');
Route::delete('/admin/tin-tuc/{id}', 'HotelBooking\Controllers\Admin\AdminTinTucController', 'destroy');

// Admin - Quản lý hình ảnh
Route::get('/admin/hinh-anh', 'HotelBooking\Controllers\Admin\AdminController', 'hinhAnhIndex');
Route::get('/admin/hinh-anh/create', 'HotelBooking\Controllers\Admin\AdminController', 'hinhAnhCreate');
Route::post('/admin/hinh-anh', 'HotelBooking\Controllers\Admin\AdminController', 'hinhAnhStore');
Route::delete('/admin/hinh-anh/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'hinhAnhDestroy');

// ===== API ROUTES =====

// API cho tìm kiếm
Route::get('/api/phong/search', 'HotelBooking\Controllers\Client\PhongController', 'search');
Route::get('/api/dich-vu/search', 'HotelBooking\Controllers\Client\DichVuController', 'search');
Route::get('/api/tin-tuc/search', 'HotelBooking\Controllers\Client\TinTucController', 'search');

// API cho upload hình ảnh
Route::post('/api/upload/image', 'HotelBooking\Controllers\Admin\AdminController', 'upload');
Route::delete('/api/upload/image/{id}', 'HotelBooking\Controllers\Admin\AdminController', 'deleteUpload');

// API cho báo cáo và thống kê
Route::get('/api/admin/stats', 'HotelBooking\Controllers\Admin\AdminController', 'getStats');
Route::get('/api/admin/revenue', 'HotelBooking\Controllers\Admin\AdminController', 'getRevenue');
Route::get('/api/admin/bookings', 'HotelBooking\Controllers\Admin\AdminController', 'getBookings');

