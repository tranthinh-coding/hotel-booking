<?php
$title = 'Lịch sử đánh giá - Ocean Pearl Hotel';
ob_start();
?>

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-teal-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-teal-600 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-bold text-white">Đánh giá của tôi</h1>
            <p class="text-blue-100 mt-2">Xem lại các đánh giá bạn đã đưa ra</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Navigation -->
        <div class="bg-white rounded-lg shadow-sm p-1 mb-8">
            <div class="flex flex-wrap gap-2">
                <a href="/tai-khoan" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <i class="fas fa-tachometer-alt mr-2"></i>Tổng quan
                </a>
                <a href="/tai-khoan/lich-su-dat-phong" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <i class="fas fa-calendar-alt mr-2"></i>Lịch sử đặt phòng
                </a>
                <a href="/tai-khoan/lich-su-danh-gia"
                    class="px-4 py-2 bg-blue-100 text-blue-700 rounded-md font-medium">
                    <i class="fas fa-star mr-2"></i>Đánh giá của tôi
                </a>
                <a href="/profile" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <i class="fas fa-edit mr-2"></i>Chỉnh sửa hồ sơ
                </a>
            </div>
        </div>

        <!-- Reviews List -->
        <?php if (empty($reviews)): ?>
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-star text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Chưa có đánh giá nào</h3>
                <p class="text-gray-500 mb-6">Bạn chưa đưa ra đánh giá nào. Hãy đặt phòng và trải nghiệm dịch vụ để có thể
                    đánh giá!</p>
                <a href="/booking/checkout"
                    class="inline-flex items-center bg-gradient-to-r from-blue-600 to-teal-600 text-white px-6 py-3 rounded-lg font-medium hover:from-blue-700 hover:to-teal-700 transition-all">
                    <i class="fas fa-plus mr-2"></i>
                    Đặt phòng ngay
                </a>
            </div>
        <?php else: ?>
            <div class="space-y-6">
                <?php foreach ($reviews as $review): ?>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <!-- Review Header -->
                        <div class="p-6 border-b border-gray-100">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-star text-yellow-500 text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            <?= safe_htmlspecialchars($review->ten_phong) ?>
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            <?= safe_htmlspecialchars($review->loai_phong) ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 lg:mt-0 flex items-center space-x-4">
                                    <!-- Star Rating Display -->
                                    <div class="flex items-center">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i
                                                class="fas fa-star <?= $i <= $review->diem_so ? 'text-yellow-400' : 'text-gray-300' ?> text-sm"></i>
                                        <?php endfor; ?>
                                        <span class="ml-2 text-sm font-medium text-gray-700"><?= $review->diem_so ?>/5</span>
                                    </div>

                                    <span class="text-sm text-gray-500">
                                        <?= date('d/m/Y', strtotime($review->ngay_tao)) ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Review Content -->
                        <div class="p-6">
                            <div class="prose max-w-none">
                                <p class="text-gray-700 leading-relaxed">
                                    <?= safe_htmlspecialchars($review->noi_dung) ?>
                                </p>
                            </div>

                            <!-- Review Stats -->
                            <div class="mt-6 pt-6 border-t border-gray-100">
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center space-x-4">
                                        <span class="flex items-center">
                                            <i class="fas fa-clock mr-1"></i>
                                            Đánh giá vào <?= date('H:i d/m/Y', strtotime($review->ngay_tao)) ?>
                                        </span>
                                        <?php if (isNotEmpty($review->ngay_cap_nhat) && $review->ngay_cap_nhat !== $review->ngay_tao): ?>
                                            <span class="flex items-center">
                                                <i class="fas fa-edit mr-1"></i>
                                                Cập nhật <?= date('d/m/Y', strtotime($review->ngay_cap_nhat)) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex items-center space-x-2">
                                        <button
                                            onclick="editReview(<?= $review->ma_danh_gia ?>, <?= $review->diem_so ?>, '<?= addslashes($review->noi_dung) ?>')"
                                            class="text-blue-600 hover:text-blue-800 font-medium">
                                            <i class="fas fa-edit mr-1"></i>
                                            Sửa
                                        </button>
                                        <span class="text-gray-300">|</span>
                                        <button onclick="deleteReview(<?= $review->ma_danh_gia ?>)"
                                            class="text-red-600 hover:text-red-800 font-medium">
                                            <i class="fas fa-trash mr-1"></i>
                                            Xóa
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Summary Stats -->
            <div class="bg-white rounded-xl shadow-lg p-6 mt-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Thống kê đánh giá</h3>
                <?php
                $totalReviews = count($reviews);
                $averageRating = $totalReviews > 0 ? array_sum(array_column($reviews, 'diem_so')) / $totalReviews : 0;
                $ratingCounts = array_count_values(array_column($reviews, 'diem_so'));
                ?>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-600"><?= $totalReviews ?></div>
                        <div class="text-sm text-gray-500">Tổng đánh giá</div>
                    </div>

                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-500"><?= number_format($averageRating, 1) ?></div>
                        <div class="text-sm text-gray-500">Điểm trung bình</div>
                    </div>

                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-600">
                            <?= isset($ratingCounts[5]) ? $ratingCounts[5] : 0 ?>
                        </div>
                        <div class="text-sm text-gray-500">Đánh giá 5 sao</div>
                    </div>
                </div>

                <!-- Rating Distribution -->
                <div class="mt-6">
                    <h4 class="font-medium text-gray-700 mb-3">Phân phối điểm</h4>
                    <div class="space-y-2">
                        <?php for ($star = 5; $star >= 1; $star--): ?>
                            <?php
                            $count = isset($ratingCounts[$star]) ? $ratingCounts[$star] : 0;
                            $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                            ?>
                            <div class="flex items-center text-sm">
                                <span class="w-8"><?= $star ?> sao</span>
                                <div class="flex-1 mx-3 bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-400 h-2 rounded-full" style="width: <?= $percentage ?>%"></div>
                                </div>
                                <span class="w-8 text-right"><?= $count ?></span>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Edit Review Modal -->
