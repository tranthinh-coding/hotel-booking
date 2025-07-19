<?php
$title = 'Dịch vụ khách sạn - Ocean Pearl Hotel';
ob_start();
?>

<!-- Hero Section -->
<div class="relative h-96 bg-gradient-to-r from-blue-400 via-blue-500 to-cyan-500 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg xmlns=\"
            http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\">
            <defs>
                <pattern id=\"waves\" width=\"100\" height=\"100\" patternUnits=\"userSpaceOnUse\">
                    <path d=\"M0,50 Q25,30 50,50 T100,50 V100 H0 Z\" fill=\"rgba(255,255,255,0.1)\" />
                </pattern>
            </defs>
            <rect width=\"100\" height=\"100\" fill=\"url(%23waves)\" /></svg>');">
        </div>
    </div>

    <div class="relative h-full flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="fade-in-up text-center">
                <!-- Breadcrumb -->
                <nav class="flex items-center justify-center space-x-2 text-blue-100 mb-8">
                    <a href="/" class="hover:text-white transition-colors">
                        <i class="fas fa-home mr-1"></i>Trang chủ
                    </a>
                    <i class="fas fa-chevron-right text-xs"></i>
                    <span class="text-white font-medium">Dịch vụ</span>
                </nav>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 text-shadow">
                    Dịch vụ khách sạn
                </h1>
                <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                    Trải nghiệm những dịch vụ đẳng cấp thế giới tại Ocean Pearl Hotel
                </p>
            </div>
        </div>
    </div>

    <!-- Enhanced Wave decoration -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1200 120" class="w-full h-16 fill-current text-white">
            <path d="M0,60 C150,120 300,0 450,60 C600,120 750,0 900,60 C1050,120 1200,0 1200,60 V120 H0 V60Z"></path>
        </svg>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-gray-50 -mt-1">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (isNotEmpty($dichVus)): ?>
                <?php foreach ($dichVus as $dichVu): ?>
                    <div
                        class="bg-white rounded-2xl shadow-sm overflow-hidden group hover:shadow-md transition-all duration-300">
                        <!-- Service Image -->
                        <div class="h-64 bg-gradient-to-br from-blue-100 to-cyan-100 relative overflow-hidden">
                            <?php if (isNotEmpty($dichVu->hinh_anh)): ?>
                                <?php
                                // Construct proper image URL
                                $imageUrl = '/uploads/' . $dichVu->hinh_anh;
                                ?>
                                <img src="<?= htmlspecialchars($imageUrl) ?>" alt="<?= htmlspecialchars($dichVu->ten_dich_vu) ?>"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                    onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                                <div class="w-full h-full flex items-center justify-center hidden">
                                    <i class="fas fa-concierge-bell text-6xl text-blue-300"></i>
                                </div>
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-concierge-bell text-6xl text-blue-300"></i>
                                </div>
                            <?php endif; ?>

                            <!-- Service Price Badge -->
                            <div class="absolute top-4 right-4">
                                <div class="bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full">
                                    <span class="text-blue-600 font-bold text-lg">
                                        <?= number_format($dichVu->gia) ?>₫
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Service Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-blue-600 transition-colors">
                                <?= htmlspecialchars($dichVu->ten_dich_vu) ?>
                            </h3>

                            <!-- Service Description -->
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                <?php if (isNotEmpty($dichVu->mo_ta)): ?>
                                    <?= htmlspecialchars($dichVu->mo_ta) ?>
                                <?php else: ?>
                                    Dịch vụ chất lượng cao được cung cấp bởi Ocean Pearl Hotel với đội ngũ nhân viên chuyên nghiệp.
                                <?php endif; ?>
                            </p>

                            <!-- Service Features -->
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <i class="fas fa-clock mr-1"></i>
                                    24/7
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-star mr-1 text-yellow-400"></i>
                                    Premium
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-20">
                    <div class="mb-8">
                        <i class="fas fa-concierge-bell text-6xl text-gray-300"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-600 mb-4">Chưa có dịch vụ nào</h3>
                    <p class="text-gray-500 mb-8">Hiện tại chúng tôi đang cập nhật thêm các dịch vụ mới.</p>
                    <a href="/"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-lg hover:from-blue-600 hover:to-cyan-600 transition-all duration-200">
                        <i class="fas fa-home mr-2"></i>
                        Về trang chủ
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>