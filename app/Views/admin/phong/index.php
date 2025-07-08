<div class="bg-white rounded-3xl soft-shadow">
    <!-- Header -->
    <div class="px-8 py-6 border-b border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Quản lý phòng</h1>
                <p class="text-gray-600 mt-1">Danh sách và quản lý tất cả các phòng trong khách sạn</p>
            </div>
            <a href="/admin/phong/create" class="btn-admin text-white px-6 py-3 rounded-xl font-medium inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Thêm phòng mới
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="p-8 border-b border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-gradient-to-br from-ocean-50 to-ocean-100 rounded-2xl p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-ocean-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-bed text-white"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Tổng số phòng</p>
                        <p class="text-2xl font-bold text-gray-900"><?= count($phongs) ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-white"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Còn trống</p>
                        <p class="text-2xl font-bold text-gray-900">
                            <?= count(array_filter($phongs, function($p) { return $p->trang_thai === 'Còn trống'; })) ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-2xl p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-friends text-white"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Đã đặt</p>
                        <p class="text-2xl font-bold text-gray-900">
                            <?= count(array_filter($phongs, function($p) { return $p->trang_thai === 'Đã đặt'; })) ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-yellow-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-tools text-white"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Bảo trì</p>
                        <p class="text-2xl font-bold text-gray-900">
                            <?= count(array_filter($phongs, function($p) { return $p->trang_thai === 'Bảo trì'; })) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="px-8 py-6 border-b border-gray-100">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Tìm kiếm phòng..." 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 w-full sm:w-64">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500">
                    <option value="">Tất cả trạng thái</option>
                    <option value="Còn trống">Còn trống</option>
                    <option value="Đã đặt">Đã đặt</option>
                    <option value="Bảo trì">Bảo trì</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">Hiển thị:</span>
                <select class="px-3 py-1 border border-gray-300 rounded-lg text-sm">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Phòng
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Loại phòng
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Giá
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Sức chứa
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Trạng thái
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Thao tác
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (empty($phongs)): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-bed text-4xl text-gray-300 mb-4"></i>
                                <p class="text-lg font-medium mb-2">Chưa có phòng nào</p>
                                <p class="text-sm">Bắt đầu bằng cách thêm phòng đầu tiên</p>
                                <a href="/admin/phong/create" class="mt-4 btn-admin text-white px-6 py-2 rounded-lg text-sm">
                                    <i class="fas fa-plus mr-2"></i>Thêm phòng
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($phongs as $phong): ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-ocean-400 to-ocean-600 rounded-xl flex items-center justify-center text-white font-bold mr-4">
                                        <?= htmlspecialchars(substr($phong->ten_phong, -3)) ?>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            <?= htmlspecialchars($phong->ten_phong) ?>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <?= htmlspecialchars(substr($phong->mo_ta, 0, 50)) ?>...
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-ocean-100 text-ocean-800">
                                    Loại <?= $phong->ma_danh_muc ?? 'N/A' ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    <?= number_format($phong->gia) ?>đ
                                </div>
                                <div class="text-sm text-gray-500">/ đêm</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center text-sm text-gray-900">
                                    <i class="fas fa-users mr-2 text-gray-400"></i>
                                    <?= $phong->so_khach_toi_da ?? 2 ?> khách
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php
                                $statusClass = '';
                                $statusIcon = '';
                                switch($phong->trang_thai) {
                                    case 'Còn trống':
                                        $statusClass = 'bg-green-100 text-green-800';
                                        $statusIcon = 'fas fa-check-circle';
                                        break;
                                    case 'Đã đặt':
                                        $statusClass = 'bg-red-100 text-red-800';
                                        $statusIcon = 'fas fa-user-friends';
                                        break;
                                    case 'Bảo trì':
                                        $statusClass = 'bg-yellow-100 text-yellow-800';
                                        $statusIcon = 'fas fa-tools';
                                        break;
                                    default:
                                        $statusClass = 'bg-gray-100 text-gray-800';
                                        $statusIcon = 'fas fa-question-circle';
                                }
                                ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusClass ?>">
                                    <i class="<?= $statusIcon ?> mr-1"></i>
                                    <?= htmlspecialchars($phong->trang_thai) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="/admin/phong/<?= $phong->ma_phong ?>/edit" 
                                       class="text-ocean-600 hover:text-ocean-900 gentle-hover p-2 rounded-lg">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="deleteRoom(<?= $phong->ma_phong ?>)" 
                                            class="text-red-600 hover:text-red-900 gentle-hover p-2 rounded-lg">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if (!empty($phongs)): ?>
        <div class="px-8 py-6 border-t border-gray-100">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Hiển thị <span class="font-medium">1</span> đến <span class="font-medium"><?= count($phongs) ?></span>
                    của <span class="font-medium"><?= count($phongs) ?></span> kết quả
                </div>
                <nav class="flex items-center space-x-2">
                    <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 disabled:opacity-50" disabled>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="px-3 py-2 bg-ocean-500 text-white rounded-lg">1</button>
                    <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 disabled:opacity-50" disabled>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </nav>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 max-w-md w-full">
        <div class="text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-trash text-red-600 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Xóa phòng</h3>
            <p class="text-gray-600 mb-6">Bạn có chắc chắn muốn xóa phòng này? Hành động này không thể hoàn tác.</p>
            <div class="flex space-x-4">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Hủy
                </button>
                <button onclick="confirmDelete()" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Xóa
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let deleteRoomId = null;

function deleteRoom(roomId) {
    deleteRoomId = roomId;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    deleteRoomId = null;
}

function confirmDelete() {
    if (deleteRoomId) {
        // Create and submit delete form
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/phong/${deleteRoomId}/delete`;
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}

// Search functionality
document.querySelector('input[placeholder="Tìm kiếm phòng..."]').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const roomName = row.querySelector('td:first-child .text-sm.font-medium')?.textContent.toLowerCase() || '';
        if (roomName.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Status filter
document.querySelector('select').addEventListener('change', function(e) {
    const selectedStatus = e.target.value;
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const statusElement = row.querySelector('td:nth-child(5) span');
        if (!statusElement) return;
        
        const status = statusElement.textContent.trim();
        if (selectedStatus === '' || status.includes(selectedStatus)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
