<?php
$title = 'Về Ocean Pearl Hotel - Thiên Đường Nghỉ Dưỡng Bên Bờ Biển';
ob_start();
?>

<!-- Include animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<style>
    .ocean-gradient-bg {
        background: linear-gradient(135deg,
                rgba(42, 144, 187, 0.08) 0%,
                rgba(10, 118, 168, 0.08) 25%,
                rgba(4, 139, 163, 0.08) 50%,
                rgba(15, 136, 122, 0.08) 75%,
                rgba(11, 129, 90, 0.08) 100%);
    }

    .gentle-card {
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0 8px 40px rgba(56, 189, 248, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .gentle-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 60px rgba(56, 189, 248, 0.15);
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

        0%,
        100% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }
    }

    .parallax-element {
        will-change: transform;
    }

    /* Fix responsive issues */
    @media (max-width: 768px) {
        .text-6xl {
            font-size: 3rem;
        }

        .text-7xl {
            font-size: 3.5rem;
        }

        .text-5xl {
            font-size: 2.5rem;
        }

        .px-8 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .py-6 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .gap-16 {
            gap: 2rem;
        }

        .mb-24 {
            margin-bottom: 3rem;
        }

        .py-20 {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
    }

    /* Ensure proper container behavior */
    .max-w-7xl {
        max-width: 1280px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Fix grid layout */
    .grid {
        display: grid;
    }

    .grid-cols-1 {
        grid-template-columns: repeat(1, minmax(0, 1fr));
    }

    @media (min-width: 768px) {
        .md\\:grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .md\\:grid-cols-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .md\\:grid-cols-4 {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }
    }

    @media (min-width: 1024px) {
        .lg\\:grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .lg\\:grid-cols-4 {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }
    }

    /* Ensure proper spacing */
    .gap-8 {
        gap: 2rem;
    }

    .gap-16 {
        gap: 4rem;
    }

    /* Fix text alignment issues */
    .text-center {
        text-align: center;
    }

    .items-center {
        align-items: center;
    }

    .justify-center {
        justify-content: center;
    }

    /* Fix overflow issues */
    .overflow-hidden {
        overflow: hidden;
    }

    .relative {
        position: relative;
    }

    .absolute {
        position: absolute;
    }
</style>

<div class="min-h-screen ocean-gradient-bg">
    <!-- Hero Section với parallax effect -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 parallax-element">
            <div class="w-full h-full bg-gradient-to-br from-blue-400/20 via-cyan-400/20 to-teal-400/20"></div>
            <!-- Floating ocean elements -->
            <div class="absolute top-20 left-10 w-16 h-16 bg-blue-200/30 rounded-full animate-pulse"></div>
            <div class="absolute top-40 right-20 w-12 h-12 bg-cyan-200/30 rounded-full animate-pulse"
                style="animation-delay: 1s;"></div>
            <div class="absolute bottom-20 left-20 w-20 h-20 bg-teal-200/30 rounded-full animate-pulse"
                style="animation-delay: 2s;"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center hero-content">
                <div
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-full text-blue-600 text-sm font-medium mb-8 gentle-card">
                    <i class="fas fa-anchor mr-2"></i>
                    Câu chuyện của chúng tôi
                </div>
                <h1 class="text-6xl md:text-7xl font-bold mb-8 ocean-wave-text">
                    Ocean Pearl Hotel
                </h1>
                <p class="text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed mb-12">
                    Nơi biển xanh hòa quyện cùng dịch vụ đẳng cấp quốc tế,
                    tạo nên những khoảnh khắc nghỉ dưỡng không thể nào quên
                </p>
                <div class="flex flex-wrap justify-center gap-8 text-center">
                    <div class="gentle-card px-8 py-6 rounded-2xl">
                        <div class="text-4xl font-bold ocean-wave-text mb-2">15+</div>
                        <div class="text-gray-600">Năm kinh nghiệm</div>
                    </div>
                    <div class="gentle-card px-8 py-6 rounded-2xl">
                        <div class="text-4xl font-bold ocean-wave-text mb-2">1M+</div>
                        <div class="text-gray-600">Khách hàng hài lòng</div>
                    </div>
                    <div class="gentle-card px-8 py-6 rounded-2xl">
                        <div class="text-4xl font-bold ocean-wave-text mb-2">200m</div>
                        <div class="text-gray-600">Mặt tiền biển</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <!-- Story Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mb-24 items-center">
            <div class="story-content">
                <h2 class="text-4xl font-bold text-gray-800 mb-8">
                    <span class="ocean-wave-text">Hành trình</span> từ giấc mơ đến hiện thực
                </h2>
                <div class="space-y-6 text-lg text-gray-600 leading-relaxed">
                    <p>
                        Ocean Pearl Hotel ra đời từ tình yêu sâu sắc với biển cả và khát vọng mang đến
                        những trải nghiệm nghỉ dưỡng đẳng cấp thế giới ngay tại Việt Nam. Từ năm 2009,
                        chúng tôi đã không ngừng hoàn thiện để trở thành viên ngọc trai sáng nhất
                        trên bờ biển xanh ngọc bích.
                    </p>
                    <p>
                        Với vị trí đắc địa ôm trọn 200 mét bờ biển riêng tư, Ocean Pearl Hotel không chỉ
                        là nơi nghỉ ngơi mà còn là điểm đến tâm linh nơi con người hòa quyện với thiên nhiên.
                        Mỗi căn phòng đều được thiết kế để tối ưu tầm nhìn ra biển, mang đến cảm giác như
                        đang sống giữa lòng đại dương bao la.
                    </p>
                    <p>
                        Đội ngũ hơn 300 nhân viên của chúng tôi được đào tạo bài bản theo tiêu chuẩn quốc tế,
                        luôn sẵn sàng phục vụ với tâm hồn nhiệt huyết và tinh thần "Khách hàng là gia đình".
                    </p>
                </div>
                <div class="mt-8 flex flex-wrap gap-4">
                    <div class="flex items-center text-blue-600">
                        <i class="fas fa-award mr-2"></i>
                        <span class="font-medium">ISO 9001:2015</span>
                    </div>
                    <div class="flex items-center text-blue-600">
                        <i class="fas fa-star mr-2"></i>
                        <span class="font-medium">5 sao quốc tế</span>
                    </div>
                    <div class="flex items-center text-blue-600">
                        <i class="fas fa-leaf mr-2"></i>
                        <span class="font-medium">Green Hotel Certified</span>
                    </div>
                </div>
            </div>

            <div class="story-image">
                <div class="relative">
                    <div class="gentle-card rounded-3xl overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                            alt="Ocean Pearl Hotel" class="w-full h-96 object-cover">
                    </div>
                    <!-- Floating stats -->
                    <div
                        class="absolute -bottom-6 -left-6 gentle-card rounded-2xl p-6 bg-gradient-to-r from-blue-500 to-cyan-500 text-slate-600">
                        <div class="text-3xl font-bold">98%</div>
                        <div class="text-sm">Khách hàng hài lòng</div>
                    </div>
                    <div
                        class="absolute -top-6 -right-6 gentle-card rounded-2xl p-6 bg-gradient-to-r from-teal-500 to-green-500 text-slate-600">
                        <div class="text-3xl font-bold">4.9</div>
                        <div class="text-sm">Đánh giá trung bình</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ocean Features Section -->
        <div class="mb-24">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-4">
                <span class="ocean-wave-text">Ôm trọn</span> vẻ đẹp đại dương
            </h2>
            <p class="text-xl text-gray-600 text-center max-w-3xl mx-auto mb-16">
                Ocean Pearl Hotel được thiết kế để bạn có thể cảm nhận trọn vẹn sự kỳ diệu của biển cả từ mọi góc độ
            </p>

            <div class="grid grid-cols-4 gap-8">
                <div class="text-center ocean-feature" data-delay="0">
                    <div class="gentle-card rounded-3xl p-8 mb-6  transition-transform duration-300">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-water text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Biển riêng tư</h3>
                        <p class="text-gray-600">200m bờ biển hoang sơ chỉ dành riêng cho khách lưu trú</p>
                    </div>
                </div>

                <div class="text-center ocean-feature" data-delay="0.2">
                    <div class="gentle-card rounded-3xl p-8 mb-6  transition-transform duration-300">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-cyan-500 to-teal-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-sun text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Sunrise View</h3>
                        <p class="text-gray-600">Ngắm bình minh tuyệt đẹp ngay từ ban công phòng</p>
                    </div>
                </div>

                <div class="text-center ocean-feature" data-delay="0.4">
                    <div class="gentle-card rounded-3xl p-8 mb-6 transition-transform duration-300">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-teal-500 to-green-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-fish text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Hệ sinh thái</h3>
                        <p class="text-gray-600">Rạn san hô tự nhiên và đa dạng sinh vật biển</p>
                    </div>
                </div>

                <div class="text-center ocean-feature" data-delay="0.6">
                    <div class="gentle-card rounded-3xl p-8 mb-6 transition-transform duration-300">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-waves text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Âm thanh biển</h3>
                        <p class="text-gray-600">Thư giãn với tiếng sóng vỗ tự nhiên 24/7</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Environmental Commitment -->
        <div class="gentle-card rounded-3xl p-12 !mt-12 text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">
                <span class="ocean-wave-text">Cam kết</span> bảo vệ môi trường biển
            </h2>
            <p class="text-xl text-gray-600 max-w-4xl mx-auto mb-12 leading-relaxed">
                Chúng tôi hiểu rằng vẻ đẹp của biển cần được bảo vệ cho các thế hệ tương lai.
                Ocean Pearl Hotel cam kết thực hiện các hoạt động du lịch bền vững và bảo vệ môi trường.
            </p>

            <div class="grid grid-cols-3 gap-8 mb-12">
                <div class="commitment-item" data-delay="0">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-recycle text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">100% Tái chế</h3>
                    <p class="text-gray-600">Tất cả chất thải được xử lý và tái chế theo tiêu chuẩn quốc tế</p>
                </div>

                <div class="commitment-item" data-delay="0.2">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-solar-panel text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Năng lượng sạch</h3>
                    <p class="text-gray-600">80% năng lượng sử dụng từ nguồn tái tạo và năng lượng mặt trời</p>
                </div>

                <div class="commitment-item" data-delay="0.4">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-teal-500 to-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-seedling text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Bảo tồn san hô</h3>
                    <p class="text-gray-600">Tham gia dự án bảo tồn và phục hồi rạn san hô địa phương</p>
                </div>
            </div>

            <div class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-2xl p-8 max-w-2xl mx-auto">
                <h3 class="text-2xl font-bold mb-4">Tham gia cùng chúng tôi</h3>
                <p class="mb-6">Mỗi lần bạn lưu trú tại Ocean Pearl, bạn đang góp phần bảo vệ môi trường biển</p>
                <div class="flex justify-center space-x-6 text-center">
                    <div>
                        <div class="text-3xl font-bold">500+</div>
                        <div class="text-sm opacity-90">Cây được trồng</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold">2km²</div>
                        <div class="text-sm opacity-90">San hô được bảo vệ</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold">85%</div>
                        <div class="text-sm opacity-90">Giảm carbon footprint</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Environmental Commitment -->
        <div class="gentle-card rounded-3xl p-12 mt-12 text-center mb-24">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">
                <span class="ocean-wave-text">Cam kết</span> bảo vệ môi trường biển
            </h2>
            <p class="text-xl text-gray-600 max-w-4xl mx-auto mb-12 leading-relaxed">
                Chúng tôi hiểu rằng vẻ đẹp của biển cần được bảo vệ cho các thế hệ tương lai.
                Ocean Pearl Hotel cam kết thực hiện các hoạt động du lịch bền vững và bảo vệ môi trường.
            </p>

            <div class="grid grid-cols-3 gap-8 mb-12">
                <div class="commitment-item" data-delay="0">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-recycle text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">100% Tái chế</h3>
                    <p class="text-gray-600">Tất cả chất thải được xử lý và tái chế theo tiêu chuẩn quốc tế</p>
                </div>

                <div class="commitment-item" data-delay="0.2">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-solar-panel text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Năng lượng sạch</h3>
                    <p class="text-gray-600">80% năng lượng sử dụng từ nguồn tái tạo và năng lượng mặt trời</p>
                </div>

                <div class="commitment-item" data-delay="0.4">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-teal-500 to-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-seedling text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Bảo tồn san hô</h3>
                    <p class="text-gray-600">Tham gia dự án bảo tồn và phục hồi rạn san hô địa phương</p>
                </div>
            </div>

            <div class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-2xl p-8 max-w-2xl mx-auto">
                <h3 class="text-2xl font-bold mb-4">Tham gia cùng chúng tôi</h3>
                <p class="mb-6">Mỗi lần bạn lưu trú tại Ocean Pearl, bạn đang góp phần bảo vệ môi trường biển</p>
                <div class="flex justify-center space-x-6 text-center">
                    <div>
                        <div class="text-3xl font-bold">500+</div>
                        <div class="text-sm opacity-90">Cây được trồng</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold">2km²</div>
                        <div class="text-sm opacity-90">San hô được bảo vệ</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold">85%</div>
                        <div class="text-sm opacity-90">Giảm carbon footprint</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Trải nghiệm Ocean Pearl Hotel ngay hôm nay</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                Hãy để chúng tôi mang đến cho bạn những kỷ niệm đẹp nhất trong chuyến nghỉ dưỡng.
                Đặt phòng ngay để nhận ưu đãi đặc biệt!
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="/phong"
                    class="bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-8 py-3 rounded-xl font-semibold transition-all transform shadow-lg inline-flex items-center">
                    <i class="fas fa-bed mr-2"></i>
                    Đặt phòng ngay
                </a>
                <a href="/contact"
                    class="border-2 border-blue-600 text-blue-600 px-8 py-3 rounded-xl font-semibold hover:bg-blue-600 hover:text-white transition-all inline-flex items-center">
                    <i class="fas fa-phone mr-2"></i>
                    Liên hệ tư vấn
                </a>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Animations -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Register GSAP plugins
        gsap.registerPlugin(ScrollTrigger);

        // Hero content animation
        gsap.from('.hero-content', {
            duration: 1.5,
            y: 100,
            opacity: 0,
            ease: "power3.out"
        });

        // Parallax effect for floating elements
        gsap.to('.parallax-element', {
            y: -50,
            scrollTrigger: {
                trigger: '.parallax-element',
                start: 'top bottom',
                end: 'bottom top',
                scrub: 1
            }
        });

        // Story content animation
        gsap.from('.story-content', {
            duration: 1,
            x: -100,
            opacity: 0,
            scrollTrigger: {
                trigger: '.story-content',
                start: 'top 80%',
                end: 'bottom 20%',
                toggleActions: 'play none none reverse'
            }
        });

        gsap.from('.story-image', {
            duration: 1,
            x: 100,
            opacity: 0,
            scrollTrigger: {
                trigger: '.story-image',
                start: 'top 80%',
                end: 'bottom 20%',
                toggleActions: 'play none none reverse'
            }
        });

        // Ocean features animation
        document.querySelectorAll('.ocean-feature').forEach((feature, index) => {
            const delay = parseFloat(feature.dataset.delay) || 0;

            gsap.from(feature, {
                duration: 0.8,
                y: 50,
                opacity: 0,
                delay: delay,
                scrollTrigger: {
                    trigger: feature,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Commitment items animation
        document.querySelectorAll('.commitment-item').forEach((item, index) => {
            const delay = parseFloat(item.dataset.delay) || 0;

            gsap.from(item, {
                duration: 1,
                scale: 0.8,
                opacity: 0,
                delay: delay,
                ease: "elastic.out(1, 0.5)",
                scrollTrigger: {
                    trigger: item,
                    start: 'top 90%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Ocean wave text animation
        gsap.to('.ocean-wave-text', {
            backgroundPosition: '200% center',
            duration: 3,
            ease: 'none',
            repeat: -1
        });
    });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>