<?php
$title = $dichVu->ten_dich_vu . ' - Ocean Pearl Hotel';
$pageTitle = $dichVu->ten_dich_vu;
ob_start();
?>

<div class="max-w-4xl mx-auto space-y-8">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-600">
        <ol class="flex items-center space-x-2">
            <li><a href="/" class="hover:text-blue-600">Trang chủ</a></li>
            <li class="text-gray-400">/</li>
            <li><a href="/dich-vu" class="hover:text-blue-600">Dịch vụ</a></li>
            <li class="text-gray-400">/</li>
            <li class="text-gray-900"><?= htmlspecialchars($dichVu->ten_dich_vu) ?></li>
        </ol>
    </nav>

    <!-- Service Header -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <?php if (!empty($dichVu->hinh_anh)): ?>
            <div class="h-64 bg-cover bg-center" style="background-image: url('<?= htmlspecialchars($dichVu->hinh_anh) ?>');">
                <div class="h-full bg-black bg-opacity-40 flex items-end">
                    <div class="p-6 text-white">
                        <h1 class="text-3xl font-bold"><?= htmlspecialchars($dichVu->ten_dich_vu) ?></h1>
                        <p class="text-xl mt-2"><?= number_format($dichVu->gia, 0, ',', '.') ?> VNĐ</p>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="h-64 bg-gradient-to-r from-blue-600 to-purple-600 flex items-center justify-center">
                <div class="text-center text-white">
                    <h1 class="text-3xl font-bold"><?= htmlspecialchars($dichVu->ten_dich_vu) ?></h1>
                    <p class="text-xl mt-2"><?= number_format($dichVu->gia, 0, ',', '.') ?> VNĐ</p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Service Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Description -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Mô tả dịch vụ</h2>
                <?php if (!empty($dichVu->mo_ta)): ?>
                    <div class="prose prose-gray max-w-none">
                        <?= nl2br(htmlspecialchars($dichVu->mo_ta)) ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-600">Chưa có mô tả chi tiết cho dịch vụ này.</p>
                <?php endif; ?>
            </div>

            <!-- Features -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Đặc điểm nổi bật</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-blue-600"></i>
                        </div>
                        <span class="text-gray-700">Chất lượng cao</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-clock text-blue-600"></i>
                        </div>
                        <span class="text-gray-700">Phục vụ 24/7</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-blue-600"></i>
                        </div>
                        <span class="text-gray-700">Đội ngũ chuyên nghiệp</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-star text-blue-600"></i>
                        </div>
                        <span class="text-gray-700">Đánh giá cao</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Booking Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Đặt dịch vụ</h3>
                <div class="space-y-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600">
                            <?= number_format($dichVu->gia, 0, ',', '.') ?> VNĐ
                        </div>
                        <div class="text-sm text-gray-600">/ lần sử dụng</div>
                    </div>
                    
                    <?php if (auth_check()): ?>
                        <button class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            Đặt dịch vụ
                        </button>
                    <?php else: ?>
                        <a href="/login" class="block w-full bg-gray-600 text-white py-3 px-4 rounded-lg hover:bg-gray-700 transition-colors font-medium text-center">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Đăng nhập để đặt
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Liên hệ</h3>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-phone text-blue-600"></i>
                        <span class="text-gray-700">+84 123 456 789</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-blue-600"></i>
                        <span class="text-gray-700">info@oceanpearl.com</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-map-marker-alt text-blue-600"></i>
                        <span class="text-gray-700">123 Đường ABC, TP.HCM</span>
                    </div>
                </div>
            </div>

            <!-- Related Services -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Dịch vụ khác</h3>
                <div class="space-y-3">
                    <a href="/dich-vu" class="block p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="text-sm font-medium text-gray-800">Xem tất cả dịch vụ</div>
                        <div class="text-xs text-gray-600">Khám phá thêm nhiều dịch vụ khác</div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="text-center">
        <a href="/dich-vu" class="inline-flex items-center space-x-2 text-blue-600 hover:text-blue-700 transition-colors">
            <i class="fas fa-arrow-left"></i>
            <span>Quay lại danh sách dịch vụ</span>
        </a>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
