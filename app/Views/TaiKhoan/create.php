<?php $title = 'Tạo tài khoản mới'; ?>
<?php include_once __DIR__ . '/../layouts/app.php'; ?>

<?php ob_start(); ?>

<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm text-slate-600">
            <li><a href="/" class="hover:text-cyan-600 transition-colors">Trang chủ</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="/tai-khoan" class="hover:text-cyan-600 transition-colors">Tài khoản</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-slate-800 font-medium">Tạo tài khoản mới</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800 mb-2">Tạo tài khoản mới</h1>
        <p class="text-slate-600">Thêm tài khoản người dùng mới vào hệ thống</p>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="xl:col-span-2">
            <form id="createAccountForm" class="space-y-6">
                <!-- Basic Info Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-cyan-50 to-blue-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Thông tin cơ bản</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="ho_ten" class="block text-sm font-medium text-slate-700 mb-2">
                                    Họ và tên <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="ho_ten" name="ho_ten" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       placeholder="Nhập họ và tên"
                                       required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       placeholder="user@example.com"
                                       required>
                                <p class="text-xs text-slate-500 mt-1">Email sẽ được sử dụng để đăng nhập</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="so_dien_thoai" class="block text-sm font-medium text-slate-700 mb-2">
                                    Số điện thoại <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" id="so_dien_thoai" name="so_dien_thoai" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       placeholder="0123456789"
                                       required>
                            </div>
                            <div>
                                <label for="ngay_sinh" class="block text-sm font-medium text-slate-700 mb-2">
                                    Ngày sinh <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="ngay_sinh" name="ngay_sinh" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="gioi_tinh" class="block text-sm font-medium text-slate-700 mb-2">
                                    Giới tính <span class="text-red-500">*</span>
                                </label>
                                <select id="gioi_tinh" name="gioi_tinh" 
                                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                        required>
                                    <option value="">Chọn giới tính</option>
                                    <option value="nam">Nam</option>
                                    <option value="nu">Nữ</option>
                                    <option value="khac">Khác</option>
                                </select>
                            </div>
                            <div>
                                <label for="vai_tro" class="block text-sm font-medium text-slate-700 mb-2">
                                    Vai trò <span class="text-red-500">*</span>
                                </label>
                                <select id="vai_tro" name="vai_tro" 
                                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                        required>
                                    <option value="">Chọn vai trò</option>
                                    <option value="khach_hang">Khách hàng</option>
                                    <option value="nhan_vien">Nhân viên</option>
                                    <option value="quan_ly">Quản lý</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Password Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Mật khẩu</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="mat_khau" class="block text-sm font-medium text-slate-700 mb-2">
                                    Mật khẩu <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" id="mat_khau" name="mat_khau" 
                                           class="w-full px-3 py-2 pr-10 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                           placeholder="Nhập mật khẩu"
                                           required>
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('mat_khau')">
                                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="mt-2">
                                    <div class="flex items-center space-x-1 text-xs">
                                        <div id="length-check" class="flex items-center">
                                            <span class="w-3 h-3 rounded-full bg-slate-300 mr-1"></span>
                                            <span class="text-slate-500">Ít nhất 8 ký tự</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-1 text-xs mt-1">
                                        <div id="uppercase-check" class="flex items-center">
                                            <span class="w-3 h-3 rounded-full bg-slate-300 mr-1"></span>
                                            <span class="text-slate-500">Chữ hoa</span>
                                        </div>
                                        <div id="number-check" class="flex items-center ml-4">
                                            <span class="w-3 h-3 rounded-full bg-slate-300 mr-1"></span>
                                            <span class="text-slate-500">Số</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="xac_nhan_mat_khau" class="block text-sm font-medium text-slate-700 mb-2">
                                    Xác nhận mật khẩu <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" id="xac_nhan_mat_khau" name="xac_nhan_mat_khau" 
                                           class="w-full px-3 py-2 pr-10 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                           placeholder="Nhập lại mật khẩu"
                                           required>
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('xac_nhan_mat_khau')">
                                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <p id="password-match" class="text-xs text-slate-500 mt-1">Mật khẩu phải trùng khớp</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-50 to-green-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Địa chỉ</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="dia_chi" class="block text-sm font-medium text-slate-700 mb-2">
                                Địa chỉ
                            </label>
                            <input type="text" id="dia_chi" name="dia_chi" 
                                   class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                   placeholder="Số nhà, tên đường">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="thanh_pho" class="block text-sm font-medium text-slate-700 mb-2">
                                    Thành phố
                                </label>
                                <select id="thanh_pho" name="thanh_pho" 
                                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all">
                                    <option value="">Chọn thành phố</option>
                                    <option value="ho_chi_minh">Hồ Chí Minh</option>
                                    <option value="ha_noi">Hà Nội</option>
                                    <option value="da_nang">Đà Nẵng</option>
                                    <option value="can_tho">Cần Thơ</option>
                                    <option value="hai_phong">Hải Phòng</option>
                                </select>
                            </div>
                            <div>
                                <label for="quan_huyen" class="block text-sm font-medium text-slate-700 mb-2">
                                    Quận/Huyện
                                </label>
                                <input type="text" id="quan_huyen" name="quan_huyen" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       placeholder="Quận/Huyện">
                            </div>
                            <div>
                                <label for="ma_buu_dien" class="block text-sm font-medium text-slate-700 mb-2">
                                    Mã bưu điện
                                </label>
                                <input type="text" id="ma_buu_dien" name="ma_buu_dien" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       placeholder="700000">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Cài đặt tài khoản</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="checkbox" id="email_xac_thuc" name="email_xac_thuc" value="1"
                                           class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-slate-300 rounded">
                                    <label for="email_xac_thuc" class="ml-2 block text-sm text-slate-700">
                                        Gửi email xác thực ngay
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="trang_thai" name="trang_thai" value="1" checked
                                           class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-slate-300 rounded">
                                    <label for="trang_thai" class="ml-2 block text-sm text-slate-700">
                                        Kích hoạt tài khoản
                                    </label>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="checkbox" id="thong_bao_email" name="thong_bao_email" value="1"
                                           class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-slate-300 rounded">
                                    <label for="thong_bao_email" class="ml-2 block text-sm text-slate-700">
                                        Nhận thông báo qua email
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="thong_bao_sms" name="thong_bao_sms" value="1"
                                           class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-slate-300 rounded">
                                    <label for="thong_bao_sms" class="ml-2 block text-sm text-slate-700">
                                        Nhận thông báo qua SMS
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end">
                    <a href="/tai-khoan" 
                       class="px-6 py-2 border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors text-center">
                        Hủy bỏ
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-medium rounded-lg hover:from-cyan-600 hover:to-blue-700 transition-all transform hover:scale-105 shadow-lg">
                        Tạo tài khoản
                    </button>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Guide -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Hướng dẫn</h3>
                </div>
                <div class="p-6">
                    <ul class="text-sm text-slate-600 space-y-2">
                        <li class="flex items-start space-x-2">
                            <span class="w-2 h-2 bg-cyan-500 rounded-full mt-2 flex-shrink-0"></span>
                            <span>Email phải là duy nhất trong hệ thống</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="w-2 h-2 bg-cyan-500 rounded-full mt-2 flex-shrink-0"></span>
                            <span>Mật khẩu phải có ít nhất 8 ký tự</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="w-2 h-2 bg-cyan-500 rounded-full mt-2 flex-shrink-0"></span>
                            <span>Số điện thoại có thể được dùng để khôi phục tài khoản</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="w-2 h-2 bg-cyan-500 rounded-full mt-2 flex-shrink-0"></span>
                            <span>Vai trò quyết định quyền hạn của người dùng</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Account Stats -->
            <div class="bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl border border-cyan-200 p-6">
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Thống kê hệ thống</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Tổng tài khoản</span>
                        <span class="text-lg font-bold text-cyan-600">1,234</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Hoạt động</span>
                        <span class="text-lg font-bold text-green-600">1,180</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Khóa</span>
                        <span class="text-lg font-bold text-red-600">54</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Hôm nay</span>
                        <span class="text-lg font-bold text-blue-600">+12</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const type = field.type === 'password' ? 'text' : 'password';
    field.type = type;
}

