<?php
$title = 'Chỉnh sửa Tài khoản - Ocean Pearl Hotel Admin';
$pageTitle = 'Chỉnh sửa Tài khoản';
ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <div>
        <nav class="text-sm text-gray-500">
            <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="/admin/tai-khoan" class="hover:text-gray-700">Tài khoản</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">Chỉnh sửa</span>
        </nav>
    </div>

    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Chỉnh sửa Tài khoản</h1>
            <p class="text-gray-600 mt-1">Cập nhật thông tin tài khoản người dùng</p>
        </div>
        <div>
            <a href="/admin/tai-khoan" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Quay lại
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <form method="POST" action="/admin/tai-khoan/update?id=<?= $taiKhoan->ma_tai_khoan ?>" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Họ tên -->
                <div>
                    <label for="ho_ten" class="block text-sm font-medium text-gray-700 mb-2">
                        Họ và tên <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="ho_ten" 
                           name="ho_ten" 
                           value="<?= htmlspecialchars($taiKhoan->ho_ten ?? '') ?>"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <!-- Email -->
                <div>
                    <label for="mail" class="block text-sm font-medium text-gray-700 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           id="mail" 
                           name="mail" 
                           value="<?= htmlspecialchars($taiKhoan->mail ?? '') ?>"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <!-- Số điện thoại -->
                <div>
                    <label for="sdt" class="block text-sm font-medium text-gray-700 mb-2">
                        Số điện thoại
                    </label>
                    <input type="tel" 
                           id="sdt" 
                           name="sdt" 
                           value="<?= htmlspecialchars($taiKhoan->sdt ?? '') ?>"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Số CCCD -->
                <div>
                    <label for="so_cccd" class="block text-sm font-medium text-gray-700 mb-2">
                        Số CCCD
                    </label>
                    <input type="text" 
                           id="so_cccd" 
                           name="so_cccd" 
                           value="<?= htmlspecialchars($taiKhoan->so_cccd ?? '') ?>"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Phân quyền -->
                <div>
                    <label for="phan_quyen" class="block text-sm font-medium text-gray-700 mb-2">
                        Phân quyền <span class="text-red-500">*</span>
                    </label>
                    <?php $currentUser = auth_check() ? user() : null; ?>
                    <select id="phan_quyen" 
                            name="phan_quyen" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        <option value="Khách hàng" <?= ($taiKhoan->phan_quyen ?? '') === 'Khách hàng' ? 'selected' : '' ?>>Khách hàng</option>
                        <?php if ($currentUser && $currentUser->phan_quyen === 'Quản lý'): ?>
                        <option value="Lễ tân" <?= ($taiKhoan->phan_quyen ?? '') === 'Lễ tân' ? 'selected' : '' ?>>Lễ tân</option>
                        <option value="Quản lý" <?= ($taiKhoan->phan_quyen ?? '') === 'Quản lý' ? 'selected' : '' ?>>Quản lý</option>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Mật khẩu mới -->
                <div>
                    <label for="mat_khau" class="block text-sm font-medium text-gray-700 mb-2">
                        Mật khẩu mới (để trống nếu không thay đổi)
                    </label>
                    <input type="password" 
                           id="mat_khau" 
                           name="mat_khau" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Chỉ nhập nếu muốn thay đổi mật khẩu</p>
                </div>
            </div>

            <!-- Account Info Display -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Thông tin tài khoản</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Mã tài khoản:</span>
                        <span class="ml-2 font-medium"><?= htmlspecialchars($taiKhoan->ma_tai_khoan) ?></span>
                    </div>
                    <div>
                        <span class="text-gray-500">Ngày tạo:</span>
                        <span class="ml-2"><?= date('d/m/Y H:i', strtotime($taiKhoan->ngay_tao ?? 'now')) ?></span>
                    </div>
                </div>
            </div>

            <!-- Submit buttons -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="/admin/tai-khoan" 
                   class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Hủy
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Cập nhật tài khoản
                </button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
