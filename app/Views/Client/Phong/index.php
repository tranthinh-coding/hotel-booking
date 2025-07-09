<?php ob_start(); ?>

<!-- Include animate.css and GSAP -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<style>
    .ocean-gradient {
        background: linear-gradient(135deg, 
            rgba(56, 189, 248, 0.1) 0%, 
            rgba(14, 165, 233, 0.1) 25%, 
            rgba(6, 182, 212, 0.1) 50%, 
            rgba(20, 184, 166, 0.1) 75%, 
            rgba(16, 185, 129, 0.1) 100%);
    }
    
    .card-gentle {
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.85);
        box-shadow: 0 8px 32px rgba(56, 189, 248, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .card-gentle:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(56, 189, 248, 0.2);
        background: rgba(255, 255, 255, 0.95);
    }
    
    .ocean-ripple {
        position: relative;
        overflow: hidden;
    }
    
    .ocean-ripple::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }
    
    .ocean-ripple:hover::before {
        left: 100%;
    }
</style>

<div class="min-h-screen ocean-gradient relative overflow-hidden">
    <!-- Floating Ocean Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="ocean-bubble absolute w-3 h-3 bg-blue-200 rounded-full opacity-30 animate-pulse" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
        <div class="ocean-bubble absolute w-2 h-2 bg-teal-200 rounded-full opacity-40 animate-pulse" style="top: 60%; left: 85%; animation-delay: 1s;"></div>
        <div class="ocean-bubble absolute w-4 h-4 bg-cyan-200 rounded-full opacity-20 animate-pulse" style="top: 40%; left: 20%; animation-delay: 2s;"></div>
        <div class="ocean-bubble absolute w-2 h-2 bg-blue-300 rounded-full opacity-30 animate-pulse" style="top: 80%; left: 70%; animation-delay: 3s;"></div>
    </div>

    <div class="relative z-10 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-16 fade-in-header">
                <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-full text-blue-600 text-sm font-medium mb-6 shadow-sm">
                    <i class="fas fa-waves mr-2"></i>
                    Ocean Pearl Hotel
                </div>
                <h1 class="text-5xl font-bold text-gray-800 mb-6 bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent">
                    Khám Phá Thiên Đường Nghỉ Dưỡng
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Đắm chìm trong không gian sang trọng bên bờ biển xanh ngọc bích, 
                    nơi mỗi phòng nghỉ là một câu chuyện riêng về sự thoải mái và đẳng cấp
                </p>
                <div class="mt-8">
                    <a href="/search-rooms" class="ocean-ripple inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-2xl hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 text-lg font-medium">
                        <i class="fas fa-search mr-3"></i>
                        Tìm Phòng Lý Tưởng
                        <i class="fas fa-arrow-right ml-3"></i>
                    </a>
                </div>
            </div>

        <?php if (empty($phongs)): ?>
            <div class="text-center py-20 fade-in-empty">
                <div class="card-gentle rounded-3xl p-16 max-w-2xl mx-auto">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner">
                        <i class="fas fa-umbrella-beach text-6xl text-blue-400"></i>
                    </div>
                    <h3 class="text-3xl font-semibold text-gray-800 mb-4">Đang Chuẩn Bị Những Trải Nghiệm Tuyệt Vời</h3>
                    <p class="text-lg text-gray-600 mb-10 leading-relaxed">
                        Chúng tôi đang hoàn thiện những không gian nghỉ dưỡng đẳng cấp dành riêng cho bạn. 
                        Hãy liên hệ để được tư vấn và đặt phòng sớm nhất.
                    </p>
                    <div class="space-y-4">
                        <a href="/contact" class="ocean-ripple inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-2xl hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 text-lg font-medium">
                            <i class="fas fa-phone mr-3"></i>
                            Liên Hệ Ngay
                        </a>
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-clock mr-2"></i>
                            Phục vụ 24/7 - Hotline: 1900 8888
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Rooms Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 rooms-grid">
                <?php foreach ($phongs as $index => $phong): ?>
                    <div class="room-card card-gentle rounded-3xl overflow-hidden" data-index="<?= $index ?>">
                        <!-- Room Image -->
                        <div class="relative h-64 bg-gradient-to-br from-blue-400 via-cyan-400 to-teal-400 overflow-hidden">
                            <!-- Ocean waves animation -->
                            <div class="absolute inset-0 opacity-30">
                                <div class="wave wave1"></div>
                                <div class="wave wave2"></div>
                                <div class="wave wave3"></div>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            <div class="absolute bottom-6 left-6 text-white">
                                <h3 class="text-2xl font-bold mb-1"><?= htmlspecialchars($phong->ten_phong) ?></h3>
                                <p class="text-blue-100 text-lg"><?= htmlspecialchars($phong->loai_phong) ?></p>
                            </div>
                            <div class="absolute top-6 right-6">
                                <span class="bg-white/20 backdrop-blur-md text-white px-3 py-1 rounded-full text-sm font-medium">
                                    <i class="fas fa-star text-yellow-300 mr-1"></i>
                                    Premium
                                </span>
                            </div>
                        </div>

                        <!-- Room Info -->
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <div class="text-3xl font-bold text-blue-600 mb-1">
                                        <?= number_format($phong->gia_phong, 0, ',', '.') ?><span class="text-lg text-gray-500">đ</span>
                                    </div>
                                    <div class="text-sm text-gray-500">mỗi đêm</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm text-gray-600 mb-1">Mã phòng</div>
                                    <div class="font-mono text-blue-600 font-semibold"><?= htmlspecialchars($phong->ma_phong) ?></div>
                                </div>
                            </div>

                            <!-- Room Features -->
                            <div class="grid grid-cols-2 gap-4 mb-8">
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-water text-blue-400 w-5 mr-3"></i>
                                    <span class="text-sm">View biển</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-wifi text-blue-400 w-5 mr-3"></i>
                                    <span class="text-sm">WiFi miễn phí</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-snowflake text-blue-400 w-5 mr-3"></i>
                                    <span class="text-sm">Điều hòa</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-concierge-bell text-blue-400 w-5 mr-3"></i>
                                    <span class="text-sm">Room service</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex space-x-3">
                                <a href="/phong/<?= $phong->id ?>" class="flex-1 ocean-ripple bg-gradient-to-r from-blue-50 to-cyan-50 text-blue-600 py-3 px-4 rounded-xl hover:from-blue-100 hover:to-cyan-100 transition-all duration-300 text-center font-medium border border-blue-200">
                                    <i class="fas fa-eye mr-2"></i>
                                    Chi tiết
                                </a>
                                <a href="/booking/<?= $phong->id ?>" class="flex-1 ocean-ripple bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-3 px-4 rounded-xl hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 text-center font-medium shadow-lg hover:shadow-xl">
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    Đặt ngay
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        </div>
    </div>
