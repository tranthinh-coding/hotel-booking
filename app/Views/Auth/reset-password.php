<?php
$title = 'Đặt lại mật khẩu - Hotel Ocean';
ob_start();
?>

<div class="max-w-md mx-auto">
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                <i class="fas fa-key text-3xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Đặt lại mật khẩu</h1>
            <p class="text-gray-600 mt-2">Tạo mật khẩu mới cho tài khoản của bạn</p>
        </div>

        <!-- Form -->
        <form action="/reset-password" method="POST" class="space-y-6">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token ?? '') ?>">
            <input type="hidden" name="email" value="<?= htmlspecialchars($email ?? '') ?>">

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-lock mr-1"></i> Mật khẩu mới
                </label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                       required
                       placeholder="Nhập mật khẩu mới (tối thiểu 6 ký tự)"
                       minlength="6">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-lock mr-1"></i> Xác nhận mật khẩu
                </label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                       required
                       placeholder="Nhập lại mật khẩu mới">
            </div>

            <!-- Password Requirements -->
            <div class="bg-gray-50 rounded-xl p-4">
                <h4 class="text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                    Yêu cầu mật khẩu:
                </h4>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        Tối thiểu 6 ký tự
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        Nên chứa ít nhất một chữ cái viết hoa
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        Nên chứa ít nhất một số
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        Nên chứa ký tự đặc biệt
                    </li>
                </ul>
            </div>

            <button type="submit" 
                    class="w-full bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg">
                <i class="fas fa-save mr-2"></i>
                Đặt lại mật khẩu
            </button>
        </form>

        <!-- Security notice -->
        <div class="mt-6 p-4 bg-yellow-50 rounded-xl">
            <h4 class="text-sm font-medium text-yellow-800 mb-2">
                <i class="fas fa-shield-alt mr-1"></i>
                Bảo mật:
            </h4>
            <p class="text-sm text-yellow-700">
                Sau khi đặt lại mật khẩu, bạn sẽ được tự động đăng nhập. 
                Hãy đảm bảo giữ mật khẩu an toàn và không chia sẻ với ai.
            </p>
        </div>

        <!-- Back to login -->
        <div class="text-center mt-6">
            <a href="/login" class="text-ocean-600 hover:text-ocean-700 font-medium transition-colors">
                <i class="fas fa-arrow-left mr-1"></i>
                Quay lại đăng nhập
            </a>
        </div>
    </div>
</div>

<script>
// Password confirmation validation
document.getElementById('password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmation = this.value;
    
    if (confirmation && password !== confirmation) {
        this.setCustomValidity('Mật khẩu xác nhận không khớp');
    } else {
        this.setCustomValidity('');
    }
});

document.getElementById('password').addEventListener('input', function() {
    const confirmation = document.getElementById('password_confirmation');
    if (confirmation.value && this.value !== confirmation.value) {
        confirmation.setCustomValidity('Mật khẩu xác nhận không khớp');
    } else {
        confirmation.setCustomValidity('');
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
