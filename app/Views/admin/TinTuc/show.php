<?php
$title = 'Chi tiết Tin tức - Ocean Pearl Hotel Admin';
$pageTitle = 'Chi tiết Tin tức';
ob_start();
?>

<div class="space-y-6">
    <!-- Success Message -->
    <?php if (isset($_GET['success'])): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">
                        <?php if ($_GET['success'] === 'updated'): ?>
                            Tin tức đã được cập nhật thành công!
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <nav class="text-sm text-gray-500">
                <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
                <span class="mx-2">/</span>
                <a href="/admin/tin-tuc" class="hover:text-gray-700">Tin tức</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Chi tiết</span>
            </nav>
        </div>
        <div class="flex space-x-3">
            <a href="/admin/tin-tuc"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Quay lại
            </a>
            <a href="/admin/tin-tuc/edit?id=<?= $tinTuc->ma_tin_tuc ?>"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class="fas fa-edit mr-2"></i>
                Chỉnh sửa
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Article Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Article Header -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($tinTuc->tieu_de ?? '') ?></h1>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-calendar text-gray-400"></i>
                                    <span><?= date('d/m/Y H:i', strtotime($tinTuc->ngay_dang ?? 'now')) ?></span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-eye text-gray-400"></i>
                                    <span><?= number_format($tinTuc->luot_xem ?? 0) ?> lượt xem</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-hashtag text-gray-400"></i>
                                    <span>ID: <?= $tinTuc->ma_tin_tuc ?></span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <?php
                            $status = $tinTuc->trang_thai ?? 'draft';
                            $statusClass = $status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
                            $statusLabel = $status === 'published' ? 'Đã xuất bản' : 'Bản nháp';
                            ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?= $statusClass ?>">
                                <i class="fas fa-circle text-xs mr-1"></i>
                                <?= $statusLabel ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Article Image -->
            <?php if (isNotEmpty($tinTuc->anh_dai_dien)): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Hình ảnh đại diện</h3>
                    </div>
                    <div class="p-6">
                        <?php $imageUrl = getFileUrl($tinTuc->anh_dai_dien); ?>
                        <?php if ($imageUrl): ?>
                            <img src="<?= htmlspecialchars($imageUrl) ?>" 
                                 alt="<?= htmlspecialchars($tinTuc->tieu_de) ?>"
                                 class="w-full max-h-96 object-cover rounded-lg border border-gray-200"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="w-full h-64 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center" style="display: none;">
                                <div class="text-center text-white">
                                    <i class="fas fa-newspaper text-6xl mb-4 opacity-80"></i>
                                    <p class="text-sm">Ảnh không thể tải</p>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="w-full h-64 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <div class="text-center text-white">
                                    <i class="fas fa-newspaper text-6xl mb-4 opacity-80"></i>
                                    <p class="text-sm">Ảnh không tồn tại</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Article Content -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Nội dung bài viết</h3>
                </div>
                <div class="p-6">
                    <div class="prose max-w-none">
                        <?= nl2br(htmlspecialchars($tinTuc->noi_dung ?? '')) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Article Stats -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Thống kê</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-eye text-blue-600"></i>
                            <span class="text-sm font-medium text-gray-700">Lượt xem</span>
                        </div>
                        <span class="text-lg font-bold text-blue-600"><?= number_format($tinTuc->luot_xem ?? 0) ?></span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar text-gray-600"></i>
                            <span class="text-sm font-medium text-gray-700">Ngày đăng</span>
                        </div>
                        <span class="text-sm font-medium text-gray-900"><?= date('d/m/Y', strtotime($tinTuc->ngay_dang ?? 'now')) ?></span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-user text-gray-600"></i>
                            <span class="text-sm font-medium text-gray-700">Tác giả</span>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Admin</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-file-alt text-gray-600"></i>
                            <span class="text-sm font-medium text-gray-700">Độ dài</span>
                        </div>
                        <span class="text-sm font-medium text-gray-900"><?= number_format(strlen($tinTuc->noi_dung ?? '')) ?> ký tự</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Thao tác nhanh</h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="/admin/tin-tuc/edit?id=<?= $tinTuc->ma_tin_tuc ?>"
                        class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center justify-center">
                        <i class="fas fa-edit mr-2"></i>
                        Chỉnh sửa tin tức
                    </a>
                    
                    <?php if (($tinTuc->trang_thai ?? '') === 'draft'): ?>
                        <button onclick="changeStatus('published')"
                            class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors inline-flex items-center justify-center">
                            <i class="fas fa-check mr-2"></i>
                            Xuất bản ngay
                        </button>
                    <?php else: ?>
                        <button onclick="changeStatus('draft')"
                            class="w-full bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors inline-flex items-center justify-center">
                            <i class="fas fa-eye-slash mr-2"></i>
                            Chuyển về nháp
                        </button>
                    <?php endif; ?>
                    
                    <a href="/admin/tin-tuc"
                        class="w-full bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors inline-flex items-center justify-center">
                        <i class="fas fa-list mr-2"></i>
                        Danh sách tin tức
                    </a>
                </div>
            </div>

            <!-- SEO Info -->
            <?php if (isNotEmpty($tinTuc->anh_dai_dien)): ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-search mr-2 text-green-600"></i>
                        SEO Preview
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <div>
                            <h4 class="text-blue-600 text-lg font-medium hover:underline cursor-pointer line-clamp-2">
                                <?= htmlspecialchars($tinTuc->tieu_de ?? '') ?>
                            </h4>
                        </div>
                        <div class="text-green-600 text-sm">
                            <?= $_SERVER['HTTP_HOST'] ?>/tin-tuc/<?= $tinTuc->ma_tin_tuc ?>
                        </div>
                        <div class="text-gray-600 text-sm line-clamp-3">
                            <?= htmlspecialchars(substr($tinTuc->noi_dung ?? '', 0, 160)) ?>...
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function changeStatus(newStatus) {
    const statusText = newStatus === 'published' ? 'xuất bản' : 'chuyển về nháp';
    const confirmText = `Bạn có chắc chắn muốn ${statusText} tin tức này?`;
    
    if (confirm(confirmText)) {
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/tin-tuc/update';
        
        // Add hidden inputs
        const inputs = [
            { name: 'id', value: '<?= $tinTuc->ma_tin_tuc ?>' },
            { name: 'tieu_de', value: '<?= htmlspecialchars($tinTuc->tieu_de ?? '') ?>' },
            { name: 'noi_dung', value: '<?= htmlspecialchars($tinTuc->noi_dung ?? '') ?>' },
            { name: 'trang_thai', value: newStatus }
        ];
        
        inputs.forEach(input => {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = input.name;
            hiddenInput.value = input.value;
            form.appendChild(hiddenInput);
        });
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

<style>
.prose {
    line-height: 1.6;
    color: #374151;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
