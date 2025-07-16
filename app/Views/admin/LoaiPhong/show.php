<?php
$title = 'Chi tiết Loại phòng - Ocean Pearl Hotel Admin';
$pageTitle = 'Chi tiết Loại phòng';
ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <div class="flex justify-between items-center">
        <nav class="text-sm text-gray-500">
            <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="/admin/loai-phong" class="hover:text-gray-700">Quản lý Loại phòng</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">Chi tiết</span>
        </nav>
        <div class="flex space-x-3">
            <a href="/admin/loai-phong/edit?id=<?= $loaiPhong->ma_loai_phong ?>"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class="fas fa-edit mr-2"></i>
                Chỉnh sửa
            </a>
            <a href="/admin/loai-phong"
               class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Quay lại
            </a>
        </div>
    </div>

    <!-- Thông báo -->
    <?php if (isset($_GET['success'])): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>
                    <?php
                    switch ($_GET['success']) {
                        case 'updated':
                            echo 'Cập nhật thông tin loại phòng thành công!';
                            break;
                        case 'room_removed':
                            echo 'Xóa phòng khỏi loại phòng thành công!';
                            break;
                        case 'room_added':
                            echo 'Thêm phòng vào loại phòng thành công!';
                            break;
                        default:
                            echo 'Thao tác thành công!';
                    }
                    ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <span>
                    <?php
                    switch ($_GET['error']) {
                        case 'room_not_found':
                            echo 'Không tìm thấy phòng!';
                            break;
                        case 'operation_failed':
                            echo 'Thao tác thất bại! Vui lòng thử lại.';
                            break;
                        default:
                            echo 'Có lỗi xảy ra!';
                    }
                    ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <!-- Thống kê tổng quan -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-bed text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Tổng phòng</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['total'] ?? 0 ?></p>
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
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['available'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-broom text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Đang dọn dẹp</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['cleaning'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-tools text-orange-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Bảo trì</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['maintenance'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-power-off text-red-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Ngừng hoạt động</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['deactivated'] ?? 0 ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Thông tin cơ bản -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-900"><?= htmlspecialchars($loaiPhong->ten) ?></h2>
                <div class="flex items-center space-x-4">
                    <?php 
                    $trangThai = $loaiPhong->trang_thai ?? 'hoat_dong';
                    $statusColor = $trangThai === 'hoat_dong' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                    $statusLabel = $trangThai === 'hoat_dong' ? 'Hoạt động' : 'Ngừng hoạt động';
                    ?>
                    <span class="px-3 py-1 text-sm font-medium rounded-full <?= $statusColor ?>">
                        <?= $statusLabel ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Thông tin chi tiết -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Thông tin chi tiết</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Mã loại phòng:</span>
                            <span class="font-medium text-gray-900">#<?= $loaiPhong->ma_loai_phong ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tên loại phòng:</span>
                            <span class="font-medium text-gray-900"><?= htmlspecialchars($loaiPhong->ten) ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tổng số phòng:</span>
                            <span class="font-medium text-gray-900"><?= $totalRooms ?> phòng</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Trạng thái:</span>
                            <span class="font-medium text-gray-900"><?= $statusLabel ?></span>
                        </div>
                    </div>
                </div>

                <!-- Mô tả -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Mô tả</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-700 leading-relaxed">
                            <?= htmlspecialchars($loaiPhong->mo_ta ?: 'Chưa có mô tả cho loại phòng này.') ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Hình ảnh -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Hình ảnh</h3>
                <?php if (!isEmpty($loaiPhong->hinh_anh)): ?>
                    <div class="relative">
                        <img src="<?= htmlspecialchars($loaiPhong->hinh_anh) ?>" 
                             alt="Hình ảnh loại phòng" 
                             class="w-full h-64 object-cover rounded-lg"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center" style="display: none;">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-center py-12 text-gray-500 bg-gray-50 rounded-lg">
                        <i class="fas fa-image text-4xl mb-3"></i>
                        <p>Chưa có hình ảnh cho loại phòng này</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Danh sách phòng -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">
                    Danh sách phòng (<?= $totalRooms ?> phòng)
                </h3>
                <button onclick="openAddRoomModal()"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Thêm phòng
                </button>
            </div>
        </div>

        <div class="p-6">
            <?php if (isNotEmpty($rooms['data'])): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($rooms['data'] as $phong): ?>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="font-semibold text-gray-900"><?= htmlspecialchars($phong->ten_phong) ?></h4>
                                    <p class="text-sm text-gray-600">Phòng #<?= $phong->ma_phong ?></p>
                                    <p class="text-sm font-medium text-green-600"><?= number_format($phong->gia) ?> VNĐ</p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="/admin/phong/show?id=<?= $phong->ma_phong ?>"
                                       class="text-blue-600 hover:text-blue-800 text-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button onclick="confirmRemoveRoom(<?= $phong->ma_phong ?>, '<?= htmlspecialchars($phong->ten_phong) ?>')"
                                            class="text-red-600 hover:text-red-800 text-sm">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <?php
                            $statusColors = [
                                \HotelBooking\Enums\TrangThaiPhong::CON_TRONG => 'bg-green-100 text-green-800',
                                \HotelBooking\Enums\TrangThaiPhong::DANG_DON_DEP => 'bg-blue-100 text-blue-800',
                                \HotelBooking\Enums\TrangThaiPhong::BAO_TRI => 'bg-red-100 text-red-800',
                                \HotelBooking\Enums\TrangThaiPhong::NGUNG_HOAT_DONG => 'bg-gray-100 text-gray-800'
                            ];
                            $statusColor = $statusColors[$phong->trang_thai] ?? 'bg-gray-100 text-gray-800';
                            ?>
                            <span class="px-2 py-1 text-xs font-medium rounded-full <?= $statusColor ?>">
                                <?= \HotelBooking\Enums\TrangThaiPhong::getLabel($phong->trang_thai) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Phân trang -->
                <?php if ($rooms['last_page'] > 1): ?>
                    <div class="flex justify-center items-center space-x-2 mt-6">
                        <?php if ($rooms['current_page'] > 1): ?>
                            <a href="?id=<?= $loaiPhong->ma_loai_phong ?>&page=<?= $rooms['current_page'] - 1 ?>"
                               class="px-3 py-2 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $rooms['last_page']; $i++): ?>
                            <?php if ($i == $rooms['current_page']): ?>
                                <span class="px-3 py-2 text-sm bg-blue-600 text-white rounded"><?= $i ?></span>
                            <?php else: ?>
                                <a href="?id=<?= $loaiPhong->ma_loai_phong ?>&page=<?= $i ?>"
                                   class="px-3 py-2 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300"><?= $i ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php if ($rooms['current_page'] < $rooms['last_page']): ?>
                            <a href="?id=<?= $loaiPhong->ma_loai_phong ?>&page=<?= $rooms['current_page'] + 1 ?>"
                               class="px-3 py-2 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-door-open text-4xl mb-3"></i>
                    <p class="text-lg font-medium mb-2">Chưa có phòng nào</p>
                    <p class="mb-4">Loại phòng này chưa có phòng nào được phân loại</p>
                    <button onclick="openAddRoomModal()"
                            class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Thêm phòng đầu tiên
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Thao tác nhanh -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Thao tác nhanh</h3>
        <div class="flex flex-wrap gap-3">
            <a href="/admin/loai-phong/edit?id=<?= $loaiPhong->ma_loai_phong ?>"
               class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors inline-flex items-center">
                <i class="fas fa-edit mr-2"></i>
                Chỉnh sửa thông tin
            </a>
            <?php if ($trangThai === 'ngung_hoat_dong'): ?>
                <button onclick="confirmReactivate(<?= $loaiPhong->ma_loai_phong ?>)"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors inline-flex items-center">
                    <i class="fas fa-power-off mr-2"></i>
                    Kích hoạt lại
                </button>
            <?php else: ?>
                <button onclick="confirmDeactivate(<?= $loaiPhong->ma_loai_phong ?>)"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors inline-flex items-center">
                    <i class="fas fa-power-off mr-2"></i>
                    Ngừng hoạt động
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal thêm phòng -->
<div id="addRoomModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h3 class="text-lg font-semibold mb-4">Thêm phòng vào loại phòng</h3>
            <form id="addRoomForm" method="POST" action="/admin/loai-phong/add-room">
                <input type="hidden" name="loai_phong_id" value="<?= $loaiPhong->ma_loai_phong ?>">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Chọn phòng</label>
                    <select name="phong_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Chọn phòng...</option>
                        <?php foreach ($availableRooms as $room): ?>
                            <option value="<?= $room->ma_phong ?>">
                                <?= htmlspecialchars($room->ten_phong) ?> 
                                <?php if ($room->ma_loai_phong): ?>
                                    (Hiện tại: <?= htmlspecialchars($room->loaiPhongName ?? 'Không xác định') ?>)
                                <?php else: ?>
                                    (Chưa phân loại)
                                <?php endif; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="text-sm text-gray-500 mt-1">
                        Nếu phòng đã có loại khác, loại cũ sẽ được thay thế
                    </p>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeAddRoomModal()"
                            class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Hủy
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Thêm phòng
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openAddRoomModal() {
    document.getElementById('addRoomModal').classList.remove('hidden');
}

function closeAddRoomModal() {
    document.getElementById('addRoomModal').classList.add('hidden');
}

function confirmRemoveRoom(roomId, roomName) {
    if (confirm(`🗑️ Bạn có chắc chắn muốn xóa phòng "${roomName}" khỏi loại phòng này?\n\nPhòng sẽ trở thành chưa phân loại.`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/loai-phong/remove-room';
        
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'phong_id';
        idInput.value = roomId;
        form.appendChild(idInput);
        
        const loaiPhongInput = document.createElement('input');
        loaiPhongInput.type = 'hidden';
        loaiPhongInput.name = 'loai_phong_id';
        loaiPhongInput.value = <?= $loaiPhong->ma_loai_phong ?>;
        form.appendChild(loaiPhongInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}

function confirmDeactivate(loaiPhongId) {
    if (confirm('🔴 Bạn có chắc chắn muốn ngừng hoạt động loại phòng này?\n\nLoại phòng sẽ được đánh dấu là "Ngừng hoạt động" và:\n• Không thể tạo phòng mới với loại này\n• Vẫn giữ nguyên tất cả dữ liệu\n• Có thể kích hoạt lại bất cứ lúc nào')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/loai-phong/deactivate';
        
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id';
        idInput.value = loaiPhongId;
        form.appendChild(idInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}

function confirmReactivate(loaiPhongId) {
    if (confirm('🟢 Bạn có chắc chắn muốn kích hoạt lại loại phòng này?\n\nLoại phòng sẽ được đánh dấu là "Hoạt động" và có thể được sử dụng trở lại.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/loai-phong/reactivate';
        
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id';
        idInput.value = loaiPhongId;
        form.appendChild(idInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}

// Close modal when clicking outside
document.getElementById('addRoomModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAddRoomModal();
    }
});

// Form validation
document.getElementById('addRoomForm').addEventListener('submit', function(e) {
    const phongId = this.querySelector('[name="phong_id"]').value;
    if (!phongId) {
        alert('Vui lòng chọn phòng!');
        e.preventDefault();
        return;
    }
});
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../../layouts/admin.php';
?>
