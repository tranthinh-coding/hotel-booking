<?php
$title = 'Chi tiết Phòng - Ocean Pearl Hotel Admin';
$pageTitle = 'Chi tiết Phòng';
ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <div class="flex justify-between items-center">
        <nav class="text-sm text-gray-500">
            <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="/admin/phong" class="hover:text-gray-700">Quản lý Phòng</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">Chi tiết</span>
        </nav>
        <div class="flex space-x-3">
            <a href="/admin/phong/edit?id=<?= $phong->ma_phong ?>"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class="fas fa-edit mr-2"></i>
                Chỉnh sửa
            </a>
            <a href="/admin/phong"
               class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Quay lại
            </a>
        </div>
    </div>

    <!-- Thông tin cơ bản -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-900"><?= htmlspecialchars($phong->ten_phong) ?></h2>
                <div class="flex items-center space-x-4">
                    <span class="text-lg font-bold text-blue-600">
                        <?= number_format($phong->gia) ?> VNĐ
                    </span>
                    <?php
                    $statusColors = [
                        \HotelBooking\Enums\TrangThaiPhong::CON_TRONG => 'bg-green-100 text-green-800',
                        \HotelBooking\Enums\TrangThaiPhong::DANG_DON_DEP => 'bg-blue-100 text-blue-800',
                        \HotelBooking\Enums\TrangThaiPhong::BAO_TRI => 'bg-red-100 text-red-800'
                    ];
                    $statusColor = $statusColors[$phong->trang_thai] ?? 'bg-gray-100 text-gray-800';
                    ?>
                    <span class="px-3 py-1 text-sm font-medium rounded-full <?= $statusColor ?>">
                        <?= \HotelBooking\Enums\TrangThaiPhong::getLabel($phong->trang_thai) ?>
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
                            <span class="text-gray-600">Mã phòng:</span>
                            <span class="font-medium text-gray-900">#<?= $phong->ma_phong ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tên phòng:</span>
                            <span class="font-medium text-gray-900"><?= htmlspecialchars($phong->ten_phong) ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Loại phòng:</span>
                            <span class="font-medium text-gray-900">
                                <?= $loaiPhong ? htmlspecialchars($loaiPhong->ten) : 'Chưa phân loại' ?>
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Giá phòng:</span>
                            <span class="font-medium text-gray-900"><?= number_format($phong->gia) ?> VNĐ</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Trạng thái:</span>
                            <span class="font-medium text-gray-900">
                                <?= \HotelBooking\Enums\TrangThaiPhong::getLabel($phong->trang_thai) ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Mô tả -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Mô tả phòng</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-700 leading-relaxed">
                            <?= htmlspecialchars($phong->mo_ta ?: 'Chưa có mô tả cho phòng này.') ?>
                        </p>
                    </div>
                </div>

                <!-- Tiện nghi phòng -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tiện nghi</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-wifi text-blue-500 mr-3"></i>
                            WiFi miễn phí
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-snowflake text-blue-500 mr-3"></i>
                            Điều hòa không khí
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-tv text-blue-500 mr-3"></i>
                            Smart TV
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-bath text-blue-500 mr-3"></i>
                            Phòng tắm riêng
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-bed text-blue-500 mr-3"></i>
                            Giường đôi
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-coffee text-blue-500 mr-3"></i>
                            Minibar
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hình ảnh phòng -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Hình ảnh phòng</h3>
                <?php if (!empty($hinhAnhs)): ?>
                    <div class="grid grid-cols-2 gap-4">
                        <?php foreach ($hinhAnhs as $index => $hinhAnh): ?>
                            <div class="relative group">
                                <img src="<?= htmlspecialchars($hinhAnh->duong_dan) ?>" 
                                     alt="Hình ảnh phòng" 
                                     class="w-full h-32 object-cover rounded-lg">
                                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                    <button onclick="viewImage('<?= htmlspecialchars($hinhAnh->duong_dan) ?>')" 
                                            class="text-white hover:text-blue-300">
                                        <i class="fas fa-expand text-xl"></i>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-image text-4xl mb-3"></i>
                        <p>Chưa có hình ảnh cho phòng này</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Thao tác nhanh -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Thao tác nhanh</h3>
        <div class="flex flex-wrap gap-3">
            <button onclick="changeRoomStatus(<?= $phong->ma_phong ?>)"
                    class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors inline-flex items-center">
                <i class="fas fa-sync mr-2"></i>
                Đổi trạng thái
            </button>
            <a href="/admin/phong/edit?id=<?= $phong->ma_phong ?>"
               class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors inline-flex items-center">
                <i class="fas fa-edit mr-2"></i>
                Chỉnh sửa thông tin
            </a>
            <?php if ($phong->trang_thai === \HotelBooking\Enums\TrangThaiPhong::NGUNG_HOAT_DONG): ?>
                <button onclick="confirmReactivate(<?= $phong->ma_phong ?>)"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors inline-flex items-center">
                    <i class="fas fa-power-off mr-2"></i>
                    Kích hoạt lại
                </button>
            <?php else: ?>
                <button onclick="confirmDeactivate(<?= $phong->ma_phong ?>)"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors inline-flex items-center">
                    <i class="fas fa-power-off mr-2"></i>
                    Ngừng hoạt động
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal xem ảnh -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center">
    <div class="relative max-w-4xl max-h-full p-4">
        <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain">
        <button onclick="closeImageModal()" 
                class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