document.addEventListener('DOMContentLoaded', function() {
    // Password strength checking
    const passwordInput = document.getElementById('mat_khau');
    const confirmPasswordInput = document.getElementById('xac_nhan_mat_khau');
    const lengthCheck = document.getElementById('length-check');
    const uppercaseCheck = document.getElementById('uppercase-check');
    const numberCheck = document.getElementById('number-check');
    const passwordMatch = document.getElementById('password-match');

    function updatePasswordStrength() {
        const password = passwordInput.value;
        
        // Length check
        if (password.length >= 8) {
            lengthCheck.querySelector('span').classList.remove('bg-slate-300');
            lengthCheck.querySelector('span').classList.add('bg-green-500');
            lengthCheck.querySelector('span:last-child').classList.remove('text-slate-500');
            lengthCheck.querySelector('span:last-child').classList.add('text-green-600');
        } else {
            lengthCheck.querySelector('span').classList.remove('bg-green-500');
            lengthCheck.querySelector('span').classList.add('bg-slate-300');
            lengthCheck.querySelector('span:last-child').classList.remove('text-green-600');
            lengthCheck.querySelector('span:last-child').classList.add('text-slate-500');
        }
        
        // Uppercase check
        if (/[A-Z]/.test(password)) {
            uppercaseCheck.querySelector('span').classList.remove('bg-slate-300');
            uppercaseCheck.querySelector('span').classList.add('bg-green-500');
            uppercaseCheck.querySelector('span:last-child').classList.remove('text-slate-500');
            uppercaseCheck.querySelector('span:last-child').classList.add('text-green-600');
        } else {
            uppercaseCheck.querySelector('span').classList.remove('bg-green-500');
            uppercaseCheck.querySelector('span').classList.add('bg-slate-300');
            uppercaseCheck.querySelector('span:last-child').classList.remove('text-green-600');
            uppercaseCheck.querySelector('span:last-child').classList.add('text-slate-500');
        }
        
        // Number check
        if (/\d/.test(password)) {
            numberCheck.querySelector('span').classList.remove('bg-slate-300');
            numberCheck.querySelector('span').classList.add('bg-green-500');
            numberCheck.querySelector('span:last-child').classList.remove('text-slate-500');
            numberCheck.querySelector('span:last-child').classList.add('text-green-600');
        } else {
            numberCheck.querySelector('span').classList.remove('bg-green-500');
            numberCheck.querySelector('span').classList.add('bg-slate-300');
            numberCheck.querySelector('span:last-child').classList.remove('text-green-600');
            numberCheck.querySelector('span:last-child').classList.add('text-slate-500');
        }
    }

    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (confirmPassword === '') {
            passwordMatch.textContent = 'Mật khẩu phải trùng khớp';
            passwordMatch.classList.remove('text-green-600', 'text-red-600');
            passwordMatch.classList.add('text-slate-500');
        } else if (password === confirmPassword) {
            passwordMatch.textContent = 'Mật khẩu trùng khớp';
            passwordMatch.classList.remove('text-slate-500', 'text-red-600');
            passwordMatch.classList.add('text-green-600');
        } else {
            passwordMatch.textContent = 'Mật khẩu không trùng khớp';
            passwordMatch.classList.remove('text-slate-500', 'text-green-600');
            passwordMatch.classList.add('text-red-600');
        }
    }

    passwordInput.addEventListener('input', updatePasswordStrength);
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    passwordInput.addEventListener('input', checkPasswordMatch);

    // Email validation
    const emailInput = document.getElementById('email');
    emailInput.addEventListener('blur', function() {
        const email = this.value;
        if (email) {
            // Simulate email validation
            setTimeout(() => {
                if (email === 'test@example.com') {
                    this.classList.add('border-red-500');
                    this.classList.remove('border-slate-300');
                    // Show error message
                } else {
                    this.classList.remove('border-red-500');
                    this.classList.add('border-green-500');
                }
            }, 500);
        }
    });

    // Phone number formatting
    const phoneInput = document.getElementById('so_dien_thoai');
    phoneInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 10) value = value.slice(0, 10);
        this.value = value;
    });

    // Form submission
    const form = document.getElementById('createAccountForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validation
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (password !== confirmPassword) {
            alert('Mật khẩu và xác nhận mật khẩu không trùng khớp!');
            return;
        }
        
        if (password.length < 8 || !/[A-Z]/.test(password) || !/\d/.test(password)) {
            alert('Mật khẩu không đáp ứng yêu cầu bảo mật!');
            return;
        }
        
        // Success animation
        const button = form.querySelector('button[type="submit"]');
        button.innerHTML = '<span class="flex items-center"><svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Đang tạo tài khoản...</span>';
        button.disabled = true;
        
        setTimeout(() => {
            alert('Tạo tài khoản thành công!');
            window.location.href = '/tai-khoan';
        }, 2000);
    });

    // Animation on load
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 200);
    });
});
</script>

<?php $content = ob_get_clean(); ?>
<?php echo $content; ?>
