<?php
$title = 'Danh sách dịch vụ - Hotel Ocean';
ob_start();
?>

<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            <i class="fas fa-concierge-bell text-ocean-600 mr-2"></i>
            Danh sách dịch vụ
        </h1>
        <p class="text-gray-600">Khám phá các dịch vụ cao cấp tại khách sạn của chúng tôi</p>
    </div>
    <div>
        <?php if (auth_can_crud()): ?>
        <a href="/dich-vu/create" class="bg-gradient-to-r from-ocean-600 to-seafoam-600 text-white px-6 py-3 rounded-lg hover:from-ocean-700 hover:to-seafoam-700 transition-all transform hover:scale-105 inline-flex items-center shadow-lg mr-3">
            <i class="fas fa-plus mr-2"></i>
            Thêm dịch vụ mới
        </a>
        <?php endif; ?>
        <a href="/contact" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all transform hover:scale-105 inline-flex items-center shadow-lg">
            <i class="fas fa-calendar-check mr-2"></i>
            Liên hệ tư vấn
        </a>
    </div>
</div>

<?php if (empty($dichVus)): ?>
    <div class="bg-white/80 backdrop-blur-md rounded-2xl p-12 text-center shadow-lg border border-ocean-200">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-concierge-bell text-4xl text-gray-400"></i>
        </div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-2">Hiện tại chưa có dịch vụ nào</h3>
        <p class="text-gray-600 mb-6">Vui lòng quay lại sau hoặc liên hệ với chúng tôi để biết thêm thông tin</p>
        <a href="/contact" class="bg-ocean-600 text-white px-6 py-3 rounded-lg hover:bg-ocean-700 transition-colors inline-flex items-center">
            <i class="fas fa-phone mr-2"></i>
            Liên hệ tư vấn
        </a>
    </div>
<?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php foreach ($dichVus as $dichVu): ?>
            <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-ocean-200 transform hover:-translate-y-1">
                <!-- Service Icon -->
                <div class="h-32 bg-gradient-to-br from-seafoam-400 to-ocean-400 flex items-center justify-center">
                    <i class="fas fa-concierge-bell text-4xl text-white opacity-80"></i>
                </div>
                
                <!-- Service Info -->
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3"><?= htmlspecialchars($dichVu->ten_dich_vu) ?></h3>
                    
                    <div class="flex items-center justify-center mb-4">
                        <div class="text-center">
                            <div class="flex items-center justify-center text-ocean-600">
                                <i class="fas fa-money-bill-wave mr-2"></i>
                                <span class="text-2xl font-bold"><?= number_format($dichVu->gia) ?></span>
                            </div>
                            <span class="text-sm text-gray-500">VNĐ</span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="space-y-2">
                        <div class="flex space-x-2">
                            <a href="/dich-vu/show/<?= $dichVu->ma_dich_vu ?>" 
                               class="flex-1 bg-ocean-100 text-ocean-700 px-3 py-2 rounded-lg hover:bg-ocean-200 transition-colors text-center text-sm">
                                <i class="fas fa-eye mr-1"></i>
                                Xem chi tiết
                            </a>
                            <?php if (auth_can_crud()): ?>
                            <a href="/dich-vu/edit/<?= $dichVu->ma_dich_vu ?>" 
                               class="flex-1 bg-seafoam-100 text-seafoam-700 px-3 py-2 rounded-lg hover:bg-seafoam-200 transition-colors text-center text-sm">
                                <i class="fas fa-edit mr-1"></i>
                                Chỉnh sửa
                            </a>
                            <?php else: ?>
                            <a href="/contact" 
                               class="flex-1 bg-green-100 text-green-700 px-3 py-2 rounded-lg hover:bg-green-200 transition-colors text-center text-sm">
                                <i class="fas fa-phone mr-1"></i>
                                Liên hệ
                            </a>
                            <?php endif; ?>
                        </div>
                        <?php if (auth_can_crud()): ?>
                        <button onclick="confirmDelete(<?= $dichVu->ma_dich_vu ?>, '<?= htmlspecialchars($dichVu->ten_dich_vu) ?>')" 
                                class="w-full bg-red-100 text-red-700 px-3 py-2 rounded-lg hover:bg-red-200 transition-colors text-sm">
                            <i class="fas fa-trash mr-1"></i>
                            Xóa dịch vụ
                        </button>
                        <?php endif; ?>
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
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Xác nhận xóa dịch vụ</h3>
            <p class="text-gray-600 mb-6">
                Bạn có chắc chắn muốn xóa dịch vụ <span id="serviceName" class="font-semibold"></span>?
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
    document.getElementById('serviceName').textContent = name;
    document.getElementById('deleteForm').action = `/dich-vu/destroy/${id}`;
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