<!-- Modal đổi trạng thái -->
<div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h3 class="text-lg font-semibold mb-4">Đổi trạng thái phòng</h3>
            <form id="statusForm" method="POST">
                <input type="hidden" name="ma_phong" value="<?= $phong->ma_phong ?>">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái mới</label>
                    <select name="trang_thai" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <?php
                        $trangThaiList = \HotelBooking\Enums\TrangThaiPhong::all();
                        foreach ($trangThaiList as $status): ?>
                            <option value="<?= $status ?>" <?= $status === $phong->trang_thai ? 'selected' : '' ?>>
                                <?= \HotelBooking\Enums\TrangThaiPhong::getLabel($status) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeStatusModal()"
                            class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Hủy
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function viewImage(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').classList.remove('hidden');
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

function changeRoomStatus(roomId) {
    document.getElementById('statusForm').action = '/admin/phong/update-status';
    // Add hidden ID field to form
    const idInput = document.getElementById('statusRoomId') || document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'id';
    idInput.id = 'statusRoomId';
    idInput.value = roomId;
    if (!document.getElementById('statusRoomId')) {
        document.getElementById('statusForm').appendChild(idInput);
    }
    document.getElementById('statusModal').classList.remove('hidden');
}

function closeStatusModal() {
    document.getElementById('statusModal').classList.add('hidden');
}

function confirmDeactivate(roomId) {
    if (confirm('🔴 Bạn có chắc chắn muốn ngừng hoạt động phòng này?\n\nPhòng sẽ được đánh dấu là "Ngừng hoạt động" và:\n• Không thể đặt phòng mới\n• Vẫn giữ nguyên tất cả dữ liệu\n• Có thể kích hoạt lại bất cứ lúc nào')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/phong/deactivate';
        
        // Add ID as hidden input
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id';
        idInput.value = roomId;
        form.appendChild(idInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}

function confirmReactivate(roomId) {
    if (confirm('🟢 Bạn có chắc chắn muốn kích hoạt lại phòng này?\n\nPhòng sẽ được đánh dấu là "Còn trống" và có thể được đặt phòng trở lại.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/phong/reactivate';
        
        // Add ID as hidden input
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id';
        idInput.value = roomId;
        form.appendChild(idInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}

// Close modals when clicking outside
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

document.getElementById('statusModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeStatusModal();
    }
});
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../../layouts/admin.php';
?>
