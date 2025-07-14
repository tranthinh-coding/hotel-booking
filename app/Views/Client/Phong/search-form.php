<?php
$title = 'Tìm kiếm phòng - Ocean Pearl Hotel';
ob_start();
?>

<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Tìm kiếm phòng nghỉ</h1>
        <p class="text-xl text-gray-600">Tìm kiếm và đặt phòng nghỉ tuyệt vời cho kỳ nghỉ của bạn</p>
    </div>

    <!-- Search Form -->
    <div class="bg-white rounded-2xl soft-shadow p-8 mb-8">
        <form method="POST" action="/search-rooms" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Check-in Date -->
                <div>
                    <label for="checkin" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-calendar-alt mr-2 text-ocean-500"></i>Ngày nhận phòng
                    </label>
                    <input type="date" 
                           id="checkin" 
                           name="checkin" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition-colors"
                           required
                           min="<?= date('Y-m-d') ?>">
                </div>

                <!-- Check-out Date -->
                <div>
                    <label for="checkout" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-calendar-check mr-2 text-ocean-500"></i>Ngày trả phòng
                    </label>
                    <input type="date" 
                           id="checkout" 
                           name="checkout" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition-colors"
                           required
                           min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                </div>

                <!-- Number of Guests -->
                <div>
                    <label for="guests" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-users mr-2 text-ocean-500"></i>Số khách
                    </label>
                    <select id="guests" 
                            name="guests" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition-colors">
                        <option value="1">1 khách</option>
                        <option value="2" selected>2 khách</option>
                        <option value="3">3 khách</option>
                        <option value="4">4 khách</option>
                        <option value="5">5+ khách</option>
                    </select>
                </div>

                <!-- Room Type -->
                <div>
                    <label for="room_type" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-bed mr-2 text-ocean-500"></i>Loại phòng
                    </label>
                    <select id="room_type" 
                            name="room_type" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition-colors">
                        <option value="">Tất cả loại phòng</option>
                        <?php if (!empty($loaiPhongs)): ?>
                            <?php foreach ($loaiPhongs as $loaiPhong): ?>
                                <option value="<?= htmlspecialchars($loaiPhong->ma_loai_phong) ?>">
                                    <?= htmlspecialchars($loaiPhong->ten) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <!-- Search Button -->
            <div class="text-center pt-4">
                <button type="submit" 
                        class="btn-ocean text-white px-8 py-4 rounded-xl text-lg font-medium gentle-hover inline-flex items-center">
                    <i class="fas fa-search mr-3"></i>
                    Tìm kiếm phòng trống
                </button>
            </div>
        </form>
    </div>

    <!-- Popular Room Types -->
    <?php if (!empty($loaiPhongs)): ?>
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Các loại phòng phổ biến</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach (array_slice($loaiPhongs, 0, 3) as $loaiPhong): ?>
                    <div class="bg-white rounded-xl soft-shadow p-6 text-center card-hover">
                        <div class="w-16 h-16 bg-gradient-to-br from-ocean-400 to-ocean-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-bed text-white text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2"><?= htmlspecialchars($loaiPhong->ten) ?></h3>
                        <p class="text-gray-600 mb-4"><?= htmlspecialchars($loaiPhong->mo_ta ?? 'Phòng thoải mái với đầy đủ tiện nghi') ?></p>
                        <button onclick="selectRoomType('<?= htmlspecialchars($loaiPhong->ma_loai_phong) ?>')" 
                                class="text-ocean-600 hover:text-ocean-800 font-medium gentle-hover">
                            Chọn loại phòng này
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Quick Search Tips -->
    <div class="bg-gradient-to-r from-ocean-50 to-ocean-100 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-ocean-800 mb-4">
            <i class="fas fa-lightbulb mr-2"></i>Mẹo tìm kiếm
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-ocean-700">
            <div class="flex items-start">
                <i class="fas fa-check-circle text-ocean-500 mr-2 mt-1"></i>
                <span>Đặt phòng trước ít nhất 3 ngày để có giá tốt nhất</span>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-ocean-500 mr-2 mt-1"></i>
                <span>Kiểm tra chính sách hủy phòng trước khi đặt</span>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-ocean-500 mr-2 mt-1"></i>
                <span>Liên hệ với chúng tôi để được hỗ trợ đặt phòng</span>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check-circle text-ocean-500 mr-2 mt-1"></i>
                <span>Đăng ký thành viên để nhận ưu đãi đặc biệt</span>
            </div>
        </div>
    </div>
</div>

<script>
function selectRoomType(roomTypeId) {
    document.getElementById('room_type').value = roomTypeId;
    document.getElementById('room_type').focus();
}

// Set minimum checkout date based on checkin date
document.getElementById('checkin').addEventListener('change', function() {
    const checkinDate = new Date(this.value);
    const checkoutDate = new Date(checkinDate);
    checkoutDate.setDate(checkoutDate.getDate() + 1);
    
    const checkoutInput = document.getElementById('checkout');
    checkoutInput.min = checkoutDate.toISOString().split('T')[0];
    
    if (checkoutInput.value && new Date(checkoutInput.value) <= checkinDate) {
        checkoutInput.value = checkoutDate.toISOString().split('T')[0];
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
