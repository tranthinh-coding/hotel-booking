<?php
$title = 'Đặt phòng - Ocean Pearl Hotel';
ob_start();
?>

<!-- Hero Section -->
<div class="relative h-80 bg-gradient-to-r from-ocean-600 via-ocean-700 to-teal-600 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"grain\" width=\"100\" height=\"100\" patternUnits=\"userSpaceOnUse\"><circle cx=\"25\" cy=\"25\" r=\"1\" fill=\"white\" opacity=\"0.5\" /><circle cx=\"75\" cy=\"75\" r=\"1\" fill=\"white\" opacity=\"0.3\" /><circle cx=\"50\" cy=\"10\" r=\"0.5\" fill=\"white\" opacity=\"0.4\" /></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23grain)\" /></svg>');">
        </div>
    </div>

    <div class="relative h-full flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="fade-in-up text-center">
                <!-- Breadcrumb -->
                <nav class="flex items-center justify-center space-x-2 text-ocean-100 mb-6">
                    <a href="/" class="hover:text-white transition-colors">Trang chủ</a>
                    <i class="fas fa-chevron-right text-xs"></i>
                    <span class="text-white">Đặt phòng</span>
                </nav>

                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 text-shadow">
                    Đặt phòng
                </h1>
                <p class="text-xl text-ocean-100 max-w-2xl mx-auto">
                    Đặt phòng tại Ocean Pearl Hotel để có những trải nghiệm tuyệt vời
                </p>
            </div>
        </div>
    </div>

    <!-- Wave decoration -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1200 120" class="w-full h-12 fill-current text-white">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
        </svg>
    </div>
</div>

