<?php
$title = 'Chi tiết Đánh giá - Ocean Pearl Hotel Admin';
$pageTitle = 'Chi tiết Đánh giá';
ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <div>
        <nav class="text-sm text-gray-500">
            <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="/admin/danh-gia" class="hover:text-gray-700">Đánh giá</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">Chi tiết</span>
        </nav>
    </div>

    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Chi tiết Đánh giá</h1>
            <p class="text-gray-600 mt-1">Thông tin chi tiết đánh giá của khách hàng</p>
        </div>
        <div class="flex space-x-3">
            <a href="/admin/danh-gia"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Quay lại
            </a>
        </div>
    </div>

    <!-- Review Information Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Review Details -->
            <div class="space-y-6">
                <div class="text-center">
                    <div class="w-24 h-24 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-star text-yellow-600 text-3xl"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Đánh giá #<?= $danhGia->ma_danh_gia ?></h2>
                    <!-- Rating Stars -->
                    <div class="flex justify-center items-center mt-3">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i
                                class="fas fa-star text-2xl <?= $i <= $danhGia->diem_danh_gia ? 'text-yellow-400' : 'text-gray-300' ?> mr-1"></i>
                        <?php endfor; ?>
                        <span class="ml-2 text-xl font-bold text-gray-700"><?= $danhGia->diem_danh_gia ?>/5</span>
                    </div>
                </div>

                <!-- Review Content -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Nội dung đánh giá</h3>
                    <div class="text-gray-700 leading-relaxed">
                        <?php if (isNotEmpty($danhGia->noi_dung)): ?>
                            <p class="italic">"<?= htmlspecialchars($danhGia->noi_dung) ?>"</p>
                        <?php else: ?>
                            <p class="text-gray-500 italic">Không có nội dung đánh giá.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Review Details -->
            <div class="space-y-6">
                <!-- Customer Info -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Thông tin khách hàng</h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-user text-gray-400 w-5"></i>
                            <span class="ml-3 text-gray-700">Mã khách hàng: #<?= $danhGia->ma_khach_hang ?></span>
                        </div>
                        <a href="/admin/tai-khoan/show?id=<?= $danhGia->ma_khach_hang ?>"
                            class="text-blue-600 hover:text-blue-900 mt-2">
                            Xem chi tiết khách hàng
                        </a>
                    </div>
                </div>

                <!-- Room Info -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Thông tin phòng</h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-bed text-gray-400 w-5"></i>
                            <span class="ml-3 text-gray-700">Mã phòng: #<?= $danhGia->ma_phong ?></span>
                        </div>
                        <a href="/admin/phong/show?id=<?= $danhGia->ma_phong ?>"
                            class="text-blue-600 hover:text-blue-900 mt-2">
                            Xem chi tiết phòng
                        </a>
                    </div>
                </div>

                <!-- Review Info -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Thông tin đánh giá</h3>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ngày đánh giá</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    <?= date('d/m/Y H:i', strtotime($danhGia->ngay_danh_gia ?? 'now')) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>