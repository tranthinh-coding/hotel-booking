<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Ocean Pearl Hotel - Admin' ?></title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-link {
            transition: all 0.12s ease;
        }

        .sidebar-link:hover {
            background-color: rgba(59, 130, 246, 0.1);
            border-left: 4px solid #3b82f6;
        }

        .sidebar-link.active {
            background-color: rgba(59, 130, 246, 0.15);
            border-left: 4px solid #3b82f6;
            color: #3b82f6;
        }

        .dropdown-menu {
            transform: translateY(-10px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.12s ease;
        }

        .dropdown:hover .dropdown-menu {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }

        /* Custom styles for room management pages */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .image-upload-zone {
            border: 2px dashed #d1d5db;
            transition: all 0.12s ease;
        }

        .image-upload-zone:hover {
            border-color: #3b82f6;
            background-color: #eff6ff;
        }

        .image-upload-zone.dragover {
            border-color: #3b82f6;
            background-color: #dbeafe;
        }

        .room-card {
            transition: all 0.12s ease;
        }

        .room-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .modal-backdrop {
            backdrop-filter: blur(4px);
        }

        /* Animation for image modal */
        #imageModal img {
            animation: zoomIn 0.3s ease-out;
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Custom scrollbar for modals */
        .modal-content {
            scrollbar-width: thin;
            scrollbar-color: #d1d5db transparent;
        }

        .modal-content::-webkit-scrollbar {
            width: 6px;
        }

        .modal-content::-webkit-scrollbar-track {
            background: transparent;
        }

        .modal-content::-webkit-scrollbar-thumb {
            background-color: #d1d5db;
            border-radius: 3px;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg border-b border-gray-200 fixed w-full top-0 z-50">
        <div class="max-w-full mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <button id="sidebar-toggle" class="lg:hidden text-gray-600 hover:text-gray-900 mr-4">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <a href="/admin/dashboard" class="flex items-center">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-hotel text-white text-lg"></i>
                        </div>
                        <div>
                            <div class="text-xl font-bold text-gray-900">Ocean Pearl Hotel</div>
                            <div class="text-xs text-gray-500">Admin Panel</div>
                        </div>
                    </a>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <div class="relative">
                        <a href="/">
                            <button class="text-gray-600 hover:text-gray-900 relative">
                                Xem trang web
                            </button>
                        </a>
                    </div>

                    <!-- User Dropdown -->
                    <div class="relative dropdown">
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-gray-900">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <span
                                class="font-medium"><?= htmlspecialchars(auth_check() ? user()->ho_ten : 'Admin') ?></span>
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>

                        <div
                            class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200">
                            <a href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-user mr-2"></i>Hồ sơ
                            </a>
                            <a href="/change-password" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-key mr-2"></i>Đổi mật khẩu
                            </a>
                            <hr class="my-1">
                            <a href="/logout" class="block px-4 py-2 text-red-600 hover:bg-red-50">
                                <i class="fas fa-sign-out-alt mr-2"></i>Đăng xuất
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex pt-16">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="w-64 bg-white shadow-lg h-screen sticky top-16 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40">
            <div class="p-4">
                <nav class="space-y-2">
                    <!-- Dashboard -->
                    <a href="/admin/dashboard"
                        class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg">
                        <i class="fas fa-tachometer-alt mr-3 text-lg"></i>
                        <span>Dashboard</span>
                    </a>

                    <!-- Quản lý phòng -->
                    <?php $role = auth_check() ? user()->phan_quyen : null; ?>
                    <div class="space-y-1">
                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-2">Quản lý phòng</div>
                        <a href="/admin/phong" class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg">
                            <i class="fas fa-bed mr-3 text-lg"></i>
                            <span>Danh sách phòng</span>
                        </a>
                        <a href="/admin/loai-phong" class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg">
                            <i class="fas fa-home mr-3 text-lg"></i>
                            <span>Loại phòng</span>
                        </a>
                    </div>

                    <!-- Đặt phòng -->
                    <div class="space-y-1">
                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-2">Đặt phòng</div>
                        <a href="/admin/hoa-don" class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg">
                            <i class="fas fa-receipt mr-3 text-lg"></i>
                            <span>Hóa đơn</span>
                        </a>
                    </div>

                    <!-- Dịch vụ -->
                    <div class="space-y-1">
                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-2">Dịch vụ</div>
                        <a href="/admin/dich-vu" class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg">
                            <i class="fas fa-concierge-bell mr-3 text-lg"></i>
                            <span>Danh sách dịch vụ</span>
                        </a>
                    </div>

                    <!-- Nội dung -->
                    <div class="space-y-1">
                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-2">Nội dung</div>
                        <a href="/admin/tin-tuc" class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg">
                            <i class="fas fa-newspaper mr-3 text-lg"></i>
                            <span>Tin tức</span>
                        </a>
                        <?php if ($role === HotelBooking\Enums\PhanQuyen::QUAN_LY): ?>
                        <a href="/admin/danh-gia" class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg">
                            <i class="fas fa-star mr-3 text-lg"></i>
                            <span>Đánh giá</span>
                        </a>
                        <a href="/admin/lien-he" class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg">
                            <i class="fas fa-envelope mr-3 text-lg"></i>
                            <span>Liên hệ</span>
                        </a>
                        <?php endif; ?>
                    </div>

                    <?php if ($role === HotelBooking\Enums\PhanQuyen::QUAN_LY): ?>
                    <!-- Người dùng -->
                    <div class="space-y-1">
                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-2">Hệ thống</div>
                        <a href="/admin/tai-khoan" class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg">
                            <i class="fas fa-users mr-3 text-lg"></i>
                            <span>Tài khoản</span>
                        </a>
                        <a href="/admin/thong-ke" class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg">
                            <i class="fas fa-chart-bar mr-3 text-lg"></i>
                            <span>Thống kê</span>
                        </a>
                    </div>
                    <?php endif; ?>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 lg:p-8 overflow-x-hidden">
            <div class="max-w-7xl mx-auto">
                <!-- Page Header -->
                <?php if (isset($pageTitle)): ?>
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-gray-900"><?= htmlspecialchars($pageTitle) ?></h1>
                    </div>
                <?php endif; ?>

                <!-- Flash Messages -->
                <?php if (isset($_SESSION['flash_message'])): ?>
                    <div class="mb-6">
                        <?php
                        $flash = $_SESSION['flash_message'];
                        $alertClass = '';
                        switch ($flash['type']) {
                            case 'success':
                                $alertClass = 'bg-green-50 border-green-200 text-green-800';
                                $iconClass = 'fas fa-check-circle text-green-400';
                                break;
                            case 'error':
                                $alertClass = 'bg-red-50 border-red-200 text-red-800';
                                $iconClass = 'fas fa-exclamation-circle text-red-400';
                                break;
                            case 'warning':
                                $alertClass = 'bg-yellow-50 border-yellow-200 text-yellow-800';
                                $iconClass = 'fas fa-exclamation-triangle text-yellow-400';
                                break;
                            default:
                                $alertClass = 'bg-blue-50 border-blue-200 text-blue-800';
                                $iconClass = 'fas fa-info-circle text-blue-400';
                        }
                        ?>
                        <div class="<?= $alertClass ?> border rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="<?= $iconClass ?> mr-3"></i>
                                <span><?= $flash['message'] ?></span>
                            </div>
                        </div>
                    </div>
                    <?php unset($_SESSION['flash_message']); ?>
                <?php endif; ?>

                <!-- Content -->
                <?= $content ?>
            </div>
        </main>
    </div>

    <!-- Sidebar overlay for mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-30 lg:hidden hidden"></div>

    <script>
        // Sidebar toggle for mobile
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        sidebarToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        });

        sidebarOverlay?.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        // Active sidebar link
        const currentPath = window.location.pathname;
        const sidebarLinks = document.querySelectorAll('.sidebar-link');

        sidebarLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>

</html>