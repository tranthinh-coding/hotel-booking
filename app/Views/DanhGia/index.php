<?php
$title = 'Đánh giá khách hàng - Hotel Ocean';
ob_start();
?>

<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Đánh giá khách hàng</h1>
                <p class="text-gray-600">Xem và quản lý tất cả đánh giá từ khách hàng</p>
            </div>
            <div class="flex items-center space-x-4">
                <?php if (auth_check()): ?>
                    <a href="/danh-gia/create" 
                       class="bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white px-6 py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg">
                        <i class="fas fa-plus mr-2"></i>
                        Viết đánh giá
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="filter_rating" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-star mr-1"></i> Đánh giá
                </label>
                <select id="filter_rating" 
                        name="rating" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <option value="">Tất cả</option>
                    <option value="5" <?= ($_GET['rating'] ?? '') === '5' ? 'selected' : '' ?>>5 sao</option>
                    <option value="4" <?= ($_GET['rating'] ?? '') === '4' ? 'selected' : '' ?>>4 sao</option>
                    <option value="3" <?= ($_GET['rating'] ?? '') === '3' ? 'selected' : '' ?>>3 sao</option>
                    <option value="2" <?= ($_GET['rating'] ?? '') === '2' ? 'selected' : '' ?>>2 sao</option>
                    <option value="1" <?= ($_GET['rating'] ?? '') === '1' ? 'selected' : '' ?>>1 sao</option>
                </select>
            </div>

            <div>
                <label for="filter_type" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-filter mr-1"></i> Loại đánh giá
                </label>
                <select id="filter_type" 
                        name="type" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <option value="">Tất cả</option>
                    <option value="phong" <?= ($_GET['type'] ?? '') === 'phong' ? 'selected' : '' ?>>Phòng</option>
                    <option value="dich_vu" <?= ($_GET['type'] ?? '') === 'dich_vu' ? 'selected' : '' ?>>Dịch vụ</option>
                    <option value="tong_quat" <?= ($_GET['type'] ?? '') === 'tong_quat' ? 'selected' : '' ?>>Tổng quát</option>
                </select>
            </div>

            <div>
                <label for="filter_sort" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-sort mr-1"></i> Sắp xếp
                </label>
                <select id="filter_sort" 
                        name="sort" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <option value="newest" <?= ($_GET['sort'] ?? '') === 'newest' ? 'selected' : '' ?>>Mới nhất</option>
                    <option value="oldest" <?= ($_GET['sort'] ?? '') === 'oldest' ? 'selected' : '' ?>>Cũ nhất</option>
                    <option value="highest" <?= ($_GET['sort'] ?? '') === 'highest' ? 'selected' : '' ?>>Điểm cao nhất</option>
                    <option value="lowest" <?= ($_GET['sort'] ?? '') === 'lowest' ? 'selected' : '' ?>>Điểm thấp nhất</option>
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit" 
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-search mr-2"></i>
                    Lọc
                </button>
            </div>
        </form>
    </div>

    <!-- Reviews Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 text-center">
            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-star text-2xl text-yellow-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800"><?= number_format($avgRating ?? 4.5, 1) ?></h3>
            <p class="text-gray-600">Điểm trung bình</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 text-center">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-comments text-2xl text-blue-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800"><?= number_format($totalReviews ?? count($danhGias ?? [])) ?></h3>
            <p class="text-gray-600">Tổng đánh giá</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-thumbs-up text-2xl text-green-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800"><?= number_format($positiveRate ?? 85) ?>%</h3>
            <p class="text-gray-600">Đánh giá tích cực</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 text-center">
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-calendar text-2xl text-purple-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800"><?= $thisMonthReviews ?? 12 ?></h3>
            <p class="text-gray-600">Đánh giá tháng này</p>
        </div>
    </div>

    <!-- Reviews List -->
    <div class="space-y-6">
        <?php if (!empty($danhGias) && is_array($danhGias)): ?>
            <?php foreach ($danhGias as $danhGia): ?>
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow">
                    <div class="flex items-start space-x-6">
                        <!-- Avatar -->
                        <div class="w-16 h-16 bg-gradient-to-br from-ocean-500 to-seafoam-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-user text-white text-xl"></i>
                        </div>

                        <!-- Review Content -->
                        <div class="flex-1">
                            <!-- Header -->
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800">
                                        <?= htmlspecialchars($danhGia->ho_ten ?? 'Khách hàng') ?>
                                    </h3>
                                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                                        <span>
                                            <i class="fas fa-calendar mr-1"></i>
                                            <?= isset($danhGia->ngay_tao) ? date('d/m/Y', strtotime($danhGia->ngay_tao)) : date('d/m/Y') ?>
                                        </span>
                                        <?php if (!empty($danhGia->loai_danh_gia)): ?>
                                            <span class="px-2 py-1 bg-gray-100 rounded text-xs">
                                                <?= ucfirst(htmlspecialchars($danhGia->loai_danh_gia)) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Rating -->
                                <div class="flex items-center space-x-2">
                                    <div class="flex">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="fas fa-star text-lg <?= $i <= ($danhGia->diem_danh_gia ?? 5) ? 'text-yellow-400' : 'text-gray-300' ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="text-lg font-semibold text-gray-800">
                                        <?= number_format($danhGia->diem_danh_gia ?? 5, 1) ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Review Text -->
                            <div class="mb-4">
                                <p class="text-gray-700 leading-relaxed">
                                    <?= nl2br(htmlspecialchars($danhGia->noi_dung ?? 'Đánh giá tuyệt vời!')) ?>
                                </p>
                            </div>

                            <!-- Review Details -->
                            <?php if (!empty($danhGia->phong_id) || !empty($danhGia->dich_vu_id)): ?>
                                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                    <div class="text-sm text-gray-600">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Đánh giá cho: 
                                        <?php if (!empty($danhGia->phong_id)): ?>
                                            <span class="font-medium">Phòng #<?= htmlspecialchars($danhGia->phong_id) ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($danhGia->dich_vu_id)): ?>
                                            <span class="font-medium">Dịch vụ #<?= htmlspecialchars($danhGia->dich_vu_id) ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Actions -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <?php if (auth_check() && user()->id === ($danhGia->tai_khoan_id ?? null)): ?>
                                        <a href="/danh-gia/<?= $danhGia->id ?>/edit" 
                                           class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                            <i class="fas fa-edit mr-1"></i>
                                            Chỉnh sửa
                                        </a>
                                        <button onclick="deleteReview(<?= $danhGia->id ?>)" 
                                                class="text-red-600 hover:text-red-700 text-sm font-medium">
                                            <i class="fas fa-trash mr-1"></i>
                                            Xóa
                                        </button>
                                    <?php endif; ?>
                                </div>

                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <button class="hover:text-gray-700">
                                        <i class="fas fa-thumbs-up mr-1"></i>
                                        Hữu ích (<?= $danhGia->helpful_count ?? 0 ?>)
                                    </button>
                                    <button class="hover:text-gray-700">
                                        <i class="fas fa-reply mr-1"></i>
                                        Trả lời
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-star text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Chưa có đánh giá nào</h3>
                <p class="text-gray-600 mb-6">Hãy là người đầu tiên đánh giá dịch vụ của chúng tôi!</p>
                <?php if (auth_check()): ?>
                    <a href="/danh-gia/create" 
                       class="bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white px-6 py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg">
                        <i class="fas fa-plus mr-2"></i>
                        Viết đánh giá đầu tiên
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if (!empty($pagination)): ?>
        <div class="mt-8 flex justify-center">
            <nav class="flex items-center space-x-2">
                <?php if ($pagination['current_page'] > 1): ?>
                    <a href="?page=<?= $pagination['current_page'] - 1 ?>" 
                       class="px-3 py-2 text-gray-600 bg-white rounded-lg border hover:bg-gray-50">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                    <a href="?page=<?= $i ?>" 
                       class="px-3 py-2 <?= $i === $pagination['current_page'] ? 'bg-yellow-500 text-white' : 'text-gray-600 bg-white hover:bg-gray-50' ?> rounded-lg border">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                    <a href="?page=<?= $pagination['current_page'] + 1 ?>" 
                       class="px-3 py-2 text-gray-600 bg-white rounded-lg border hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    <?php endif; ?>
</div>

<script>
function deleteReview(id) {
    if (confirm('Bạn có chắc chắn muốn xóa đánh giá này?')) {
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/danh-gia/' + id;
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
    }
}

// Auto-submit filters on change
document.querySelectorAll('select[name="rating"], select[name="type"], select[name="sort"]').forEach(select => {
    select.addEventListener('change', function() {
        this.form.submit();
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
