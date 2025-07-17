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
Route::get('/contact', 'HotelBooking\Controllers\Client\ContactController', 'show');
Route::post('/contact', 'HotelBooking\Controllers\Client\ContactController', 'submit');

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
Route::get('/phong/show', 'HotelBooking\Controllers\Client\PhongController', 'show');

// Dịch vụ (chỉ xem)
Route::get('/dich-vu', 'HotelBooking\Controllers\Client\DichVuController', 'index');
Route::get('/dich-vu/show', 'HotelBooking\Controllers\Client\DichVuController', 'show');

// Đánh giá (khách hàng có thể đánh giá)
Route::get('/danh-gia', 'HotelBooking\Controllers\Admin\AdminDanhGiaController', 'index');
Route::get('/danh-gia/create', 'HotelBooking\Controllers\Admin\AdminDanhGiaController', 'create');
Route::post('/danh-gia/store', 'HotelBooking\Controllers\Admin\AdminDanhGiaController', 'store');
Route::get('/danh-gia/show', 'HotelBooking\Controllers\Admin\AdminDanhGiaController', 'show');

// Tin tức (chỉ xem)
Route::get('/tin-tuc', 'HotelBooking\Controllers\Client\TinTucController', 'index');
Route::get('/tin-tuc/{id}', 'HotelBooking\Controllers\Client\TinTucController', 'show');

// Đặt phòng (khách hàng)
Route::get('/dat-phong/{maPhong}', 'HotelBooking\Controllers\Client\BookingController', 'showBookingForm');
Route::post('/dat-phong', 'HotelBooking\Controllers\Client\BookingController', 'processBooking');
Route::post('/huy-dat-phong/{maHoaDon}', 'HotelBooking\Controllers\Client\BookingController', 'cancelBooking');

// Booking system mới
Route::get('/booking/checkout', 'HotelBooking\Controllers\Client\BookingController', 'checkout');
Route::post('/booking/process', 'HotelBooking\Controllers\Client\BookingController', 'processCheckout');
Route::get('/booking/success', 'HotelBooking\Controllers\Client\BookingController', 'success');

// Tài khoản khách hàng
Route::get('/tai-khoan', 'HotelBooking\Controllers\Client\TaiKhoanController', 'show');
Route::get('/tai-khoan/lich-su-dat-phong', 'HotelBooking\Controllers\Client\TaiKhoanController', 'bookingHistory');
Route::get('/tai-khoan/chi-tiet-hoa-don', 'HotelBooking\Controllers\Client\TaiKhoanController', 'getBookingDetails');
Route::get('/tai-khoan/lich-su-danh-gia', 'HotelBooking\Controllers\Client\TaiKhoanController', 'reviewHistory');
Route::post('/tai-khoan/gui-danh-gia', 'HotelBooking\Controllers\Client\TaiKhoanController', 'submitReview');
Route::post('/tai-khoan/cap-nhat-danh-gia', 'HotelBooking\Controllers\Client\TaiKhoanController', 'updateReview');
Route::post('/tai-khoan/xoa-danh-gia', 'HotelBooking\Controllers\Client\TaiKhoanController', 'deleteReview');
Route::post('/tai-khoan/huy-dat-phong', 'HotelBooking\Controllers\Client\TaiKhoanController', 'cancelBooking');

// ===== ADMIN ROUTES =====

// Dashboard
Route::get('/admin', 'HotelBooking\Controllers\Admin\AdminController', 'dashboard');
Route::get('/admin/dashboard', 'HotelBooking\Controllers\Admin\AdminController', 'dashboard');
Route::get('/admin/thong-ke', 'HotelBooking\Controllers\Admin\AdminController', 'thongKe');