<div class="bg-gray-50 min-h-screen -mt-1">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Success/Error Messages -->
        <?php if (flash_get('success')): ?>
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                <div class="flex">
                    <i class="fas fa-check-circle text-green-400 mr-3 mt-1"></i>
                    <div><?= flash_get('success') ?></div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (flash_get('error')): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                <div class="flex">
                    <i class="fas fa-exclamation-circle text-red-400 mr-3 mt-1"></i>
                    <div><?= flash_get('error') ?></div>
                </div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Booking Form -->
            <div class="lg:col-span-2">
                <div class="bg-gradient-to-br from-gray-50 via-white to-blue-50/30 rounded-xl shadow-lg border border-gray-100/50 p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Thông tin đặt phòng</h2>
                
                <form action="/dat-phong" method="POST" class="space-y-6">
                    <!-- Room Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="ma_phong" class="block text-sm font-semibold text-gray-700 mb-2">
                                Chọn phòng *
                            </label>
                            <select id="ma_phong" name="ma_phong" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Chọn phòng --</option>
                                <?php if (isset($phong) && $phong): ?>
                                    <option value="<?= $phong->ma_phong ?>" selected>
                                        <?= safe_htmlspecialchars($phong->ten_phong) ?> - <?= number_format($phong->gia) ?>đ/đêm
                                    </option>
                                <?php else: ?>
                                    <?php foreach ($loaiPhongs as $loaiPhong): ?>
                                        <optgroup label="<?= safe_htmlspecialchars($loaiPhong->ten_loai) ?>">
                                            <?php 
                                            $phongs = Phong::getByLoaiPhong($loaiPhong->ma_loai_phong);
                                            foreach ($phongs as $p): 
                                            ?>
                                                <option value="<?= $p->ma_phong ?>" <?= old('ma_phong') == $p->ma_phong ? 'selected' : '' ?>>
                                                    <?= safe_htmlspecialchars($p->ten_phong) ?> - <?= number_format($p->gia) ?>đ/đêm
                                                </option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div>
                            <label for="so_khach" class="block text-sm font-semibold text-gray-700 mb-2">
                                Số khách
                            </label>
                            <select id="so_khach" name="so_khach"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <?php for ($i = 1; $i <= 8; $i++): ?>
                                    <option value="<?= $i ?>" <?= old('so_khach', 2) == $i ? 'selected' : '' ?>>
                                        <?= $i ?> khách
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Date Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="check_in" class="block text-sm font-semibold text-gray-700 mb-2">
                                Ngày nhận phòng *
                            </label>
                            <input type="date" id="check_in" name="check_in" required
                                   min="<?= date('Y-m-d') ?>"
                                   value="<?= old('check_in') ?>"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="check_out" class="block text-sm font-semibold text-gray-700 mb-2">
                                Ngày trả phòng *
                            </label>
                            <input type="date" id="check_out" name="check_out" required
                                   min="<?= date('Y-m-d', strtotime('+1 day')) ?>"
                                   value="<?= old('check_out') ?>"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Special Requests -->
                    <div>
                        <label for="ghi_chu" class="block text-sm font-semibold text-gray-700 mb-2">
                            Ghi chú đặc biệt
                        </label>
                        <textarea id="ghi_chu" name="ghi_chu" rows="4"
                                  placeholder="Yêu cầu đặc biệt của bạn..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"><?= old('ghi_chu') ?></textarea>
                    </div>

                    <!-- Price Preview -->
                    <div id="price-preview" class="bg-gray-50 p-6 rounded-lg hidden">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tóm tắt đặt phòng</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span>Phòng:</span>
                                <span id="room-name"></span>
                            </div>
                            <div class="flex justify-between">
                                <span>Số đêm:</span>
                                <span id="nights-count">0</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Giá/đêm:</span>
                                <span id="room-price">0đ</span>
                            </div>
                            <hr class="my-2">
                            <div class="flex justify-between font-bold text-lg">
                                <span>Tổng cộng:</span>
                                <span id="total-price" class="text-blue-600">0đ</span>
                            </div>
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <h4 class="font-semibold text-gray-900 mb-3">Điều khoản đặt phòng</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Thời gian nhận phòng: 14:00 - 22:00</li>
                            <li>• Thời gian trả phòng: 06:00 - 12:00</li>
                            <li>• Hủy miễn phí trước 24h</li>
                            <li>• Thanh toán tại khách sạn</li>
                        </ul>
                        <div class="mt-4">
                            <label class="flex items-center">
                                <input type="checkbox" required class="mr-2">
                                <span class="text-sm">Tôi đồng ý với <a href="#" class="text-blue-600 underline">điều khoản và điều kiện</a></span>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="submit" 
                                class="flex-1 btn-ocean text-white py-4 px-8 rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-calendar-check mr-2"></i>
                            Đặt phòng ngay
                        </button>
                        <a href="/phong" 
                           class="flex-1 bg-gray-200 text-gray-700 py-4 px-8 rounded-lg font-semibold hover:bg-gray-300 transition-colors text-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="space-y-8">
                <!-- Selected Room Info -->
                <?php if (isset($phong)): ?>
                    <div class="bg-gradient-to-br from-ocean-50 via-white to-teal-50/30 rounded-xl shadow-lg border border-ocean-100/50 p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Phòng đã chọn</h3>
                        <div class="text-center">
                            <?php if (!empty($phong->hinh_anh)): ?>
                                <img src="<?= safe_htmlspecialchars($phong->hinh_anh) ?>" 
                                     alt="<?= safe_htmlspecialchars($phong->ten_phong) ?>"
                                     class="w-full h-32 object-cover rounded-lg mb-4">
                            <?php endif; ?>
                            <h4 class="font-semibold text-gray-900"><?= safe_htmlspecialchars($phong->ten_phong) ?></h4>
                            <p class="text-gray-600 mt-2"><?= safe_htmlspecialchars($phong->loaiPhong->ten_loai_phong ?? '') ?></p>
                            <p class="text-ocean-600 font-bold mt-2">
                                <?= number_format($phong->loaiPhong->gia_tien ?? 0) ?>đ/đêm
                            </p>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Booking Guidelines -->
                <div class="bg-gradient-to-br from-blue-50 via-white to-indigo-50/30 rounded-xl shadow-lg border border-blue-100/50 p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Hướng dẫn đặt phòng</h3>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                            <span>Nhận phòng từ 14:00, trả phòng trước 12:00</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                            <span>Miễn phí hủy đặt phòng trước 24h</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                            <span>Thanh toán khi nhận phòng</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                            <span>Bao gồm wifi miễn phí và bữa sáng</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Support -->
                <div class="bg-gradient-to-br from-ocean-600 to-teal-600 rounded-xl p-6 text-white text-center">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Cần hỗ trợ?</h3>
                    <p class="text-ocean-100 mb-4 text-sm">
                        Liên hệ với chúng tôi để được tư vấn và hỗ trợ đặt phòng
                    </p>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center justify-center">
                            <i class="fas fa-phone mr-2"></i>
                            <span>(84) 258 123 456</span>
                        </div>
                        <div class="flex items-center justify-center">
                            <i class="fas fa-envelope mr-2"></i>
                            <span>booking@oceanpearl.com</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const roomSelect = document.getElementById('ma_phong');
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    const pricePreview = document.getElementById('price-preview');
    
    function updatePricePreview() {
        const selectedRoom = roomSelect.selectedOptions[0];
        const checkIn = new Date(checkInInput.value);
        const checkOut = new Date(checkOutInput.value);
        
        if (selectedRoom && selectedRoom.value && checkInInput.value && checkOutInput.value && checkOut > checkIn) {
            const roomText = selectedRoom.textContent;
            const roomPrice = roomText.match(/(\d{1,3}(?:,\d{3})*)/)[1].replace(/,/g, '');
            const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
            const total = parseInt(roomPrice) * nights;
            
            document.getElementById('room-name').textContent = roomText.split(' - ')[0];
            document.getElementById('nights-count').textContent = nights + ' đêm';
            document.getElementById('room-price').textContent = parseInt(roomPrice).toLocaleString() + 'đ';
            document.getElementById('total-price').textContent = total.toLocaleString() + 'đ';
            
            pricePreview.classList.remove('hidden');
        } else {
            pricePreview.classList.add('hidden');
        }
    }
    
    roomSelect.addEventListener('change', updatePricePreview);
    checkInInput.addEventListener('change', updatePricePreview);
    checkOutInput.addEventListener('change', updatePricePreview);
    
    // Set minimum check-out date when check-in changes
    checkInInput.addEventListener('change', function() {
        const checkInDate = new Date(this.value);
        const nextDay = new Date(checkInDate);
        nextDay.setDate(nextDay.getDate() + 1);
        checkOutInput.min = nextDay.toISOString().split('T')[0];
        
        if (checkOutInput.value && new Date(checkOutInput.value) <= checkInDate) {
            checkOutInput.value = nextDay.toISOString().split('T')[0];
        }
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
