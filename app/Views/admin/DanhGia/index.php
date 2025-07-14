<?php
$title = 'Quản lý Đánh giá - Ocean Pearl Hotel Admin';
$pageTitle = 'Quản lý Đánh giá';
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
                        <?php if ($_GET['success'] === 'created'): ?>
                            Đánh giá đã được tạo thành công!
                        <?php elseif ($_GET['success'] === 'updated'): ?>
                            Đánh giá đã được cập nhật thành công!
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
                            Không tìm thấy đánh giá!
                        <?php elseif ($_GET['error'] === 'missing_id'): ?>
                            Thiếu mã đánh giá!
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
                <span class="text-gray-900">Đánh giá</span>
            </nav>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Tổng đánh giá</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['total'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-comments text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Điểm trung bình</p>
                    <p class="text-2xl font-bold text-yellow-600"><?= $stats['average_rating'] ?? 0 ?>/5</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-star text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">5 sao</p>
                    <p class="text-2xl font-bold text-green-600"><?= $stats['five_star'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-heart text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">4 sao</p>
                    <p class="text-2xl font-bold text-blue-600"><?= $stats['four_star'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-thumbs-up text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tìm kiếm và lọc -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <form method="GET" class="space-y-4">
            <!-- Hàng đầu tiên: Các ô input -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tìm kiếm</label>
                    <input type="text" name="search" placeholder="Nội dung đánh giá..."
                        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Điểm số</label>
                    <select name="rating"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Tất cả</option>
                        <option value="5" <?= ($_GET['rating'] ?? '') === '5' ? 'selected' : '' ?>>5 sao</option>
                        <option value="4" <?= ($_GET['rating'] ?? '') === '4' ? 'selected' : '' ?>>4 sao</option>
                        <option value="3" <?= ($_GET['rating'] ?? '') === '3' ? 'selected' : '' ?>>3 sao</option>
                        <option value="2" <?= ($_GET['rating'] ?? '') === '2' ? 'selected' : '' ?>>2 sao</option>
                        <option value="1" <?= ($_GET['rating'] ?? '') === '1' ? 'selected' : '' ?>>1 sao</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sắp xếp</label>
                    <select name="sort"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="ngay_danh_gia" <?= ($_GET['sort'] ?? '') === 'ngay_danh_gia' ? 'selected' : '' ?>>Ngày đánh giá</option>
                        <option value="diem_so" <?= ($_GET['sort'] ?? '') === 'diem_so' ? 'selected' : '' ?>>Điểm số</option>
                        <option value="noi_dung" <?= ($_GET['sort'] ?? '') === 'noi_dung' ? 'selected' : '' ?>>Nội dung</option>
                    </select>
                </div>
            </div>
            <!-- Hàng thứ hai: Nút bấm -->
            <div class="flex justify-end space-x-3">
                <a href="/admin/danh-gia"
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
                <h3 class="text-lg font-semibold text-gray-900">Danh sách đánh giá</h3>
                <span class="text-sm text-gray-500">
                    <?= count($danhGias ?? []) ?> đánh giá
                </span>
            </div>
        </div>

        <?php if (isNotEmpty($danhGias)): ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Khách hàng
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Phòng
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Điểm số
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nội dung
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ngày đánh giá
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Thao tác
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($danhGias as $danhGia): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <i class="fas fa-user text-blue-600"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                Khách hàng #<?= $danhGia->ma_tai_khoan ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Phòng #<?= $danhGia->ma_phong ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="fas fa-star <?= $i <= $danhGia->diem_so ? 'text-yellow-400' : 'text-gray-300' ?>"></i>
                                        <?php endfor; ?>
                                        <span class="ml-2 text-sm text-gray-600">(<?= $danhGia->diem_so ?>)</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs truncate">
                                        <?= htmlspecialchars($danhGia->noi_dung ?? '') ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= date('d/m/Y', strtotime($danhGia->ngay_danh_gia ?? 'now')) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="/admin/danh-gia/show?id=<?= $danhGia->ma_danh_gia ?>" 
                                           class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-eye mr-1"></i>Xem
                                        </a>
                                        <a href="/admin/danh-gia/edit?id=<?= $danhGia->ma_danh_gia ?>" 
                                           class="text-green-600 hover:text-green-900">
                                            <i class="fas fa-edit mr-1"></i>Sửa
                                        </a>
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
                    <i class="fas fa-comments text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Chưa có đánh giá nào</h3>
                <p class="text-gray-500 mb-6">Chưa có khách hàng nào đánh giá dịch vụ</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
