<?php
$title = 'Quản lý Tin tức - Ocean Pearl Hotel Admin';
$pageTitle = 'Quản lý Tin tức';
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
                            Tin tức đã được tạo thành công!
                        <?php elseif ($_GET['success'] === 'updated'): ?>
                            Tin tức đã được cập nhật thành công!
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <nav class="text-sm text-gray-500">
                <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Tin tức</span>
            </nav>
        </div>
        <div>
            <a href="/admin/tin-tuc/create"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Thêm tin tức
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Tổng tin tức</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['total'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Đã xuất bản</p>
                    <p class="text-2xl font-bold text-green-600"><?= $stats['published'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Bản nháp</p>
                    <p class="text-2xl font-bold text-yellow-600"><?= $stats['draft'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-edit text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Tổng lượt xem</p>
                    <p class="text-2xl font-bold text-purple-600"><?= number_format($stats['total_views'] ?? 0) ?></p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-eye text-purple-600 text-xl"></i>
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
                    <input type="text" name="search" placeholder="Tiêu đề tin tức..."
                        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                    <select name="trang_thai"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Tất cả</option>
                        <option value="published" <?= ($_GET['trang_thai'] ?? '') === 'published' ? 'selected' : '' ?>>Đã xuất bản</option>
                        <option value="draft" <?= ($_GET['trang_thai'] ?? '') === 'draft' ? 'selected' : '' ?>>Bản nháp</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sắp xếp</label>
                    <select name="sort"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="ngay_dang" <?= ($_GET['sort'] ?? '') === 'ngay_dang' ? 'selected' : '' ?>>Ngày đăng</option>
                        <option value="tieu_de" <?= ($_GET['sort'] ?? '') === 'tieu_de' ? 'selected' : '' ?>>Tiêu đề</option>
                        <option value="luot_xem" <?= ($_GET['sort'] ?? '') === 'luot_xem' ? 'selected' : '' ?>>Lượt xem</option>
                    </select>
                </div>
            </div>
            <!-- Hàng thứ hai: Nút bấm -->
            <div class="flex justify-end space-x-3">
                <a href="/admin/tin-tuc"
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

    <!-- Articles List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Danh sách tin tức</h3>
                <span class="text-sm text-gray-500">
                    <?= count($tinTucs ?? []) ?> tin tức
                </span>
            </div>
        </div>

        <?php if (isNotEmpty($tinTucs)): ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tin tức</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lượt xem</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày đăng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($tinTucs as $tinTuc): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            <?php if (isNotEmpty($tinTuc->anh_dai_dien)): ?>
                                                <?php $imageUrl = getFileUrl($tinTuc->anh_dai_dien); ?>
                                                <?php if ($imageUrl): ?>
                                                    <img src="<?= htmlspecialchars($imageUrl) ?>" 
                                                         alt="<?= htmlspecialchars($tinTuc->tieu_de) ?>"
                                                         class="w-16 h-12 object-cover rounded-lg border border-gray-200">
                                                <?php else: ?>
                                                    <div class="w-16 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                                        <i class="fas fa-image text-gray-400"></i>
                                                    </div>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <div class="w-16 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-newspaper text-gray-400"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-medium text-gray-900 line-clamp-2">
                                                <?= htmlspecialchars($tinTuc->tieu_de ?? '') ?>
                                            </h4>
                                            <p class="text-sm text-gray-500 line-clamp-2 mt-1">
                                                <?= htmlspecialchars(mb_substr($tinTuc->noi_dung ?? '', 0, 100, 'UTF-8')) ?>...
                                            </p>
                                            <div class="flex items-center space-x-2 mt-2 text-xs text-gray-400">
                                                <span>ID: <?= $tinTuc->ma_tin_tuc ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                    $status = $tinTuc->trang_thai ?? 'draft';
                                    $statusClass = $status === 'published' 
                                        ? 'bg-green-100 text-green-800' 
                                        : 'bg-yellow-100 text-yellow-800';
                                    $statusLabel = $status === 'published' ? 'Đã xuất bản' : 'Bản nháp';
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusClass ?>">
                                        <?= $statusLabel ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-eye text-gray-400"></i>
                                        <span><?= number_format($tinTuc->luot_xem ?? 0) ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= date('d/m/Y', strtotime($tinTuc->ngay_dang ?? 'now')) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="/admin/tin-tuc/show?id=<?= $tinTuc->ma_tin_tuc ?? $tinTuc['ma_tin_tuc'] ?>" 
                                           class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-eye mr-1"></i>Xem
                                        </a>
                                        <a href="/admin/tin-tuc/edit?id=<?= $tinTuc->ma_tin_tuc ?? $tinTuc['ma_tin_tuc'] ?>" 
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
                    <i class="fas fa-newspaper text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Chưa có tin tức nào</h3>
                <p class="text-gray-500 mb-6">Bắt đầu tạo tin tức đầu tiên cho website của bạn</p>
                <a href="/admin/tin-tuc/create" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Tạo tin tức mới
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
