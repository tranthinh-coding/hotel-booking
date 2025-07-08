<?php
$title = 'Ocean Pearl Hotel - Khách sạn sang trọng bên bờ biển';
ob_start();
?>

<!-- Hero Section with Search -->
<div class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2000&q=80" 
             alt="Ocean Pearl Hotel" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/40 to-black/60"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-10 text-center text-white px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 text-shadow animate__animated animate__fadeInUp">
            Ocean Pearl Hotel
        </h1>
        <p class="text-xl md:text-2xl mb-8 text-gray-200 animate__animated animate__fadeInUp animate__delay-1s">
            Trải nghiệm nghỉ dưỡng sang trọng bên bờ biển xanh thơ mộng
        </p>
        
        <!-- Search Form -->
        <div class="bg-white/95 backdrop-blur-md p-8 rounded-2xl soft-shadow max-w-4xl mx-auto animate__animated animate__fadeInUp animate__delay-2s">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Tìm kiếm phòng nghỉ</h3>
            <form action="/search-rooms" method="GET" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Check-in Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar-alt mr-2 text-ocean-500"></i>Ngày nhận phòng
                        </label>
                        <input type="date" name="checkin" id="checkin" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all"
                               min="<?= date('Y-m-d') ?>" required>
                    </div>
                    
                    <!-- Check-out Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar-alt mr-2 text-ocean-500"></i>Ngày trả phòng
                        </label>
                        <input type="date" name="checkout" id="checkout"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all"
                               min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
                    </div>
                    
                    <!-- Guests -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-users mr-2 text-ocean-500"></i>Số khách
                        </label>
                        <select name="guests" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all">
                            <option value="1">1 khách</option>
                            <option value="2" selected>2 khách</option>
                            <option value="3">3 khách</option>
                            <option value="4">4 khách</option>
                            <option value="5+">5+ khách</option>
                        </select>
                    </div>
                    
                    <!-- Room Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-bed mr-2 text-ocean-500"></i>Loại phòng
                        </label>
                        <select name="room_type"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all">
                            <option value="">Tất cả loại phòng</option>
                            <option value="standard">Phòng tiêu chuẩn</option>
                            <option value="deluxe">Phòng cao cấp</option>
                            <option value="suite">Phòng suite</option>
                            <option value="ocean_view">Phòng view biển</option>
                        </select>
                    </div>
                </div>
                
                <!-- Search Button -->
                <div class="text-center">
                    <button type="submit" class="btn-ocean text-white px-12 py-4 rounded-full text-lg font-medium inline-flex items-center">
                        <i class="fas fa-search mr-3"></i>Tìm kiếm phòng nghỉ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div class="fade-in-up">
                <div class="text-4xl font-bold text-ocean-600 mb-2" data-count="150">0</div>
                <p class="text-gray-600">Phòng nghỉ</p>
            </div>
            <div class="fade-in-up">
                <div class="text-4xl font-bold text-ocean-600 mb-2" data-count="15000">0</div>
                <p class="text-gray-600">Khách hàng hài lòng</p>
            </div>
            <div class="fade-in-up">
                <div class="text-4xl font-bold text-ocean-600 mb-2" data-count="25">0</div>
                <p class="text-gray-600">Dịch vụ cao cấp</p>
            </div>
            <div class="fade-in-up">
                <div class="text-4xl font-bold text-ocean-600 mb-2" data-count="98">0</div>
                <p class="text-gray-600">% Đánh giá tích cực</p>
            </div>
        </div>
    </div>
</div>

