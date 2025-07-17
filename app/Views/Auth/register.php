<?php
$title = 'Đăng ký - Hotel Ocean';
ob_start();
?>

<div class="register-container min-h-screen relative overflow-hidden bg-gradient-to-br from-ocean-100 via-ocean-50 to-white">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Floating Bubbles Animation -->
        <div class="bubble-animation">
            <div class="bubble bubble-1"></div>
            <div class="bubble bubble-2"></div>
            <div class="bubble bubble-3"></div>
            <div class="bubble bubble-4"></div>
            <div class="bubble bubble-5"></div>
            <div class="bubble bubble-6"></div>
        </div>
        
        <!-- Gradient Orbs -->
        <div class="absolute top-20 -left-20 w-96 h-96 bg-gradient-to-r from-ocean-400/30 to-seafoam-400/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-gradient-to-r from-seafoam-400/30 to-ocean-400/30 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>

    <div class="relative z-10 flex items-center justify-center min-h-screen py-16 px-4">
        <div class="w-full max-w-6xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                
                <!-- Left Side - Hero Content -->
                <div class="hidden lg:block space-y-8 fade-in-left">
                    <div class="text-center lg:text-left">
                        <h1 class="text-5xl font-bold bg-gradient-to-r from-ocean-700 to-ocean-600 bg-clip-text text-transparent mb-6">
                            Chào mừng đến với Ocean Pearl Hotel
                        </h1>
                        <p class="text-xl text-gray-600 mb-8">
                            Tham gia cộng đồng những người yêu thích du lịch và khám phá những trải nghiệm tuyệt vời tại khách sạn 5 sao của chúng tôi.
                        </p>
                    </div>

                    <!-- Features -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4 bg-white/80 backdrop-blur-sm rounded-2xl p-4 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-star text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Ưu đãi độc quyền</h3>
                                <p class="text-gray-600 text-sm">Giảm giá đặc biệt cho thành viên</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 bg-white/80 backdrop-blur-sm rounded-2xl p-4 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-bell text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Thông báo ưu tiên</h3>
                                <p class="text-gray-600 text-sm">Nhận tin về khuyến mãi sớm nhất</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 bg-white/80 backdrop-blur-sm rounded-2xl p-4 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-crown text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Dịch vụ VIP</h3>
                                <p class="text-gray-600 text-sm">Trải nghiệm dịch vụ đẳng cấp</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hotel Image -->
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-r from-ocean-500/20 to-seafoam-500/20 rounded-3xl transform rotate-3 group-hover:rotate-6 transition-transform duration-500"></div>
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                             alt="Ocean Pearl Hotel" 
                             class="relative w-full h-64 object-cover rounded-3xl shadow-lg group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-3xl flex items-end p-6">
                            <div class="text-white">
                                <h3 class="text-lg font-semibold">Ocean Pearl Hotel</h3>
                                <p class="text-sm opacity-90">Hoàng Mai, Hà Nội</p>
                            </div>
                        </div>
                    </div>
                </div>
 
                <!-- Right Side - Registration Form -->
                <div class="fade-in-right">
                    <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-lg p-8 border border-white/30 hover:shadow-xl transition-all duration-500">
                        <!-- Header -->
                        <div class="text-center mb-8">
                            <div class="flex justify-center mb-6">
                                <div class="w-20 h-20 rounded-full overflow-hidden shadow-md ocean-wave-animation">
                                    <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" 
                                         alt="Ocean Waves" 
                                         class="w-full h-full object-cover wave-effect">
                                </div>
                            </div>
                            <h2 class="text-3xl font-bold bg-gradient-to-r from-ocean-700 to-ocean-600 bg-clip-text text-transparent mb-2">
                                Đăng ký tài khoản
                            </h2>
                            <p class="text-gray-600">Tạo tài khoản mới để tận hưởng những ưu đãi đặc biệt</p>
                        </div>

                        <!-- Register Form -->
                        <form class="space-y-6" method="POST" action="/register" id="registerForm">
                            <!-- Row 1 -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="form-group">
                                    <label for="ho_ten" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-user mr-2 text-ocean-600"></i>Họ và tên
                                    </label>
                                    <input 
                                        id="ho_ten" 
                                        name="ho_ten" 
                                        type="text" 
                                        required 
                                        value="<?= old('ho_ten') ?>"
                                        class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 focus:outline-none transition-all duration-300 bg-white/80 hover:bg-white"
                                        placeholder="Nguyễn Văn A"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="so_cccd" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-id-card mr-2 text-ocean-600"></i>Số CCCD
                                    </label>
                                    <input 
                                        id="so_cccd" 
                                        name="so_cccd" 
                                        type="text" 
                                        required 
                                        value="<?= old('so_cccd') ?>"
                                        class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 focus:outline-none transition-all duration-300 bg-white/80 hover:bg-white"
                                        placeholder="012345678901"
                                    >
                                </div>
                            </div>

                            <!-- Row 2 -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="form-group">
                                    <label for="sdt" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-phone mr-2 text-ocean-600"></i>Số điện thoại
                                    </label>
                                    <input 
                                        id="sdt" 
                                        name="sdt" 
                                        type="tel" 
                                        required 
                                        value="<?= old('sdt') ?>"
                                        class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 focus:outline-none transition-all duration-300 bg-white/80 hover:bg-white"
                                        placeholder="0123456789"
                                    >
                                </div>
                                
                                <div class="form-group">
                                    <label for="mail" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-envelope mr-2 text-ocean-600"></i>Email
                                    </label>
                                    <input 
                                        id="mail" 
                                        name="mail" 
                                        type="email" 
                                        required 
                                        value="<?= old('mail') ?>"
                                        class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 focus:outline-none transition-all duration-300 bg-white/80 hover:bg-white"
                                        placeholder="your@email.com"
                                    >
                                </div>
                            </div>

                            <!-- Row 3 -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="form-group">
                                    <label for="mat_khau" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-lock mr-2 text-ocean-600"></i>Mật khẩu
                                    </label>
                                    <div class="relative">
                                        <input 
                                            id="mat_khau" 
                                            name="mat_khau" 
                                            type="password" 
                                            required
                                            class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 focus:outline-none transition-all duration-300 bg-white/80 hover:bg-white pr-12"
                                            placeholder="••••••••"
                                        >
                                        <button type="button" onclick="togglePassword('mat_khau')" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                            <i class="fas fa-eye text-gray-400 hover:text-ocean-600 transition-colors" id="mat_khau-toggle"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-lock mr-2 text-ocean-600"></i>Xác nhận mật khẩu
                                    </label>
                                    <div class="relative">
                                        <input 
                                            id="confirm_password" 
                                            name="confirm_password" 
                                            type="password" 
                                            required
                                            class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 focus:outline-none transition-all duration-300 bg-white/80 hover:bg-white pr-12"
                                            placeholder="••••••••"
                                        >
                                        <button type="button" onclick="togglePassword('confirm_password')" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                            <i class="fas fa-eye text-gray-400 hover:text-ocean-600 transition-colors" id="confirm_password-toggle"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms Checkbox -->
                            <div class="flex items-start space-x-3 p-4 bg-ocean-50/50 rounded-xl border border-ocean-100">
                                <input type="checkbox" required class="mt-1 rounded border-gray-300 text-ocean-600 shadow-sm focus:border-ocean-300 focus:ring focus:ring-ocean-200 focus:ring-opacity-50">
                                <span class="text-sm text-gray-700 leading-relaxed">
                                    Tôi đồng ý với 
                                    <a href="/terms" class="text-ocean-600 hover:text-ocean-800 font-medium underline">Điều khoản dịch vụ</a> 
                                    và 
                                    <a href="/privacy" class="text-ocean-600 hover:text-ocean-800 font-medium underline">Chính sách bảo mật</a> 
                                    của Ocean Pearl Hotel
                                </span>
                            </div>

                            <!-- Submit Button -->
                            <button 
                                type="submit" 
                                class="w-full flex justify-center items-center py-4 px-6 border border-transparent rounded-xl shadow-md text-lg font-semibold text-white bg-gradient-to-r from-ocean-600 to-ocean-700 hover:from-ocean-700 hover:to-ocean-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ocean-500 transition-all duration-300 transform hover:scale-105 hover:shadow-lg"
                            >
                                <i class="fas fa-user-plus mr-3"></i>
                                <span>Tạo tài khoản</span>
                                <div class="ml-3 w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin hidden" id="loading"></div>
                            </button>
                        </form>

                        <!-- Login Link -->
                        <div class="mt-8 text-center p-4 bg-gray-50/50 rounded-xl">
                            <p class="text-gray-600">
                                Đã có tài khoản? 
                                <a href="/login" class="font-semibold text-ocean-600 hover:text-ocean-800 transition-colors hover:underline">
                                    Đăng nhập ngay
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Ocean Wave Animation for Header Icon */
.ocean-wave-animation {
    position: relative;
    overflow: hidden;
}

