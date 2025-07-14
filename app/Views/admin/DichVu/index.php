<?php
$title = 'Quản lý Dịch vụ - Ocean Pearl Hotel Admin';
$pageTitle = 'Quản lý Dịch vụ';
ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <div class="flex justify-between items-center">
        <nav class="text-sm text-gray-500">
            <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">Quản lý Dịch vụ</span>
        </nav>
        <a href="/admin/dich-vu/create"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Thêm dịch vụ
        </a>
    </div>

    <!-- Thông báo -->
    <?php if (isset($_GET['success'])): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>
                    <?php
                    switch ($_GET['success']) {
                        case 'created':
                            echo 'Tạo dịch vụ thành công!';
                            break;
                        case 'updated':
                            echo 'Cập nhật dịch vụ thành công!';
                            break;
                        case 'deleted':
                            echo 'Xóa dịch vụ thành công!';
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
                        case 'notfound':
                            echo 'Dịch vụ không tồn tại!';
                            break;
                        case 'validation':
                            echo 'Dữ liệu không hợp lệ!';
                            break;
                        default:
                            echo 'Có lỗi xảy ra!';
                    }
                    ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <!-- Thống kê nhanh -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-concierge-bell text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Tổng dịch vụ</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['total'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Đang hoạt động</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['active'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-times-circle text-red-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Ngừng hoạt động</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['inactive'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-line text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Giá trung bình</p>
                    <p class="text-xl font-bold text-gray-900"><?= number_format($stats['avg_price'] ?? 0, 0, ',', '.') ?>₫</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-crown text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Giá cao nhất</p>
                    <p class="text-xl font-bold text-gray-900"><?= number_format($stats['max_price'] ?? 0, 0, ',', '.') ?>₫</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bộ lọc -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <form method="GET" class="space-y-4">
            <!-- Hàng đầu tiên: 4 cột tìm kiếm -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tìm kiếm</label>
                    <input type="text" name="search" placeholder="Tên dịch vụ..."
                        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                    <select name="trang_thai"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Tất cả</option>
                        <?php
                        $trangThaiList = \HotelBooking\Enums\TrangThaiDichVu::all();
                        foreach ($trangThaiList as $status): ?>
                            <option value="<?= $status ?>" <?= ($_GET['trang_thai'] ?? '') === $status ? 'selected' : '' ?>>
                                <?= \HotelBooking\Enums\TrangThaiDichVu::getLabel($status) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Giá từ</label>
                    <input type="number" name="min_price" placeholder="0"
                        value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Giá đến</label>
                    <input type="number" name="max_price" placeholder="1000000"
                        value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <!-- Hàng thứ hai: Sắp xếp và nút bấm -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sắp xếp</label>
                    <select name="sort"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="ten_dich_vu" <?= ($_GET['sort'] ?? '') === 'ten_dich_vu' ? 'selected' : '' ?>>Tên dịch vụ</option>
                        <option value="gia" <?= ($_GET['sort'] ?? '') === 'gia' ? 'selected' : '' ?>>Giá dịch vụ</option>
                        <option value="ma_dich_vu" <?= ($_GET['sort'] ?? '') === 'ma_dich_vu' ? 'selected' : '' ?>>Mã dịch vụ</option>
                    </select>
                </div>
                <div class="md:col-span-3 flex justify-end items-end space-x-3">
                    <a href="/admin/dich-vu"
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors inline-flex items-center">
                        <i class="fas fa-times mr-2"></i>Xóa lọc
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                        <i class="fas fa-search mr-2"></i>Lọc
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Danh sách dịch vụ -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php if (isNotEmpty($dichVus)): ?>
            <?php foreach ($dichVus as $dichVu): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300">
                    <div class="h-48 bg-gray-200">
                        <?php if (isNotEmpty($dichVu->hinh_anh)): ?>
                            <?php $imageUrl = getFileUrl($dichVu->hinh_anh); ?>
                            <?php if ($imageUrl): ?>
                                <img src="<?= htmlspecialchars($imageUrl) ?>" 
                                     alt="<?= htmlspecialchars($dichVu->ten_dich_vu) ?>"
                                     class="w-full h-full object-cover"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-purple-600" style="display: none;">
                                    <i class="fas fa-concierge-bell text-6xl text-white opacity-80"></i>
                                </div>
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-purple-600">
                                    <i class="fas fa-concierge-bell text-6xl text-white opacity-80"></i>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-purple-600">
                                <i class="fas fa-concierge-bell text-6xl text-white opacity-80"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="p-6">
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                <?= htmlspecialchars($dichVu->ten_dich_vu ?? $dichVu['ten_dich_vu']) ?>
                            </h3>
                            <p class="text-gray-600 text-sm">
                                Mã: <span class="font-medium"><?= htmlspecialchars($dichVu->ma_dich_vu ?? $dichVu['ma_dich_vu']) ?></span>
                            </p>
                        </div>

                        <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600">
                                    <?= number_format($dichVu->gia ?? $dichVu['gia'], 0, ',', '.') ?>₫
                                </div>
                                <div class="text-sm text-gray-500">Giá dịch vụ</div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex space-x-3">
                                <a href="/admin/dich-vu/show?id=<?= $dichVu->ma_dich_vu ?? $dichVu['ma_dich_vu'] ?>" 
                                   class="text-green-600 hover:text-green-800 text-sm font-medium inline-flex items-center">
                                    <i class="fas fa-eye mr-1"></i>Xem
                                </a>
                                <a href="/admin/dich-vu/edit?id=<?= $dichVu->ma_dich_vu ?? $dichVu['ma_dich_vu'] ?>" 
                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium inline-flex items-center">
                                    <i class="fas fa-edit mr-1"></i>Sửa
                                </a>
                            </div>
                            <?php
                            $status = $dichVu->trang_thai ?? \HotelBooking\Enums\TrangThaiDichVu::HOAT_DONG;
                            $statusClass = \HotelBooking\Enums\TrangThaiDichVu::getColor($status);
                            $statusLabel = \HotelBooking\Enums\TrangThaiDichVu::getLabel($status);
                            ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusClass ?>">
                                <?= $statusLabel ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full">
                <div class="text-center py-12 bg-white rounded-xl border border-gray-200">
                    <i class="fas fa-concierge-bell text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Chưa có dịch vụ nào</h3>
                    <p class="text-gray-500 mb-6">Hãy thêm dịch vụ đầu tiên để bắt đầu</p>
                    <a href="/admin/dich-vu/create" 
                       class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Thêm dịch vụ
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
 
 