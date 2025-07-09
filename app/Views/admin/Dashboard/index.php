<?php
$title = 'Dashboard Quản trị - Ocean Pearl Hotel';
$pageTitle = 'Dashboard Quản trị';
ob_start();
?>

<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-2">Chào mừng trở lại, <?= htmlspecialchars($user->ho_ten ?? 'Admin') ?>!</h1>
                <p class="text-blue-100">Hôm nay là <?= date('d/m/Y') ?> - Hãy bắt đầu một ngày làm việc hiệu quả</p>
            </div>
            <div class="text-right">
                <div class="text-3xl font-bold"><?= date('H:i') ?></div>
                <div class="text-blue-200 text-sm"><?= date('l') ?></div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Revenue Card -->
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Doanh thu hôm nay</p>
                    <p class="text-2xl font-bold text-gray-900"><?= number_format($todayRevenue ?? 0) ?>₫</p>
                    <p class="text-green-600 text-sm mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>+12% so với hôm qua
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Bookings Card -->
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Đặt phòng hôm nay</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $totalBookings ?? 0 ?></p>
                    <p class="text-blue-600 text-sm mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>+8% so với hôm qua
                    </p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Rooms Card -->
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Tổng số phòng</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $totalRooms ?? 0 ?></p>
                    <p class="text-purple-600 text-sm mt-1">
                        <i class="fas fa-bed mr-1"></i>Đang hoạt động
                    </p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-door-open text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Users Card -->
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Khách hàng</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $totalUsers ?? 0 ?></p>
                    <p class="text-orange-600 text-sm mt-1">
                        <i class="fas fa-users mr-1"></i>Tài khoản
                    </p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions and Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-bolt text-blue-600 mr-2"></i>
                Thao tác nhanh
            </h3>
            <div class="space-y-3">
                <a href="/admin/phong/create" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                    <i class="fas fa-plus text-blue-600 mr-3"></i>
                    <span class="text-gray-700">Thêm phòng mới</span>
                </a>
                <a href="/admin/loai-phong/create" class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                    <i class="fas fa-tags text-green-600 mr-3"></i>
                    <span class="text-gray-700">Thêm loại phòng</span>
                </a>
                <a href="/admin/tai-khoan/create" class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                    <i class="fas fa-user-plus text-purple-600 mr-3"></i>
                    <span class="text-gray-700">Thêm tài khoản</span>
                </a>
                <a href="/admin/dich-vu/create" class="flex items-center p-3 bg-orange-50 hover:bg-orange-100 rounded-lg transition-colors">
                    <i class="fas fa-concierge-bell text-orange-600 mr-3"></i>
                    <span class="text-gray-700">Thêm dịch vụ</span>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="lg:col-span-2 bg-white rounded-xl p-6 shadow-lg border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-history text-blue-600 mr-2"></i>
                Hoạt động gần đây
            </h3>
            <div class="space-y-3">
                <?php if (!empty($recentActivities)): ?>
                    <?php foreach ($recentActivities as $activity): ?>
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <div class="w-8 h-8 bg-<?= $activity['color'] ?? 'blue' ?>-500 rounded-full flex items-center justify-center text-white text-sm">
                                <i class="fas fa-<?= $activity['icon'] ?? 'info' ?>"></i>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-gray-800"><?= htmlspecialchars($activity['title']) ?></p>
                                <p class="text-xs text-gray-500"><?= $activity['time'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-3"></i>
                        <p>Chưa có hoạt động nào</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Revenue Chart -->
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-chart-line text-green-600 mr-2"></i>
                Doanh thu 7 ngày qua
            </h3>
            <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                <div class="text-center text-gray-500">
                    <i class="fas fa-chart-line text-4xl mb-3"></i>
                    <p>Biểu đồ doanh thu</p>
                    <small>Tích hợp Chart.js để hiển thị</small>
                </div>
            </div>
        </div>

        <!-- Room Status -->
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-bed text-purple-600 mr-2"></i>
                Tình trạng phòng
            </h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                        <span class="font-medium">Phòng trống</span>
                    </div>
                    <span class="text-green-600 font-bold"><?= $availableRooms ?? 0 ?></span>
                </div>
                <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                        <span class="font-medium">Đã đặt</span>
                    </div>
                    <span class="text-blue-600 font-bold"><?= $bookedRooms ?? 0 ?></span>
                </div>
                <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-red-500 rounded-full mr-3"></div>
                        <span class="font-medium">Bảo trì</span>
                    </div>
                    <span class="text-red-600 font-bold"><?= $maintenanceRooms ?? 0 ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
