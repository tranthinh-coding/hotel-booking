<?php
$title = 'Chi tiết Liên hệ - Ocean Pearl Hotel Admin';
$pageTitle = 'Chi tiết Liên hệ';
ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <div>
        <nav class="text-sm text-gray-500">
            <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="/admin/lien-he" class="hover:text-gray-700">Liên hệ</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">Chi tiết</span>
        </nav>
    </div>

    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Chi tiết Liên hệ #<?= $lienHe->ma_lien_he ?></h1>
            <p class="text-gray-600 mt-1">Thông tin chi tiết liên hệ từ khách hàng</p>
        </div>
        <div class="flex space-x-3">
            <a href="/admin/lien-he" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Quay lại
            </a>
            <?php if ($lienHe->trang_thai !== \HotelBooking\Models\LienHe::TRANG_THAI_DA_DONG): ?>
                <form method="POST" action="/admin/lien-he/close" class="inline">
                    <input type="hidden" name="id" value="<?= $lienHe->ma_lien_he ?>">
                    <button type="submit" 
                            onclick="return confirm('Bạn có chắc chắn muốn đóng liên hệ này?')"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors inline-flex items-center">
                        <i class="fas fa-times mr-2"></i>Đóng liên hệ
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <?php if (isset($_GET['success'])): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>
                    <?php if ($_GET['success'] === 'replied'): ?>
                        Đã gửi phản hồi thành công!
                    <?php elseif ($_GET['success'] === 'status_updated'): ?>
                        Đã cập nhật trạng thái thành công!
                    <?php endif; ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span>
                    <?php if ($_GET['error'] === 'reply_failed'): ?>
                        Gửi phản hồi thất bại!
                    <?php elseif ($_GET['error'] === 'status_failed'): ?>
                        Cập nhật trạng thái thất bại!
                    <?php else: ?>
                        Có lỗi xảy ra!
                    <?php endif; ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Contact Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Contact Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Thông tin liên hệ</h3>
                    <?php 
                    $statusColor = \HotelBooking\Models\LienHe::getStatusColor($lienHe->trang_thai);
                    $statusLabel = \HotelBooking\Models\LienHe::getStatusLabel($lienHe->trang_thai);
                    
                    $statusClasses = [
                        'blue' => 'bg-blue-100 text-blue-800',
                        'yellow' => 'bg-yellow-100 text-yellow-800',
                        'green' => 'bg-green-100 text-green-800',
                        'gray' => 'bg-gray-100 text-gray-800'
                    ];
                    $colorClass = $statusClasses[$statusColor] ?? 'bg-gray-100 text-gray-800';
                    ?>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?= $colorClass ?>">
                        <?= htmlspecialchars($statusLabel) ?>
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900"><?= htmlspecialchars($lienHe->ho_ten) ?></h4>
                                <p class="text-gray-500">Khách hàng</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-gray-400 w-5"></i>
                                <span class="ml-3 text-gray-700"><?= htmlspecialchars($lienHe->email) ?></span>
                            </div>
                            <?php if (isNotEmpty($lienHe->so_dien_thoai)): ?>
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-gray-400 w-5"></i>
                                    <span class="ml-3 text-gray-700"><?= htmlspecialchars($lienHe->so_dien_thoai) ?></span>
                                </div>
                            <?php endif; ?>
                            <div class="flex items-center">
                                <i class="fas fa-calendar text-gray-400 w-5"></i>
                                <span class="ml-3 text-gray-700"><?= date('d/m/Y H:i', strtotime($lienHe->ngay_gui)) ?></span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h5 class="font-medium text-gray-900 mb-2">Chủ đề</h5>
                            <p class="text-gray-700">
                                <?php 
                                // Chuyển đổi chủ đề từ code sang text
                                $chuDeMap = [
                                    'dat_phong' => '🏨 Đặt phòng',
                                    'dich_vu' => '🛎️ Dịch vụ', 
                                    'khieu_nai' => '⚠️ Khiếu nại',
                                    'gop_y' => '💡 Góp ý',
                                    'su_kien' => '🎉 Tổ chức sự kiện',
                                    'khac' => '📝 Khác'
                                ];
                                echo htmlspecialchars($chuDeMap[$lienHe->chu_de] ?? $lienHe->chu_de);
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message Content -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Nội dung tin nhắn</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="text-gray-700 leading-relaxed whitespace-pre-wrap"><?= htmlspecialchars($lienHe->noi_dung) ?></div>
                </div>
            </div>

            <!-- Reply Section -->
            <?php if ($lienHe->trang_thai !== \HotelBooking\Models\LienHe::TRANG_THAI_DA_DONG): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Phản hồi</h3>
                    
                    <?php if (isNotEmpty($lienHe->noi_dung_phan_hoi)): ?>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-check-circle text-green-600 mr-2"></i>
                                <span class="font-medium text-green-800">Đã phản hồi</span>
                                <?php if (isNotEmpty($lienHe->ngay_phan_hoi)): ?>
                                    <span class="ml-2 text-sm text-green-600">
                                        - <?= date('d/m/Y H:i', strtotime($lienHe->ngay_phan_hoi)) ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="text-green-700 whitespace-pre-wrap"><?= htmlspecialchars($lienHe->noi_dung_phan_hoi) ?></div>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/admin/lien-he/reply">
                        <input type="hidden" name="id" value="<?= $lienHe->ma_lien_he ?>">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <?= isNotEmpty($lienHe->noi_dung_phan_hoi) ? 'Phản hồi bổ sung' : 'Nội dung phản hồi' ?>
                            </label>
                            <textarea name="noi_dung_phan_hoi" rows="6" required
                                      placeholder="Nhập nội dung phản hồi..."
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                        <button type="submit" 
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                            <i class="fas fa-paper-plane mr-2"></i>
                            <?= isNotEmpty($lienHe->noi_dung_phan_hoi) ? 'Gửi phản hồi bổ sung' : 'Gửi phản hồi' ?>
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>

        <!-- Right Column - Status & Actions -->
        <div class="space-y-6">
            <!-- Status Update -->
            <?php if ($lienHe->trang_thai !== \HotelBooking\Models\LienHe::TRANG_THAI_DA_DONG): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Cập nhật trạng thái</h3>
                    <form method="POST" action="/admin/lien-he/update-status">
                        <input type="hidden" name="id" value="<?= $lienHe->ma_lien_he ?>">
                        <div class="mb-4">
                            <select name="status" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="<?= \HotelBooking\Models\LienHe::TRANG_THAI_MOI ?>" <?= $lienHe->trang_thai === \HotelBooking\Models\LienHe::TRANG_THAI_MOI ? 'selected' : '' ?>>Tin nhắn mới</option>
                                <option value="<?= \HotelBooking\Models\LienHe::TRANG_THAI_DANG_XU_LY ?>" <?= $lienHe->trang_thai === \HotelBooking\Models\LienHe::TRANG_THAI_DANG_XU_LY ? 'selected' : '' ?>>Đang xử lý</option>
                                <option value="<?= \HotelBooking\Models\LienHe::TRANG_THAI_DA_PHAN_HOI ?>" <?= $lienHe->trang_thai === \HotelBooking\Models\LienHe::TRANG_THAI_DA_PHAN_HOI ? 'selected' : '' ?>>Đã phản hồi</option>
                                <option value="<?= \HotelBooking\Models\LienHe::TRANG_THAI_DA_DONG ?>" <?= $lienHe->trang_thai === \HotelBooking\Models\LienHe::TRANG_THAI_DA_DONG ? 'selected' : '' ?>>Đã đóng</option>
                            </select>
                        </div>
                        <button type="submit" 
                                class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors inline-flex items-center justify-center">
                            <i class="fas fa-sync mr-2"></i>Cập nhật trạng thái
                        </button>
                    </form>
                </div>
            <?php endif; ?>

            <!-- Contact Info Summary -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Tóm tắt</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mã liên hệ</label>
                        <p class="mt-1 text-sm text-gray-900">#<?= htmlspecialchars($lienHe->ma_lien_he) ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Thời gian xử lý</label>
                        <p class="mt-1 text-sm text-gray-900">
                            <?php
                            $now = new DateTime();
                            $sent = new DateTime($lienHe->ngay_gui);
                            $diff = $now->diff($sent);
                            
                            if ($diff->days > 0) {
                                echo $diff->days . ' ngày trước';
                            } elseif ($diff->h > 0) {
                                echo $diff->h . ' giờ trước';
                            } else {
                                echo $diff->i . ' phút trước';
                            }
                            ?>
                        </p>
                    </div>
                    <?php if (isNotEmpty($lienHe->ngay_phan_hoi)): ?>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Thời gian phản hồi</label>
                            <p class="mt-1 text-sm text-gray-900">
                                <?= date('d/m/Y H:i', strtotime($lienHe->ngay_phan_hoi)) ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-blue-50 rounded-xl border border-blue-200 p-6">
                <h3 class="text-lg font-medium text-blue-900 mb-4">Liên kết nhanh</h3>
                <div class="space-y-3">
                    <a href="mailto:<?= htmlspecialchars($lienHe->email) ?>" 
                       class="block w-full text-center bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition-colors">
                        <i class="fas fa-envelope mr-2"></i>Gửi email trực tiếp
                    </a>
                    <?php if (isNotEmpty($lienHe->so_dien_thoai)): ?>
                        <a href="tel:<?= htmlspecialchars($lienHe->so_dien_thoai) ?>" 
                           class="block w-full text-center bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition-colors">
                            <i class="fas fa-phone mr-2"></i>Gọi điện thoại
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
