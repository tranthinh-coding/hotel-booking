<!DOCTYPE html>
<html lang="vi" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Ocean Pearl Hotel - Khách sạn sang trọng bên bờ biển' ?></title>
    <meta name="description" content="Ocean Pearl Hotel - Trải nghiệm nghỉ dưỡng sang trọng với view biển tuyệt đẹp, dịch vụ 5 sao và các tiện ích hiện đại.">
    
    <!-- Tailwind CSS v4 -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ocean: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- GSAP Animation Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- Custom Styles -->
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #0891b2 0%, #0d9488 50%, #065f46 100%);
        }
        
        .card-hover {
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.15);
        }
        
        .btn-ocean {
            background: linear-gradient(135deg, #0891b2, #0d9488);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .btn-ocean:hover {
            background: linear-gradient(135deg, #0e7490, #0f766e);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px -6px rgba(8, 145, 178, 0.3);
        }
        
        .navbar-blur {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid rgba(13, 148, 136, 0.08);
        }
        
        .soft-shadow {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.08);
        }
        
        .gentle-hover {
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .gentle-hover:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }
        
        @keyframes fadeInUp {
            from { 
                opacity: 0; 
                transform: translateY(30px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .text-shadow {
            text-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }
        
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 50%;
            background: linear-gradient(90deg, #0d9488, #14b8a6);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Toast Notifications */
        .toast {
            transform: translateX(100%);
            transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            opacity: 0;
            pointer-events: none;
        }
        
        .toast.show {
            transform: translateX(0);
            opacity: 1;
            pointer-events: auto;
        }
        
        .toast.hide {
            transform: translateX(100%);
            opacity: 0;
        }
        
        @media (max-width: 640px) {
            #toast-container {
                left: 1rem;
                right: 1rem;
                top: 1rem;
            }
            
            .toast {
                transform: translateY(-100%);
            }
            
            .toast.show {
                transform: translateY(0);
            }
            
            .toast.hide {
                transform: translateY(-100%);
            }
        }
    </style>
</head>
<body class="h-full bg-gradient-to-br from-gray-50 via-ocean-50 to-white">
    <!-- Navigation -->
    <nav class="navbar-blur sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-3 gentle-hover">
                        <div class="w-10 h-10 bg-gradient-to-br from-ocean-400 to-ocean-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-water text-white text-lg"></i>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-ocean-600 to-ocean-800 bg-clip-text text-transparent">
                            Ocean Pearl Hotel
                        </span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="nav-link text-gray-700 hover:text-ocean-600 font-medium">Trang chủ</a>
                    <a href="/phong" class="nav-link text-gray-700 hover:text-ocean-600 font-medium">Phòng nghỉ</a>
                    <a href="/dich-vu" class="nav-link text-gray-700 hover:text-ocean-600 font-medium">Dịch vụ</a>
                    <a href="/about" class="nav-link text-gray-700 hover:text-ocean-600 font-medium">Về chúng tôi</a>
                    <a href="/contact" class="nav-link text-gray-700 hover:text-ocean-600 font-medium">Liên hệ</a>
                    
                    <!-- User Menu -->
                    <div class="flex items-center space-x-4">
                        <?php if (function_exists('auth_check') && auth_check()): ?>
                            <?php $currentUser = user(); ?>
                            <div class="relative group">
                                <button class="flex items-center space-x-2 text-gray-700 hover:text-ocean-600 gentle-hover px-3 py-2 rounded-lg">
                                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($currentUser->ho_ten ?? 'User') ?>&background=0d9488&color=fff&size=32" 
                                         alt="Avatar" class="w-8 h-8 rounded-full ring-2 ring-ocean-100">
                                    <span class="font-medium"><?= htmlspecialchars($currentUser->ho_ten ?? 'User') ?></span>
                                    <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                                </button>
                                
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl soft-shadow border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform scale-95 group-hover:scale-100">
                                    <div class="py-2">
                                        <a href="/profile" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-ocean-50 transition-colors">
                                            <i class="fas fa-user w-4 mr-3 text-ocean-500"></i>Hồ sơ của tôi
                                        </a>
                                        <a href="/change-password" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-ocean-50 transition-colors">
                                            <i class="fas fa-key w-4 mr-3 text-ocean-500"></i>Đổi mật khẩu
                                        </a>
                                        <?php if (($currentUser->phan_quyen ?? '') === 'Quản lý' || ($currentUser->phan_quyen ?? '') === 'Lễ tân'): ?>
                                            <div class="border-t border-gray-100 my-1"></div>
                                            <a href="/admin/dashboard" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-ocean-50 transition-colors">
                                                <i class="fas fa-cog w-4 mr-3 text-ocean-500"></i>Quản trị
                                            </a>
                                        <?php endif; ?>
                                        <div class="border-t border-gray-100 my-1"></div>
                                        <form method="POST" action="/logout" class="block">
                                            <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                                <i class="fas fa-sign-out-alt w-4 mr-3"></i>Đăng xuất
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <a href="/login" class="text-gray-700 hover:text-ocean-600 transition-colors font-medium">Đăng nhập</a>
                            <a href="/register" class="btn-ocean text-white px-6 py-2 rounded-full text-sm font-medium">
                                Đăng ký ngay
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-700 hover:text-ocean-600 gentle-hover p-2 rounded-lg" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-100">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <a href="/" class="block px-3 py-3 text-gray-700 hover:bg-ocean-50 rounded-lg transition-colors">
                    <i class="fas fa-home w-5 mr-3 text-ocean-500"></i>Trang chủ
                </a>
                <a href="/phong" class="block px-3 py-3 text-gray-700 hover:bg-ocean-50 rounded-lg transition-colors">
                    <i class="fas fa-bed w-5 mr-3 text-ocean-500"></i>Phòng nghỉ
                </a>
                <a href="/dich-vu" class="block px-3 py-3 text-gray-700 hover:bg-ocean-50 rounded-lg transition-colors">
                    <i class="fas fa-concierge-bell w-5 mr-3 text-ocean-500"></i>Dịch vụ
                </a>
                <a href="/about" class="block px-3 py-3 text-gray-700 hover:bg-ocean-50 rounded-lg transition-colors">
                    <i class="fas fa-info-circle w-5 mr-3 text-ocean-500"></i>Về chúng tôi
                </a>
                <a href="/contact" class="block px-3 py-3 text-gray-700 hover:bg-ocean-50 rounded-lg transition-colors">
                    <i class="fas fa-phone w-5 mr-3 text-ocean-500"></i>Liên hệ
                </a>
                
                <?php if (function_exists('auth_check') && auth_check()): ?>
                    <div class="border-t border-gray-100 mt-2 pt-2">
                        <a href="/profile" class="block px-3 py-3 text-gray-700 hover:bg-ocean-50 rounded-lg transition-colors">
                            <i class="fas fa-user w-5 mr-3 text-ocean-500"></i>Hồ sơ
                        </a>
                        <?php $currentUser = user(); ?>
                        <?php if (($currentUser->phan_quyen ?? '') === 'Quản lý' || ($currentUser->phan_quyen ?? '') === 'Lễ tân'): ?>
                            <a href="/admin/dashboard" class="block px-3 py-3 text-gray-700 hover:bg-ocean-50 rounded-lg transition-colors">
                                <i class="fas fa-cog w-5 mr-3 text-ocean-500"></i>Quản trị
                            </a>
                        <?php endif; ?>
                        <form method="POST" action="/logout">
                            <button type="submit" class="w-full text-left px-3 py-3 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <i class="fas fa-sign-out-alt w-5 mr-3"></i>Đăng xuất
                            </button>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="border-t border-gray-100 mt-2 pt-2">
                        <a href="/login" class="block px-3 py-3 text-gray-700 hover:bg-ocean-50 rounded-lg transition-colors">
                            <i class="fas fa-sign-in-alt w-5 mr-3 text-ocean-500"></i>Đăng nhập
                        </a>
                        <a href="/register" class="block px-3 py-3 text-ocean-600 hover:bg-ocean-50 rounded-lg font-medium transition-colors">
                            <i class="fas fa-user-plus w-5 mr-3"></i>Đăng ký
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Flash Messages Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-3"></div>
    
    <?php if (function_exists('flash_get')): ?>
        <?php $success = flash_get('success'); ?>
        <?php $error = flash_get('error'); ?>
        <?php $info = flash_get('info'); ?>
        
        <?php if ($success): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    showToast('<?= addslashes(htmlspecialchars($success)) ?>', 'success');
                });
            </script>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    showToast('<?= addslashes(htmlspecialchars($error)) ?>', 'error');
                });
            </script>
        <?php endif; ?>
        
        <?php if ($info): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    showToast('<?= addslashes(htmlspecialchars($info)) ?>', 'info');
                });
            </script>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="flex-1">
        <?= $content ?? '' ?>
    </main>

    <!-- Footer -->
    <footer class="mt-20 bg-gradient-to-r from-ocean-900 via-ocean-800 to-ocean-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-ocean-400 to-ocean-600 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-water text-white text-xl"></i>
                        </div>
                        <span class="font-bold text-2xl">Ocean Pearl Hotel</span>
                    </div>
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        Khách sạn 5 sao với view biển tuyệt đẹp, dịch vụ chuyên nghiệp và không gian nghỉ dưỡng lý tưởng. 
                        Trải nghiệm những khoảnh khắc tuyệt vời bên gia đình và người thân.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-ocean-700 rounded-full flex items-center justify-center gentle-hover hover:bg-ocean-600">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-ocean-700 rounded-full flex items-center justify-center gentle-hover hover:bg-ocean-600">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-ocean-700 rounded-full flex items-center justify-center gentle-hover hover:bg-ocean-600">
                            <i class="fab fa-youtube text-sm"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-semibold mb-6 text-lg">Liên kết nhanh</h3>
                    <ul class="space-y-3 text-gray-300">
                        <li><a href="/phong" class="hover:text-ocean-300 transition-colors gentle-hover">Phòng nghỉ</a></li>
                        <li><a href="/dich-vu" class="hover:text-ocean-300 transition-colors gentle-hover">Dịch vụ</a></li>
                        <li><a href="/about" class="hover:text-ocean-300 transition-colors gentle-hover">Về chúng tôi</a></li>
                        <li><a href="/contact" class="hover:text-ocean-300 transition-colors gentle-hover">Liên hệ</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-semibold mb-6 text-lg">Thông tin liên hệ</h3>
                    <div class="space-y-3 text-gray-300">
                        <p class="flex items-start">
                            <i class="fas fa-map-marker-alt mr-3 mt-1 text-ocean-400"></i>
                            <span>123 Trần Phú, Nha Trang<br>Khánh Hòa, Việt Nam</span>
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-phone mr-3 text-ocean-400"></i>
                            <span>(84) 258 123 456</span>
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-ocean-400"></i>
                            <span>info@oceanpearl.com</span>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-ocean-700 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Ocean Pearl Hotel. Tất cả quyền được bảo lưu. | Thiết kế bởi Ocean Pearl Team</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Toast Notification System
        function showToast(message, type = 'info', duration = 5000) {
            const container = document.getElementById('toast-container');
            
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `toast max-w-sm w-full bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden`;
            
            // Define styles and icons based on type
            let iconClass, bgColor, textColor, borderColor;
            switch(type) {
                case 'success':
                    iconClass = 'fas fa-check-circle';
                    bgColor = 'bg-emerald-50';
                    textColor = 'text-emerald-700';
                    borderColor = 'border-emerald-200';
                    break;
                case 'error':
                    iconClass = 'fas fa-exclamation-circle';
                    bgColor = 'bg-red-50';
                    textColor = 'text-red-700';
                    borderColor = 'border-red-200';
                    break;
                case 'info':
                default:
                    iconClass = 'fas fa-info-circle';
                    bgColor = 'bg-blue-50';
                    textColor = 'text-blue-700';
                    borderColor = 'border-blue-200';
                    break;
            }
            
            toast.innerHTML = `
                <div class="${bgColor} ${borderColor} border-l-4 p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="${iconClass} ${textColor} text-lg"></i>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="${textColor} text-sm font-medium">${message}</p>
                        </div>
                        <div class="ml-4 flex-shrink-0">
                            <button onclick="hideToast(this.closest('.toast'))" class="${textColor} hover:opacity-75 transition-opacity">
                                <i class="fas fa-times text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            // Add to container
            container.appendChild(toast);
            
            // Show with animation
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);
            
            // Auto hide
            if (duration > 0) {
                setTimeout(() => {
                    hideToast(toast);
                }, duration);
            }
            
            return toast;
        }
        
        function hideToast(toast) {
            toast.classList.add('hide');
            toast.classList.remove('show');
            
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 500);
        }

        // GSAP Animations
        gsap.registerPlugin(ScrollTrigger);

        // Initialize page animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate fade-in-up elements
            gsap.fromTo('.fade-in-up', {
                opacity: 0,
                y: 30
            }, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                stagger: 0.2,
                ease: "power2.out"
            });
        });
    </script>
</body>
</html>