// Admin - Quản lý loại phòng
Route::get('/admin/loai-phong', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'index');
Route::get('/admin/loai-phong/create', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'create');
Route::post('/admin/loai-phong/store', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'store');
Route::get('/admin/loai-phong/show', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'show');
Route::get('/admin/loai-phong/edit', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'edit');
Route::post('/admin/loai-phong/update', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'update');
Route::post('/admin/loai-phong/deactivate', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'deactivate');
Route::post('/admin/loai-phong/reactivate', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'reactivate');
Route::post('/admin/loai-phong/add-room', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'addRoom');
Route::post('/admin/loai-phong/remove-room', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'removeRoom');
Route::post('/admin/loai-phong/delete', 'HotelBooking\Controllers\Admin\AdminLoaiPhongController', 'destroy');

// Admin - Quản lý phòng  
Route::get('/admin/phong', 'HotelBooking\Controllers\Admin\AdminPhongController', 'index');
Route::get('/admin/phong/create', 'HotelBooking\Controllers\Admin\AdminPhongController', 'create');
Route::post('/admin/phong/store', 'HotelBooking\Controllers\Admin\AdminPhongController', 'store');
Route::get('/admin/phong/show', 'HotelBooking\Controllers\Admin\AdminPhongController', 'show');
Route::get('/admin/phong/edit', 'HotelBooking\Controllers\Admin\AdminPhongController', 'edit');
Route::post('/admin/phong/update', 'HotelBooking\Controllers\Admin\AdminPhongController', 'update');
Route::post('/admin/phong/update-status', 'HotelBooking\Controllers\Admin\AdminPhongController', 'updateStatus');
Route::post('/admin/phong/deactivate', 'HotelBooking\Controllers\Admin\AdminPhongController', 'deactivate');
Route::post('/admin/phong/reactivate', 'HotelBooking\Controllers\Admin\AdminPhongController', 'reactivate');
Route::post('/admin/phong/add-image', 'HotelBooking\Controllers\Admin\AdminPhongController', 'addImage');
Route::post('/admin/phong/delete-image', 'HotelBooking\Controllers\Admin\AdminPhongController', 'deleteImage');

// Admin - Quản lý tài khoản
Route::get('/admin/tai-khoan', 'HotelBooking\Controllers\Admin\AdminTaiKhoanController', 'index');
Route::get('/admin/tai-khoan/create', 'HotelBooking\Controllers\Admin\AdminTaiKhoanController', 'create');
Route::post('/admin/tai-khoan/store', 'HotelBooking\Controllers\Admin\AdminTaiKhoanController', 'store');
Route::get('/admin/tai-khoan/show', 'HotelBooking\Controllers\Admin\AdminTaiKhoanController', 'show');
Route::get('/admin/tai-khoan/edit', 'HotelBooking\Controllers\Admin\AdminTaiKhoanController', 'edit');
Route::post('/admin/tai-khoan/update', 'HotelBooking\Controllers\Admin\AdminTaiKhoanController', 'update');
Route::post('/admin/tai-khoan/update-status', 'HotelBooking\Controllers\Admin\AdminTaiKhoanController', 'updateStatus');

// Admin - Quản lý dịch vụ
Route::get('/admin/dich-vu', 'HotelBooking\Controllers\Admin\AdminDichVuController', 'index');
Route::get('/admin/dich-vu/create', 'HotelBooking\Controllers\Admin\AdminDichVuController', 'create');
Route::post('/admin/dich-vu/store', 'HotelBooking\Controllers\Admin\AdminDichVuController', 'store');
Route::get('/admin/dich-vu/show', 'HotelBooking\Controllers\Admin\AdminDichVuController', 'show');
Route::get('/admin/dich-vu/edit', 'HotelBooking\Controllers\Admin\AdminDichVuController', 'edit');
Route::post('/admin/dich-vu/update', 'HotelBooking\Controllers\Admin\AdminDichVuController', 'update');

// Admin - Quản lý hóa đơn
Route::get('/admin/hoa-don', 'HotelBooking\Controllers\Admin\AdminHoaDonController', 'index');
Route::get('/admin/hoa-don/create', 'HotelBooking\Controllers\Admin\AdminHoaDonController', 'create');
Route::post('/admin/hoa-don/store', 'HotelBooking\Controllers\Admin\AdminHoaDonController', 'store');
Route::get('/admin/hoa-don/show', 'HotelBooking\Controllers\Admin\AdminHoaDonController', 'show');
Route::get('/admin/hoa-don/edit', 'HotelBooking\Controllers\Admin\AdminHoaDonController', 'edit');
Route::post('/admin/hoa-don/update', 'HotelBooking\Controllers\Admin\AdminHoaDonController', 'update');