<!-- About Section -->
<div class="py-20 bg-gradient-to-br from-ocean-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="fade-in-up">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">
                    Chào mừng đến với Ocean Pearl Hotel
                </h2>
                <p class="text-lg text-gray-700 mb-6 leading-relaxed">
                    Tọa lạc tại vị trí đắc địa bên bờ biển Nha Trang, Ocean Pearl Hotel mang đến cho bạn trải nghiệm 
                    nghỉ dưỡng sang trọng với dịch vụ 5 sao và view biển tuyệt đẹp.
                </p>
                <p class="text-lg text-gray-700 mb-8 leading-relaxed">
                    Với 150 phòng nghỉ được thiết kế tinh tế, nhà hàng cao cấp, spa thư giãn và các tiện ích hiện đại, 
                    chúng tôi cam kết mang đến những khoảnh khắc đáng nhớ cho kỳ nghỉ của bạn.
                </p>
                <a href="/about" class="btn-ocean text-white px-8 py-3 rounded-full inline-flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>Tìm hiểu thêm
                </a>
            </div>
            <div class="fade-in-up">
                <img src="https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                     alt="Ocean Pearl Hotel Interior" class="rounded-2xl soft-shadow w-full">
            </div>
        </div>
    </div>
</div>

<!-- Room Types -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4 fade-in-up">Các loại phòng nghỉ</h2>
            <p class="text-xl text-gray-600 fade-in-up">Lựa chọn phòng nghỉ phù hợp với nhu cầu của bạn</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Standard Room -->
            <div class="card-hover bg-white rounded-2xl soft-shadow overflow-hidden fade-in-up">
                <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                     alt="Standard Room" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Phòng tiêu chuẩn</h3>
                    <p class="text-gray-600 mb-4">Phòng nghỉ thoải mái với đầy đủ tiện nghi cơ bản</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-ocean-600">2,500,000₫</span>
                        <span class="text-sm text-gray-500">/đêm</span>
                    </div>
                    <a href="/phong" class="mt-4 btn-ocean text-white px-6 py-2 rounded-lg text-sm inline-block text-center w-full">
                        Xem chi tiết
                    </a>
                </div>
            </div>
            
            <!-- Deluxe Room -->
            <div class="card-hover bg-white rounded-2xl soft-shadow overflow-hidden fade-in-up">
                <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                     alt="Deluxe Room" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Phòng cao cấp</h3>
                    <p class="text-gray-600 mb-4">Không gian rộng rãi với ban công riêng và trang thiết bị hiện đại</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-ocean-600">3,800,000₫</span>
                        <span class="text-sm text-gray-500">/đêm</span>
                    </div>
                    <a href="/phong" class="mt-4 btn-ocean text-white px-6 py-2 rounded-lg text-sm inline-block text-center w-full">
                        Xem chi tiết
                    </a>
                </div>
            </div>
            
            <!-- Ocean View Suite -->
            <div class="card-hover bg-white rounded-2xl soft-shadow overflow-hidden fade-in-up">
                <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                     alt="Ocean View Suite" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Suite view biển</h3>
                    <p class="text-gray-600 mb-4">Phòng suite sang trọng với view biển tuyệt đẹp</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-ocean-600">6,500,000₫</span>
                        <span class="text-sm text-gray-500">/đêm</span>
                    </div>
                    <a href="/phong" class="mt-4 btn-ocean text-white px-6 py-2 rounded-lg text-sm inline-block text-center w-full">
                        Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services -->
<div class="py-20 bg-gradient-to-br from-gray-50 to-ocean-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4 fade-in-up">Dịch vụ cao cấp</h2>
            <p class="text-xl text-gray-600 fade-in-up">Trải nghiệm những dịch vụ tuyệt vời tại Ocean Pearl Hotel</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Restaurant -->
            <div class="text-center fade-in-up">
                <div class="w-16 h-16 bg-gradient-to-br from-ocean-400 to-ocean-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-utensils text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Nhà hàng cao cấp</h3>
                <p class="text-gray-600">Thưởng thức ẩm thực đa dạng từ Việt Nam và quốc tế</p>
            </div>
            
            <!-- Spa -->
            <div class="text-center fade-in-up">
                <div class="w-16 h-16 bg-gradient-to-br from-ocean-400 to-ocean-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-spa text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Spa thư giãn</h3>
                <p class="text-gray-600">Dịch vụ massage và chăm sóc sức khỏe chuyên nghiệp</p>
            </div>
            
            <!-- Pool -->
            <div class="text-center fade-in-up">
                <div class="w-16 h-16 bg-gradient-to-br from-ocean-400 to-ocean-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-swimming-pool text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Hồ bơi infinity</h3>
                <p class="text-gray-600">Hồ bơi vô cực với view biển tuyệt đẹp</p>
            </div>
            
            <!-- Fitness -->
            <div class="text-center fade-in-up">
                <div class="w-16 h-16 bg-gradient-to-br from-ocean-400 to-ocean-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-dumbbell text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Phòng gym</h3>
                <p class="text-gray-600">Trang thiết bị hiện đại và huấn luyện viên chuyên nghiệp</p>
            </div>
        </div>
    </div>
