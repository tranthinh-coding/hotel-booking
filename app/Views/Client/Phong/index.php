<?php
$title = 'Phòng Nghỉ - Ocean Pearl Hotel';
ob_start();
?>

<style>
    .room-card {
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .room-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(56, 189, 248, 0.15);
        background: rgba(255, 255, 255, 1);
    }
    
    .filter-section {
        backdrop-filter: blur(16px);
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(13, 148, 136, 0.1);
    }
    
    .price-badge {
        background: linear-gradient(135deg, #0891b2, #0d9488);
    }
    
    .available-badge {
        background: linear-gradient(135deg, #10b981, #059669);
    }
    
    .room-image {
        transition: transform 0.4s ease;
    }
    
    .room-card:hover .room-image {
        transform: scale(1.05);
    }
</style>

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-cyan-50 via-blue-50 to-emerald-50 py-16">
    <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/5 to-emerald-500/5"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                Phòng Nghỉ
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-emerald-600">
                    Cao Cấp
                </span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Khám phá bộ sưu tập phòng nghỉ sang trọng với thiết kế hiện đại và view biển tuyệt đẹp
            </p>
        </div>
    </div>
</section>

<!-- Search & Filter Section -->
<section class="py-8 bg-white/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="filter-section rounded-2xl p-6 mb-8">
            <form method="GET" action="/phong" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                    <!-- Check-in Date -->
                    <div>
                        <label for="checkin" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar-check text-cyan-600 mr-2"></i>Ngày nhận phòng
                        </label>
                        <input 
                            type="date" 
                            id="checkin" 
                            name="checkin" 
                            value="<?= htmlspecialchars($searchParams['checkin']) ?>"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                            min="<?= date('Y-m-d') ?>"
                        >
                    </div>
                    
                    <!-- Check-out Date -->
                    <div>
                        <label for="checkout" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar-times text-cyan-600 mr-2"></i>Ngày trả phòng
                        </label>
                        <input 
                            type="date" 
                            id="checkout" 
                            name="checkout" 
                            value="<?= htmlspecialchars($searchParams['checkout']) ?>"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                            min="<?= date('Y-m-d', strtotime('+1 day')) ?>"
                        >
                    </div>
                    
                    <!-- Number of Guests -->
                    <div>
                        <label for="guests" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-users text-cyan-600 mr-2"></i>Số khách
                        </label>
                        <select 
                            id="guests" 
                            name="guests" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                        >
                            <?php for($i = 1; $i <= 6; $i++): ?>
                                <option value="<?= $i ?>" <?= $searchParams['guests'] == $i ? 'selected' : '' ?>>
                                    <?= $i ?> khách
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    
                    <!-- Room Type -->
                    <div>
                        <label for="room_type" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-bed text-cyan-600 mr-2"></i>Loại phòng
                        </label>
                        <select 
                            id="room_type" 
                            name="room_type" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                        >
                            <option value="">Tất cả loại phòng</option>
                            <?php foreach($loaiPhongs as $loaiPhong): ?>
                                <option value="<?= htmlspecialchars($loaiPhong['ma_loai_phong'] ?? $loaiPhong->ma_loai_phong) ?>" 
                                        <?= $searchParams['room_type'] == ($loaiPhong['ma_loai_phong'] ?? $loaiPhong->ma_loai_phong) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($loaiPhong['ten'] ?? $loaiPhong->ten) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <!-- Search Button -->
                    <div class="flex items-end">
                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-cyan-600 to-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:from-cyan-700 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105"
                        >
                            <i class="fas fa-search mr-2"></i>Tìm kiếm
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Search Results Info -->
        <?php if (!empty($searchParams['checkin']) && !empty($searchParams['checkout'])): ?>
        <div class="mb-6 p-4 bg-cyan-50 border border-cyan-200 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-info-circle text-cyan-600 mr-3"></i>
                <span class="text-cyan-800">
                    Kết quả tìm kiếm cho ngày 
                    <strong><?= date('d/m/Y', strtotime($searchParams['checkin'])) ?></strong> - 
                    <strong><?= date('d/m/Y', strtotime($searchParams['checkout'])) ?></strong>
                    (<?= count($phongs) ?> phòng có sẵn)
                </span>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Rooms Grid Section -->
<section class="py-12 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if (empty($phongs)): ?>
        <!-- No Results -->
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <i class="fas fa-bed text-6xl text-gray-300 mb-6"></i>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Không tìm thấy phòng nào</h3>
                <p class="text-gray-600 mb-8">
                    Vui lòng thử thay đổi tiêu chí tìm kiếm hoặc chọn ngày khác.
                </p>
                <a href="/phong" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-cyan-600 to-emerald-600 text-white rounded-lg font-medium hover:from-cyan-700 hover:to-emerald-700 transition-all duration-300">
                    <i class="fas fa-refresh mr-2"></i>
                    Xem tất cả phòng
                </a>
            </div>
        </div>
        <?php else: ?>
        
        <!-- Rooms Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach($phongs as $phong): 
                // Handle both array and object data
                $maPhong = $phong['ma_phong'] ?? $phong->ma_phong ?? '';
                $tenPhong = $phong['ten_phong'] ?? $phong->ten_phong ?? 'Phòng ' . $maPhong;
                $moTa = $phong['mo_ta'] ?? $phong->mo_ta ?? 'Phòng nghỉ cao cấp với đầy đủ tiện nghi hiện đại';
                $gia = $phong['gia'] ?? $phong->gia ?? 0;
                $loaiPhong = $phong['loai_phong'] ?? $phong->loai_phong ?? 'Standard';
                
                // Default room image based on room type
                $defaultImages = [
                    'Deluxe' => 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'Suite' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'Standard' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'Presidential' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                ];
                $roomImage = $defaultImages[$loaiPhong] ?? $defaultImages['Standard'];
            ?>
            
            <div class="room-card rounded-2xl overflow-hidden shadow-lg">
                <!-- Room Image -->
                <div class="relative h-64 overflow-hidden">
                    <img 
                        src="<?= $roomImage ?>" 
                        alt="<?= htmlspecialchars($tenPhong) ?>"
                        class="room-image w-full h-full object-cover"
                    >
                    <div class="absolute top-4 left-4">
                        <span class="available-badge text-white px-3 py-1 rounded-full text-sm font-medium">
                            <i class="fas fa-check mr-1"></i>Có sẵn
                        </span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="price-badge text-white px-3 py-1 rounded-full text-sm font-medium">
                            <?= number_format($gia, 0, ',', '.') ?>đ/đêm
                        </span>
                    </div>
                </div>
                
                <!-- Room Content -->
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xl font-bold text-gray-900"><?= htmlspecialchars($tenPhong) ?></h3>
                        <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                            <?= htmlspecialchars($loaiPhong) ?>
                        </span>
                    </div>
                    
                    <p class="text-gray-600 mb-4 line-clamp-2">
                        <?= htmlspecialchars($moTa) ?>
                    </p>
                    
                    <!-- Room Features -->
                    <div class="flex items-center space-x-4 mb-6 text-sm text-gray-500">
                        <span class="flex items-center">
                            <i class="fas fa-wifi mr-1 text-cyan-600"></i>WiFi miễn phí
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-snowflake mr-1 text-cyan-600"></i>Điều hòa
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-tv mr-1 text-cyan-600"></i>TV
                        </span>
                    </div>
                    
                    <!-- Price and Action -->
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-2xl font-bold text-gray-900">
                                <?= number_format($gia, 0, ',', '.') ?>đ
                            </span>
                            <span class="text-gray-500">/đêm</span>
                        </div>
                        <div class="space-x-2">
                            <a 
                                href="/phong/<?= urlencode($maPhong) ?>" 
                                class="inline-flex items-center px-4 py-2 bg-white border border-cyan-600 text-cyan-600 rounded-lg font-medium hover:bg-cyan-50 transition-all duration-300"
                            >
                                <i class="fas fa-eye mr-2"></i>Chi tiết
                            </a>
                            <button 
                                onclick="bookRoom('<?= htmlspecialchars($maPhong) ?>')"
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-600 to-emerald-600 text-white rounded-lg font-medium hover:from-cyan-700 hover:to-emerald-700 transition-all duration-300"
                            >
                                <i class="fas fa-calendar-plus mr-2"></i>Đặt phòng
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php endforeach; ?>
        </div>
        
        <?php endif; ?>
    </div>
</section>

<script>
// Initialize date inputs with today and tomorrow as default
document.addEventListener('DOMContentLoaded', function() {
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    
    // Set min dates
    const today = new Date().toISOString().split('T')[0];
    const tomorrow = new Date(Date.now() + 86400000).toISOString().split('T')[0];
    
    checkinInput.min = today;
    checkoutInput.min = tomorrow;
    
    // Set default dates if empty
    if (!checkinInput.value) {
        checkinInput.value = today;
    }
    if (!checkoutInput.value) {
        checkoutInput.value = tomorrow;
    }
    
    // Update checkout min date when checkin changes
    checkinInput.addEventListener('change', function() {
        const checkinDate = new Date(this.value);
        const minCheckout = new Date(checkinDate.getTime() + 86400000).toISOString().split('T')[0];
        checkoutInput.min = minCheckout;
        
        if (checkoutInput.value <= this.value) {
            checkoutInput.value = minCheckout;
        }
    });
});

// Book room function
function bookRoom(roomId) {
    const checkin = document.getElementById('checkin').value;
    const checkout = document.getElementById('checkout').value;
    const guests = document.getElementById('guests').value;
    
    if (!checkin || !checkout) {
        alert('Vui lòng chọn ngày nhận và trả phòng!');
        return;
    }
    
    // Redirect to booking page with parameters
    const params = new URLSearchParams({
        room_id: roomId,
        checkin: checkin,
        checkout: checkout,
        guests: guests
    });
    
    window.location.href = `/dat-phong?${params.toString()}`;
}

// Add some animation effects
document.addEventListener('DOMContentLoaded', function() {
    // Animate cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe all room cards
    document.querySelectorAll('.room-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>