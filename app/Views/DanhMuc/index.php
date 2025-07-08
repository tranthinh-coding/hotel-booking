<?php
$title = 'Quản lý danh mục - Hotel Ocean';
ob_start();
?>

<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Quản lý danh mục</h1>
                <p class="text-gray-600">Quản lý danh mục phòng và dịch vụ</p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/danh-muc/create" 
                   class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-6 py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg">
                    <i class="fas fa-plus mr-2"></i>
                    Thêm danh mục
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 text-center">
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-tags text-2xl text-purple-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800"><?= number_format($totalCategories ?? count($danhMucs ?? [])) ?></h3>
            <p class="text-gray-600">Tổng danh mục</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 text-center">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-bed text-2xl text-blue-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800"><?= number_format($roomCategories ?? 0) ?></h3>
            <p class="text-gray-600">Danh mục phòng</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-concierge-bell text-2xl text-green-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800"><?= number_format($serviceCategories ?? 0) ?></h3>
            <p class="text-gray-600">Danh mục dịch vụ</p>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($danhMucs) && is_array($danhMucs)): ?>
            <?php foreach ($danhMucs as $danhMuc): ?>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all group">
                    <!-- Category Image -->
                    <div class="relative h-48 bg-gradient-to-br from-purple-500 to-pink-500">
                        <?php if (!empty($danhMuc->hinh_anh)): ?>
                            <img src="<?= htmlspecialchars($danhMuc->hinh_anh) ?>" 
                                 alt="<?= htmlspecialchars($danhMuc->ten_danh_muc) ?>"
                                 class="w-full h-full object-cover">
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-30 transition-all"></div>
                        
                        <!-- Category Type Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                <?php
                                $type = $danhMuc->loai_danh_muc ?? 'general';
                                switch ($type) {
                                    case 'phong':
                                        echo 'bg-blue-100 text-blue-800';
                                        break;
                                    case 'dich_vu':
                                        echo 'bg-green-100 text-green-800';
                                        break;
                                    default:
                                        echo 'bg-gray-100 text-gray-800';
                                }
                                ?>">
                                <?php
                                switch ($type) {
                                    case 'phong':
                                        echo 'Phòng';
                                        break;
                                    case 'dich_vu':
                                        echo 'Dịch vụ';
                                        break;
                                    default:
                                        echo 'Tổng quát';
                                }
                                ?>
                            </span>
                        </div>

                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                <?= ($danhMuc->trang_thai ?? 'active') === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                <?= ($danhMuc->trang_thai ?? 'active') === 'active' ? 'Hoạt động' : 'Tạm dừng' ?>
                            </span>
                        </div>

                        <!-- Category Icon -->
                        <div class="absolute bottom-4 left-4">
                            <div class="w-12 h-12 bg-white bg-opacity-20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                <i class="fas fa-<?= htmlspecialchars($danhMuc->icon ?? 'tag') ?> text-white text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Category Content -->
                    <div class="p-6">
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                <?= htmlspecialchars($danhMuc->ten_danh_muc ?? '') ?>
                            </h3>
                            <p class="text-gray-600 text-sm line-clamp-2">
                                <?= htmlspecialchars($danhMuc->mo_ta ?? 'Không có mô tả') ?>
                            </p>
                        </div>

                        <!-- Stats -->
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-6">
                            <div class="flex items-center">
                                <i class="fas fa-calendar mr-1"></i>
                                <?= isset($danhMuc->ngay_tao) ? date('d/m/Y', strtotime($danhMuc->ngay_tao)) : 'N/A' ?>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-sort-numeric-up mr-1"></i>
                                Thứ tự: <?= $danhMuc->thu_tu ?? 0 ?>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <a href="/danh-muc/<?= $danhMuc->id ?>" 
                                   class="text-purple-600 hover:text-purple-700 p-2 rounded-lg hover:bg-purple-50 transition-colors">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/danh-muc/<?= $danhMuc->id ?>/edit" 
                                   class="text-blue-600 hover:text-blue-700 p-2 rounded-lg hover:bg-blue-50 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deleteCategory(<?= $danhMuc->id ?>)" 
                                        class="text-red-600 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>

                            <!-- Usage Count -->
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-link mr-1"></i>
                                <?= $danhMuc->usage_count ?? 0 ?> sử dụng
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Empty State -->
            <div class="col-span-full bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-tags text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Chưa có danh mục nào</h3>
                <p class="text-gray-600 mb-6">Tạo danh mục đầu tiên để phân loại phòng và dịch vụ</p>
                <a href="/danh-muc/create" 
                   class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-6 py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg">
                    <i class="fas fa-plus mr-2"></i>
                    Tạo danh mục đầu tiên
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Add Category Card -->
    <div class="mt-6">
        <a href="/danh-muc/create" 
           class="block bg-gray-50 border-2 border-dashed border-gray-300 rounded-2xl p-12 text-center hover:border-purple-400 hover:bg-purple-50 transition-all group">
            <div class="w-16 h-16 bg-gray-200 group-hover:bg-purple-200 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors">
                <i class="fas fa-plus text-2xl text-gray-400 group-hover:text-purple-600"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-600 group-hover:text-purple-600">Thêm danh mục mới</h3>
            <p class="text-gray-500 mt-2">Tạo danh mục để phân loại phòng và dịch vụ</p>
        </a>
    </div>
</div>

<script>
function deleteCategory(id) {
    if (confirm('Bạn có chắc chắn muốn xóa danh mục này? Thao tác này có thể ảnh hưởng đến các phòng/dịch vụ đang sử dụng danh mục.')) {
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/danh-muc/' + id;
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
    }
}

// Add hover effects
document.querySelectorAll('.group').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-4px)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
