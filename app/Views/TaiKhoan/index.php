<?php
$title = 'Quản lý tài khoản - Hotel Ocean';
ob_start();
?>

<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Quản lý tài khoản</h1>
                <p class="text-gray-600">Quản lý thông tin và phân quyền người dùng</p>
            </div>
            <?php if (auth_can_crud()): ?>
            <div class="flex items-center space-x-4">
                <a href="/tai-khoan/create" 
                   class="bg-gradient-to-r from-ocean-600 to-seafoam-600 hover:from-ocean-700 hover:to-seafoam-700 text-white px-6 py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg">
                    <i class="fas fa-plus mr-2"></i>
                    Thêm tài khoản
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="filter_role" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-user-tag mr-1"></i> Phân quyền
                </label>
                <select id="filter_role" 
                        name="role" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-ocean-500">
                    <option value="">Tất cả</option>
                    <option value="admin" <?= ($_GET['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="nhan_vien" <?= ($_GET['role'] ?? '') === 'nhan_vien' ? 'selected' : '' ?>>Nhân viên</option>
                    <option value="khach_hang" <?= ($_GET['role'] ?? '') === 'khach_hang' ? 'selected' : '' ?>>Khách hàng</option>
                </select>
            </div>

            <div>
                <label for="filter_status" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-toggle-on mr-1"></i> Trạng thái
                </label>
                <select id="filter_status" 
                        name="status" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-ocean-500">
                    <option value="">Tất cả</option>
                    <option value="active" <?= ($_GET['status'] ?? '') === 'active' ? 'selected' : '' ?>>Hoạt động</option>
                    <option value="inactive" <?= ($_GET['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Tạm khóa</option>
                    <option value="banned" <?= ($_GET['status'] ?? '') === 'banned' ? 'selected' : '' ?>>Bị cấm</option>
                </select>
            </div>

            <div>
                <label for="filter_search" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-search mr-1"></i> Tìm kiếm
                </label>
                <input type="text" 
                       id="filter_search" 
                       name="search" 
                       value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-ocean-500"
                       placeholder="Tên, email, số điện thoại...">
            </div>

            <div class="flex items-end">
                <button type="submit" 
                        class="w-full bg-ocean-500 hover:bg-ocean-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-search mr-2"></i>
                    Tìm kiếm
                </button>
            </div>
        </form>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 text-center">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-users text-2xl text-blue-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800"><?= number_format($totalUsers ?? count($taiKhoans ?? [])) ?></h3>
            <p class="text-gray-600">Tổng tài khoản</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-check text-2xl text-green-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800"><?= number_format($activeUsers ?? 0) ?></h3>
            <p class="text-gray-600">Đang hoạt động</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 text-center">
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-tie text-2xl text-purple-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800"><?= number_format($staffCount ?? 0) ?></h3>
            <p class="text-gray-600">Nhân viên</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 text-center">
            <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-calendar text-2xl text-orange-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800"><?= $newThisMonth ?? 0 ?></h3>
            <p class="text-gray-600">Mới tháng này</p>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Thông tin
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Liên hệ
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Phân quyền
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Trạng thái
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ngày tạo
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Thao tác
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($taiKhoans) && is_array($taiKhoans)): ?>
                        <?php foreach ($taiKhoans as $taiKhoan): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-br from-ocean-500 to-seafoam-500 rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <?= htmlspecialchars($taiKhoan->ho_ten ?? 'N/A') ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                ID: #<?= $taiKhoan->id ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <i class="fas fa-envelope mr-1 text-gray-400"></i>
                                        <?= htmlspecialchars($taiKhoan->email ?? 'N/A') ?>
                                    </div>
                                    <?php if (!empty($taiKhoan->so_dien_thoai)): ?>
                                        <div class="text-sm text-gray-500">
                                            <i class="fas fa-phone mr-1 text-gray-400"></i>
                                            <?= htmlspecialchars($taiKhoan->so_dien_thoai) ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        <?php
                                        $role = $taiKhoan->phan_quyen ?? 'khach_hang';
                                        switch ($role) {
                                            case 'admin':
                                                echo 'bg-red-100 text-red-800';
                                                break;
                                            case 'nhan_vien':
                                                echo 'bg-blue-100 text-blue-800';
                                                break;
                                            default:
                                                echo 'bg-green-100 text-green-800';
                                        }
                                        ?>">
                                        <?php
                                        switch ($role) {
                                            case 'admin':
                                                echo 'Admin';
                                                break;
                                            case 'nhan_vien':
                                                echo 'Nhân viên';
                                                break;
                                            default:
                                                echo 'Khách hàng';
                                        }
                                        ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        <?php
                                        $status = $taiKhoan->trang_thai ?? 'active';
                                        switch ($status) {
                                            case 'active':
                                                echo 'bg-green-100 text-green-800';
                                                break;
                                            case 'inactive':
                                                echo 'bg-yellow-100 text-yellow-800';
                                                break;
                                            case 'banned':
                                                echo 'bg-red-100 text-red-800';
                                                break;
                                            default:
                                                echo 'bg-gray-100 text-gray-800';
                                        }
                                        ?>">
                                        <?php
                                        switch ($status) {
                                            case 'active':
                                                echo 'Hoạt động';
                                                break;
                                            case 'inactive':
                                                echo 'Tạm khóa';
                                                break;
                                            case 'banned':
                                                echo 'Bị cấm';
                                                break;
                                            default:
                                                echo 'Không xác định';
                                        }
                                        ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= isset($taiKhoan->ngay_tao) ? date('d/m/Y', strtotime($taiKhoan->ngay_tao)) : 'N/A' ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="/tai-khoan/<?= $taiKhoan->id ?>" 
                                           class="text-ocean-600 hover:text-ocean-700 p-2 rounded-lg hover:bg-ocean-50" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php if (auth_can_crud()): ?>
                                        <a href="/tai-khoan/<?= $taiKhoan->id ?>/edit" 
                                           class="text-blue-600 hover:text-blue-700 p-2 rounded-lg hover:bg-blue-50" title="Chỉnh sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?php if (($taiKhoan->phan_quyen ?? '') !== 'admin'): ?>
                                            <button onclick="deleteUser(<?= $taiKhoan->id ?>)" 
                                                    class="text-red-600 hover:text-red-700 p-2 rounded-lg hover:bg-red-50" title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <i class="fas fa-users text-4xl mb-4"></i>
                                    <p class="text-lg">Không có tài khoản nào</p>
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
        <div class="mt-8 flex justify-center">
            <nav class="flex items-center space-x-2">
                <?php if ($pagination['current_page'] > 1): ?>
                    <a href="?page=<?= $pagination['current_page'] - 1 ?>" 
                       class="px-3 py-2 text-gray-600 bg-white rounded-lg border hover:bg-gray-50">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                    <a href="?page=<?= $i ?>" 
                       class="px-3 py-2 <?= $i === $pagination['current_page'] ? 'bg-ocean-500 text-white' : 'text-gray-600 bg-white hover:bg-gray-50' ?> rounded-lg border">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                    <a href="?page=<?= $pagination['current_page'] + 1 ?>" 
                       class="px-3 py-2 text-gray-600 bg-white rounded-lg border hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    <?php endif; ?>
</div>

<script>
function deleteUser(id) {
    if (confirm('Bạn có chắc chắn muốn xóa tài khoản này? Thao tác này không thể hoàn tác!')) {
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/tai-khoan/' + id;
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
    }
}

// Auto-submit search form
document.getElementById('filter_search').addEventListener('input', function() {
    clearTimeout(this.searchTimeout);
    this.searchTimeout = setTimeout(() => {
        this.form.submit();
    }, 500);
});

// Auto-submit filters on change
document.querySelectorAll('select[name="role"], select[name="status"]').forEach(select => {
    select.addEventListener('change', function() {
        this.form.submit();
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
