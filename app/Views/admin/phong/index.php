<?php
$title = 'Quản lý Phòng - Ocean Pearl Hotel';
$pageTitle = 'Quản lý Phòng';
ob_start();
?>

<div class="space-y-6">
    <!-- Header với nút thêm mới -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Quản lý Phòng</h1>
            <p class="text-gray-600 mt-1">Quản lý thông tin phòng nghỉ</p>
        </div>
        <a href="/admin/phong/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Thêm phòng
        </a>
    </div>

    <!-- Thống kê nhanh -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-bed text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Tổng phòng</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $totalRooms ?? 0 ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Phòng trống</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $availableRooms ?? 0 ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-friends text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Đã đặt</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $bookedRooms ?? 0 ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-tools text-red-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Bảo trì</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $maintenanceRooms ?? 0 ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bộ lọc -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tìm kiếm</label>
                <input type="text" name="search" placeholder="Tên phòng, số phòng..." 
                       value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Loại phòng</label>
                <select name="loai_phong" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Tất cả</option>
                    <?php if (!empty($loaiPhongs)): ?>
                        <?php foreach ($loaiPhongs as $loai): ?>
                            <option value="<?= $loai->ma_danh_muc ?>" <?= ($_GET['loai_phong'] ?? '') === $loai->ma_danh_muc ? 'selected' : '' ?>>
                                <?= htmlspecialchars($loai->ten_danh_muc) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                <select name="trang_thai" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Tất cả</option>
                    <option value="Trống" <?= ($_GET['trang_thai'] ?? '') === 'Trống' ? 'selected' : '' ?>>Trống</option>
                    <option value="Đã đặt" <?= ($_GET['trang_thai'] ?? '') === 'Đã đặt' ? 'selected' : '' ?>>Đã đặt</option>
                    <option value="Đang sử dụng" <?= ($_GET['trang_thai'] ?? '') === 'Đang sử dụng' ? 'selected' : '' ?>>Đang sử dụng</option>
                    <option value="Bảo trì" <?= ($_GET['trang_thai'] ?? '') === 'Bảo trì' ? 'selected' : '' ?>>Bảo trì</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sắp xếp</label>
                <select name="sort" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="ten_phong" <?= ($_GET['sort'] ?? '') === 'ten_phong' ? 'selected' : '' ?>>Tên phòng</option>
                    <option value="gia_phong" <?= ($_GET['sort'] ?? '') === 'gia_phong' ? 'selected' : '' ?>>Giá phòng</option>
                    <option value="created_at" <?= ($_GET['sort'] ?? '') === 'created_at' ? 'selected' : '' ?>>Ngày tạo</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                    <i class="fas fa-search mr-2"></i>Lọc
                </button>
            </div>
        </form>
    </div>

    <!-- Danh sách phòng -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php if (!empty($phongs)): ?>
            <?php foreach ($phongs as $phong): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Hình ảnh phòng -->
                    <div class="relative h-48 bg-gray-200">
                        <?php if (!empty($phong->hinh_anh)): ?>
                            <img src="<?= htmlspecialchars($phong->hinh_anh) ?>" alt="<?= htmlspecialchars($phong->ten_phong) ?>" 
                                 class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-bed text-gray-400 text-4xl"></i>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Badge trạng thái -->
                        <?php
                        $statusColors = [
                            'Trống' => 'bg-green-500',
                            'Đã đặt' => 'bg-blue-500',
                            'Đang sử dụng' => 'bg-yellow-500',
                            'Bảo trì' => 'bg-red-500'
                        ];
                        $statusColor = $statusColors[$phong->trang_thai] ?? 'bg-gray-500';
                        ?>
                        <div class="absolute top-3 left-3">
                            <span class="px-2 py-1 text-xs font-semibold text-white rounded-full <?= $statusColor ?>">
                                <?= htmlspecialchars($phong->trang_thai) ?>
                            </span>
                        </div>
                        
                        <!-- Menu dropdown -->
                        <div class="absolute top-3 right-3">
                            <div class="relative group">
                                <button class="p-2 bg-white rounded-full shadow-sm hover:bg-gray-50">
                                    <i class="fas fa-ellipsis-v text-gray-600"></i>
                                </button>
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-10">
                                    <a href="/admin/phong/<?= $phong->ma_phong ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <i class="fas fa-eye mr-2"></i>Xem chi tiết
                                    </a>
                                    <a href="/admin/phong/<?= $phong->ma_phong ?>/edit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <i class="fas fa-edit mr-2"></i>Chỉnh sửa
                                    </a>
                                    <button onclick="changeRoomStatus(<?= $phong->ma_phong ?>)" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <i class="fas fa-sync mr-2"></i>Đổi trạng thái
                                    </button>
                                    <hr class="my-1">
                                    <button onclick="confirmDelete(<?= $phong->ma_phong ?>)" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <i class="fas fa-trash mr-2"></i>Xóa phòng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Thông tin phòng -->
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2"><?= htmlspecialchars($phong->ten_phong) ?></h3>
                        <p class="text-sm text-gray-600 mb-3"><?= htmlspecialchars($phong->loai_phong ?? 'Chưa phân loại') ?></p>
                        
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-lg font-bold text-blue-600">
                                <?= number_format($phong->gia_phong ?? 0) ?>₫
                            </span>
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-users mr-1"></i><?= $phong->so_khach ?? 2 ?> khách
                            </span>
                        </div>
                        
                        <!-- Tiện ích -->
                        <div class="flex flex-wrap gap-1 mb-3">
                            <?php if (!empty($phong->tien_ich)): ?>
                                <?php foreach (explode(',', $phong->tien_ich) as $tienIch): ?>
                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded">
                                        <?= htmlspecialchars(trim($tienIch)) ?>
                                    </span>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex space-x-2">
                            <a href="/admin/phong/<?= $phong->ma_phong ?>" 
                               class="flex-1 bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                Xem chi tiết
                            </a>
                            <a href="/admin/phong/<?= $phong->ma_phong ?>/edit" 
                               class="flex-1 bg-gray-600 text-white text-center py-2 rounded-lg hover:bg-gray-700 transition-colors">
                                Chỉnh sửa
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full">
                <div class="text-center py-12">
                    <i class="fas fa-bed text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Không có phòng nào</h3>
                    <p class="text-gray-600 mb-4">Bắt đầu bằng cách thêm phòng đầu tiên</p>
                    <a href="/admin/phong/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Thêm phòng mới
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if (!empty($pagination)): ?>
        <div class="flex justify-center">
            <div class="flex space-x-2">
                <?php if ($pagination['current_page'] > 1): ?>
                    <a href="?page=<?= $pagination['current_page'] - 1 ?>" class="px-3 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Trước</a>
                <?php endif; ?>
                
                <?php for ($i = max(1, $pagination['current_page'] - 2); $i <= min($pagination['last_page'], $pagination['current_page'] + 2); $i++): ?>
                    <a href="?page=<?= $i ?>" class="px-3 py-2 <?= $i === $pagination['current_page'] ? 'bg-blue-600 text-white' : 'bg-white border border-gray-300 hover:bg-gray-50' ?> rounded-lg">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
                
                <?php if ($pagination['current_page'] < $pagination['last_page']): ?>
                    <a href="?page=<?= $pagination['current_page'] + 1 ?>" class="px-3 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Sau</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
function confirmDelete(id) {
    if (confirm('Bạn có chắc chắn muốn xóa phòng này?')) {
        fetch(`/admin/phong/${id}/delete`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        }).then(response => {
            if (response.ok) {
                location.reload();
            }
        });
    }
}

function changeRoomStatus(id) {
    const statuses = ['Trống', 'Đã đặt', 'Đang sử dụng', 'Bảo trì'];
    const status = prompt('Chọn trạng thái mới:\n1. Trống\n2. Đã đặt\n3. Đang sử dụng\n4. Bảo trì\n\nNhập số (1-4):');
    
    if (status && status >= 1 && status <= 4) {
        const newStatus = statuses[status - 1];
        fetch(`/admin/phong/${id}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ status: newStatus })
        }).then(response => {
            if (response.ok) {
                location.reload();
            }
        });
    }
}
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
