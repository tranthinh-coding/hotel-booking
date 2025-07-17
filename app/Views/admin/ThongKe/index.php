<?php
$title = 'Thống kê - Ocean Pearl Hotel';
$pageTitle = 'Thống kê';
ob_start();
?>

<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-2">Thống kê & Báo cáo</h1>
                <p class="text-purple-100">Tổng quan hiệu suất kinh doanh của khách sạn</p>
            </div>
            <div class="text-right">
                <div class="text-lg font-semibold">Cập nhật: <?= date('d/m/Y H:i') ?></div>
                <div class="text-purple-200 text-sm">Dữ liệu thời gian thực</div>
            </div>
        </div>
    </div>

    <!-- Monthly Revenue Chart -->
    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <i class="fas fa-chart-line text-green-600 mr-2"></i>
            Doanh thu 12 tháng gần nhất
        </h3>
        <div class="h-80">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <!-- Monthly Bookings Chart -->
    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <i class="fas fa-chart-bar text-blue-600 mr-2"></i>
            Số lượng đặt phòng 12 tháng gần nhất
        </h3>
        <div class="h-80">
            <canvas id="bookingsChart"></canvas>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Order Status Stats -->
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-chart-pie text-purple-600 mr-2"></i>
                Thống kê theo trạng thái đơn hàng
            </h3>
            <div class="space-y-4">
                <?php foreach ($statusStats as $stat): ?>
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="font-medium text-gray-700"><?= htmlspecialchars($stat['status']) ?></span>
                        <div class="text-right">
                            <div class="font-bold text-gray-900"><?= number_format($stat['count']) ?> đơn</div>
                            <div class="text-sm text-gray-500"><?= number_format($stat['revenue']) ?>₫</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Top Room Types -->
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-bed text-orange-600 mr-2"></i>
                Top loại phòng được đặt nhiều nhất
            </h3>
            <div class="space-y-3">
                <?php if (isNotEmpty($topRoomTypes)): ?>
                    <?php foreach ($topRoomTypes as $index => $roomType): ?>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <span class="w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">
                                    <?= $index + 1 ?>
                                </span>
                                <span class="font-medium text-gray-700"><?= htmlspecialchars($roomType['ten_loai_phong']) ?></span>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-gray-900"><?= number_format($roomType['so_lan_dat']) ?> lần</div>
                                <div class="text-sm text-gray-500"><?= number_format($roomType['doanh_thu']) ?>₫</div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-3"></i>
                        <p>Chưa có dữ liệu</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Top Services -->
    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <i class="fas fa-concierge-bell text-indigo-600 mr-2"></i>
            Top dịch vụ được sử dụng nhiều nhất
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php if (isNotEmpty($topServices)): ?>
                <?php foreach ($topServices as $index => $service): ?>
                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 p-4 rounded-lg border border-indigo-100">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-lg font-bold text-indigo-600">#<?= $index + 1 ?></span>
                            <span class="text-sm font-medium text-gray-600"><?= number_format($service['so_lan_dung']) ?> lần</span>
                        </div>
                        <h4 class="font-semibold text-gray-800 mb-1"><?= htmlspecialchars($service['ten_dich_vu']) ?></h4>
                        <p class="text-sm text-gray-600">Doanh thu: <?= number_format($service['doanh_thu']) ?>₫</p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-8 text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-3"></i>
                    <p>Chưa có dữ liệu dịch vụ</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Top Customers -->
    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <i class="fas fa-users text-green-600 mr-2"></i>
            Top khách hàng thân thiết
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">#</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Khách hàng</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Email</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Số đơn hàng</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">Tổng chi tiêu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (isNotEmpty($topCustomers)): ?>
                        <?php foreach ($topCustomers as $index => $customer): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <span class="w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                        <?= $index + 1 ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-800"><?= htmlspecialchars($customer['ho_ten']) ?></td>
                                <td class="px-4 py-3 text-gray-600"><?= htmlspecialchars($customer['email']) ?></td>
                                <td class="px-4 py-3 text-center">
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm font-medium">
                                        <?= number_format($customer['so_don_hang']) ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right font-bold text-green-600">
                                    <?= number_format($customer['tong_chi_tieu']) ?>₫
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-3"></i>
                                <p>Chưa có dữ liệu khách hàng</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: <?= json_encode(array_column($monthlyRevenue, 'month')) ?>,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: <?= json_encode(array_column($monthlyRevenue, 'revenue')) ?>,
                borderColor: 'rgb(34, 197, 94)',
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('vi-VN').format(value) + '₫';
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Doanh thu: ' + new Intl.NumberFormat('vi-VN').format(context.parsed.y) + '₫';
                        }
                    }
                }
            }
        }
    });

    // Bookings Chart
    const bookingsCtx = document.getElementById('bookingsChart').getContext('2d');
    const bookingsChart = new Chart(bookingsCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($monthlyBookings, 'month')) ?>,
            datasets: [{
                label: 'Số đặt phòng',
                data: <?= json_encode(array_column($monthlyBookings, 'bookings')) ?>,
                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                borderColor: 'rgb(59, 130, 246)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Số đặt phòng: ' + context.parsed.y;
                        }
                    }
                }
            }
        }
    });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
