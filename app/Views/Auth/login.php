<?php
$title = 'Đăng nhập - Hotel Ocean';
ob_start();
?>

<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full space-y-8">
        <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl p-8 border border-ocean-200">
            <!-- Header -->
            <div class="text-center">
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-ocean-500 to-seafoam-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-hotel text-2xl text-white"></i>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Đăng nhập</h2>
                <p class="text-gray-600">Chào mừng bạn trở lại với Hotel Ocean</p>
            </div>

            <!-- Login Form -->
            <form class="mt-8 space-y-6" method="POST" action="/login">
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-envelope mr-1 text-ocean-600"></i> Email
                        </label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            required 
                            value="<?= old('email') ?>"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition-all duration-200 bg-white/50"
                            placeholder="your@email.com"
                        >
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-lock mr-1 text-ocean-600"></i> Mật khẩu
                        </label>
                        <div class="relative">
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition-all duration-200 bg-white/50 pr-12"
                                placeholder="••••••••"
                            >
                            <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="password-toggle"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-ocean-600 shadow-sm focus:border-ocean-300 focus:ring focus:ring-ocean-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-600">Ghi nhớ đăng nhập</span>
                    </label>
                    <a href="/forgot-password" class="text-sm text-ocean-600 hover:text-ocean-800 font-medium">
                        Quên mật khẩu?
                    </a>
                </div>

                <button 
                    type="submit" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-ocean-600 to-seafoam-600 hover:from-ocean-700 hover:to-seafoam-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ocean-500 transition-all duration-200 transform hover:scale-105"
                >
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Đăng nhập
                </button>
            </form>

            <!-- Register Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Chưa có tài khoản? 
                    <a href="/register" class="font-medium text-ocean-600 hover:text-ocean-800 transition-colors">
                        Đăng ký ngay
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const toggle = document.getElementById(inputId + '-toggle');
    
    if (input.type === 'password') {
        input.type = 'text';
        toggle.classList.remove('fa-eye');
        toggle.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        toggle.classList.remove('fa-eye-slash');
        toggle.classList.add('fa-eye');
    }
}
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../layouts/app.php';
?>
