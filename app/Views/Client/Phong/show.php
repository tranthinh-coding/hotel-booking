<?php
$title = 'Chi tiết phòng - Ocean Pearl Hotel';
ob_start();
?>

<!-- Hero Section -->
<div class="relative h-80 bg-gradient-to-r from-blue-400 via-blue-500 to-cyan-500 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"waves\" width=\"100\" height=\"100\" patternUnits=\"userSpaceOnUse\"><path d=\"M0,50 Q25,30 50,50 T100,50 V100 H0 Z\" fill=\"rgba(255,255,255,0.1)\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23waves)\"/></svg>');">
        </div>
    </div>
    
    <div class="relative h-full flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="fade-in-up">
                <!-- Breadcrumb -->
                <nav class="flex items-center space-x-2 text-blue-100 mb-6">
                    <a href="/" class="hover:text-white transition-colors">
                        <i class="fas fa-home mr-1"></i>Trang chủ
                    </a>
                    <i class="fas fa-chevron-right text-xs"></i>
                    <a href="/phong" class="hover:text-white transition-colors">Phòng</a>
                    <i class="fas fa-chevron-right text-xs"></i>
                    <span class="text-white font-medium"><?= htmlspecialchars($phong->ten_phong ?? 'Chi tiết phòng') ?></span>
                </nav>

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 text-shadow">
                    <?= htmlspecialchars($phong->ten_phong ?? '') ?>
                </h1>
                <div class="flex items-center space-x-4 text-blue-100">
                    <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium">
                        <?= htmlspecialchars($phong->loai_phong_ten ?? 'Loại phòng') ?>
                    </span>
                    <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium">
                        <?= number_format($phong->gia ?? 0) ?>₫/giờ
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Wave decoration -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1200 120" class="w-full h-12 fill-current text-white">
            <path d="M0,60 C150,120 300,0 450,60 C600,120 750,0 900,60 C1050,120 1200,0 1200,60 V120 H0 V60Z"></path>
        </svg>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-gray-50 -mt-1">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Room Images -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="relative">
                        <img src="<?= htmlspecialchars($phong->hinh_anh ?? '/assets/images/default-room.jpg') ?>" 
                             alt="<?= htmlspecialchars($phong->ten_phong ?? '') ?>"
                             class="w-full h-96 object-cover">
                        <div class="absolute top-6 left-6">
                            <span class="px-4 py-2 bg-green-500 text-white text-sm font-semibold rounded-full shadow-lg">
                                <?= htmlspecialchars($phong->trang_thai ?? 'available') === 'available' ? 'Còn trống' : 'Đã đặt' ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Room Details -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Thông tin phòng</h2>

                    <!-- Room Info Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                        <div class="text-center p-4 bg-blue-50 rounded-xl">
                            <i class="fas fa-bed text-2xl text-blue-600 mb-2"></i>
                            <div class="text-sm text-gray-600">Loại phòng</div>
                            <div class="font-semibold text-gray-800"><?= htmlspecialchars($phong->loai_phong_ten ?? 'Standard') ?></div>
                        </div>

                        <div class="text-center p-4 bg-cyan-50 rounded-xl">
                            <i class="fas fa-users text-2xl text-cyan-600 mb-2"></i>
                            <div class="text-sm text-gray-600">Sức chứa</div>
                            <div class="font-semibold text-gray-800"><?= $phong->suc_chua ?? 2 ?> người</div>
                        </div>

                        <div class="text-center p-4 bg-green-50 rounded-xl">
                            <i class="fas fa-ruler-combined text-2xl text-green-600 mb-2"></i>
                            <div class="text-sm text-gray-600">Diện tích</div>
                            <div class="font-semibold text-gray-800"><?= $phong->dien_tich ?? 25 ?>m²</div>
                        </div>

                        <div class="text-center p-4 bg-yellow-50 rounded-xl">
                            <i class="fas fa-clock text-2xl text-yellow-600 mb-2"></i>
                            <div class="text-sm text-gray-600">Giá/giờ</div>
                            <div class="font-semibold text-gray-800"><?= number_format($phong->gia ?? 0) ?>₫</div>
                        </div>
                    </div>
                        <div class="font-semibold text-gray-800"><?= htmlspecialchars($phong->loai_phong ?? 'Standard') ?></div>
                    </div>
                    <div class="text-center p-4 bg-seafoam-50 rounded-xl">
                        <i class="fas fa-users text-2xl text-seafoam-600 mb-2"></i>
                        <div class="text-sm text-gray-600">Sức chứa</div>
                        <div class="font-semibold text-gray-800"><?= $phong->suc_chua ?? 2 ?> người</div>
                    </div>
                    <div class="text-center p-4 bg-blue-50 rounded-xl">
                        <i class="fas fa-expand-arrows-alt text-2xl text-blue-600 mb-2"></i>
                        <div class="text-sm text-gray-600">Diện tích</div>
                        <div class="font-semibold text-gray-800"><?= $phong->dien_tich ?? 25 ?>m²</div>
                    </div>
                    <div class="text-center p-4 bg-green-50 rounded-xl">
                        <i class="fas fa-eye text-2xl text-green-600 mb-2"></i>
                        <div class="text-sm text-gray-600">View</div>
                        <div class="font-semibold text-gray-800"><?= htmlspecialchars($phong->view_phong ?? 'City') ?></div>
                    </div>
                </div>

                    <!-- Description -->
                    <?php if (!empty($phong->mo_ta)): ?>
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Mô tả phòng</h3>
                            <p class="text-gray-600 leading-relaxed">
                                <?= nl2br(htmlspecialchars($phong->mo_ta)) ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <!-- Amenities -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Tiện nghi phòng</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-wifi text-blue-600 mr-3"></i>
                                WiFi miễn phí
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-snowflake text-blue-600 mr-3"></i>
                                Điều hòa
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-tv text-blue-600 mr-3"></i>
                                Smart TV
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-bath text-blue-600 mr-3"></i>
                                Phòng tắm riêng
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-coffee text-blue-600 mr-3"></i>
                                Minibar
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-phone text-blue-600 mr-3"></i>
                                Điện thoại
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-shield-alt text-ocean-600 mr-3"></i>
                            Két an toàn
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Sidebar -->
        <div class="space-y-6">
            <!-- Booking Form -->
            <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Đặt phòng ngay</h3>
                
                <form action="/dat-phong" method="POST" class="space-y-4">
                    <input type="hidden" name="phong_id" value="<?= $phong->id ?? '' ?>">
                    
                    <div>
                        <label for="ngay_nhan_phong" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar-plus mr-1"></i> Ngày nhận phòng
                        </label>
                        <input type="date" 
                               id="ngay_nhan_phong" 
                               name="ngay_nhan_phong" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent"
                               required
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="space-y-8">
                    <!-- Booking Form -->
                    <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-calendar-check text-blue-600 mr-2"></i>
                            Đặt phòng
                        </h3>

                        <form action="/dat-phong" method="GET" class="space-y-6">
                            <input type="hidden" name="room_id" value="<?= $phong->ma_phong ?? '' ?>">

                            <div>
                                <label for="ngay_nhan_phong" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar-plus mr-1"></i> Thời gian nhận phòng
                                </label>
                                <input type="datetime-local" 
                                       id="ngay_nhan_phong" 
                                       name="ngay_nhan_phong" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       required
                                       min="<?= date('Y-m-d\TH:i') ?>">
                            </div>

                            <div>
                                <label for="ngay_tra_phong" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar-minus mr-1"></i> Thời gian trả phòng
                                </label>
                                <input type="datetime-local" 
                                       id="ngay_tra_phong" 
                                       name="ngay_tra_phong" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       required>
                            </div>

                            <div>
                                <label for="so_nguoi" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-users mr-1"></i> Số người
                                </label>
                                <select id="so_nguoi" 
                                        name="so_nguoi" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required>
                                    <?php for ($i = 1; $i <= ($phong->suc_chua ?? 4); $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?> người</option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <!-- Price Display -->
                            <div class="bg-blue-50 rounded-xl p-4">
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700">Giá phòng/giờ:</span>
                                        <span class="font-bold text-blue-600"><?= number_format($phong->gia ?? 0) ?>₫</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm text-gray-600">
                                        <span>Thời gian thuê:</span>
                                        <span id="rental-hours">-</span>
                                    </div>
                                    <div class="flex justify-between items-center text-lg font-bold border-t pt-2">
                                        <span class="text-gray-800">Tổng tiền:</span>
                                        <span class="text-blue-600" id="total-price">0₫</span>
                                    </div>
                                </div>
                            </div>

                            <?php if (auth_check()): ?>
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white py-4 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg">
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    Đặt phòng ngay
                                </button>
                            <?php else: ?>
                                <a href="/login" 
                                   class="block w-full bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white py-4 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg text-center">
                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                    Đăng nhập để đặt phòng
                                </a>
                            <?php endif; ?>
                        </form>
                    </div>

                    <!-- Contact Info -->
                    <div class="bg-white rounded-2xl shadow-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-phone text-blue-600 mr-2"></i>
                            Cần hỗ trợ?
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-phone-alt text-blue-500 mr-3"></i>
                                <span>Hotline: +84 123 456 789</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-envelope text-blue-500 mr-3"></i>
                                <span>booking@oceanpearl.com</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-clock text-blue-500 mr-3"></i>
                                <span>Hỗ trợ 24/7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkinInput = document.getElementById('ngay_nhan_phong');
    const checkoutInput = document.getElementById('ngay_tra_phong');
    const hourlyRate = <?= $phong->gia ?? 0 ?>;
    
    function updatePrice() {
        const checkin = new Date(checkinInput.value);
        const checkout = new Date(checkoutInput.value);
        
        if (checkinInput.value && checkoutInput.value && checkout > checkin) {
            const hours = Math.ceil((checkout - checkin) / (1000 * 60 * 60));
            const minHours = Math.max(hours, 2); // Minimum 2 hours
            
            document.getElementById('rental-hours').textContent = minHours + ' giờ';
            
            const total = minHours * hourlyRate;
            document.getElementById('total-price').textContent = 
                new Intl.NumberFormat('vi-VN').format(total) + '₫';
        } else {
            document.getElementById('rental-hours').textContent = '-';
            document.getElementById('total-price').textContent = '0₫';
        }
    }
    
    // Set minimum checkout time to 2 hours after checkin
    checkinInput.addEventListener('change', function() {
        if (this.value) {
            const minCheckout = new Date(this.value);
            minCheckout.setHours(minCheckout.getHours() + 2);
            const minCheckoutStr = new Date(minCheckout.getTime() - minCheckout.getTimezoneOffset() * 60000)
                                   .toISOString().slice(0, 16);
            checkoutInput.min = minCheckoutStr;
        }
        updatePrice();
    });
    
    checkoutInput.addEventListener('change', updatePrice);
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
