<?php
$title = 'Đăng ký - Hotel Ocean';
ob_start();
?>

<div class="min-h-screen flex items-center justify-center py-12">
    <div class="max-w-md w-full space-y-8">
        <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl p-8 border border-ocean-200">
            <!-- Header -->
            <div class="text-center">
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-seafoam-500 to-ocean-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-plus text-2xl text-white"></i>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Đăng ký</h2>
                <p class="text-gray-600">Tạo tài khoản mới tại Hotel Ocean</p>
            </div>

            <!-- Register Form -->
            <form class="mt-8 space-y-6" method="POST" action="/register">
                <div class="space-y-4">
                    <div>
                        <label for="ho_ten" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-user mr-1 text-ocean-600"></i> Họ và tên
                        </label>
                        <input 
                            id="ho_ten" 
                            name="ho_ten" 
                            type="text" 
                            required 
                            value="<?= old('ho_ten') ?>"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition-all duration-200 bg-white/50"
                            placeholder="Nguyễn Văn A"
                        >
                    </div>

                    <div>
                        <label for="so_cccd" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-id-card mr-1 text-ocean-600"></i> Số CCCD
                        </label>
                        <input 
                            id="so_cccd" 
                            name="so_cccd" 
                            type="text" 
                            required 
                            value="<?= old('so_cccd') ?>"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition-all duration-200 bg-white/50"
                            placeholder="012345678901"
                        >
                    </div>

                    <div>
                        <label for="sdt" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-phone mr-1 text-ocean-600"></i> Số điện thoại
                        </label>
                        <input 
                            id="sdt" 
                            name="sdt" 
                            type="tel" 
                            required 
                            value="<?= old('sdt') ?>"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition-all duration-200 bg-white/50"
                            placeholder="0123456789"
                        >
                    </div>
                    
                    <div>
                        <label for="mail" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-envelope mr-1 text-ocean-600"></i> Email
                        </label>
                        <input 
                            id="mail" 
                            name="mail" 
                            type="email" 
                            required 
                            value="<?= old('mail') ?>"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition-all duration-200 bg-white/50"
                            placeholder="your@email.com"
                        >
                    </div>
                    
                    <div>
                        <label for="mat_khau" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-lock mr-1 text-ocean-600"></i> Mật khẩu
                        </label>
                        <div class="relative">
                            <input 
                                id="mat_khau" 
                                name="mat_khau" 
                                type="password" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition-all duration-200 bg-white/50 pr-12"
                                placeholder="••••••••"
                            >
                            <button type="button" onclick="togglePassword('mat_khau')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="mat_khau-toggle"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-lock mr-1 text-ocean-600"></i> Xác nhận mật khẩu
                        </label>
                        <div class="relative">
                            <input 
                                id="confirm_password" 
                                name="confirm_password" 
                                type="password" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition-all duration-200 bg-white/50 pr-12"
                                placeholder="••••••••"
                            >
                            <button type="button" onclick="togglePassword('confirm_password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="confirm_password-toggle"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" required class="rounded border-gray-300 text-ocean-600 shadow-sm focus:border-ocean-300 focus:ring focus:ring-ocean-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-600">
                        Tôi đồng ý với <a href="/terms" class="text-ocean-600 hover:text-ocean-800">Điều khoản dịch vụ</a> và 
                        <a href="/privacy" class="text-ocean-600 hover:text-ocean-800">Chính sách bảo mật</a>
                    </span>
                </div>

                <button 
                    type="submit" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-seafoam-600 to-ocean-600 hover:from-seafoam-700 hover:to-ocean-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ocean-500 transition-all duration-200 transform hover:scale-105"
                >
                    <i class="fas fa-user-plus mr-2"></i>
                    Đăng ký
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Đã có tài khoản? 
                    <a href="/login" class="font-medium text-ocean-600 hover:text-ocean-800 transition-colors">
                        Đăng nhập ngay
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
