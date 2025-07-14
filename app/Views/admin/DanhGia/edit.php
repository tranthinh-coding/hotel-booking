<?php
$title = 'Chỉnh sửa Đánh giá - Ocean Pearl Hotel Admin';
$pageTitle = 'Chỉnh sửa Đánh giá';
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
            <span class="text-gray-900">Chỉnh sửa</span>
        </nav>
    </div>

    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Chỉnh sửa Đánh giá</h1>
            <p class="text-gray-600 mt-1">Cập nhật thông tin đánh giá của khách hàng</p>
        </div>
        <a href="/admin/danh-gia" 
           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>Quay lại
        </a>
    </div>

    <!-- Error/Success Messages -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span><?= $_SESSION['error'] ?></span>
            </div>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Edit Form -->
    <form action="/admin/danh-gia/update?id=<?= $danhGia->ma_danh_gia ?>" method="POST" class="space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column - Review Details -->
            <div class="space-y-6">
                <!-- Review Information Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">Thông tin đánh giá</h3>
                    <div class="space-y-4">
                        <!-- Review ID (Read-only) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mã đánh giá</label>
                            <input type="text" value="<?= htmlspecialchars($danhGia->ma_danh_gia) ?>" 
                                   class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 text-gray-500" 
                                   readonly>
                        </div>

                        <!-- Customer ID (Read-only) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mã khách hàng</label>
                            <input type="text" value="<?= htmlspecialchars($danhGia->ma_tai_khoan) ?>" 
                                   class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 text-gray-500" 
                                   readonly>
                        </div>

                        <!-- Room ID (Read-only) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mã phòng</label>
                            <input type="text" value="<?= htmlspecialchars($danhGia->ma_phong) ?>" 
                                   class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 text-gray-500" 
                                   readonly>
                        </div>

                        <!-- Rating -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Điểm đánh giá *</label>
                            <select name="diem_so" required 
                                    class="mt-1 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Chọn điểm đánh giá</option>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <option value="<?= $i ?>" <?= ($danhGia->diem_so == $i) ? 'selected' : '' ?>>
                                        <?= $i ?> sao
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <!-- Review Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ngày đánh giá</label>
                            <input type="text" 
                                   value="<?= date('d/m/Y H:i', strtotime($danhGia->ngay_danh_gia ?? 'now')) ?>" 
                                   class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 text-gray-500" 
                                   readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Review Content -->
            <div class="space-y-6">
                <!-- Review Content Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">Nội dung đánh giá</h3>
                    <div class="space-y-4">
                        <!-- Content -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nội dung</label>
                            <textarea name="noi_dung" rows="8" 
                                      placeholder="Nhập nội dung đánh giá..."
                                      class="mt-1 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"><?= htmlspecialchars($danhGia->noi_dung ?? '') ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Current Rating Preview -->
                <div class="bg-yellow-50 rounded-xl border border-yellow-200 p-6">
                    <h3 class="text-lg font-medium text-yellow-800 mb-4">Xem trước đánh giá</h3>
                    <div class="text-center">
                        <div class="flex justify-center items-center mb-3">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star text-2xl <?= $i <= $danhGia->diem_so ? 'text-yellow-400' : 'text-gray-300' ?> mr-1"></i>
                            <?php endfor; ?>
                            <span class="ml-2 text-xl font-bold text-gray-700"><?= $danhGia->diem_so ?>/5</span>
                        </div>
                        <div class="text-gray-600 italic">
                            <?php if (isNotEmpty($danhGia->noi_dung)): ?>
                                "<?= htmlspecialchars(substr($danhGia->noi_dung, 0, 100)) ?><?= strlen($danhGia->noi_dung) > 100 ? '...' : '' ?>"
                            <?php else: ?>
                                Chưa có nội dung đánh giá
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
            <a href="/admin/danh-gia" 
               class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                Hủy bỏ
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class="fas fa-save mr-2"></i>Cập nhật
            </button>
        </div>
    </form>
</div>

<script>
// Real-time rating preview
document.querySelector('select[name="diem_so"]').addEventListener('change', function() {
    const rating = parseInt(this.value);
    const stars = document.querySelectorAll('.bg-yellow-50 .fas.fa-star');
    const ratingText = document.querySelector('.bg-yellow-50 .text-xl.font-bold');
    
    stars.forEach((star, index) => {
        if (index < rating) {
            star.className = 'fas fa-star text-2xl text-yellow-400 mr-1';
        } else {
            star.className = 'fas fa-star text-2xl text-gray-300 mr-1';
        }
    });
    
    if (ratingText) {
        ratingText.textContent = rating + '/5';
    }
});

// Real-time content preview
document.querySelector('textarea[name="noi_dung"]').addEventListener('input', function() {
    const content = this.value;
    const preview = document.querySelector('.bg-yellow-50 .text-gray-600.italic');
    
    if (content.trim()) {
        const truncated = content.length > 100 ? content.substring(0, 100) + '...' : content;
        preview.textContent = '"' + truncated + '"';
    } else {
        preview.textContent = 'Chưa có nội dung đánh giá';
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
