<?php
$title = 'Quên mật khẩu - Hotel Ocean';
ob_start();
?>

<div class="max-w-md mx-auto">
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-red-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                <i class="fas fa-question-circle text-3xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Quên mật khẩu?</h1>
            <p class="text-gray-600 mt-2">Không sao! Chúng tôi sẽ gửi link đặt lại mật khẩu vào email của bạn</p>
        </div>

        <!-- Form -->
        <form action="/forgot-password" method="POST" class="space-y-6">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-envelope mr-1"></i> Email đăng ký
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="<?= htmlspecialchars(old('email') ?? '') ?>"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                       required
                       placeholder="Nhập email của bạn">
            </div>

            <button type="submit" 
                    class="w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg">
                <i class="fas fa-paper-plane mr-2"></i>
                Gửi link đặt lại mật khẩu
            </button>
        </form>

        <!-- Back to login -->
        <div class="text-center mt-6">
            <p class="text-gray-600">
                Nhớ ra mật khẩu rồi? 
                <a href="/login" class="text-ocean-600 hover:text-ocean-700 font-medium transition-colors">
                    Đăng nhập ngay
                </a>
            </p>
        </div>

        <!-- Help section -->
        <div class="mt-8 p-4 bg-blue-50 rounded-xl">
            <h4 class="text-sm font-medium text-blue-800 mb-2">
                <i class="fas fa-lightbulb mr-1"></i>
                Lưu ý:
            </h4>
            <ul class="text-sm text-blue-700 space-y-1">
                <li>• Kiểm tra cả thư mục spam/junk mail</li>
                <li>• Link đặt lại có hiệu lực trong 15 phút</li>
                <li>• Nếu không nhận được email, thử lại sau 5 phút</li>
            </ul>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
