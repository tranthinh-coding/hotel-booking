<?php $title = 'Chi tiết đánh giá'; ?>
<?php include_once __DIR__ . '/../layouts/app.php'; ?>

<?php ob_start(); ?>

<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm text-slate-600">
            <li><a href="/" class="hover:text-cyan-600 transition-colors">Trang chủ</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="/danh-gia" class="hover:text-cyan-600 transition-colors">Đánh giá</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-slate-800 font-medium">Chi tiết đánh giá</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 mb-2">Chi tiết đánh giá</h1>
            <p class="text-slate-600">Xem thông tin chi tiết đánh giá của khách hàng</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 mt-4 sm:mt-0">
            <a href="/danh-gia/edit/<?= $danhGia['id'] ?? 1 ?>" 
               class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Chỉnh sửa
            </a>
            <a href="/danh-gia" 
               class="inline-flex items-center px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Quay lại
            </a>
        </div>
    </div>

    <!-- Review Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-slate-200 hover:shadow-xl transition-shadow duration-300">
        <!-- Header with Rating -->
        <div class="bg-gradient-to-r from-cyan-50 to-blue-50 p-6 border-b border-slate-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                        <?= substr($danhGia['ten_khach_hang'] ?? 'KH', 0, 1) ?>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800"><?= htmlspecialchars($danhGia['ten_khach_hang'] ?? 'Khách hàng') ?></h2>
                        <p class="text-slate-600"><?= htmlspecialchars($danhGia['email'] ?? 'khachhang@example.com') ?></p>
                    </div>
                </div>
                <div class="mt-4 sm:mt-0 flex items-center space-x-2">
                    <div class="flex items-center">
                        <?php 
                        $rating = $danhGia['so_sao'] ?? 5;
                        for ($i = 1; $i <= 5; $i++): 
                        ?>
                            <svg class="w-6 h-6 <?= $i <= $rating ? 'text-yellow-400' : 'text-slate-300' ?>" 
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <span class="text-2xl font-bold text-slate-800"><?= $rating ?>/5</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Review Details -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800 mb-3">Thông tin đánh giá</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <span class="w-2 h-2 bg-cyan-500 rounded-full mt-2 flex-shrink-0"></span>
                                <div>
                                    <span class="text-sm font-medium text-slate-600">Phòng đánh giá:</span>
                                    <p class="text-slate-800 font-medium"><?= htmlspecialchars($danhGia['ten_phong'] ?? 'Phòng Deluxe') ?></p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <span class="w-2 h-2 bg-cyan-500 rounded-full mt-2 flex-shrink-0"></span>
                                <div>
                                    <span class="text-sm font-medium text-slate-600">Ngày đánh giá:</span>
                                    <p class="text-slate-800"><?= date('d/m/Y H:i', strtotime($danhGia['ngay_tao'] ?? 'now')) ?></p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <span class="w-2 h-2 bg-cyan-500 rounded-full mt-2 flex-shrink-0"></span>
                                <div>
                                    <span class="text-sm font-medium text-slate-600">Trạng thái:</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= ($danhGia['trang_thai'] ?? 1) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                        <?= ($danhGia['trang_thai'] ?? 1) ? 'Đã duyệt' : 'Chờ duyệt' ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Review Content -->
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800 mb-3">Nội dung đánh giá</h3>
                        <div class="bg-slate-50 rounded-lg p-4 border-l-4 border-cyan-500">
                            <p class="text-slate-700 leading-relaxed italic">
                                "<?= htmlspecialchars($danhGia['noi_dung'] ?? 'Phòng rất sạch sẽ, thoải mái. Nhân viên phục vụ rất tận tình. Tôi sẽ quay lại lần sau.') ?>"
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="space-y-6">
                    <!-- Rating Breakdown -->
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800 mb-3">Chi tiết đánh giá</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-slate-600">Sạch sẽ</span>
                                <div class="flex items-center space-x-2">
                                    <div class="w-24 bg-slate-200 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 h-2 rounded-full" style="width: <?= ($danhGia['sach_se'] ?? 5) * 20 ?>%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-slate-800"><?= $danhGia['sach_se'] ?? 5 ?></span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-slate-600">Tiện nghi</span>
                                <div class="flex items-center space-x-2">
                                    <div class="w-24 bg-slate-200 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 h-2 rounded-full" style="width: <?= ($danhGia['tien_nghi'] ?? 4) * 20 ?>%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-slate-800"><?= $danhGia['tien_nghi'] ?? 4 ?></span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-slate-600">Dịch vụ</span>
                                <div class="flex items-center space-x-2">
                                    <div class="w-24 bg-slate-200 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 h-2 rounded-full" style="width: <?= ($danhGia['dich_vu'] ?? 5) * 20 ?>%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-slate-800"><?= $danhGia['dich_vu'] ?? 5 ?></span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-slate-600">Vị trí</span>
                                <div class="flex items-center space-x-2">
                                    <div class="w-24 bg-slate-200 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 h-2 rounded-full" style="width: <?= ($danhGia['vi_tri'] ?? 4) * 20 ?>%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-slate-800"><?= $danhGia['vi_tri'] ?? 4 ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Management Actions -->
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800 mb-3">Hành động quản lý</h3>
                        <div class="space-y-3">
                            <?php if (!($danhGia['trang_thai'] ?? 1)): ?>
                            <button class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Duyệt đánh giá
                            </button>
                            <?php endif; ?>
                            <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Phản hồi đánh giá
                            </button>
                            <button class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Ẩn đánh giá
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Response Section -->
    <div class="mt-8 bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
        <div class="bg-gradient-to-r from-slate-50 to-slate-100 p-4 border-b border-slate-200">
            <h3 class="text-lg font-semibold text-slate-800">Phản hồi từ khách sạn</h3>
        </div>
        <div class="p-6">
            <?php if (isset($danhGia['phan_hoi']) && $danhGia['phan_hoi']): ?>
                <div class="bg-blue-50 rounded-lg p-4 border-l-4 border-blue-500">
                    <p class="text-slate-700 leading-relaxed"><?= htmlspecialchars($danhGia['phan_hoi']) ?></p>
                    <p class="text-sm text-slate-500 mt-2">
                        Phản hồi vào <?= date('d/m/Y H:i', strtotime($danhGia['ngay_phan_hoi'] ?? 'now')) ?>
                    </p>
                </div>
            <?php else: ?>
                <form class="space-y-4">
                    <textarea rows="4" 
                              class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent resize-none"
                              placeholder="Nhập phản hồi từ khách sạn..."></textarea>
                    <button type="submit" 
                            class="bg-cyan-500 hover:bg-cyan-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Gửi phản hồi
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth animations
    const elements = document.querySelectorAll('.bg-white');
    elements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        setTimeout(() => {
            el.style.transition = 'all 0.6s ease';
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, index * 200);
    });

    // Rating bar animations
    const ratingBars = document.querySelectorAll('.bg-gradient-to-r.from-cyan-500.to-blue-500');
    ratingBars.forEach((bar, index) => {
        const width = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.transition = 'width 1s ease-out';
            bar.style.width = width;
        }, 1000 + index * 200);
    });
});
</script>

<?php $content = ob_get_clean(); ?>
<?php echo $content; ?>
