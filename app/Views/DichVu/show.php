<?php
$title = 'Chi tiết dịch vụ - Hotel Ocean';
ob_start();
?>

<div class="max-w-6xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="/" class="hover:text-ocean-600">Trang chủ</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="/dich-vu" class="hover:text-ocean-600">Dịch vụ</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-medium"><?= htmlspecialchars($dichVu->ten_dich_vu ?? 'Chi tiết dịch vụ') ?></li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Service Image -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="<?= htmlspecialchars($dichVu->hinh_anh ?? '/assets/images/default-service.jpg') ?>" 
                         alt="<?= htmlspecialchars($dichVu->ten_dich_vu ?? '') ?>"
                         class="w-full h-96 object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-seafoam-600 text-white text-sm font-semibold rounded-full">
                            <?= htmlspecialchars($dichVu->trang_thai ?? 'active') === 'active' ? 'Đang hoạt động' : 'Tạm dừng' ?>
                        </span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-white text-seafoam-600 text-sm font-semibold rounded-full shadow-lg">
                            <?= number_format($dichVu->gia_dich_vu ?? 0) ?>đ
                        </span>
                    </div>
                </div>
            </div>

            <!-- Service Details -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">
                    <?= htmlspecialchars($dichVu->ten_dich_vu ?? '') ?>
                </h1>

                <!-- Service Info Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                    <div class="text-center p-4 bg-seafoam-50 rounded-xl">
                        <i class="fas fa-concierge-bell text-2xl text-seafoam-600 mb-2"></i>
                        <div class="text-sm text-gray-600">Loại dịch vụ</div>
                        <div class="font-semibold text-gray-800"><?= htmlspecialchars($dichVu->loai_dich_vu ?? 'General') ?></div>
                    </div>
                    <div class="text-center p-4 bg-ocean-50 rounded-xl">
                        <i class="fas fa-clock text-2xl text-ocean-600 mb-2"></i>
                        <div class="text-sm text-gray-600">Thời gian</div>
                        <div class="font-semibold text-gray-800"><?= $dichVu->thoi_gian ?? '30' ?> phút</div>
                    </div>
                    <div class="text-center p-4 bg-blue-50 rounded-xl">
                        <i class="fas fa-map-marker-alt text-2xl text-blue-600 mb-2"></i>
                        <div class="text-sm text-gray-600">Địa điểm</div>
                        <div class="font-semibold text-gray-800"><?= htmlspecialchars($dichVu->dia_diem ?? 'Khách sạn') ?></div>
                    </div>
                    <div class="text-center p-4 bg-green-50 rounded-xl">
                        <i class="fas fa-users text-2xl text-green-600 mb-2"></i>
                        <div class="text-sm text-gray-600">Sức chứa</div>
                        <div class="font-semibold text-gray-800"><?= $dichVu->suc_chua ?? 'Không giới hạn' ?></div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Mô tả dịch vụ</h3>
                    <p class="text-gray-600 leading-relaxed">
                        <?= nl2br(htmlspecialchars($dichVu->mo_ta ?? 'Dịch vụ chất lượng cao với đội ngũ chuyên nghiệp, mang đến trải nghiệm tuyệt vời cho quý khách trong kỳ nghỉ tại Hotel Ocean.')) ?>
                    </p>
                </div>

                <!-- Features -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Đặc điểm nổi bật</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-seafoam-600 mr-3"></i>
                            Dịch vụ chuyên nghiệp
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-seafoam-600 mr-3"></i>
                            Đội ngũ có kinh nghiệm
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-seafoam-600 mr-3"></i>
                            Thiết bị hiện đại
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-seafoam-600 mr-3"></i>
                            Hỗ trợ 24/7
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-seafoam-600 mr-3"></i>
                            Giá cả hợp lý
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-seafoam-600 mr-3"></i>
                            Cam kết chất lượng
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Sidebar -->
        <div class="space-y-6">
            <!-- Booking Form -->
            <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Đặt dịch vụ ngay</h3>
                
                <form action="/dat-dich-vu" method="POST" class="space-y-4">
                    <input type="hidden" name="dich_vu_id" value="<?= $dichVu->id ?? '' ?>">
                    
                    <div>
                        <label for="ngay_su_dung" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar mr-1"></i> Ngày sử dụng
                        </label>
                        <input type="date" 
                               id="ngay_su_dung" 
                               name="ngay_su_dung" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent"
                               required
                               min="<?= date('Y-m-d') ?>">
                    </div>

                    <div>
                        <label for="thoi_gian" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-clock mr-1"></i> Thời gian
                        </label>
                        <select id="thoi_gian" 
                                name="thoi_gian" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent"
                                required>
                            <option value="">Chọn thời gian</option>
                            <option value="08:00">08:00</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                            <option value="19:00">19:00</option>
                            <option value="20:00">20:00</option>
                        </select>
                    </div>

                    <div>
                        <label for="so_luong" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-users mr-1"></i> Số lượng
                        </label>
                        <select id="so_luong" 
                                name="so_luong" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent"
                                required>
                            <option value="">Chọn số lượng</option>
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?> người</option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div>
                        <label for="ghi_chu" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-sticky-note mr-1"></i> Ghi chú
                        </label>
                        <textarea id="ghi_chu" 
                                  name="ghi_chu" 
                                  rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent"
                                  placeholder="Yêu cầu đặc biệt (nếu có)"></textarea>
                    </div>

                    <!-- Price Display -->
                    <div class="bg-gray-50 rounded-xl p-4">
                        <div class="flex justify-between items-center text-lg font-semibold">
                            <span class="text-gray-700">Giá dịch vụ:</span>
                            <span class="text-seafoam-600"><?= number_format($dichVu->gia_dich_vu ?? 0) ?>đ</span>
                        </div>
                        <div class="text-sm text-gray-500 mt-1">
                            *Giá có thể thay đổi tùy theo số lượng và thời gian
                        </div>
                    </div>

                    <?php if (auth_check()): ?>
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-seafoam-600 to-ocean-600 hover:from-seafoam-700 hover:to-ocean-700 text-white py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg">
                            <i class="fas fa-calendar-check mr-2"></i>
                            Đặt dịch vụ ngay
                        </button>
                    <?php else: ?>
                        <a href="/login" 
                           class="block w-full bg-gradient-to-r from-seafoam-600 to-ocean-600 hover:from-seafoam-700 hover:to-ocean-700 text-white py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg text-center">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Đăng nhập để đặt dịch vụ
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-phone text-seafoam-600 mr-2"></i>
                    Cần hỗ trợ?
                </h3>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-phone mr-3 text-seafoam-600"></i>
                        <span>Hotline: (84) 123 456 789</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-envelope mr-3 text-seafoam-600"></i>
                        <span>Email: service@hotelocean.com</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-clock mr-3 text-seafoam-600"></i>
                        <span>Hỗ trợ 24/7</span>
                    </div>
                </div>
            </div>

            <!-- Service Hours -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-clock text-seafoam-600 mr-2"></i>
                    Giờ hoạt động
                </h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Thứ 2 - Thứ 6:</span>
                        <span class="font-medium">08:00 - 22:00</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Thứ 7 - Chủ nhật:</span>
                        <span class="font-medium">07:00 - 23:00</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Ngày lễ:</span>
                        <span class="font-medium">09:00 - 21:00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Services -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Dịch vụ khác</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php if (!empty($relatedServices)): ?>
                <?php foreach ($relatedServices as $service): ?>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <img src="<?= htmlspecialchars($service->hinh_anh ?? '/assets/images/default-service.jpg') ?>" 
                             alt="<?= htmlspecialchars($service->ten_dich_vu) ?>" 
                             class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="font-semibold text-gray-800 mb-2"><?= htmlspecialchars($service->ten_dich_vu) ?></h3>
                            <div class="flex justify-between items-center">
                                <span class="text-seafoam-600 font-bold"><?= number_format($service->gia_dich_vu) ?>đ</span>
                                <a href="/dich-vu/<?= $service->id ?>" class="text-seafoam-600 hover:text-seafoam-700 font-medium">
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
// Auto-calculate total price
document.getElementById('so_luong').addEventListener('change', function() {
    const quantity = parseInt(this.value) || 1;
    const basePrice = <?= $dichVu->gia_dich_vu ?? 0 ?>;
    const totalPrice = basePrice * quantity;
    
    // Update price display if needed
    // This would be implemented based on your pricing logic
});

// Time slot validation
document.getElementById('ngay_su_dung').addEventListener('change', function() {
    const selectedDate = new Date(this.value);
    const today = new Date();
    
    // You can add logic here to disable certain time slots
    // based on the selected date or existing bookings
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
