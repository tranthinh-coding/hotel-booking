<?php 
$title = 'Kết quả tìm kiếm phòng - Ocean Pearl Hotel';
ob_start();
?>

<div class="bg-gradient-to-br from-ocean-50 via-white to-ocean-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search Summary -->
        <div class="bg-white rounded-2xl soft-shadow p-8 mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Kết quả tìm kiếm phòng</h1>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm text-gray-600">
                <div class="flex items-center">
                    <i class="fas fa-calendar-check text-ocean-500 mr-2"></i>
                    <span>Nhận phòng: <strong><?= htmlspecialchars($checkin) ?></strong></span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-calendar-times text-ocean-500 mr-2"></i>
                    <span>Trả phòng: <strong><?= htmlspecialchars($checkout) ?></strong></span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-users text-ocean-500 mr-2"></i>
                    <span>Số khách: <strong><?= htmlspecialchars($guests) ?></strong></span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-bed text-ocean-500 mr-2"></i>
                    <span>Loại phòng: <strong><?= $room_type ? htmlspecialchars($room_type) : 'Tất cả' ?></strong></span>
                </div>
            </div>
        </div>

        <?php if (isEmpty($rooms)): ?>
            <!-- No Results -->
            <div class="bg-white rounded-2xl soft-shadow p-12 text-center">
                <div class="w-24 h-24 bg-ocean-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-search text-ocean-500 text-3xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Không tìm thấy phòng phù hợp</h2>
                <p class="text-gray-600 mb-8">Rất tiếc, không có phòng nào khả dụng cho các tiêu chí tìm kiếm của bạn. Hãy thử điều chỉnh ngày hoặc số khách.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/" class="btn-ocean px-8 py-3 rounded-xl text-white font-medium">
                        <i class="fas fa-search mr-2"></i>Tìm kiếm lại
                    </a>
                    <a href="/contact" class="border-2 border-ocean-500 text-ocean-500 px-8 py-3 rounded-xl font-medium hover:bg-ocean-500 hover:text-white transition-colors">
                        <i class="fas fa-phone mr-2"></i>Liên hệ hỗ trợ
                    </a>
                </div>
            </div>
        <?php else: ?>
            <!-- Results -->
            <div class="grid gap-8">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-900">
                        Tìm thấy <span class="text-ocean-600"><?= count($rooms) ?></span> phòng phù hợp
                    </h2>
                    <div class="flex items-center space-x-4">
                        <label class="text-sm text-gray-600">Sắp xếp theo:</label>
                        <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-ocean-500">
                            <option>Giá tăng dần</option>
                            <option>Giá giảm dần</option>
                            <option>Diện tích</option>
                            <option>Đánh giá</option>
                        </select>
                    </div>
                </div>

                <?php foreach ($rooms as $room): ?>
                    <div class="bg-white rounded-2xl soft-shadow overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
                            <!-- Room Image -->
                            <div class="lg:col-span-1">
                                <div class="relative h-64 lg:h-full">
                                    <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                                         alt="<?= htmlspecialchars($room->ten_phong) ?>" 
                                         class="w-full h-full object-cover">
                                    <div class="absolute top-4 left-4 bg-ocean-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                        Đang hoạt động
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Room Info -->
                            <div class="lg:col-span-2 p-8">
                                <div class="flex flex-col lg:flex-row lg:justify-between h-full">
                                    <div class="flex-1">
                                        <h3 class="text-2xl font-bold text-gray-900 mb-3">
                                            <?= htmlspecialchars($room->ten_phong) ?>
                                        </h3>
                                        <p class="text-gray-600 mb-6 line-clamp-3">
                                            <?= htmlspecialchars($room->mo_ta) ?>
                                        </p>
                                        
                                        <!-- Room Features -->
                                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                                            <div class="flex items-center text-sm text-gray-700">
                                                <i class="fas fa-bed text-ocean-500 w-5 mr-3"></i>
                                                <span>King bed</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-700">
                                                <i class="fas fa-users text-ocean-500 w-5 mr-3"></i>
                                                <span>Tối đa <?= $room->so_khach_toi_da ?? 2 ?> khách</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-700">
                                                <i class="fas fa-expand text-ocean-500 w-5 mr-3"></i>
                                                <span>45m² diện tích</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-700">
                                                <i class="fas fa-wifi text-ocean-500 w-5 mr-3"></i>
                                                <span>WiFi miễn phí</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-700">
                                                <i class="fas fa-tv text-ocean-500 w-5 mr-3"></i>
                                                <span>Smart TV</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-700">
                                                <i class="fas fa-snowflake text-ocean-500 w-5 mr-3"></i>
                                                <span>Điều hòa</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Rating -->
                                        <div class="flex items-center mb-4">
                                            <div class="flex text-yellow-400 mr-2">
                                                <i class="fas fa-star text-sm"></i>
                                                <i class="fas fa-star text-sm"></i>
                                                <i class="fas fa-star text-sm"></i>
                                                <i class="fas fa-star text-sm"></i>
                                                <i class="fas fa-star text-sm"></i>
                                            </div>
                                            <span class="text-sm text-gray-600">(4.8/5 - 124 đánh giá)</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Pricing & Booking -->
                                    <div class="lg:ml-8 flex flex-col justify-between lg:text-right">
                                        <div class="mb-6">
                                            <div class="text-3xl font-bold text-ocean-600 mb-1">
                                                <?= number_format($room->gia) ?>đ
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                /đêm (chưa bao gồm thuế)
                                            </div>
                                            <div class="text-sm text-green-600 font-medium mt-1">
                                                Miễn phí hủy trong 24h
                                            </div>
                                        </div>
                                        
                                        <div class="space-y-3">
                                            <button class="w-full btn-ocean px-6 py-3 rounded-xl text-white font-medium hover:scale-105 transform transition-all duration-300">
                                                <i class="fas fa-calendar-check mr-2"></i>
                                                Đặt ngay
                                            </button>
                                            <button class="w-full border-2 border-ocean-500 text-ocean-500 px-6 py-3 rounded-xl font-medium hover:bg-ocean-500 hover:text-white transition-colors">
                                                <i class="fas fa-eye mr-2"></i>
                                                Xem chi tiết
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                <nav class="flex items-center space-x-2">
                    <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="px-4 py-2 bg-ocean-500 text-white rounded-lg">1</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">2</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">3</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </nav>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
// Auto-update checkout date when checkin changes
document.addEventListener('DOMContentLoaded', function() {
    const checkinInput = document.querySelector('input[name="checkin"]');
    const checkoutInput = document.querySelector('input[name="checkout"]');
    
    if (checkinInput && checkoutInput) {
        checkinInput.addEventListener('change', function() {
            const checkinDate = new Date(this.value);
            const checkoutDate = new Date(checkinDate);
            checkoutDate.setDate(checkoutDate.getDate() + 1);
            
            const minCheckout = checkoutDate.toISOString().split('T')[0];
            checkoutInput.setAttribute('min', minCheckout);
            
            if (new Date(checkoutInput.value) <= checkinDate) {
                checkoutInput.value = minCheckout;
            }
        });
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
