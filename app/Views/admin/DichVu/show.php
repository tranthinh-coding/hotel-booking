<?php
$title = 'Chi tiết Dịch vụ - Ocean Pearl Hotel Admin';
$pageTitle = 'Chi tiết Dịch vụ';
ob_start();
?>

<div class="space-y-6">
    <!-- Success Message -->
    <?php if (isset($_GET['success'])): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">
                        <?php if ($_GET['success'] === 'updated'): ?>
                            Dịch vụ đã được cập nhật thành công!
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <nav class="text-sm text-gray-500">
                <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
                <span class="mx-2">/</span>
                <a href="/admin/dich-vu" class="hover:text-gray-700">Dịch vụ</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Chi tiết</span>
            </nav>
        </div>
        <div class="flex space-x-3">
            <a href="/admin/dich-vu"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Quay lại
            </a>
            <a href="/admin/dich-vu/edit?id=<?= $dichVu->ma_dich_vu ?>"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class="fas fa-edit mr-2"></i>
                Chỉnh sửa
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Service Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Thông tin cơ bản</h3>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tên dịch vụ</label>
                        <p class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($dichVu->ten_dich_vu ?? '') ?></p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mã dịch vụ</label>
                            <p class="text-gray-900 font-mono"><?= htmlspecialchars($dichVu->ma_dich_vu ?? '') ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Giá dịch vụ</label>
                            <p class="text-2xl font-bold text-blue-600">
                                <?= number_format($dichVu->gia ?? 0, 0, ',', '.') ?>₫
                            </p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Trạng thái</label>
                        <?php
                        $status = $dichVu->trang_thai ?? \HotelBooking\Enums\TrangThaiDichVu::HOAT_DONG;
                        $statusClass = \HotelBooking\Enums\TrangThaiDichVu::getColor($status);
                        $statusLabel = \HotelBooking\Enums\TrangThaiDichVu::getLabel($status);
                        ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?= $statusClass ?>">
                            <?= $statusLabel ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Image -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Hình ảnh dịch vụ</h3>
                </div>
                <div class="p-6">
                    <div class="aspect-w-16 aspect-h-12">
                        <?php if (isNotEmpty($dichVu->hinh_anh)): ?>
                            <?php $imageUrl = getFileUrl($dichVu->hinh_anh); ?>
                            <?php if ($imageUrl): ?>
                                <img src="<?= htmlspecialchars($imageUrl) ?>" 
                                     alt="<?= htmlspecialchars($dichVu->ten_dich_vu) ?>"
                                     class="w-full h-64 object-cover rounded-lg border border-gray-200"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-64 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center" style="display: none;">
                                    <div class="text-center text-white">
                                        <i class="fas fa-concierge-bell text-6xl mb-4 opacity-80"></i>
                                        <p class="text-sm">Ảnh không thể tải</p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="w-full h-64 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <div class="text-center text-white">
                                        <i class="fas fa-concierge-bell text-6xl mb-4 opacity-80"></i>
                                        <p class="text-sm">Ảnh không tồn tại</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="w-full h-64 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <div class="text-center text-white">
                                    <i class="fas fa-concierge-bell text-6xl mb-4 opacity-80"></i>
                                    <p class="text-sm">Chưa có hình ảnh</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3 text-sm text-gray-600">
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-hashtag text-gray-400"></i>
                                <span>ID: <?= $dichVu->ma_dich_vu ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Thao tác nhanh</h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="/admin/dich-vu/edit?id=<?= $dichVu->ma_dich_vu ?>"
                        class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center justify-center">
                        <i class="fas fa-edit mr-2"></i>
                        Chỉnh sửa dịch vụ
                    </a>
                    <a href="/admin/dich-vu"
                        class="w-full bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors inline-flex items-center justify-center">
                        <i class="fas fa-list mr-2"></i>
                        Danh sách dịch vụ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
