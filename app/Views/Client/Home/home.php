<?php
$title = 'Ocean Pearl Hotel - Thiên Đường Nghỉ Dưỡng Bên Bờ Biển Xanh';
ob_start();
?>

<!-- Include animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<style>
    .ocean-hero-bg {
        background: 
            url('https://5.imimg.com/data5/SELLER/Default/2023/8/336872951/UC/XC/VH/150189352/hotel-exterior-designing-service-1000x1000.jpeg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    
    .gentle-card {
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0 8px 40px rgba(56, 189, 248, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .gentle-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(56, 189, 248, 0.15);
        background: rgba(255, 255, 255, 0.95);
    }
    
    .ocean-wave-text {
        background: linear-gradient(45deg, #0ea5e9, #06b6d4, #14b8a6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        background-size: 200% auto;
        animation: ocean-wave 3s ease-in-out infinite;
    }
    
    @keyframes ocean-wave {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    .floating-element {
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    .ocean-gradient-bg {
        background: linear-gradient(135deg, 
            rgba(56, 189, 248, 0.05) 0%, 
            rgba(14, 165, 233, 0.05) 25%, 
            rgba(6, 182, 212, 0.05) 50%, 
            rgba(20, 184, 166, 0.05) 75%, 
            rgba(16, 185, 129, 0.05) 100%);
    }
</style>

<!-- Hero Section -->
<section class="relative min-h-screen ocean-hero-bg overflow-hidden flex items-center">
    <!-- Floating ocean elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="floating-element absolute w-4 h-4 bg-white/20 rounded-full" style="top: 20%; left: 15%; animation-delay: 0s;"></div>
        <div class="floating-element absolute w-3 h-3 bg-white/30 rounded-full" style="top: 60%; left: 85%; animation-delay: 2s;"></div>
        <div class="floating-element absolute w-5 h-5 bg-white/15 rounded-full" style="top: 40%; left: 25%; animation-delay: 4s;"></div>
        <div class="floating-element absolute w-2 h-2 bg-white/25 rounded-full" style="top: 80%; left: 70%; animation-delay: 1s;"></div>
    </div>
    
    <div class="relative z-10 w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="hero-content">
                <div class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-md rounded-full text-white text-sm font-medium mb-8 border border-white/30">
                    <i class="fas fa-gem mr-2"></i>
                    Trải nghiệm đẳng cấp 5 sao
                </div>
                
                <h1 class="text-6xl md:text-8xl font-bold text-white mb-8 leading-tight">
                    Ocean Pearl
                    <span class="block ocean-wave-text bg-gradient-to-r from-white to-cyan-100 bg-clip-text text-transparent">
                        Hotel
                    </span>
                </h1>
                
                <!-- <p class="text-2xl text-white/90 max-w-4xl mx-auto mb-12 leading-relaxed">
                    Nơi biển xanh ngọc bích hòa quyện cùng dịch vụ đẳng cấp quốc tế, 
                    tạo nên những khoảnh khắc nghỉ dưỡng không thể nào quên
                </p> -->
                
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6">
                    <a href="/phong" class="group bg-white text-blue-600 px-10 py-4 rounded-2xl font-bold text-lg hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl inline-flex items-center">
                        <i class="fas fa-bed mr-3 group-hover:scale-110 transition-transform"></i>
                        Khám Phá Phòng Nghỉ
                        <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="/dich-vu" class="group border-2 border-white text-white px-10 py-4 rounded-2xl font-bold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:scale-105 inline-flex items-center backdrop-blur-md">
                        <i class="fas fa-concierge-bell mr-3 group-hover:scale-110 transition-transform"></i>
                        Dịch Vụ Cao Cấp
                    </a>
                </div>
                
                <!-- Quick stats -->
                <div class="flex flex-wrap justify-center gap-8 mt-16">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-white mb-2">15+</div>
                        <div class="text-white/80 text-sm">Năm kinh nghiệm</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-white mb-2">200m</div>
                        <div class="text-white/80 text-sm">Mặt tiền biển</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-white mb-2">98%</div>
                        <div class="text-white/80 text-sm">Khách hài lòng</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
        <i class="fas fa-chevron-down text-2xl"></i>
    </div>
</section>

<!-- Features Section -->
<section class="ocean-gradient-bg py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-full text-blue-600 text-sm font-medium mb-6 gentle-card">
                <i class="fas fa-star mr-2"></i>
                Tại sao chọn Ocean Pearl
            </div>
            <h2 class="text-5xl font-bold text-gray-800 mb-6">
                Trải nghiệm <span class="ocean-wave-text">đẳng cấp</span> bên bờ biển
            </h2>
            <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                Chúng tôi mang đến trải nghiệm nghỉ dưỡng hoàn hảo với những tiện ích hiện đại, 
                dịch vụ tận tâm và vị trí đắc địa nhất bên bờ biển xanh ngọc bích
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="feature-card gentle-card rounded-3xl p-10 text-center group" data-delay="0">
                <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-water text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">View Biển Riêng Tư</h3>
                <p class="text-gray-600 leading-relaxed">
                    200m bờ biển riêng tư với làn nước trong xanh và cát trắng mịn màng, 
                    mang đến không gian thư giãn tuyệt đối chỉ dành riêng cho khách lưu trú.
                </p>
            </div>
            
            <div class="feature-card gentle-card rounded-3xl p-10 text-center group" data-delay="0.2">
                <div class="w-20 h-20 bg-gradient-to-r from-cyan-500 to-teal-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-utensils text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Ẩm Thực Đặc Sắc</h3>
                <p class="text-gray-600 leading-relaxed">
                    Thưởng thức những món ăn tinh tế từ đầu bếp 5 sao với nguyên liệu tươi ngon từ biển.
                </p>
            </div>
            
            <div class="feature-card gentle-card rounded-3xl p-10 text-center group" data-delay="0.4">
                <div class="w-20 h-20 bg-gradient-to-r from-teal-500 to-green-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-spa text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Dịch Vụ Spa Cao Cấp</h3>
                <p class="text-gray-600 leading-relaxed">
                    Thư giãn và tái tạo năng lượng với các liệu pháp spa chuyên nghiệp trong không gian yên tĩnh.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">
                Phòng nổi bật
            </h2>
            <p class="text-lg text-gray-600">Khám phá các phòng được yêu thích nhất tại Ocean Pearl Hotel</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <?php if (isNotEmpty($phongs)): ?>
                <?php foreach ($phongs as $phong): ?>
                    <?php
                      $phong = (object) $phong;
                    ?>
                    <div class="gentle-card rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all">
                        <a href="/phong/show?id=<?= $phong->ma_phong ?>" class="block">
                            <div class="h-48 bg-gray-200 flex items-center justify-center">
                                <?php if (isNotEmpty($phong->anh_bia)): ?>
                                    <img src="<?= getFileUrl($phong->anh_bia) ?>" alt="<?= htmlspecialchars($phong->ten_phong) ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <i class="fas fa-bed text-5xl text-gray-400"></i>
                                <?php endif; ?>
                            </div>
                            <div class="p-4">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2"><?= htmlspecialchars($phong->ten_phong) ?></h3>
                                <div class="text-sm text-gray-600 mb-2">
                                    <?= htmlspecialchars($phong->ten_loai_phong ?? '') ?>
                                </div>
                                <div class="text-blue-600 font-bold text-lg mb-2">
                                    <?= number_format($phong->gia) ?> VNĐ
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <?= \HotelBooking\Enums\TrangThaiPhong::getLabel($phong->trang_thai) ?>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center text-gray-500 py-12">
                    <i class="fas fa-bed text-4xl mb-3"></i>
                    <p>Chưa có phòng nào để hiển thị</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Experience Section -->
<section class="py-24 bg-gradient-to-r from-blue-600 to-cyan-600 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full"></div>
        <div class="absolute bottom-20 right-20 w-24 h-24 bg-white rounded-full"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white rounded-full"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center text-white">
            <h2 class="text-5xl font-bold mb-8">Trải Nghiệm Đáng Nhớ</h2>
            <p class="text-xl opacity-90 max-w-3xl mx-auto mb-16 leading-relaxed">
                Mỗi khoảnh khắc tại Ocean Pearl Hotel đều được thiết kế để tạo nên những kỷ niệm không thể quên
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div class="experience-stat" data-delay="0">
                    <div class="text-5xl font-bold mb-2 counter" data-target="15">0</div>
                    <div class="text-lg opacity-90">Năm Kinh Nghiệm</div>
                </div>
                <div class="experience-stat" data-delay="0.2">
                    <div class="text-5xl font-bold mb-2 counter" data-target="250">0</div>
                    <div class="text-lg opacity-90">Phòng Cao Cấp</div>
                </div>
                <div class="experience-stat" data-delay="0.4">
                    <div class="text-5xl font-bold mb-2 counter" data-target="98">0</div>
                    <div class="text-lg opacity-90">% Khách Hài Lòng</div>
                </div>
                <div class="experience-stat" data-delay="0.6">
                    <div class="text-5xl font-bold mb-2 counter" data-target="50">0</div>
                    <div class="text-lg opacity-90">Dịch Vụ Đa Dạng</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="ocean-gradient-bg py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="gentle-card rounded-3xl p-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">
                Sẵn sàng cho kỳ nghỉ tuyệt vời?
            </h2>
            <p class="text-xl text-gray-600 mb-12 leading-relaxed">
                Đặt phòng ngay hôm nay để tận hưởng những trải nghiệm đáng nhớ tại Ocean Pearl Hotel
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="/phong" class="group bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-10 py-4 rounded-2xl font-bold text-lg hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl inline-flex items-center">
                    <i class="fas fa-calendar-check mr-3 group-hover:scale-110 transition-transform"></i>
                    Đặt phòng ngay
                </a>
                <a href="/contact" class="group border-2 border-blue-500 text-blue-600 px-10 py-4 rounded-2xl font-bold text-lg hover:bg-blue-500 hover:text-white transition-all duration-300 transform hover:scale-105 inline-flex items-center">
                    <i class="fas fa-phone mr-3 group-hover:scale-110 transition-transform"></i>
                    Liên hệ tư vấn
                </a>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript Animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Register GSAP plugins
    gsap.registerPlugin(ScrollTrigger);
    
    // Hero content animation
    gsap.from('.hero-content', {
        duration: 2,
        y: 100,
        opacity: 0,
        ease: "power3.out"
    });
    
    // Feature cards animation
    document.querySelectorAll('.feature-card').forEach((card, index) => {
        const delay = parseFloat(card.dataset.delay) || 0;
        
        gsap.from(card, {
            duration: 1,
            y: 80,
            opacity: 0,
            delay: delay,
            ease: "power3.out",
            scrollTrigger: {
                trigger: card,
                start: 'top 85%',
                toggleActions: 'play none none reverse'
            }
        });
    });
    
    // Experience stats animation
    document.querySelectorAll('.experience-stat').forEach((stat, index) => {
        const delay = parseFloat(stat.dataset.delay) || 0;
        
        gsap.from(stat, {
            duration: 1,
            scale: 0.5,
            opacity: 0,
            delay: delay,
            ease: "elastic.out(1, 0.5)",
            scrollTrigger: {
                trigger: stat,
                start: 'top 90%',
                toggleActions: 'play none none reverse'
            }
        });
    });
    
    // Counter animation
    document.querySelectorAll('.counter').forEach(counter => {
        const target = parseInt(counter.dataset.target);
        
        ScrollTrigger.create({
            trigger: counter,
            start: 'top 80%',
            onEnter: () => {
                gsap.to(counter, {
                    duration: 2,
                    innerHTML: target,
                    snap: { innerHTML: 1 },
                    ease: "power2.out"
                });
            }
        });
    });
    
    // Parallax effect for floating elements
    gsap.to('.floating-element', {
        y: -50,
        scrollTrigger: {
            trigger: '.floating-element',
            start: 'top bottom',
            end: 'bottom top',
            scrub: 1
        }
    });
    
    // Smooth hover effects
    document.querySelectorAll('.gentle-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            gsap.to(this, {
                duration: 0.3,
                y: -5,
                scale: 1.02,
                ease: "power2.out"
            });
        });
        
        card.addEventListener('mouseleave', function() {
            gsap.to(this, {
                duration: 0.3,
                y: 0,
                scale: 1,
                ease: "power2.out"
            });
        });
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