</div>

<!-- Wave Animation CSS -->
<style>
    .wave {
        position: absolute;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.3));
        border-radius: 50%;
        animation: wave-animation 6s ease-in-out infinite;
    }
    
    .wave1 {
        top: -50%;
        left: -50%;
        animation-delay: 0s;
    }
    
    .wave2 {
        top: -30%;
        left: -30%;
        animation-delay: 2s;
    }
    
    .wave3 {
        top: -70%;
        left: -70%;
        animation-delay: 4s;
    }
    
    @keyframes wave-animation {
        0%, 100% { transform: rotate(0deg) scale(1); }
        50% { transform: rotate(180deg) scale(1.1); }
    }
</style>

<!-- JavaScript Animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // GSAP Animations
    gsap.registerPlugin();
    
    // Header animation
    gsap.from('.fade-in-header', {
        duration: 1.5,
        y: 50,
        opacity: 0,
        ease: "power3.out"
    });
    
    // Room cards animation
    gsap.from('.room-card', {
        duration: 1,
        y: 80,
        opacity: 0,
        stagger: 0.2,
        ease: "power3.out",
        delay: 0.5
    });
    
    // Empty state animation
    gsap.from('.fade-in-empty', {
        duration: 1.5,
        scale: 0.8,
        opacity: 0,
        ease: "elastic.out(1, 0.5)"
    });
    
    // Floating bubbles animation
    gsap.to('.ocean-bubble', {
        y: -20,
        duration: 3,
        ease: "power1.inOut",
        yoyo: true,
        repeat: -1,
        stagger: 0.5
    });
    
    // Smooth scroll behavior
    document.querySelectorAll('a[href^="/"]').forEach(link => {
        link.addEventListener('click', function(e) {
            if (this.getAttribute('href').startsWith('/')) {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            }
        });
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>