<div id="editReviewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Chỉnh sửa đánh giá</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="editReviewForm" action="/tai-khoan/cap-nhat-danh-gia" method="POST">
                    <input type="hidden" id="edit_ma_danh_gia" name="ma_danh_gia">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Điểm đánh giá</label>
                        <div class="flex space-x-2">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <button type="button" class="edit-star-btn text-2xl text-gray-300 hover:text-yellow-400"
                                    data-rating="<?= $i ?>">
                                    <i class="fas fa-star"></i>
                                </button>
                            <?php endfor; ?>
                        </div>
                        <input type="hidden" id="edit_diem_so" name="diem_so" required>
                    </div>

                    <div class="mb-6">
                        <label for="edit_noi_dung" class="block text-sm font-medium text-gray-700 mb-2">Nội dung đánh
                            giá</label>
                        <textarea id="edit_noi_dung" name="noi_dung" rows="4" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>

                    <div class="flex space-x-3">
                        <button type="button" onclick="closeEditModal()"
                            class="flex-1 bg-gray-200 text-gray-700 py-2 px-4 rounded-lg font-medium hover:bg-gray-300 transition-colors">
                            Hủy
                        </button>
                        <button type="submit"
                            class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                            Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function editReview(maDanhGia, diemSo, noiDung) {
        document.getElementById('edit_ma_danh_gia').value = maDanhGia;
        document.getElementById('edit_diem_so').value = diemSo;
        document.getElementById('edit_noi_dung').value = noiDung;

        // Set stars
        document.querySelectorAll('.edit-star-btn').forEach((s, i) => {
            if (i < diemSo) {
                s.classList.remove('text-gray-300');
                s.classList.add('text-yellow-400');
            } else {
                s.classList.remove('text-yellow-400');
                s.classList.add('text-gray-300');
            }
        });

        document.getElementById('editReviewModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editReviewModal').classList.add('hidden');
    }

    function deleteReview(maDanhGia) {
        if (confirm('Bạn có chắc chắn muốn xóa đánh giá này?')) {
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/tai-khoan/xoa-danh-gia';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ma_danh_gia';
            input.value = maDanhGia;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Edit star rating
    document.querySelectorAll('.edit-star-btn').forEach((star, index) => {
        star.addEventListener('click', function () {
            const rating = this.dataset.rating;
            document.getElementById('edit_diem_so').value = rating;

            // Update visual stars
            document.querySelectorAll('.edit-star-btn').forEach((s, i) => {
                if (i < rating) {
                    s.classList.remove('text-gray-300');
                    s.classList.add('text-yellow-400');
                } else {
                    s.classList.remove('text-yellow-400');
                    s.classList.add('text-gray-300');
                }
            });
        });
    });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>