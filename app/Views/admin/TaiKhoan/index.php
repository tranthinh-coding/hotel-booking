<?php
$title = 'Quản lý Tài khoản - Ocean Pearl Hotel';
$pageTitle = 'Quản lý Tài khoản';
ob_start();
?>

<div class="space-y-6">
    <!-- Header với nút thêm mới -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Quản lý Tài khoản</h1>
            <p class="text-gray-600 mt-1">Quản lý thông tin tài khoản người dùng</p>
        </div>
        <a href="/admin/tai-khoan/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Thêm tài khoản
        </a>
    </div>

    <!-- Bộ lọc -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tìm kiếm</label>
                <input type="text" name="search" placeholder="Tên, email, SĐT..." 
                       value="<?= htmlspecialchars(get('search', '')) ?>"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Phân quyền</label>
                <select name="role" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Tất cả</option>
                    <option value="Khách hàng" <?= get('role') === 'Khách hàng' ? 'selected' : '' ?>>Khách hàng</option>
                    <option value="Lễ tân" <?= get('role') === 'Lễ tân' ? 'selected' : '' ?>>Lễ tân</option>
                    <option value="Quản lý" <?= get('role') === 'Quản lý' ? 'selected' : '' ?>>Quản lý</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Tất cả</option>
                    <option value="active" <?= get('status') === 'active' ? 'selected' : '' ?>>Hoạt động</option>
                    <option value="inactive" <?= get('status') === 'inactive' ? 'selected' : '' ?>>Không hoạt động</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                    <i class="fas fa-search mr-2"></i>Tìm kiếm
                </button>
            </div>
        </form>
    </div>

    <!-- Bảng dữ liệu -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Thông tin tài khoản
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Liên hệ
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Phân quyền
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ngày tạo
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Trạng thái
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Thao tác
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($taiKhoans)): ?>
                        <?php foreach ($taiKhoans as $taiKhoan): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <i class="fas fa-user text-blue-600"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <?= htmlspecialchars($taiKhoan->ho_ten) ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                ID: <?= $taiKhoan->ma_tai_khoan ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"><?= htmlspecialchars($taiKhoan->mail) ?></div>
                                    <div class="text-sm text-gray-500"><?= htmlspecialchars($taiKhoan->sdt ?? '') ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                    $roleColors = [
                                        'Quản lý' => 'bg-red-100 text-red-800',
                                        'Lễ tân' => 'bg-blue-100 text-blue-800',
                                        'Khách hàng' => 'bg-green-100 text-green-800'
                                    ];
                                    $colorClass = $roleColors[$taiKhoan->phan_quyen] ?? 'bg-gray-100 text-gray-800';
                                    ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $colorClass ?>">
                                        <?= htmlspecialchars($taiKhoan->phan_quyen) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= date('d/m/Y', strtotime($taiKhoan->created_at ?? 'now')) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Hoạt động
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="/admin/tai-khoan/<?= $taiKhoan->ma_tai_khoan ?>" 
                                           class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="/admin/tai-khoan/<?= $taiKhoan->ma_tai_khoan ?>/edit" 
                                           class="text-yellow-600 hover:text-yellow-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="confirmDelete(<?= $taiKhoan->ma_tai_khoan ?>)" 
                                                class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                <div class="py-8">
                                    <i class="fas fa-users text-4xl mb-3"></i>
                                    <p>Không có tài khoản nào</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if (!empty($pagination)): ?>
        <div class="flex justify-between items-center">
            <div class="text-sm text-gray-700">
                Hiển thị <?= $pagination['from'] ?> - <?= $pagination['to'] ?> trong tổng số <?= $pagination['total'] ?> tài khoản
            </div>
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
    if (confirm('Bạn có chắc chắn muốn xóa tài khoản này?')) {
        fetch(`/admin/tai-khoan/${id}/delete`, {
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
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
