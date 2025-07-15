<?php
$title = 'Quản lý Hóa đơn - Ocean Pearl Hotel Admin';
$pageTitle = 'Quản lý Hóa đơn';
ob_start();
?>

<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <nav class="text-sm text-gray-500">
                <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Hóa đơn</span>
            </nav>
        </div>
        <div>
            <a href="/admin/hoa-don/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Tạo hóa đơn
            </a>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <?php if (isset($_GET['success'])): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>
                    <?php
                    switch ($_GET['success']) {
                        case 'created':
                            echo 'Tạo hóa đơn thành công!';
                            break;
                        case 'updated':
                            echo 'Cập nhật hóa đơn thành công!';
                            break;
                        default:
                            echo 'Thao tác thành công!';
                    }
                    ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <span>
                    <?php
                    switch ($_GET['error']) {
                        case 'missing_id':
                            echo 'Thiếu thông tin hóa đơn!';
                            break;
                        case 'notfound':
                            echo 'Không tìm thấy hóa đơn!';
                            break;
                        default:
                            echo 'Có lỗi xảy ra!';
                    }
                    ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Tổng hóa đơn</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['total'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-receipt text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Chờ xử lý</p>
                    <p class="text-2xl font-bold text-orange-600"><?= $stats['pending'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Đã thanh toán</p>
                    <p class="text-2xl font-bold text-green-600"><?= $stats['paid'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Doanh thu hôm nay</p>
                    <p class="text-2xl font-bold text-purple-600"><?= number_format($stats['revenue_today'] ?? 0, 0, ',', '.') ?>₫</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <input type="text" 
                       name="search"
                       value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="Tìm kiếm hóa đơn, khách hàng..." 
                       id="searchInput">
            </div>
            <div>
                <select name="status" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        id="statusFilter">
                    <option value="">Tất cả trạng thái</option>
                    <option value="<?= \HotelBooking\Enums\TrangThaiHoaDon::CHO_XU_LY ?>" <?= ($_GET['status'] ?? '') === \HotelBooking\Enums\TrangThaiHoaDon::CHO_XU_LY ? 'selected' : '' ?>>Chờ xử lý</option>
                    <option value="<?= \HotelBooking\Enums\TrangThaiHoaDon::DA_XAC_NHAN ?>" <?= ($_GET['status'] ?? '') === \HotelBooking\Enums\TrangThaiHoaDon::DA_XAC_NHAN ? 'selected' : '' ?>>Đã xác nhận</option>
                    <option value="<?= \HotelBooking\Enums\TrangThaiHoaDon::DA_THANH_TOAN ?>" <?= ($_GET['status'] ?? '') === \HotelBooking\Enums\TrangThaiHoaDon::DA_THANH_TOAN ? 'selected' : '' ?>>Đã thanh toán</option>
                    <option value="<?= \HotelBooking\Enums\TrangThaiHoaDon::DA_HUY ?>" <?= ($_GET['status'] ?? '') === \HotelBooking\Enums\TrangThaiHoaDon::DA_HUY ? 'selected' : '' ?>>Đã hủy</option>
                </select>
            </div>
            <div>
                <input type="date" 
                       name="date"
                       value="<?= htmlspecialchars($_GET['date'] ?? '') ?>"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                       id="dateFilter">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-search mr-2"></i>Lọc
                </button>
                <a href="/admin/hoa-don" class="flex-1 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors text-center">
                    <i class="fas fa-times mr-2"></i>Xóa
                </a>
            </div>
        </form>
    </div>

    <!-- Invoices Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Danh sách Hóa đơn</h3>
        </div>
        
        <div class="overflow-x-auto">
            <?php if (isNotEmpty($hoaDons)): ?>
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tạo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng tiền</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phòng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($hoaDons as $hoaDon): ?>
                            <?php
                            // Convert array to object-like access
                            $hoaDon = (object) $hoaDon;
                            ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    #<?= htmlspecialchars($hoaDon->ma_hoa_don) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= htmlspecialchars($hoaDon->ten_khach_hang ?: 'Chưa có thông tin') ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= date('d/m/Y H:i', strtotime($hoaDon->thoi_gian_dat ?: 'now')) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?= number_format($hoaDon->tong_tien ?: 0, 0, ',', '.') ?>₫
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php 
                                    $status = $hoaDon->trang_thai ?: \HotelBooking\Enums\TrangThaiHoaDon::CHO_XU_LY;
                                    $statusColor = \HotelBooking\Enums\TrangThaiHoaDon::getColor($status);
                                    $statusLabel = \HotelBooking\Enums\TrangThaiHoaDon::getLabel($status);
                                    
                                    $statusClasses = [
                                        'yellow' => 'bg-yellow-100 text-yellow-800',
                                        'blue' => 'bg-blue-100 text-blue-800',
                                        'green' => 'bg-green-100 text-green-800',
                                        'red' => 'bg-red-100 text-red-800'
                                    ];
                                    $colorClass = $statusClasses[$statusColor] ?? 'bg-gray-100 text-gray-800';
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $colorClass ?>">
                                        <?= htmlspecialchars($statusLabel) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= htmlspecialchars($hoaDon->so_phong ?: 'Chưa có phòng') ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="/admin/hoa-don/show?id=<?= $hoaDon->ma_hoa_don ?>" 
                                           class="text-blue-600 hover:text-blue-900">Xem</a>
                                        <a href="/admin/hoa-don/edit?id=<?= $hoaDon->ma_hoa_don ?>" 
                                           class="text-green-600 hover:text-green-900">Sửa</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="text-center py-12">
                    <i class="fas fa-receipt text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Chưa có hóa đơn nào</h3>
                    <p class="text-gray-500 mb-6">Hãy tạo hóa đơn đầu tiên để bắt đầu</p>
                    <a href="/admin/hoa-don/create" 
                       class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Tạo hóa đơn
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Search and filter functionality
document.getElementById('searchInput')?.addEventListener('input', function() {
    // Implementation for search
});

document.getElementById('statusFilter')?.addEventListener('change', function() {
    // Implementation for status filter
});

document.getElementById('dateFilter')?.addEventListener('change', function() {
    // Implementation for date filter
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
