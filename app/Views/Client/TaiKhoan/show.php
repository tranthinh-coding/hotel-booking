<?php
$title = 'Tài khoản của tôi - Ocean Pearl Hotel';
ob_start();
?>

<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-teal-600 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center space-x-4">
                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-blue-600 text-2xl"></i>
                </div>
                <div class="text-white">
                    <h1 class="text-3xl font-bold"><?= safe_htmlspecialchars($taiKhoan->ho_ten) ?></h1>
                    <p class="text-blue-100"><?= safe_htmlspecialchars($taiKhoan->email) ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Navigation -->
        <div class="bg-white rounded-lg shadow-sm p-1 mb-8">
            <div class="flex flex-wrap gap-2">
                <a href="/tai-khoan" class="px-4 py-2 bg-blue-100 text-blue-700 rounded-md font-medium">
                    <i class="fas fa-tachometer-alt mr-2"></i>Tổng quan
                </a>
                <a href="/tai-khoan/lich-su-dat-phong" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <i class="fas fa-calendar-alt mr-2"></i>Lịch sử đặt phòng
                </a>
                <a href="/tai-khoan/lich-su-danh-gia" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <i class="fas fa-star mr-2"></i>Đánh giá của tôi
                </a>
                <a href="/profile" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <i class="fas fa-edit mr-2"></i>Chỉnh sửa hồ sơ
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Tổng đặt phòng</p>
                        <p class="text-2xl font-bold text-gray-900"><?= $stats->tong_dat_phong ?? 0 ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Đã hoàn thành</p>
                        <p class="text-2xl font-bold text-gray-900"><?= $stats->da_thanh_toan ?? 0 ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Chờ xác nhận</p>
                        <p class="text-2xl font-bold text-gray-900"><?= $stats->cho_xac_nhan ?? 0 ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-money-bill-wave text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Tổng chi tiêu</p>
                        <p class="text-2xl font-bold text-gray-900"><?= number_format($stats->tong_chi_tieu ?? 0) ?>đ
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Thao tác nhanh</h3>
                <div class="space-y-4">
                    <a href="/dat-phong"
                        class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-teal-50 rounded-lg hover:from-blue-100 hover:to-teal-100 transition-colors">
                        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900">Đặt phòng mới</h4>
                            <p class="text-sm text-gray-500">Tìm và đặt phòng yêu thích</p>
                        </div>
                    </a>

                    <a href="/phong"
                        class="flex items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg hover:from-green-100 hover:to-emerald-100 transition-colors">
                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bed text-white"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900">Xem phòng</h4>
                            <p class="text-sm text-gray-500">Khám phá các loại phòng</p>
                        </div>
                    </a>

                    <a href="/dich-vu"
                        class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg hover:from-purple-100 hover:to-pink-100 transition-colors">
                        <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-concierge-bell text-white"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900">Dịch vụ</h4>
                            <p class="text-sm text-gray-500">Xem các dịch vụ cao cấp</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Account Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Thông tin tài khoản</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="text-gray-600">Họ tên:</span>
                        <span class="font-medium"><?= safe_htmlspecialchars($taiKhoan->ho_ten) ?></span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="text-gray-600">Email:</span>
                        <span class="font-medium"><?= safe_htmlspecialchars($taiKhoan->email) ?></span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="text-gray-600">Số điện thoại:</span>
                        <span
                            class="font-medium"><?= safe_htmlspecialchars($taiKhoan->so_dien_thoai ?? 'Chưa cập nhật') ?></span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="text-gray-600">Ngày tham gia:</span>
                        <span
                            class="font-medium"><?= date('d/m/Y', strtotime($taiKhoan->ngay_tao ?? date('Y-m-d'))) ?></span>
                    </div>

                    <div class="pt-4">
                        <a href="/profile"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                            <i class="fas fa-edit mr-2"></i>
                            Chỉnh sửa thông tin
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Bookings Preview -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Đặt phòng gần đây</h3>
                <a href="/tai-khoan/lich-su-dat-phong" class="text-blue-600 hover:text-blue-800 font-medium">
                    Xem tất cả
                    <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="text-center py-8">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-calendar-alt text-gray-400 text-2xl"></i>
                </div>
                <p class="text-gray-500">Bạn chưa có đặt phòng nào</p>
                <a href="/booking/checkout"
                    class="inline-flex items-center mt-4 text-blue-600 hover:text-blue-800 font-medium">
                    <i class="fas fa-plus mr-2"></i>
                    Đặt phòng ngay
                </a>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../../layouts/app.php';
?>