<!DOCTYPE html>
<html lang="vi" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Quản trị - Ocean Pearl Hotel' ?></title>
    <meta name="description" content="Hệ thống quản trị Ocean Pearl Hotel">
    
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
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- Custom Styles -->
    <style>
        .admin-sidebar {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.98);
            border-right: 1px solid rgba(13, 148, 136, 0.1);
        }
        
        .admin-sidebar-item {
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .admin-sidebar-item:hover {
            background: rgba(13, 148, 136, 0.05);
            transform: translateX(4px);
        }
        
        .admin-sidebar-item.active {
            background: rgba(13, 148, 136, 0.1);
            border-right: 3px solid #0d9488;
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
        
        .btn-admin {
            background: linear-gradient(135deg, #0891b2, #0d9488);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .btn-admin:hover {
            background: linear-gradient(135deg, #0e7490, #0f766e);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px -6px rgba(8, 145, 178, 0.3);
        }
        
        .admin-header {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid rgba(13, 148, 136, 0.08);
        }
    </style>
</head>
<body class="h-full bg-gray-50">
    <div class="flex h-full">
        <!-- Sidebar -->
        <div class="hidden md:flex md:w-64 md:flex-col">
            <div class="admin-sidebar flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0 px-4 mb-8">
                    <div class="w-10 h-10 bg-gradient-to-br from-ocean-400 to-ocean-600 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-water text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold bg-gradient-to-r from-ocean-600 to-ocean-800 bg-clip-text text-transparent">Ocean Pearl</h1>
                        <p class="text-xs text-gray-500">Quản trị viên</p>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="mt-5 flex-1 px-2 space-y-1">
                    <a href="/admin/dashboard" class="admin-sidebar-item group flex items-center px-2 py-2 text-sm font-medium text-gray-700 rounded-md">
                        <i class="fas fa-tachometer-alt mr-3 text-ocean-500"></i>Dashboard
                    </a>
                    
                    <!-- Quản lý phòng -->
                    <div class="space-y-1">
                        <button onclick="toggleSubmenu('rooms')" class="admin-sidebar-item group flex items-center w-full px-2 py-2 text-sm font-medium text-gray-700 rounded-md">
                            <i class="fas fa-bed mr-3 text-ocean-500"></i>
                            Quản lý phòng
                            <i class="fas fa-chevron-down ml-auto transform transition-transform" id="rooms-icon"></i>
                        </button>
                        <div id="rooms-submenu" class="hidden ml-6 space-y-1">
                            <a href="/admin/phong" class="admin-sidebar-item block px-2 py-1 text-sm text-gray-600 rounded-md">
                                <i class="fas fa-list mr-2"></i>Danh sách phòng
                            </a>
                            <a href="/admin/phong/create" class="admin-sidebar-item block px-2 py-1 text-sm text-gray-600 rounded-md">
                                <i class="fas fa-plus mr-2"></i>Thêm phòng mới
                            </a>
                            <a href="/admin/danh-muc-phong" class="admin-sidebar-item block px-2 py-1 text-sm text-gray-600 rounded-md">
                                <i class="fas fa-tags mr-2"></i>Danh mục phòng
                            </a>
                        </div>
                    </div>
                    
                    <!-- Quản lý dịch vụ -->
                    <div class="space-y-1">
                        <button onclick="toggleSubmenu('services')" class="admin-sidebar-item group flex items-center w-full px-2 py-2 text-sm font-medium text-gray-700 rounded-md">
                            <i class="fas fa-concierge-bell mr-3 text-ocean-500"></i>
                            Quản lý dịch vụ
                            <i class="fas fa-chevron-down ml-auto transform transition-transform" id="services-icon"></i>
                        </button>
                        <div id="services-submenu" class="hidden ml-6 space-y-1">
                            <a href="/admin/dich-vu" class="admin-sidebar-item block px-2 py-1 text-sm text-gray-600 rounded-md">
                                <i class="fas fa-list mr-2"></i>Danh sách dịch vụ
                            </a>
                            <a href="/admin/dich-vu/create" class="admin-sidebar-item block px-2 py-1 text-sm text-gray-600 rounded-md">
                                <i class="fas fa-plus mr-2"></i>Thêm dịch vụ mới
                            </a>
                        </div>
                    </div>
                    
                    <!-- Quản lý tài khoản -->
                    <div class="space-y-1">
                        <button onclick="toggleSubmenu('accounts')" class="admin-sidebar-item group flex items-center w-full px-2 py-2 text-sm font-medium text-gray-700 rounded-md">
                            <i class="fas fa-users mr-3 text-ocean-500"></i>
                            Quản lý tài khoản
                            <i class="fas fa-chevron-down ml-auto transform transition-transform" id="accounts-icon"></i>
                        </button>
                        <div id="accounts-submenu" class="hidden ml-6 space-y-1">
                            <a href="/admin/tai-khoan" class="admin-sidebar-item block px-2 py-1 text-sm text-gray-600 rounded-md">
                                <i class="fas fa-list mr-2"></i>Danh sách tài khoản
                            </a>
                            <a href="/admin/tai-khoan/create" class="admin-sidebar-item block px-2 py-1 text-sm text-gray-600 rounded-md">
                                <i class="fas fa-user-plus mr-2"></i>Thêm tài khoản mới
                            </a>
                        </div>
                    </div>
                    
                    <!-- Quản lý hóa đơn -->
                    <a href="/admin/hoa-don" class="admin-sidebar-item group flex items-center px-2 py-2 text-sm font-medium text-gray-700 rounded-md">
                        <i class="fas fa-file-invoice mr-3 text-ocean-500"></i>Quản lý hóa đơn
                    </a>
                    
                    <!-- Quản lý nội dung -->
                    <div class="space-y-1">
                        <button onclick="toggleSubmenu('content')" class="admin-sidebar-item group flex items-center w-full px-2 py-2 text-sm font-medium text-gray-700 rounded-md">
                            <i class="fas fa-newspaper mr-3 text-ocean-500"></i>
                            Quản lý nội dung
                            <i class="fas fa-chevron-down ml-auto transform transition-transform" id="content-icon"></i>
                        </button>
                        <div id="content-submenu" class="hidden ml-6 space-y-1">
                            <a href="/tin-tuc" class="admin-sidebar-item block px-2 py-1 text-sm text-gray-600 rounded-md">
                                <i class="fas fa-newspaper mr-2"></i>Tin tức
                            </a>
                            <a href="/hinh-anh" class="admin-sidebar-item block px-2 py-1 text-sm text-gray-600 rounded-md">
                                <i class="fas fa-images mr-2"></i>Hình ảnh
                            </a>
                        </div>
                    </div>
                    
                    <!-- Báo cáo thống kê -->
                    <a href="/admin/reports" class="admin-sidebar-item group flex items-center px-2 py-2 text-sm font-medium text-gray-700 rounded-md">
                        <i class="fas fa-chart-bar mr-3 text-ocean-500"></i>Báo cáo thống kê
                    </a>
                </nav>
                
                <!-- Back to site -->
                <div class="px-2 pt-4 border-t border-gray-200">
                    <a href="/" class="admin-sidebar-item group flex items-center px-2 py-2 text-sm font-medium text-gray-700 rounded-md">
                        <i class="fas fa-home mr-3 text-ocean-500"></i>Về trang chủ
                    </a>
                </div>
            </div>
        </div>

        <!-- Main content area -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top navigation -->
            <header class="admin-header">
                <div class="flex items-center justify-between px-4 py-3">
                    <!-- Mobile menu button -->
                    <button onclick="toggleMobileSidebar()" class="md:hidden text-gray-500 hover:text-gray-700 gentle-hover">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    
                    <!-- Page title -->
                    <h1 class="text-xl font-semibold text-gray-900"><?= $pageTitle ?? 'Dashboard' ?></h1>
                    
                    <!-- User menu -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <button class="text-gray-500 hover:text-gray-700 gentle-hover">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        
                        <!-- User dropdown -->
                        <?php if (function_exists('auth_check') && auth_check()): ?>
                            <?php $currentUser = user(); ?>
                            <div class="relative group">
                                <button class="flex items-center space-x-2 text-gray-700 hover:text-ocean-600 gentle-hover px-3 py-2 rounded-lg">
                                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($currentUser->ho_ten ?? 'Admin') ?>&background=0d9488&color=fff&size=32" 
                                         alt="Avatar" class="w-8 h-8 rounded-full ring-2 ring-ocean-100">
                                    <span class="font-medium"><?= htmlspecialchars($currentUser->ho_ten ?? 'Admin') ?></span>
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
                                        <div class="border-t border-gray-100 my-1"></div>
                                        <form method="POST" action="/logout" class="block">
                                            <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                                <i class="fas fa-sign-out-alt w-4 mr-3"></i>Đăng xuất
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </header>

            <!-- Flash Messages -->
            <?php if (function_exists('flash_get')): ?>
                <?php $success = flash_get('success'); ?>
                <?php $error = flash_get('error'); ?>
                <?php $info = flash_get('info'); ?>
                
                <?php if ($success): ?>
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mx-4 mt-4 relative soft-shadow animate__animated animate__fadeInDown" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span><?= htmlspecialchars($success) ?></span>
                        <button onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 px-4 py-3 gentle-hover">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                <?php endif; ?>
                
                <?php if ($error): ?>
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mx-4 mt-4 relative soft-shadow animate__animated animate__fadeInDown" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span><?= $error ?></span>
                        <button onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 px-4 py-3 gentle-hover">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                <?php endif; ?>
                
                <?php if ($info): ?>
                    <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-xl mx-4 mt-4 relative soft-shadow animate__animated animate__fadeInDown" role="alert">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span><?= htmlspecialchars($info) ?></span>
                        <button onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 px-4 py-3 gentle-hover">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Page content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                <div class="container mx-auto px-6 py-8">
                    <?= $content ?? '' ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="mobile-sidebar-overlay" class="hidden fixed inset-0 z-40 md:hidden">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" onclick="toggleMobileSidebar()"></div>
        <!-- Mobile sidebar content would go here -->
    </div>

    <!-- Scripts -->
    <script>
        // Toggle submenu
        function toggleSubmenu(submenuId) {
            const submenu = document.getElementById(submenuId + '-submenu');
            const icon = document.getElementById(submenuId + '-icon');
            
            submenu.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }

        // Toggle mobile sidebar
        function toggleMobileSidebar() {
            const overlay = document.getElementById('mobile-sidebar-overlay');
            overlay.classList.toggle('hidden');
        }

        // Auto hide flash messages
        setTimeout(() => {
            document.querySelectorAll('[role="alert"]').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // GSAP Animations
        document.addEventListener('DOMContentLoaded', function() {
            gsap.fromTo('.admin-sidebar', {
                x: -100,
                opacity: 0
            }, {
                x: 0,
                opacity: 1,
                duration: 0.5,
                ease: "power2.out"
            });
        });
    </script>
</body>
</html>