</div>

<!-- Gallery -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4 fade-in-up">Hình ảnh khách sạn</h2>
            <p class="text-xl text-gray-600 fade-in-up">Khám phá vẻ đẹp của Ocean Pearl Hotel</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="fade-in-up">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                     alt="Hotel Exterior" class="w-full h-64 object-cover rounded-2xl soft-shadow card-hover">
            </div>
            <div class="fade-in-up">
                <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                     alt="Hotel Pool" class="w-full h-64 object-cover rounded-2xl soft-shadow card-hover">
            </div>
            <div class="fade-in-up">
                <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                     alt="Hotel Restaurant" class="w-full h-64 object-cover rounded-2xl soft-shadow card-hover">
            </div>
            <div class="fade-in-up">
                <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                     alt="Hotel Spa" class="w-full h-64 object-cover rounded-2xl soft-shadow card-hover">
            </div>
            <div class="fade-in-up">
                <img src="https://images.unsplash.com/photo-1595576508898-0ad5c879a061?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                     alt="Hotel Beach" class="w-full h-64 object-cover rounded-2xl soft-shadow card-hover">
            </div>
            <div class="fade-in-up">
                <img src="https://images.unsplash.com/photo-1584132967334-10e028bd69f7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                     alt="Hotel Sunset" class="w-full h-64 object-cover rounded-2xl soft-shadow card-hover">
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-20 gradient-bg text-white text-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold mb-6 fade-in-up">Đặt phòng ngay hôm nay</h2>
        <p class="text-xl mb-8 fade-in-up">Trải nghiệm kỳ nghỉ tuyệt vời tại Ocean Pearl Hotel với ưu đãi đặc biệt</p>
        <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center fade-in-up">
            <a href="/phong" class="bg-white text-ocean-600 px-8 py-3 rounded-full font-medium inline-flex items-center gentle-hover">
                <i class="fas fa-bed mr-2"></i>Xem phòng nghỉ
            </a>
            <a href="/contact" class="border-2 border-white text-white px-8 py-3 rounded-full font-medium inline-flex items-center gentle-hover hover:bg-white hover:text-ocean-600">
                <i class="fas fa-phone mr-2"></i>Liên hệ ngay
            </a>
        </div>
    </div>
</div>

<script>
// Date picker validation
document.addEventListener('DOMContentLoaded', function() {
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    
    checkinInput.addEventListener('change', function() {
        const checkinDate = new Date(this.value);
        const checkoutDate = new Date(checkinDate);
        checkoutDate.setDate(checkoutDate.getDate() + 1);
        
        checkoutInput.min = checkoutDate.toISOString().split('T')[0];
        
        if (checkoutInput.value && new Date(checkoutInput.value) <= checkinDate) {
            checkoutInput.value = checkoutDate.toISOString().split('T')[0];
        }
    });
    
    // Counter animation
    const counters = document.querySelectorAll('[data-count]');
    
    const animateCounter = (counter) => {
        const target = parseInt(counter.getAttribute('data-count'));
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            counter.textContent = Math.floor(current).toLocaleString();
        }, 16);
    };
    
    // Trigger counter animation on scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    });
    
    counters.forEach(counter => observer.observe(counter));
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/app.php';
?>
