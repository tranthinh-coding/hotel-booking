<?php
$title = 'Trang chủ - Hotel Ocean';
ob_start();
?>

<!-- Hero Section -->
<section class="relative h-96 bg-gradient-to-r from-ocean-600 to-seafoam-600 rounded-3xl overflow-hidden mb-12">
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="relative z-10 flex items-center justify-center h-full text-center text-white px-6">
        <div>
            <h1 class="text-5xl font-bold mb-4">Chào mừng đến Hotel Ocean</h1>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Trải nghiệm không gian nghỉ dưỡng đẳng cấp với view biển tuyệt đẹp và dịch vụ 5 sao
            </p>
            <div class="space-x-4">
                <a href="/phong" class="bg-white text-ocean-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors transform hover:scale-105 inline-flex items-center">
                    <i class="fas fa-bed mr-2"></i>
                    Đặt phòng ngay
                </a>
                <a href="/dich-vu" class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-ocean-600 transition-colors transform hover:scale-105 inline-flex items-center">
                    <i class="fas fa-concierge-bell mr-2"></i>
                    Khám phá dịch vụ
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="mb-12">
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">Tại sao chọn Hotel Ocean?</h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Chúng tôi mang đến trải nghiệm nghỉ dưỡng hoàn hảo với những tiện ích hiện đại và dịch vụ tận tâm
        </p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white/80 backdrop-blur-md rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-ocean-200">
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-ocean-500 to-seafoam-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-water text-2xl text-white"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">View Biển Tuyệt Đẹp</h3>
                <p class="text-gray-600">
                    Mỗi phòng đều có tầm nhìn ra biển xanh bao la, mang đến cảm giác thư thái và bình yên tuyệt đối.
                </p>
            </div>
        </div>
        
        <div class="bg-white/80 backdrop-blur-md rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-ocean-200">
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-seafoam-500 to-ocean-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-spa text-2xl text-white"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Dịch Vụ Spa Cao Cấp</h3>
                <p class="text-gray-600">
                    Thư giãn và tái tạo năng lượng với các liệu pháp spa chuyên nghiệp trong không gian yên tĩnh.
                </p>
            </div>
        </div>
        
        <div class="bg-white/80 backdrop-blur-md rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-ocean-200">
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-ocean-500 to-seafoam-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-utensils text-2xl text-white"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Ẩm Thực Đặc Sắc</h3>
                <p class="text-gray-600">
                    Thưởng thức những món ăn tinh tế từ đầu bếp 5 sao với nguyên liệu tươi ngon từ biển.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Quick Stats -->
<section class="mb-12">
    <div class="bg-gradient-to-r from-ocean-600 to-seafoam-600 rounded-3xl p-8 text-white">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold mb-2">100+</div>
                <div class="text-lg opacity-90">Phòng nghỉ</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">50+</div>
                <div class="text-lg opacity-90">Dịch vụ</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">1000+</div>
                <div class="text-lg opacity-90">Khách hàng hài lòng</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">24/7</div>
                <div class="text-lg opacity-90">Hỗ trợ</div>
            </div>
        </div>
    </div>
</section>

<!-- Recent Reviews -->
<?php if (isset($danhGias) && !empty($danhGias)): ?>
<section class="mb-12">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Đánh giá từ khách hàng</h2>
        <p class="text-gray-600">Những trải nghiệm thực tế từ khách hàng của chúng tôi</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach (array_slice($danhGias, 0, 3) as $danhGia): ?>
        <div class="bg-white/80 backdrop-blur-md rounded-xl p-6 shadow-lg border border-ocean-200">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-ocean-500 to-seafoam-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white"></i>
                </div>
                <div class="ml-4">
                    <div class="font-semibold text-gray-800">Khách hàng</div>
                    <div class="flex items-center">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star <?= $i <= $danhGia->diem_danh_gia ? 'text-yellow-400' : 'text-gray-300' ?>"></i>
                        <?php endfor; ?>
                        <span class="ml-2 text-sm text-gray-600"><?= $danhGia->diem_danh_gia ?>/5</span>
                    </div>
                </div>
            </div>
            <p class="text-gray-600 italic">"<?= htmlspecialchars(substr($danhGia->noi_dung, 0, 100)) ?>..."</p>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div class="text-center mt-8">
        <a href="/danh-gia" class="bg-ocean-600 text-white px-6 py-3 rounded-full hover:bg-ocean-700 transition-colors inline-flex items-center">
            <i class="fas fa-star mr-2"></i>
            Xem tất cả đánh giá
        </a>
    </div>
</section>
<?php endif; ?>

<!-- Call to Action -->
<section class="text-center">
    <div class="bg-white/80 backdrop-blur-md rounded-3xl p-12 shadow-lg border border-ocean-200">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">Sẵn sàng cho kỳ nghỉ tuyệt vời?</h2>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Đặt phòng ngay hôm nay để tận hưởng những trải nghiệm đáng nhớ tại Hotel Ocean
        </p>
        <div class="space-x-4">
            <a href="/phong" class="bg-gradient-to-r from-ocean-600 to-seafoam-600 text-white px-8 py-4 rounded-full font-semibold hover:from-ocean-700 hover:to-seafoam-700 transition-all transform hover:scale-105 inline-flex items-center">
                <i class="fas fa-calendar-check mr-2"></i>
                Đặt phòng ngay
            </a>
            <a href="/contact" class="border-2 border-ocean-600 text-ocean-600 px-8 py-4 rounded-full font-semibold hover:bg-ocean-600 hover:text-white transition-colors transform hover:scale-105 inline-flex items-center">
                <i class="fas fa-phone mr-2"></i>
                Liên hệ tư vấn
            </a>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layouts/app.php';
?>
