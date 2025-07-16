<?php
$title = 'Quản lý Liên hệ - Ocean Pearl Hotel Admin';
$pageTitle = 'Quản lý Liên hệ';
ob_start();
?>

<div class="space-y-6">
    <!-- Success/Error Messages -->
    <?php if (isset($_GET['success'])): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">
                        <?php if ($_GET['success'] === 'replied'): ?>
                            Đã gửi phản hồi thành công!
                        <?php elseif ($_GET['success'] === 'status_updated'): ?>
                            Đã cập nhật trạng thái thành công!
                        <?php elseif ($_GET['success'] === 'closed'): ?>
                            Đã đóng liên hệ thành công!
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">
                        <?php if ($_GET['error'] === 'notfound'): ?>
                            Không tìm thấy liên hệ!
                        <?php elseif ($_GET['error'] === 'missing_id'): ?>
                            Thiếu mã liên hệ!
                        <?php elseif ($_GET['error'] === 'missing_data'): ?>
                            Thiếu dữ liệu bắt buộc!
                        <?php else: ?>
                            Có lỗi xảy ra!
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Breadcrumb -->
    <div class="flex justify-between items-center">
        <div>
            <nav class="text-sm text-gray-500">
                <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Liên hệ</span>
            </nav>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Tổng liên hệ</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['total'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-envelope text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Tin nhắn mới</p>
                    <p class="text-2xl font-bold text-blue-600"><?= $stats['new_messages'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-bell text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Đang xử lý</p>
                    <p class="text-2xl font-bold text-yellow-600"><?= $stats['processing'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Đã phản hồi</p>
                    <p class="text-2xl font-bold text-green-600"><?= $stats['replied'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Hôm nay</p>
                    <p class="text-2xl font-bold text-purple-600"><?= $stats['today_messages'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-day text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tìm kiếm và lọc -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <form method="GET" class="space-y-4">
            <!-- Hàng đầu tiên: Các ô input -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tìm kiếm</label>
                    <input type="text" name="search" placeholder="Tên, email, chủ đề..."
                        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                    <select name="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Tất cả trạng thái</option>
                        <option value="<?= \HotelBooking\Models\LienHe::TRANG_THAI_MOI ?>" <?= ($_GET['status'] ?? '') === \HotelBooking\Models\LienHe::TRANG_THAI_MOI ? 'selected' : '' ?>>Tin nhắn mới</option>
                        <option value="<?= \HotelBooking\Models\LienHe::TRANG_THAI_DANG_XU_LY ?>" <?= ($_GET['status'] ?? '') === \HotelBooking\Models\LienHe::TRANG_THAI_DANG_XU_LY ? 'selected' : '' ?>>Đang xử lý</option>
                        <option value="<?= \HotelBooking\Models\LienHe::TRANG_THAI_DA_PHAN_HOI ?>" <?= ($_GET['status'] ?? '') === \HotelBooking\Models\LienHe::TRANG_THAI_DA_PHAN_HOI ? 'selected' : '' ?>>Đã phản hồi</option>
                        <option value="<?= \HotelBooking\Models\LienHe::TRANG_THAI_DA_DONG ?>" <?= ($_GET['status'] ?? '') === \HotelBooking\Models\LienHe::TRANG_THAI_DA_DONG ? 'selected' : '' ?>>Đã đóng</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ngày gửi</label>
                    <input type="date" name="date"
                        value="<?= htmlspecialchars($_GET['date'] ?? '') ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sắp xếp</label>
                    <select name="sort"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="ngay_gui" <?= ($_GET['sort'] ?? '') === 'ngay_gui' ? 'selected' : '' ?>>Ngày gửi</option>
                        <option value="trang_thai" <?= ($_GET['sort'] ?? '') === 'trang_thai' ? 'selected' : '' ?>>Trạng thái</option>
                        <option value="ho_ten" <?= ($_GET['sort'] ?? '') === 'ho_ten' ? 'selected' : '' ?>>Tên người gửi</option>
                    </select>
                </div>
            </div>
            <!-- Hàng thứ hai: Nút bấm -->
            <div class="flex justify-end space-x-3">
                <a href="/admin/lien-he"
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors inline-flex items-center">
                    <i class="fas fa-times mr-2"></i>Xóa lọc
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                    <i class="fas fa-search mr-2"></i>Lọc
                </button>
            </div>
        </form>
    </div>

    <!-- Bảng dữ liệu -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Danh sách liên hệ</h3>
                <span class="text-sm text-gray-500">
                    <?= count($lienHes ?? []) ?> liên hệ
                </span>
            </div>
        </div>

        <?php if (isNotEmpty($lienHes)): ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Người gửi
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Chủ đề
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Trạng thái
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ngày gửi
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Người phản hồi
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Thao tác
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($lienHes as $lienHe): ?>
                            <?php $lienHe = (object) $lienHe; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full <?= ($lienHe->trang_thai === \HotelBooking\Models\LienHe::TRANG_THAI_MOI) ? 'bg-blue-100' : 'bg-gray-100' ?> flex items-center justify-center">
                                                <i class="fas fa-user <?= ($lienHe->trang_thai === \HotelBooking\Models\LienHe::TRANG_THAI_MOI) ? 'text-blue-600' : 'text-gray-600' ?>"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <?= htmlspecialchars($lienHe->ho_ten) ?>
                                                <?php if ($lienHe->trang_thai === \HotelBooking\Models\LienHe::TRANG_THAI_MOI): ?>
                                                    <span class="ml-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                        Mới
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="text-sm text-gray-500"><?= htmlspecialchars($lienHe->email) ?></div>
                                            <?php if (isNotEmpty($lienHe->so_dien_thoai)): ?>
                                                <div class="text-sm text-gray-500"><?= htmlspecialchars($lienHe->so_dien_thoai) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs">
                                        <div class="font-medium">
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
                                        </div>
                                        <div class="text-gray-500 truncate">
                                            <?= htmlspecialchars(substr($lienHe->noi_dung, 0, 60)) ?><?= strlen($lienHe->noi_dung) > 60 ? '...' : '' ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
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
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $colorClass ?>">
                                        <?= htmlspecialchars($statusLabel) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= date('d/m/Y H:i', strtotime($lienHe->ngay_gui)) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= htmlspecialchars($lienHe->ten_nhan_vien_phan_hoi ?? 'Chưa có') ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="/admin/lien-he/show?id=<?= $lienHe->ma_lien_he ?>" 
                                           class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-eye mr-1"></i>Xem
                                        </a>
                                        <?php if ($lienHe->trang_thai !== \HotelBooking\Models\LienHe::TRANG_THAI_DA_DONG): ?>
                                            <a href="/admin/lien-he/show?id=<?= $lienHe->ma_lien_he ?>" 
                                               class="text-green-600 hover:text-green-900">
                                                <i class="fas fa-reply mr-1"></i>Phản hồi
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-envelope text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Chưa có liên hệ nào</h3>
                <p class="text-gray-500 mb-6">Chưa có khách hàng nào gửi liên hệ</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
