<?php $title = 'Chi tiết danh mục'; ?>
<?php include_once __DIR__ . '/../layouts/app.php'; ?>

<?php ob_start(); ?>

<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm text-slate-600">
            <li><a href="/" class="hover:text-cyan-600 transition-colors">Trang chủ</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="/danh-muc" class="hover:text-cyan-600 transition-colors">Danh mục</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-slate-800 font-medium">Chi tiết danh mục</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 mb-2">Chi tiết danh mục</h1>
            <p class="text-slate-600">Xem thông tin chi tiết danh mục sản phẩm/dịch vụ</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 mt-4 sm:mt-0">
            <a href="/danh-muc/edit/<?= $danhMuc['id'] ?? 1 ?>" 
               class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Chỉnh sửa
            </a>
            <a href="/danh-muc" 
               class="inline-flex items-center px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Quay lại
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="xl:col-span-2 space-y-6">
            <!-- Category Info Card -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-cyan-50 to-blue-50 p-6 border-b border-slate-200">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                            <?= substr($danhMuc['ten_danh_muc'] ?? 'DM', 0, 2) ?>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800"><?= htmlspecialchars($danhMuc['ten_danh_muc'] ?? 'Danh mục phòng') ?></h2>
                            <p class="text-slate-600"><?= htmlspecialchars($danhMuc['slug'] ?? 'danh-muc-phong') ?></p>
                            <div class="flex items-center mt-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= ($danhMuc['trang_thai'] ?? 1) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                    <?= ($danhMuc['trang_thai'] ?? 1) ? 'Hoạt động' : 'Vô hiệu hóa' ?>
                                </span>
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Loại: <?= ucfirst($danhMuc['loai'] ?? 'phong') ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">ID danh mục</label>
                                <p class="text-slate-800 font-medium">#<?= $danhMuc['id'] ?? 1 ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Tên danh mục</label>
                                <p class="text-slate-800 font-medium"><?= htmlspecialchars($danhMuc['ten_danh_muc'] ?? 'Danh mục phòng') ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Slug URL</label>
                                <p class="text-slate-800"><?= htmlspecialchars($danhMuc['slug'] ?? 'danh-muc-phong') ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Thứ tự hiển thị</label>
                                <p class="text-slate-800"><?= $danhMuc['thu_tu'] ?? 1 ?></p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Loại danh mục</label>
                                <p class="text-slate-800"><?= ucfirst($danhMuc['loai'] ?? 'phong') ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Danh mục cha</label>
                                <p class="text-slate-800"><?= $danhMuc['danh_muc_cha_id'] ? 'Có (#' . $danhMuc['danh_muc_cha_id'] . ')' : 'Không có' ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Ngày tạo</label>
                                <p class="text-slate-800"><?= date('d/m/Y H:i', strtotime($danhMuc['ngay_tao'] ?? 'now')) ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Cập nhật cuối</label>
                                <p class="text-slate-800"><?= date('d/m/Y H:i', strtotime($danhMuc['ngay_cap_nhat'] ?? 'now')) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Card -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-50 to-green-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Mô tả danh mục</h3>
                </div>
                <div class="p-6">
                    <?php if (!empty($danhMuc['mo_ta'])): ?>
                        <div class="prose max-w-none text-slate-700">
                            <p><?= nl2br(htmlspecialchars($danhMuc['mo_ta'])) ?></p>
                        </div>
                    <?php else: ?>
                        <p class="text-slate-500 italic">Chưa có mô tả cho danh mục này.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- SEO Info Card -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Thông tin SEO</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1">Meta Title</label>
                            <p class="text-slate-800"><?= htmlspecialchars($danhMuc['meta_title'] ?? $danhMuc['ten_danh_muc'] ?? 'Danh mục phòng') ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1">Meta Description</label>
                            <p class="text-slate-800"><?= htmlspecialchars($danhMuc['meta_description'] ?? 'Mô tả danh mục phòng khách sạn chất lượng cao') ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1">Meta Keywords</label>
                            <p class="text-slate-800"><?= htmlspecialchars($danhMuc['meta_keywords'] ?? 'phòng, khách sạn, booking') ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Items -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-50 to-red-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Sản phẩm trong danh mục</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Sample products -->
                        <?php 
                        $sampleProducts = [
                            ['id' => 1, 'ten' => 'Phòng Deluxe', 'gia' => '1,500,000₫'],
                            ['id' => 2, 'ten' => 'Phòng Premium', 'gia' => '2,000,000₫'],
                            ['id' => 3, 'ten' => 'Phòng VIP', 'gia' => '3,500,000₫']
                        ];
                        foreach ($sampleProducts as $product): ?>
                        <div class="border border-slate-200 rounded-lg p-3 hover:border-cyan-300 transition-colors">
                            <div class="w-full h-24 bg-gradient-to-br from-cyan-100 to-blue-100 rounded-lg mb-2 flex items-center justify-center">
                                <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21l4-4 4 4"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13h.01"></path>
                                </svg>
                            </div>
                            <h4 class="font-medium text-slate-800 text-sm"><?= $product['ten'] ?></h4>
                            <p class="text-cyan-600 font-semibold text-sm"><?= $product['gia'] ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Hành động nhanh</h3>
                </div>
                <div class="p-6 space-y-3">
                    <button class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Kích hoạt danh mục
                    </button>
                    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Tạo danh mục con
                    </button>
                    <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Sao chép danh mục
                    </button>
                    <button class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Xóa danh mục
                    </button>
                </div>
            </div>

            <!-- Category Stats -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-cyan-50 to-blue-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Thống kê danh mục</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Tổng sản phẩm</span>
                        <span class="text-lg font-bold text-cyan-600">25</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Sản phẩm hoạt động</span>
                        <span class="text-lg font-bold text-green-600">22</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Sản phẩm ẩn</span>
                        <span class="text-lg font-bold text-red-600">3</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Danh mục con</span>
                        <span class="text-lg font-bold text-purple-600">4</span>
                    </div>
                </div>
            </div>

            <!-- Category Tree -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-50 to-green-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Cây danh mục</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center text-cyan-600 font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            </svg>
                            <?= htmlspecialchars($danhMuc['ten_danh_muc'] ?? 'Danh mục phòng') ?>
                        </div>
                        <div class="ml-6 space-y-1">
                            <div class="flex items-center text-slate-600">
                                <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                Phòng Standard
                            </div>
                            <div class="flex items-center text-slate-600">
                                <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                Phòng Deluxe
                            </div>
                            <div class="flex items-center text-slate-600">
                                <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                Phòng Premium
                            </div>
                            <div class="flex items-center text-slate-600">
                                <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                Phòng VIP
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl border border-blue-200 p-6">
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Hoạt động gần đây</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div>
                            <p class="text-slate-800">Thêm sản phẩm mới</p>
                            <p class="text-slate-500 text-xs">2 giờ trước</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div>
                            <p class="text-slate-800">Cập nhật mô tả</p>
                            <p class="text-slate-500 text-xs">1 ngày trước</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div>
                            <p class="text-slate-800">Thay đổi thứ tự</p>
                            <p class="text-slate-500 text-xs">3 ngày trước</p>
                        </div>
                    </div>
                </div>
            </div>
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

    // Quick action buttons
    const actionButtons = document.querySelectorAll('button[class*="bg-"]');
    actionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.textContent.trim();
            if (confirm(`Bạn có chắc chắn muốn ${action.toLowerCase()}?`)) {
                // Add loading state
                const originalText = this.innerHTML;
                this.innerHTML = '<span class="flex items-center justify-center"><svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Đang xử lý...</span>';
                this.disabled = true;
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                    alert(`${action} thành công!`);
                }, 2000);
            }
        });
    });

    // Product card hover effects
    const productCards = document.querySelectorAll('.border.border-slate-200.rounded-lg');
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
            this.style.transition = 'all 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });
});
</script>

<?php $content = ob_get_clean(); ?>
<?php echo $content; ?>
