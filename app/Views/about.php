<?php
$title = 'Về chúng tôi - Hotel Ocean';
ob_start();
?>

<div class="max-w-6xl mx-auto">
    <!-- Hero Section -->
    <div class="relative h-96 bg-gradient-to-r from-ocean-600 to-seafoam-600 rounded-3xl overflow-hidden mb-12">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="relative z-10 flex items-center justify-center h-full text-center text-white px-6">
            <div>
                <h1 class="text-5xl font-bold mb-4">Về Hotel Ocean</h1>
                <p class="text-xl mb-8 max-w-2xl mx-auto">
                    Khách sạn 5 sao với hơn 15 năm kinh nghiệm phục vụ, mang đến những trải nghiệm nghỉ dưỡng đẳng cấp quốc tế
                </p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-white via-white to-transparent"></div>
    </div>

    <!-- About Content -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Câu chuyện của chúng tôi</h2>
            <div class="space-y-4 text-gray-600">
                <p>
                    Hotel Ocean được thành lập vào năm 2009 với tầm nhìn trở thành một trong những khách sạn hàng đầu 
                    tại Việt Nam. Nằm ở vị trí đắc địa với tầm nhìn tuyệt đẹp ra biển, chúng tôi đã phục vụ hàng triệu 
                    khách hàng trong và ngoài nước.
                </p>
                <p>
                    Với đội ngũ nhân viên chuyên nghiệp, tận tâm và cơ sở vật chất hiện đại, Hotel Ocean cam kết mang đến 
                    những trải nghiệm nghỉ dưỡng không thể quên cho mỗi vị khách.
                </p>
                <p>
                    Chúng tôi tự hào là khách sạn đầu tiên tại khu vực đạt chứng nhận ISO 9001:2015 về chất lượng dịch vụ 
                    và được vinh danh "Khách sạn xuất sắc nhất năm" 3 năm liên tiếp.
                </p>
            </div>
        </div>
        
        <div class="relative">
            <img src="/assets/images/about-hotel.jpg" 
                 alt="Hotel Ocean Building" 
                 class="w-full h-80 object-cover rounded-2xl shadow-lg">
            <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-gradient-to-br from-ocean-500 to-seafoam-500 rounded-2xl flex items-center justify-center text-white text-center">
                <div>
                    <div class="text-2xl font-bold">15+</div>
                    <div class="text-sm">Năm kinh nghiệm</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Giá trị cốt lõi</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-heart text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Tận tâm phục vụ</h3>
                <p class="text-gray-600">
                    Chúng tôi luôn đặt khách hàng làm trung tâm, lắng nghe và đáp ứng mọi nhu cầu với sự tận tâm cao nhất.
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-leaf text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Bền vững môi trường</h3>
                <p class="text-gray-600">
                    Cam kết bảo vệ môi trường thông qua các chương trình xanh và sử dụng năng lượng tái tạo.
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-gem text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Chất lượng vượt trội</h3>
                <p class="text-gray-600">
                    Không ngừng nâng cao chất lượng dịch vụ và cơ sở vật chất để mang đến trải nghiệm đẳng cấp.
                </p>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="bg-gradient-to-r from-ocean-600 to-seafoam-600 rounded-2xl p-8 mb-12 text-white">
        <h2 class="text-3xl font-bold text-center mb-8">Con số ấn tượng</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-4xl font-bold mb-2">500K+</div>
                <div class="text-sm opacity-90">Khách hàng hài lòng</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold mb-2">200+</div>
                <div class="text-sm opacity-90">Phòng cao cấp</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold mb-2">50+</div>
                <div class="text-sm opacity-90">Dịch vụ đa dạng</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold mb-2">4.8/5</div>
                <div class="text-sm opacity-90">Đánh giá trung bình</div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Đội ngũ lãnh đạo</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <img src="/assets/images/team-1.jpg" 
                     alt="CEO" 
                     class="w-full h-64 object-cover">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Nguyễn Minh Đức</h3>
                    <p class="text-ocean-600 font-medium mb-3">CEO & Founder</p>
                    <p class="text-gray-600 text-sm">
                        Với hơn 20 năm kinh nghiệm trong ngành khách sạn, ông Đức đã dẫn dắt Hotel Ocean trở thành 
                        một trong những thương hiệu uy tín nhất.
                    </p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <img src="/assets/images/team-2.jpg" 
                     alt="General Manager" 
                     class="w-full h-64 object-cover">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Trần Thị Lan</h3>
                    <p class="text-ocean-600 font-medium mb-3">General Manager</p>
                    <p class="text-gray-600 text-sm">
                        Bà Lan chịu trách nhiệm vận hành toàn bộ hoạt động khách sạn, đảm bảo chất lượng dịch vụ 
                        luôn ở mức cao nhất.
                    </p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <img src="/assets/images/team-3.jpg" 
                     alt="Chef" 
                     class="w-full h-64 object-cover">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Chef Marco Rossi</h3>
                    <p class="text-ocean-600 font-medium mb-3">Executive Chef</p>
                    <p class="text-gray-600 text-sm">
                        Chef Marco mang đến những trải nghiệm ẩm thực đẳng cấp quốc tế với sự kết hợp hoàn hảo 
                        giữa hương vị Á-Âu.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Awards & Certifications -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-12">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Giải thưởng & Chứng nhận</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-trophy text-2xl text-yellow-600"></i>
                </div>
                <h4 class="font-semibold text-gray-800 mb-2">World Travel Awards</h4>
                <p class="text-sm text-gray-600">Best Hotel Vietnam 2023</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-certificate text-2xl text-blue-600"></i>
                </div>
                <h4 class="font-semibold text-gray-800 mb-2">ISO 9001:2015</h4>
                <p class="text-sm text-gray-600">Quality Management</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-star text-2xl text-green-600"></i>
                </div>
                <h4 class="font-semibold text-gray-800 mb-2">TripAdvisor</h4>
                <p class="text-sm text-gray-600">Travelers' Choice 2023</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-award text-2xl text-purple-600"></i>
                </div>
                <h4 class="font-semibold text-gray-800 mb-2">Vietnam Tourism</h4>
                <p class="text-sm text-gray-600">Golden Dragon Award</p>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Trải nghiệm Hotel Ocean ngay hôm nay</h2>
        <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
            Hãy để chúng tôi mang đến cho bạn những kỷ niệm đẹp nhất trong chuyến nghỉ dưỡng. 
            Đặt phòng ngay để nhận ưu đãi đặc biệt!
        </p>
        <div class="space-x-4">
            <a href="/phong" 
               class="bg-gradient-to-r from-ocean-600 to-seafoam-600 hover:from-ocean-700 hover:to-seafoam-700 text-white px-8 py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg inline-flex items-center">
                <i class="fas fa-bed mr-2"></i>
                Đặt phòng ngay
            </a>
            <a href="/contact" 
               class="border-2 border-ocean-600 text-ocean-600 px-8 py-3 rounded-xl font-semibold hover:bg-ocean-600 hover:text-white transition-all inline-flex items-center">
                <i class="fas fa-phone mr-2"></i>
                Liên hệ tư vấn
            </a>
        </div>
    </div>
</div>

<style>
/* Counter animation */
@keyframes countUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.counter {
    animation: countUp 0.8s ease-out;
}
</style>

<script>
// Simple counter animation when scrolling into view
const observerOptions = {
    threshold: 0.5,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const counters = entry.target.querySelectorAll('.text-4xl');
            counters.forEach(counter => {
                counter.classList.add('counter');
            });
        }
    });
}, observerOptions);

const statsSection = document.querySelector('.bg-gradient-to-r');
if (statsSection) {
    observer.observe(statsSection);
}
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
