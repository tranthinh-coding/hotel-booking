<?php
$title = 'Danh sách phòng - Hotel Ocean';
ob_start();
?>

<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            <i class="fas fa-bed text-ocean-600 mr-2"></i>
            Danh sách phòng
        </h1>
        <p class="text-gray-600">Quản lý thông tin các phòng nghỉ tại khách sạn</p>
    </div>
    <a href="/phong/create" class="bg-gradient-to-r from-ocean-600 to-seafoam-600 text-white px-6 py-3 rounded-lg hover:from-ocean-700 hover:to-seafoam-700 transition-all transform hover:scale-105 inline-flex items-center shadow-lg">
        <i class="fas fa-plus mr-2"></i>
        Thêm phòng mới
    </a>
</div>

<?php if (empty($phongs)): ?>
    <div class="bg-white/80 backdrop-blur-md rounded-2xl p-12 text-center shadow-lg border border-ocean-200">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-bed text-4xl text-gray-400"></i>
        </div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-2">Chưa có phòng nào</h3>
        <p class="text-gray-600 mb-6">Hãy thêm phòng đầu tiên để bắt đầu quản lý</p>
        <a href="/phong/create" class="bg-ocean-600 text-white px-6 py-3 rounded-lg hover:bg-ocean-700 transition-colors inline-flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Thêm phòng đầu tiên
        </a>
    </div>
<?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($phongs as $phong): ?>
            <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-ocean-200 transform hover:-translate-y-1">
                <!-- Room Image Placeholder -->
                <div class="h-48 bg-gradient-to-br from-ocean-400 to-seafoam-400 flex items-center justify-center">
                    <i class="fas fa-bed text-6xl text-white opacity-80"></i>
                </div>
                
                <!-- Room Info -->
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($phong->ten_phong) ?></h3>
                        <span class="px-3 py-1 rounded-full text-sm font-medium
                            <?= $phong->trang_thai === 'trong' ? 'bg-green-100 text-green-800' : 
                               ($phong->trang_thai === 'dang_su_dung' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') ?>">
                            <?= ucfirst(str_replace('_', ' ', $phong->trang_thai)) ?>
                        </span>
                    </div>
                    
                    <p class="text-gray-600 mb-4 line-clamp-2"><?= htmlspecialchars($phong->mo_ta) ?></p>
                    
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center text-ocean-600">
                            <i class="fas fa-money-bill-wave mr-2"></i>
                            <span class="text-2xl font-bold"><?= number_format($phong->gia) ?></span>
                            <span class="text-sm text-gray-500 ml-1">VNĐ/đêm</span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex space-x-2">
                        <a href="/phong/show/<?= $phong->ma_phong ?>" 
                           class="flex-1 bg-ocean-100 text-ocean-700 px-4 py-2 rounded-lg hover:bg-ocean-200 transition-colors text-center">
                            <i class="fas fa-eye mr-1"></i>
                            Xem
                        </a>
                        <a href="/phong/edit/<?= $phong->ma_phong ?>" 
                           class="flex-1 bg-seafoam-100 text-seafoam-700 px-4 py-2 rounded-lg hover:bg-seafoam-200 transition-colors text-center">
                            <i class="fas fa-edit mr-1"></i>
                            Sửa
                        </a>
                        <button onclick="confirmDelete(<?= $phong->ma_phong ?>, '<?= htmlspecialchars($phong->ten_phong) ?>')" 
                                class="flex-1 bg-red-100 text-red-700 px-4 py-2 rounded-lg hover:bg-red-200 transition-colors">
                            <i class="fas fa-trash mr-1"></i>
                            Xóa
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4 transform transition-all">
        <div class="text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Xác nhận xóa phòng</h3>
            <p class="text-gray-600 mb-6">
                Bạn có chắc chắn muốn xóa phòng <span id="roomName" class="font-semibold"></span>?
                <br>Hành động này không thể hoàn tác.
            </p>
            <div class="flex space-x-4">
                <button onclick="closeDeleteModal()" 
                        class="flex-1 bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors">
                    Hủy
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    <button type="submit" 
                            class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                        Xóa
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    document.getElementById('roomName').textContent = name;
    document.getElementById('deleteForm').action = `/phong/destroy/${id}`;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../layouts/app.php';
?>