.wave-effect {
    animation: wave 3s ease-in-out infinite;
}

@keyframes wave {
    0%, 100% {
        transform: translateY(0px) scale(1);
        filter: brightness(1);
    }
    25% {
        transform: translateY(-2px) scale(1.05);
        filter: brightness(1.1);
    }
    50% {
        transform: translateY(0px) scale(1);
        filter: brightness(1);
    }
    75% {
        transform: translateY(-1px) scale(1.02);
        filter: brightness(1.05);
    }
}

.ocean-wave-animation::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    animation: shine 4s ease-in-out infinite;
}

@keyframes shine {
    0% {
        left: -100%;
    }
    50% {
        left: 100%;
    }
    100% {
        left: 100%;
    }
}

/* Bubble Animation */
.bubble-animation {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
    pointer-events: none;
}

.bubble {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(13, 148, 136, 0.15), rgba(52, 211, 153, 0.15));
    animation: floating 6s ease-in-out infinite;
}

.bubble-1 {
    width: 40px;
    height: 40px;
    left: 10%;
    animation-delay: 0s;
    animation-duration: 8s;
}

.bubble-2 {
    width: 60px;
    height: 60px;
    left: 20%;
    animation-delay: 2s;
    animation-duration: 10s;
}

.bubble-3 {
    width: 80px;
    height: 80px;
    left: 80%;
    animation-delay: 4s;
    animation-duration: 12s;
}