// Admin - Quản lý đánh giá
Route::get('/admin/danh-gia', 'HotelBooking\Controllers\Admin\AdminDanhGiaController', 'index');
Route::get('/admin/danh-gia/show', 'HotelBooking\Controllers\Admin\AdminDanhGiaController', 'show');
Route::get('/admin/danh-gia/edit', 'HotelBooking\Controllers\Admin\AdminDanhGiaController', 'edit');
Route::post('/admin/danh-gia/update', 'HotelBooking\Controllers\Admin\AdminDanhGiaController', 'update');

// Admin - Quản lý liên hệ
Route::get('/admin/lien-he', 'HotelBooking\Controllers\Admin\AdminLienHeController', 'index');
Route::get('/admin/lien-he/show', 'HotelBooking\Controllers\Admin\AdminLienHeController', 'show');
Route::post('/admin/lien-he/reply', 'HotelBooking\Controllers\Admin\AdminLienHeController', 'reply');
Route::post('/admin/lien-he/update-status', 'HotelBooking\Controllers\Admin\AdminLienHeController', 'updateStatus');
Route::post('/admin/lien-he/close', 'HotelBooking\Controllers\Admin\AdminLienHeController', 'close');

// Admin - Quản lý tin tức
// Tin tức routes
Route::get('/admin/tin-tuc', 'HotelBooking\Controllers\Admin\AdminTinTucController', 'index');
Route::get('/admin/tin-tuc/create', 'HotelBooking\Controllers\Admin\AdminTinTucController', 'create');
Route::post('/admin/tin-tuc/store', 'HotelBooking\Controllers\Admin\AdminTinTucController', 'store');
Route::get('/admin/tin-tuc/show', 'HotelBooking\Controllers\Admin\AdminTinTucController', 'show');
Route::get('/admin/tin-tuc/edit', 'HotelBooking\Controllers\Admin\AdminTinTucController', 'edit');
Route::post('/admin/tin-tuc/update', 'HotelBooking\Controllers\Admin\AdminTinTucController', 'update');

// Admin - Quản lý hình ảnh
Route::get('/admin/hinh-anh', 'HotelBooking\Controllers\Admin\AdminController', 'hinhAnhIndex');
Route::get('/admin/hinh-anh/create', 'HotelBooking\Controllers\Admin\AdminController', 'hinhAnhCreate');
Route::post('/admin/hinh-anh/store', 'HotelBooking\Controllers\Admin\AdminController', 'hinhAnhStore');
Route::post('/admin/hinh-anh/delete', 'HotelBooking\Controllers\Admin\AdminController', 'hinhAnhDestroy');

// ===== API ROUTES =====

// API cho tìm kiếm
Route::get('/api/phong/search', 'HotelBooking\Controllers\Client\PhongController', 'search');
Route::get('/api/dich-vu/search', 'HotelBooking\Controllers\Client\DichVuController', 'search');
Route::get('/api/tin-tuc/search', 'HotelBooking\Controllers\Client\TinTucController', 'search');

// API cho upload hình ảnh
Route::post('/api/upload/image', 'HotelBooking\Controllers\Admin\AdminController', 'upload');
Route::post('/api/upload/image/delete', 'HotelBooking\Controllers\Admin\AdminController', 'deleteUpload');

// API cho báo cáo và thống kê
Route::get('/api/admin/stats', 'HotelBooking\Controllers\Admin\AdminController', 'getStats');
Route::get('/api/admin/revenue', 'HotelBooking\Controllers\Admin\AdminController', 'getRevenue');
Route::get('/api/admin/bookings', 'HotelBooking\Controllers\Admin\AdminController', 'getBookings');

