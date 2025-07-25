<?php
$title = 'Đổi mật khẩu - Hotel Ocean';
ob_start();
?>

<div class="min-h-screen bg-gray-50 pb-7 pt-12">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div
                    class="w-20 h-20 bg-gradient-to-br from-ocean-500 to-seafoam-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-key text-3xl text-white"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800">Đổi mật khẩu</h1>
                <p class="text-gray-600 mt-2">Cập nhật mật khẩu để bảo mật tài khoản</p>
            </div>

            <!-- Form -->
            <form action="/change-password" method="POST" class="space-y-6">
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-1"></i> Mật khẩu hiện tại
                    </label>
                    <input type="password" id="current_password" name="current_password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all"
                        required placeholder="Nhập mật khẩu hiện tại">
                </div>

                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-key mr-1"></i> Mật khẩu mới
                    </label>
                    <input type="password" id="new_password" name="new_password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all"
                        required placeholder="Nhập mật khẩu mới (tối thiểu 6 ký tự)" minlength="6">
                </div>

                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-1"></i> Xác nhận mật khẩu mới
                    </label>
                    <input type="password" id="confirm_password" name="confirm_password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all"
                        required placeholder="Nhập lại mật khẩu mới">
                </div>

                <div class="flex items-center justify-between pt-6">
                    <a href="/profile" class="text-gray-600 hover:text-gray-800 font-medium transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Quay lại thông tin cá nhân
                    </a>

                    <button type="submit"
                        class="bg-ocean-600 text-white px-8 py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg">
                        <i class="fas fa-save mr-2"></i>
                        Cập nhật mật khẩu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Password confirmation validation
    document.getElementById('confirm_password').addEventListener('input', function () {
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = this.value;

        if (confirmPassword && newPassword !== confirmPassword) {
            this.setCustomValidity('Mật khẩu xác nhận không khớp');
        } else {
            this.setCustomValidity('');
        }
    });

    document.getElementById('new_password').addEventListener('input', function () {
        const confirmPassword = document.getElementById('confirm_password');
        if (confirmPassword.value && this.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('Mật khẩu xác nhận không khớp');
        } else {
            confirmPassword.setCustomValidity('');
        }
    });
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../layouts/app.php';
?>