.bubble-4 {
    width: 30px;
    height: 30px;
    left: 70%;
    animation-delay: 1s;
    animation-duration: 9s;
}

.bubble-5 {
    width: 50px;
    height: 50px;
    left: 50%;
    animation-delay: 3s;
    animation-duration: 11s;
}

.bubble-6 {
    width: 35px;
    height: 35px;
    left: 90%;
    animation-delay: 5s;
    animation-duration: 7s;
}

@keyframes floating {
    0% {
        transform: translateY(100vh) rotate(0deg);
        opacity: 0;
    }
    10% {
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        transform: translateY(-100px) rotate(360deg);
        opacity: 0;
    }
}

/* Form Animations */
.fade-in-left {
    animation: fadeInLeft 1s ease-out;
}

.fade-in-right {
    animation: fadeInRight 1s ease-out 0.3s both;
}

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Form Group Animation */
.form-group {
    animation: slideUp 0.6s ease-out both;
}

.form-group:nth-child(1) { animation-delay: 0.1s; }
.form-group:nth-child(2) { animation-delay: 0.2s; }
.form-group:nth-child(3) { animation-delay: 0.3s; }
.form-group:nth-child(4) { animation-delay: 0.4s; }

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Input Focus Effects - Remove black outline */
.form-input {
    position: relative;
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.form-input:focus {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px -3px rgba(13, 148, 136, 0.15);
    outline: none !important;
    border-color: #0d9488 !important;
}

.form-input:hover {
    transform: translateY(-0.5px);
    box-shadow: 0 2px 8px -2px rgba(13, 148, 136, 0.1);
}

/* Remove all default outlines */
input:focus,
button:focus,
select:focus,
textarea:focus {
    outline: none !important;
    box-shadow: 0 0 0 2px rgba(13, 148, 136, 0.2) !important;
}

/* Button Ripple Effect */
.btn-submit {
    position: relative;
    overflow: hidden;
}

.btn-submit::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transition: width 0.6s, height 0.6s;
    transform: translate(-50%, -50%);
    z-index: 0;
}

