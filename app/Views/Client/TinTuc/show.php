<?php
$title = isset($tinTuc) ? safe_htmlspecialchars($tinTuc->tieu_de) . ' - Ocean Pearl Hotel' : 'Chi tiết tin tức - Ocean Pearl Hotel';
ob_start();
?>

<!-- Hero Section -->
<div class="relative h-96 bg-gradient-to-r from-ocean-600 via-ocean-700 to-teal-600 overflow-hidden">
    <?php if (isset($tinTuc) && isNotEmpty($tinTuc->anh_dai_dien)): ?>
        <img src="<?= safe_htmlspecialchars($tinTuc->anh_dai_dien) ?>" alt="<?= safe_htmlspecialchars($tinTuc->tieu_de) ?>"
            class="absolute inset-0 w-full h-full object-cover opacity-30">
    <?php endif; ?>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative h-full flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="fade-in-up">
                <!-- Breadcrumb -->
                <nav class="flex items-center space-x-2 text-ocean-100 mb-6">
                    <a href="/" class="hover:text-white transition-colors">Trang chủ</a>
                    <i class="fas fa-chevron-right text-xs"></i>
                    <a href="/tin-tuc" class="hover:text-white transition-colors">Tin tức</a>
                    <i class="fas fa-chevron-right text-xs"></i>
                    <span class="text-white">Bài viết</span>
                </nav>

                <?php if (isset($tinTuc)): ?>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6 text-shadow max-w-4xl">
                        <?= safe_htmlspecialchars($tinTuc->tieu_de) ?>
                    </h1>

                    <!-- Meta Info -->
                    <div class="flex flex-wrap items-center gap-6 text-ocean-100">
                        <span class="flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <?= date('d/m/Y', strtotime($tinTuc->ngay_dang ?? date('Y-m-d H:i:s'))) ?>
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            <?= date('H:i', strtotime($tinTuc->ngay_dang ?? date('Y-m-d H:i:s'))) ?>
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-eye mr-2"></i>
                            <?= number_format($tinTuc->luot_xem ?? 0) ?> lượt xem
                        </span>
                    </div>
                <?php else: ?>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6 text-shadow">
                        Tin tức không tìm thấy
                    </h1>
                <?php endif; ?>
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
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <?php if (isset($tinTuc)): ?>
                    <article class="bg-gradient-to-br from-gray-50 via-white to-blue-50/30 rounded-xl shadow-lg border border-gray-100/50 overflow-hidden">
                        <!-- Featured Image -->
                        <?php if (isNotEmpty($tinTuc->anh_dai_dien)): ?>
                            <div class="aspect-video bg-gray-100 overflow-hidden">
                                <img src="<?= getFileUrl($tinTuc->anh_dai_dien) ?>"
                                    alt="<?= safe_htmlspecialchars($tinTuc->tieu_de) ?>" class="w-full h-full object-cover">
                            </div>
                        <?php endif; ?>

                        <!-- Content -->
                        <div class="p-8">
                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-ocean-100 text-ocean-700 px-3 py-1 rounded-full text-sm font-medium">
                                    Tin tức
                                </span>
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                    Ocean Pearl Hotel
                                </span>
                            </div>

                            <!-- Article Content -->
                            <div class="prose prose-lg max-w-none">
                                <div class="text-gray-700 leading-relaxed space-y-4">
                                    <?= nl2br(safe_htmlspecialchars($tinTuc->noi_dung)) ?>
                                </div>
                            </div>

                            <!-- Social Share -->
                            <div class="border-t border-gray-200 pt-8 mt-12">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Chia sẻ bài viết</h4>
                                <div class="flex space-x-4">
                                    <a href="#"
                                        class="flex items-center justify-center w-10 h-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#"
                                        class="flex items-center justify-center w-10 h-10 bg-blue-400 text-white rounded-full hover:bg-blue-500 transition-colors">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#"
                                        class="flex items-center justify-center w-10 h-10 bg-red-600 text-white rounded-full hover:bg-red-700 transition-colors">
                                        <i class="fab fa-pinterest"></i>
                                    </a>
                                    <a href="#"
                                        class="flex items-center justify-center w-10 h-10 bg-green-600 text-white rounded-full hover:bg-green-700 transition-colors">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php else: ?>
                    <!-- Not Found -->
                    <div class="bg-gradient-to-br from-red-50 via-white to-pink-50/30 rounded-xl shadow-lg border border-red-100/50 p-12 text-center">
                        <div
                            class="w-24 h-24 bg-gradient-to-br from-red-100 to-red-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-exclamation-triangle text-red-500 text-3xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Không tìm thấy tin tức</h2>
                        <p class="text-gray-600 mb-8">Bài viết bạn đang tìm kiếm không tồn tại hoặc đã bị xóa.</p>
                        <a href="/tin-tuc"
                            class="btn-ocean text-white px-6 py-3 rounded-lg font-medium inline-flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Quay lại danh sách tin tức
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Navigation -->
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="/tin-tuc"
                        class="flex items-center text-ocean-600 hover:text-ocean-800 font-medium transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Quay lại danh sách tin tức
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="space-y-8">
                    <!-- Latest News - Only show if there are related news -->
                    <?php if (isNotEmpty($relatedNews) && count($relatedNews) > 0): ?>
                        <div class="bg-gradient-to-br from-ocean-50 via-white to-teal-50/30 rounded-xl shadow-lg border border-ocean-100/50 p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Tin tức liên quan</h3>
                            <div class="space-y-6">
                                <?php foreach ($relatedNews as $news): ?>
                                    <article class="flex space-x-4 group">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-20 h-16 bg-gradient-to-br from-ocean-400 to-ocean-600 rounded-lg overflow-hidden">
                                                <?php if (isNotEmpty($news->anh_dai_dien)): ?>
                                                    <img src="<?= safe_htmlspecialchars($news->anh_dai_dien) ?>"
                                                        alt="<?= safe_htmlspecialchars($news->tieu_de) ?>"
                                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                                <?php else: ?>
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <i class="fas fa-newspaper text-white text-sm opacity-60"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4
                                                class="text-sm font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-ocean-600 transition-colors">
                                                <a href="/tin-tuc/<?= $news->ma_tin_tuc ?>">
                                                    <?= safe_htmlspecialchars($news->tieu_de) ?>
                                                </a>
                                            </h4>
                                            <div class="flex items-center text-xs text-gray-500 space-x-3">
                                                <span><?= date('d/m/Y', strtotime($news->ngay_dang ?? date('Y-m-d'))) ?></span>
                                                <span class="flex items-center">
                                                    <i class="fas fa-eye mr-1"></i>
                                                    <?= number_format($news->luot_xem ?? 0) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            </div>

                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <a href="/tin-tuc"
                                    class="inline-flex items-center text-ocean-600 hover:text-ocean-800 font-medium transition-colors">
                                    Xem tất cả tin tức
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Hotel Info -->
                    <div class="bg-gradient-to-br from-ocean-600 to-teal-600 rounded-xl p-6 text-white">
                        <h3 class="text-xl font-bold mb-4">Ocean Pearl Hotel</h3>
                        <p class="text-ocean-100 mb-6 leading-relaxed">
                            Khách sạn 5 sao với view biển tuyệt đẹp và dịch vụ chuyên nghiệp tại Nha Trang.
                        </p>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-3 text-ocean-200"></i>
                                <span>123 Trần Phú, Nha Trang</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-phone mr-3 text-ocean-200"></i>
                                <span>(84) 258 123 456</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-envelope mr-3 text-ocean-200"></i>
                                <span>info@oceanpearl.com</span>
                            </div>
                        </div>
                        <div class="mt-6">
                            <a href="/dat-phong"
                                class="inline-flex items-center bg-white text-ocean-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                                <i class="fas fa-calendar-check mr-2"></i>
                                Đặt phòng ngay
                            </a>
                        </div>
                    </div>

                    <!-- Contact CTA -->
                    <div class="bg-gradient-to-br from-blue-50 via-white to-indigo-50/30 rounded-xl shadow-lg border border-blue-100/50 p-6 text-center">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-ocean-400 to-ocean-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-headset text-white text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Cần hỗ trợ?</h3>
                        <p class="text-gray-600 mb-4">Liên hệ với chúng tôi để được tư vấn tốt nhất</p>
                        <a href="/contact"
                            class="btn-ocean text-white px-6 py-2 rounded-lg font-medium inline-flex items-center">
                            <i class="fas fa-phone mr-2"></i>
                            Liên hệ ngay
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>