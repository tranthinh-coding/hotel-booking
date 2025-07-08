<!DOCTYPE html>
<html lang="vi" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Hotel Booking System' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ocean: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                            950: '#082f49'
                        },
                        seafoam: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a'
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="h-full bg-gradient-to-br from-ocean-50 via-white to-seafoam-50">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md shadow-lg border-b border-ocean-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-hotel text-2xl text-ocean-600 mr-2"></i>
                        <span class="font-bold text-xl text-gray-800">Hotel Ocean</span>
                    </div>
                    
                    <!-- Navigation Links -->
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="/" class="text-gray-700 hover:text-ocean-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            <i class="fas fa-home mr-1"></i> Trang chủ
                        </a>
                        <a href="/phong" class="text-gray-700 hover:text-ocean-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            <i class="fas fa-bed mr-1"></i> Phòng
                        </a>
                        <a href="/dich-vu" class="text-gray-700 hover:text-ocean-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            <i class="fas fa-concierge-bell mr-1"></i> Dịch vụ
                        </a>
                        <a href="/danh-gia" class="text-gray-700 hover:text-ocean-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            <i class="fas fa-star mr-1"></i> Đánh giá
                        </a>
                    </div>
                </div>

                <!-- User menu -->
                <div class="flex items-center space-x-4">
                    <?php if (function_exists('auth_check') && auth_check()): ?>
                        <?php $currentUser = user(); ?>
                        <div class="relative group">
                            <button class="flex items-center text-sm rounded-full text-gray-700 hover:text-ocean-600 focus:outline-none">
                                <i class="fas fa-user-circle text-xl mr-2"></i>
                                <span class="font-medium"><?= htmlspecialchars($currentUser->ho_ten ?? 'User') ?></span>
                                <i class="fas fa-chevron-down ml-1 text-xs"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-ocean-50">
                                    <i class="fas fa-user mr-2"></i> Thông tin cá nhân
                                </a>
                                <a href="/change-password" class="block px-4 py-2 text-sm text-gray-700 hover:bg-ocean-50">
                                    <i class="fas fa-key mr-2"></i> Đổi mật khẩu
                                </a>
                                <?php if (($currentUser->phan_quyen ?? '') === 'admin' || ($currentUser->phan_quyen ?? '') === 'nhan_vien'): ?>
                                    <div class="border-t border-gray-200 my-1"></div>
                                    <a href="/admin/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-ocean-50">
                                        <i class="fas fa-cog mr-2"></i> Quản trị
                                    </a>
                                <?php endif; ?>
                                <div class="border-t border-gray-200 my-1"></div>
                                <a href="/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="/login" class="text-gray-700 hover:text-ocean-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            <i class="fas fa-sign-in-alt mr-1"></i> Đăng nhập
                        </a>
                        <a href="/register" class="bg-ocean-600 hover:bg-ocean-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            <i class="fas fa-user-plus mr-1"></i> Đăng ký
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <?php if (function_exists('flash_get')): ?>
        <?php $success = flash_get('success'); ?>
        <?php $error = flash_get('error'); ?>
        <?php $info = flash_get('info'); ?>
        
        <?php if ($success): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md mx-4 mt-4 relative" role="alert">
                <i class="fas fa-check-circle mr-2"></i>
                <span><?= htmlspecialchars($success) ?></span>
                <button onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md mx-4 mt-4 relative" role="alert">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span><?= $error ?></span>
                <button onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        <?php endif; ?>
        
        <?php if ($info): ?>
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-md mx-4 mt-4 relative" role="alert">
                <i class="fas fa-info-circle mr-2"></i>
                <span><?= htmlspecialchars($info) ?></span>
                <button onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <?= $content ?? '' ?>
    </main>

    <!-- Footer -->
    <footer class="mt-12 bg-ocean-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-hotel text-2xl text-seafoam-400 mr-2"></i>
                        <span class="font-bold text-xl">Hotel Ocean</span>
                    </div>
                    <p class="text-gray-300">
                        Khách sạn 5 sao với view biển tuyệt đẹp, dịch vụ chuyên nghiệp và không gian nghỉ dưỡng lý tưởng.
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">Liên kết nhanh</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="/phong" class="hover:text-seafoam-400 transition-colors">Phòng nghỉ</a></li>
                        <li><a href="/dich-vu" class="hover:text-seafoam-400 transition-colors">Dịch vụ</a></li>
                        <li><a href="/danh-gia" class="hover:text-seafoam-400 transition-colors">Đánh giá</a></li>
                        <li><a href="/contact" class="hover:text-seafoam-400 transition-colors">Liên hệ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">Thông tin liên hệ</h3>
                    <div class="space-y-2 text-gray-300">
                        <p><i class="fas fa-map-marker-alt mr-2"></i> 123 Bãi biển Nha Trang, Việt Nam</p>
                        <p><i class="fas fa-phone mr-2"></i> (84) 123 456 789</p>
                        <p><i class="fas fa-envelope mr-2"></i> info@hotelocean.com</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-ocean-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Hotel Ocean. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <script>
        // Auto hide flash messages after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('[role="alert"]').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>