.btn-submit:active::before {
    width: 300px;
    height: 300px;
}

/* Loading Animation */
@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Responsive Adjustments */
@media (max-width: 1024px) {
    .fade-in-left {
        animation: fadeInRight 1s ease-out;
    }
}

/* Blur Background */
.blur-3xl {
    filter: blur(120px);
}

/* Shadow Effects - More Reduced */
.shadow-3xl {
    box-shadow: 0 10px 25px -8px rgba(0, 0, 0, 0.08);
}

/* Custom form styles */
.form-input {
    border: 1px solid #e5e7eb;
}

.form-input:focus {
    border-color: #0d9488;
    box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
}

/* Fix margin issues and footer layout */
body {
    margin: 0 !important;
    padding: 0 !important;
}

.register-container {
    margin: 0 !important;
    padding: 0 !important;
}

.min-h-screen {
    min-height: 100vh;
    margin: 0 !important;
    padding-bottom: 0 !important;
}

/* Override footer margin for register page only */
body:has(.register-container) footer,
.register-container ~ footer,
.register-container + main + footer {
    margin-top: 0 !important;
}

/* Alternative approach - use CSS selector */
footer {
    margin-top: 0 !important;
}

/* Input focus effects with reduced shadow */
.form-input:focus {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px -3px rgba(13, 148, 136, 0.15);
    outline: none !important;
    border-color: #0d9488 !important;
}

.form-input:hover {
    transform: translateY(-0.5px);
    box-shadow: 0 2px 8px -2px rgba(13, 148, 136, 0.1);
}
</style>

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

// Form Validation & Loading State
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const button = this.querySelector('button[type="submit"]');
    const loading = document.getElementById('loading');
    const buttonText = button.querySelector('span');
    
    // Show loading state
    loading.classList.remove('hidden');
    buttonText.textContent = 'Đang xử lý...';
    button.disabled = true;
    
    // Password validation
    const password = document.getElementById('mat_khau').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (password !== confirmPassword) {
        e.preventDefault();
        alert('Mật khẩu xác nhận không khớp!');
        
        // Reset button state
        loading.classList.add('hidden');
        buttonText.textContent = 'Tạo tài khoản';
        button.disabled = false;
        return;
    }
    
    if (password.length < 6) {
        e.preventDefault();
        alert('Mật khẩu phải có ít nhất 6 ký tự!');
        
        // Reset button state
        loading.classList.add('hidden');
        buttonText.textContent = 'Tạo tài khoản';
        button.disabled = false;
        return;
    }
});

// Input Animation Effects
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
    });
    
    input.addEventListener('blur', function() {
        this.parentElement.classList.remove('focused');
    });
});

// Phone number formatting
document.getElementById('sdt').addEventListener('input', function() {
    let value = this.value.replace(/\D/g, '');
    if (value.length > 10) value = value.slice(0, 10);
    this.value = value;
});

// CCCD formatting
document.getElementById('so_cccd').addEventListener('input', function() {
    let value = this.value.replace(/\D/g, '');
    if (value.length > 12) value = value.slice(0, 12);
    this.value = value;
});

// Parallax effect for background elements
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const bubbles = document.querySelectorAll('.bubble');
    
    bubbles.forEach((bubble, index) => {
        const speed = 0.5 + (index * 0.1);
        bubble.style.transform = `translateY(${scrolled * speed}px)`;
    });
});

// Intersection Observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animationPlayState = 'running';
        }
    });
}, observerOptions);

document.querySelectorAll('.form-group').forEach(group => {
    observer.observe(group);
});

// Override footer margin for register page
document.addEventListener('DOMContentLoaded', function() {
    const footer = document.querySelector('footer');
    if (footer) {
        footer.style.marginTop = '0';
        footer.classList.remove('mt-20');
    }
});
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../layouts/app.php';
?>
