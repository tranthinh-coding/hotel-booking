<?php
$title = 'Tin tức - Ocean Pearl Hotel';
ob_start();
?>

<!-- Hero Section -->
<div class="relative h-80 bg-gradient-to-r from-ocean-600 via-ocean-700 to-teal-600 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg xmlns=\"
            http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\">
            <defs>
                <pattern id=\"grain\" width=\"100\" height=\"100\" patternUnits=\"userSpaceOnUse\">
                    <circle cx=\"25\" cy=\"25\" r=\"1\" fill=\"white\" opacity=\"0.5\" />
                    <circle cx=\"75\" cy=\"75\" r=\"1\" fill=\"white\" opacity=\"0.3\" />
                    <circle cx=\"50\" cy=\"10\" r=\"0.5\" fill=\"white\" opacity=\"0.4\" />
                </pattern>
            </defs>
            <rect width=\"100\" height=\"100\" fill=\"url(%23grain)\" /></svg>');">
        </div>
    </div>

    <div class="relative h-full flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="fade-in-up">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 text-shadow">
                    Tin tức & Sự kiện
                </h1>
                <p class="text-xl text-ocean-100 max-w-2xl mx-auto">
                    Cập nhật những thông tin mới nhất về khách sạn và các ưu đãi đặc biệt
                </p>
            </div>
        </div>
    </div>

    <!-- Wave decoration -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1200 120" class="w-full h-12 fill-current text-white">
            <path
                d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z">
            </path>
        </svg>
    </div>
</div>

<div class="bg-gray-50 min-h-screen -mt-1">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <?php if (empty($tinTucs)): ?>
            <!-- Empty State -->
            <div class="text-center py-16">
                <div
                    class="w-24 h-24 mx-auto mb-8 bg-gradient-to-br from-ocean-100 to-ocean-200 rounded-full flex items-center justify-center">
                    <i class="fas fa-newspaper text-ocean-500 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-700 mb-4">Chưa có tin tức nào</h3>
                <p class="text-gray-500 mb-8">Hãy quay lại sau để xem những tin tức mới nhất từ Ocean Pearl Hotel!</p>
                <a href="/" class="inline-flex items-center btn-ocean text-white px-6 py-3 rounded-lg font-medium">
                    <i class="fas fa-home mr-2"></i>
                    Về trang chủ
                </a>
            </div>
        <?php else: ?>
            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($tinTucs as $tinTuc): ?>
                    <article
                        class="bg-gradient-to-br from-gray-50 via-white to-blue-50/30 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group card-hover border border-gray-100/50">
                        <!-- Image -->
                        <div class="relative h-48 bg-gradient-to-br from-ocean-400 to-ocean-600 overflow-hidden">
                            <?php if (isNotEmpty($tinTuc->anh_dai_dien)): ?>
                                <img src="<?= getFileUrl($tinTuc->anh_dai_dien) ?>"
                                    alt="<?= safe_htmlspecialchars($tinTuc->tieu_de) ?>"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-newspaper text-white text-3xl opacity-60"></i>
                                </div>
                            <?php endif; ?>

                            <!-- Date Badge -->
                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-white/90 backdrop-blur-sm text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <?= date('d/m/Y', strtotime($tinTuc->ngay_dang ?? $tinTuc->ngay_tao ?? date('Y-m-d'))) ?>
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h3
                                class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-ocean-600 transition-colors">
                                <a href="/tin-tuc/<?= $tinTuc->ma_tin_tuc ?>" class="hover:underline">
                                    <?= safe_htmlspecialchars($tinTuc->tieu_de) ?>
                                </a>
                            </h3>

                            <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                                <?= truncate_text(strip_tags($tinTuc->noi_dung ?? ''), 120) ?>
                            </p>

                            <!-- Meta Info -->
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center">
                                        <i class="fas fa-eye mr-1 text-ocean-400"></i>
                                        <?= number_format($tinTuc->luot_xem ?? 0) ?>
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-clock mr-1 text-ocean-400"></i>
                                        <?= date('H:i', strtotime($tinTuc->ngay_dang ?? $tinTuc->ngay_tao ?? date('Y-m-d'))) ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Read More Button -->
                            <a href="/tin-tuc/<?= $tinTuc->ma_tin_tuc ?>"
                                class="inline-flex items-center text-ocean-600 hover:text-ocean-800 font-medium transition-colors group">
                                Đọc thêm
                                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Pagination placeholder -->
            <?php if (count($tinTucs) >= 9): ?>
                <div class="text-center mt-12">
                    <button class="btn-ocean text-white px-8 py-3 rounded-lg font-medium shadow-lg">
                        <i class="fas fa-plus mr-2"></i>
                        Xem thêm tin tức
                    </button>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>