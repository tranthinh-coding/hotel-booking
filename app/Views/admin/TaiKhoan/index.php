<?php
$title = 'Quản lý Tài khoản - Ocean Pearl Hotel Admin';
$pageTitle = 'Quản lý Tài khoản';
ob_start();
?>

<div class="space-y-6">
    <!-- Success/Error Messages -->
    <?php if (isset($_GET['success'])): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">
                        <?php if ($_GET['success'] === 'created'): ?>
                            Tài khoản đã được tạo thành công!
                        <?php elseif ($_GET['success'] === 'updated'): ?>
                            Tài khoản đã được cập nhật thành công!
                        <?php elseif ($_GET['success'] === 'status_updated'): ?>
                            Trạng thái tài khoản đã được cập nhật thành công!
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">
                        <?php if ($_GET['error'] === 'notfound'): ?>
                            Không tìm thấy tài khoản!
                        <?php elseif ($_GET['error'] === 'missing_id'): ?>
                            Thiếu mã tài khoản!
                        <?php elseif ($_GET['error'] === 'missing_data'): ?>
                            Thiếu dữ liệu cần thiết!
                        <?php elseif ($_GET['error'] === 'invalid_status'): ?>
                            Trạng thái không hợp lệ!
                        <?php else: ?>
                            Có lỗi xảy ra!
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Breadcrumb -->
    <div class="flex justify-between items-center">
        <div>
            <nav class="text-sm text-gray-500">
                <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Tài khoản</span>
            </nav>
        </div>
        <div>
            <a href="/admin/tai-khoan/create"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Thêm tài khoản
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Tổng tài khoản</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['total'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Hoạt động</p>
                    <p class="text-2xl font-bold text-green-600"><?= $stats['active'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Tạm khóa</p>
                    <p class="text-2xl font-bold text-yellow-600"><?= $stats['suspended'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-pause-circle text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Bị khóa</p>
                    <p class="text-2xl font-bold text-red-600"><?= $stats['blocked'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-ban text-red-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Quản lý</p>
                    <p class="text-2xl font-bold text-blue-600"><?= $stats['managers'] ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-shield text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tìm kiếm và lọc -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <form method="GET" class="space-y-4">
            <!-- Hàng đầu tiên: Các ô input -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tìm kiếm</label>
                    <input type="text" name="search" placeholder="Tên, email, SĐT..."
                        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phân quyền</label>
                    <select name="role"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Tất cả</option>
                        <option value="Khách hàng" <?= ($_GET['role'] ?? '') === 'Khách hàng' ? 'selected' : '' ?>>Khách
                            hàng</option>
                        <option value="Lễ tân" <?= ($_GET['role'] ?? '') === 'Lễ tân' ? 'selected' : '' ?>>Lễ tân</option>
                        <option value="Quản lý" <?= ($_GET['role'] ?? '') === 'Quản lý' ? 'selected' : '' ?>>Quản lý
                        </option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                    <select name="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Tất cả</option>
                        <option value="<?= \HotelBooking\Enums\TrangThaiTaiKhoan::HOAT_DONG ?>" <?= ($_GET['status'] ?? '') === \HotelBooking\Enums\TrangThaiTaiKhoan::HOAT_DONG ? 'selected' : '' ?>>
                            <?= \HotelBooking\Enums\TrangThaiTaiKhoan::getLabel(\HotelBooking\Enums\TrangThaiTaiKhoan::HOAT_DONG) ?>
                        </option>
                        <option value="<?= \HotelBooking\Enums\TrangThaiTaiKhoan::TAM_KHOA ?>" <?= ($_GET['status'] ?? '') === \HotelBooking\Enums\TrangThaiTaiKhoan::TAM_KHOA ? 'selected' : '' ?>>
                            <?= \HotelBooking\Enums\TrangThaiTaiKhoan::getLabel(\HotelBooking\Enums\TrangThaiTaiKhoan::TAM_KHOA) ?>
                        </option>
                        <option value="<?= \HotelBooking\Enums\TrangThaiTaiKhoan::BI_KHOA ?>" <?= ($_GET['status'] ?? '') === \HotelBooking\Enums\TrangThaiTaiKhoan::BI_KHOA ? 'selected' : '' ?>>
                            <?= \HotelBooking\Enums\TrangThaiTaiKhoan::getLabel(\HotelBooking\Enums\TrangThaiTaiKhoan::BI_KHOA) ?>
                        </option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sắp xếp</label>
                    <select name="sort"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="ngay_tao" <?= ($_GET['sort'] ?? '') === 'ngay_tao' ? 'selected' : '' ?>>Ngày tạo
                        </option>
                        <option value="ho_ten" <?= ($_GET['sort'] ?? '') === 'ho_ten' ? 'selected' : '' ?>>Họ tên</option>
                        <option value="mail" <?= ($_GET['sort'] ?? '') === 'mail' ? 'selected' : '' ?>>Email</option>
                    </select>
                </div>
            </div>
            <!-- Hàng thứ hai: Nút bấm -->
            <div class="flex justify-end space-x-3">
                <a href="/admin/tai-khoan"
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors inline-flex items-center">
                    <i class="fas fa-times mr-2"></i>Xóa lọc
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                    <i class="fas fa-search mr-2"></i>Lọc
                </button>
            </div>
        </form>
    </div>

    <!-- Bảng dữ liệu -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Danh sách tài khoản</h3>
                <span class="text-sm text-gray-500">
                    <?= count($taiKhoans ?? []) ?> tài khoản
                </span>
            </div>
        </div>

        <?php if (isNotEmpty($taiKhoans)): ?>
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
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $colorClass ?>">
                                        <?= htmlspecialchars($taiKhoan->phan_quyen) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= date('d/m/Y', strtotime($taiKhoan->ngay_tao ?? 'now')) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                    // Import enum if needed
                                    $trangThai = $taiKhoan->trang_thai ?? \HotelBooking\Enums\TrangThaiTaiKhoan::HOAT_DONG;
                                    $statusColor = \HotelBooking\Enums\TrangThaiTaiKhoan::getColor($trangThai);
                                    $statusLabel = \HotelBooking\Enums\TrangThaiTaiKhoan::getLabel($trangThai);
                                    
                                    $colorClasses = [
                                        'green' => 'bg-green-100 text-green-800',
                                        'yellow' => 'bg-yellow-100 text-yellow-800',
                                        'red' => 'bg-red-100 text-red-800',
                                        'gray' => 'bg-gray-100 text-gray-800'
                                    ];
                                    $colorClass = $colorClasses[$statusColor] ?? 'bg-gray-100 text-gray-800';
                                    ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $colorClass ?>">
                                        <?= htmlspecialchars($statusLabel) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="/admin/tai-khoan/show?id=<?= $taiKhoan->ma_tai_khoan ?>"
                                            class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-eye mr-1"></i>Xem
                                        </a>
                                        <?php if ($taiKhoan->phan_quyen === 'Khách hàng') { ?>
                                        <a href="/admin/tai-khoan/edit?id=<?= $taiKhoan->ma_tai_khoan ?>"
                                            class="text-green-600 hover:text-green-900">
                                            <i class="fas fa-edit mr-1"></i>Sửa
                                        </a>
                                        <?php } ?>
                                        <?php if ($taiKhoan->phan_quyen === 'Khách hàng') { ?>
                                        <button onclick="changeAccountStatus(<?= $taiKhoan->ma_tai_khoan ?>)"
                                            class="text-orange-600 hover:text-orange-900">
                                            <i class="fas fa-sync mr-1"></i>Đổi trạng thái
                                        </button>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Chưa có tài khoản nào</h3>
                <p class="text-gray-500 mb-6">Bắt đầu tạo tài khoản đầu tiên cho hệ thống</p>
                <a href="/admin/tai-khoan/create"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Tạo tài khoản mới
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal đổi trạng thái -->
<div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h3 class="text-lg font-semibold mb-4">Đổi trạng thái tài khoản</h3>
            <form id="statusForm" method="POST" action="/admin/tai-khoan/update-status">
                <input type="hidden" name="ma_tai_khoan" id="statusAccountId">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái mới</label>
                    <select name="trang_thai" id="newStatus" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="<?= \HotelBooking\Enums\TrangThaiTaiKhoan::HOAT_DONG ?>">
                            <?= \HotelBooking\Enums\TrangThaiTaiKhoan::getLabel(\HotelBooking\Enums\TrangThaiTaiKhoan::HOAT_DONG) ?>
                        </option>
                        <option value="<?= \HotelBooking\Enums\TrangThaiTaiKhoan::TAM_KHOA ?>">
                            <?= \HotelBooking\Enums\TrangThaiTaiKhoan::getLabel(\HotelBooking\Enums\TrangThaiTaiKhoan::TAM_KHOA) ?>
                        </option>
                        <option value="<?= \HotelBooking\Enums\TrangThaiTaiKhoan::BI_KHOA ?>">
                            <?= \HotelBooking\Enums\TrangThaiTaiKhoan::getLabel(\HotelBooking\Enums\TrangThaiTaiKhoan::BI_KHOA) ?>
                        </option>
                    </select>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeStatusModal()" class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
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
function changeAccountStatus(accountId) {
    document.getElementById('statusAccountId').value = accountId;
    document.getElementById('statusModal').classList.remove('hidden');
}

function closeStatusModal() {
    document.getElementById('statusModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('statusModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeStatusModal();
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>