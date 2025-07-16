<?php
$title = 'Chi tiết phòng - Hotel Ocean';
ob_start();
?>

<div class="max-w-6xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="/" class="hover:text-ocean-600">Trang chủ</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="/phong" class="hover:text-ocean-600">Phòng</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-medium"><?= htmlspecialchars($phong->ten_phong ?? 'Chi tiết phòng') ?></li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Room Images -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="<?= htmlspecialchars($phong->hinh_anh ?? '/assets/images/default-room.jpg') ?>" 
                         alt="<?= htmlspecialchars($phong->ten_phong ?? '') ?>"
                         class="w-full h-96 object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-ocean-600 text-white text-sm font-semibold rounded-full">
                            <?= htmlspecialchars($phong->trang_thai ?? 'available') === 'available' ? 'Còn trống' : 'Đã đặt' ?>
                        </span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-white text-ocean-600 text-sm font-semibold rounded-full shadow-lg">
                            <?= number_format($phong->gia_phong ?? 0) ?>đ/đêm
                        </span>
                    </div>
                </div>
            </div>

            <!-- Room Details -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">
                    <?= htmlspecialchars($phong->ten_phong ?? '') ?>
                </h1>

                <!-- Room Info Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                    <div class="text-center p-4 bg-ocean-50 rounded-xl">
                        <i class="fas fa-bed text-2xl text-ocean-600 mb-2"></i>
                        <div class="text-sm text-gray-600">Loại phòng</div>
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
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Mô tả phòng</h3>
                    <p class="text-gray-600 leading-relaxed">
                        <?= nl2br(htmlspecialchars($phong->mo_ta ?? 'Phòng được thiết kế hiện đại với đầy đủ tiện nghi và tầm nhìn tuyệt đẹp ra biển. Không gian thoáng mát, sang trọng mang lại trải nghiệm nghỉ dưỡng hoàn hảo.')) ?>
                    </p>
                </div>

                <!-- Amenities -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Tiện nghi phòng</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-wifi text-ocean-600 mr-3"></i>
                            WiFi miễn phí
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-snowflake text-ocean-600 mr-3"></i>
                            Điều hòa
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-tv text-ocean-600 mr-3"></i>
                            Smart TV
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-bath text-ocean-600 mr-3"></i>
                            Phòng tắm riêng
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-coffee text-ocean-600 mr-3"></i>
                            Minibar
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
                               min="<?= date('Y-m-d') ?>">
                    </div>

                    <div>
                        <label for="ngay_tra_phong" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar-minus mr-1"></i> Ngày trả phòng
                        </label>
                        <input type="date" 
                               id="ngay_tra_phong" 
                               name="ngay_tra_phong" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent"
                               required
                               min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                    </div>

                    <div>
                        <label for="so_nguoi" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-users mr-1"></i> Số người
                        </label>
                        <select id="so_nguoi" 
                                name="so_nguoi" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent"
                                required>
                            <?php for ($i = 1; $i <= ($phong->suc_chua ?? 4); $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?> người</option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <!-- Price Display -->
                    <div class="bg-gray-50 rounded-xl p-4">
                        <div class="flex justify-between items-center text-lg font-semibold">
                            <span class="text-gray-700">Giá phòng/đêm:</span>
                            <span class="text-ocean-600"><?= number_format($phong->gia_phong ?? 0) ?>đ</span>
                        </div>
                    </div>

                    <?php if (auth_check()): ?>
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-ocean-600 to-seafoam-600 hover:from-ocean-700 hover:to-seafoam-700 text-white py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg">
                            <i class="fas fa-calendar-check mr-2"></i>
                            Đặt phòng ngay
                        </button>
                    <?php else: ?>
                        <a href="/login" 
                           class="block w-full bg-gradient-to-r from-ocean-600 to-seafoam-600 hover:from-ocean-700 hover:to-seafoam-700 text-white py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg text-center">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Đăng nhập để đặt phòng
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-phone text-ocean-600 mr-2"></i>
                    Cần hỗ trợ?
                </h3>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-phone mr-3 text-ocean-600"></i>
                        <span>Hotline: (84) 123 456 789</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-envelope mr-3 text-ocean-600"></i>
                        <span>Email: booking@hotelocean.com</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-clock mr-3 text-ocean-600"></i>
                        <span>Hỗ trợ 24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Rooms -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Phòng tương tự</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- This would be populated with related rooms from the controller -->
            <?php if (isNotEmpty($relatedRooms)): ?>
                <?php foreach ($relatedRooms as $room): ?>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <img src="<?= htmlspecialchars($room->hinh_anh ?? '/assets/images/default-room.jpg') ?>" 
                             alt="<?= htmlspecialchars($room->ten_phong) ?>" 
                             class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="font-semibold text-gray-800 mb-2"><?= htmlspecialchars($room->ten_phong) ?></h3>
                            <div class="flex justify-between items-center">
                                <span class="text-ocean-600 font-bold"><?= number_format($room->gia_phong) ?>đ/đêm</span>
                                <a href="/phong/<?= $room->id ?>" class="text-ocean-600 hover:text-ocean-700 font-medium">
                                    Xem chi tiết <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Auto-calculate checkout date
document.getElementById('ngay_nhan_phong').addEventListener('change', function() {
    const checkinDate = new Date(this.value);
    const checkoutDate = new Date(checkinDate);
    checkoutDate.setDate(checkoutDate.getDate() + 1);
    
    const checkoutInput = document.getElementById('ngay_tra_phong');
    checkoutInput.min = checkoutDate.toISOString().split('T')[0];
    
    if (!checkoutInput.value || new Date(checkoutInput.value) <= checkinDate) {
        checkoutInput.value = checkoutDate.toISOString().split('T')[0];
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
