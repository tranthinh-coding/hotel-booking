<?php
$title = 'Thêm Tài khoản - Ocean Pearl Hotel Admin';
$pageTitle = 'Thêm Tài khoản';
ob_start();
?>

<div class="max-w-7xl mx-auto space-y-6">
    <!-- Breadcrumb -->
    <div>
        <nav class="text-sm text-gray-500">
            <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="/admin/tai-khoan" class="hover:text-gray-700">Tài khoản</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">Thêm mới</span>
        </nav>
    </div>

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Thêm Tài khoản</h1>
            <p class="text-gray-600 mt-1">Tạo tài khoản mới cho hệ thống</p>
        </div>
        <a href="/admin/tai-khoan" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            Quay lại
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form method="POST" action="/admin/tai-khoan/store" class="space-y-6">
            <!-- Thông tin cơ bản -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Thông tin cơ bản</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="ho_ten" class="block text-sm font-medium text-gray-700 mb-2">
                            Họ và tên <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="ho_ten" name="ho_ten" required
                               value="<?= htmlspecialchars(old('ho_ten', '')) ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Nhập họ và tên">
                        <?php if (has_error('ho_ten')): ?>
                            <p class="text-red-500 text-sm mt-1"><?= get_error('ho_ten') ?></p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="so_cccd" class="block text-sm font-medium text-gray-700 mb-2">
                            Số CCCD <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="so_cccd" name="so_cccd" required
                               value="<?= htmlspecialchars(old('so_cccd', '')) ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Nhập số CCCD">
                        <?php if (has_error('so_cccd')): ?>
                            <p class="text-red-500 text-sm mt-1"><?= get_error('so_cccd') ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Thông tin liên hệ -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Thông tin liên hệ</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="mail" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="mail" name="mail" required
                               value="<?= htmlspecialchars(old('mail', '')) ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Nhập địa chỉ email">
                        <?php if (has_error('mail')): ?>
                            <p class="text-red-500 text-sm mt-1"><?= get_error('mail') ?></p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="sdt" class="block text-sm font-medium text-gray-700 mb-2">
                            Số điện thoại <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="sdt" name="sdt" required
                               value="<?= htmlspecialchars(old('sdt', '')) ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Nhập số điện thoại">
                        <?php if (has_error('sdt')): ?>
                            <p class="text-red-500 text-sm mt-1"><?= get_error('sdt') ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Mật khẩu -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Mật khẩu</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="mat_khau" class="block text-sm font-medium text-gray-700 mb-2">
                            Mật khẩu <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="mat_khau" name="mat_khau" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Nhập mật khẩu">
                        <?php if (has_error('mat_khau')): ?>
                            <p class="text-red-500 text-sm mt-1"><?= get_error('mat_khau') ?></p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">
                            Xác nhận mật khẩu <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="confirm_password" name="confirm_password" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Nhập lại mật khẩu">
                        <?php if (has_error('confirm_password')): ?>
                            <p class="text-red-500 text-sm mt-1"><?= get_error('confirm_password') ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Phân quyền -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Phân quyền</h3>
                <div>
                    <label for="phan_quyen" class="block text-sm font-medium text-gray-700 mb-2">
                        Vai trò <span class="text-red-500">*</span>
                    </label>
                    <?php $currentUser = auth_check() ? user() : null; ?>
                    <select id="phan_quyen" name="phan_quyen" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Chọn vai trò</option>
                        <option value="Khách hàng" <?= old('phan_quyen') === 'Khách hàng' ? 'selected' : '' ?>>Khách hàng</option>
                        <?php if ($currentUser && $currentUser->phan_quyen === 'Quản lý'): ?>
                        <option value="Lễ tân" <?= old('phan_quyen') === 'Lễ tân' ? 'selected' : '' ?>>Lễ tân</option>
                        <option value="Quản lý" <?= old('phan_quyen') === 'Quản lý' ? 'selected' : '' ?>>Quản lý</option>
                        <?php endif; ?>
                    </select>
                    <?php if (has_error('phan_quyen')): ?>
                        <p class="text-red-500 text-sm mt-1"><?= get_error('phan_quyen') ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="/admin/tai-khoan" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Hủy
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-save mr-2"></i>
                    Tạo tài khoản
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Validate password confirmation
document.getElementById('confirm_password').addEventListener('input', function() {
    const password = document.getElementById('mat_khau').value;
    const confirmPassword = this.value;
    
    if (password !== confirmPassword) {
        this.setCustomValidity('Mật khẩu xác nhận không khớp');
    } else {
        this.setCustomValidity('');
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
