<?php
$title = 'Đặt phòng - Ocean Pearl Hotel';
ob_start();
?>

<!-- Modern CSS Styles -->
<style>
    .booking-card {
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.98);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .booking-card:hover {
        box-shadow: 0 8px 40px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }
    
    .gradient-bg {
        background: linear-gradient(135deg, 
            rgba(56, 189, 248, 0.05) 0%, 
            rgba(14, 165, 233, 0.05) 50%, 
            rgba(6, 182, 212, 0.05) 100%);
    }
    
    .form-input {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.2s ease;
        background: rgba(255, 255, 255, 0.8);
    }
    
    .form-input:focus {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        outline: none;
        background: rgba(255, 255, 255, 1);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
        border: none;
        box-shadow: 0 4px 14px rgba(14, 165, 233, 0.2);
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.3);
        background: linear-gradient(135deg, #0284c7 0%, #0891b2 100%);
    }
    
    .step-indicator {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border: 2px solid #e2e8f0;
    }
    
    .step-indicator.active {
        background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
        border-color: #0ea5e9;
        color: white;
    }
    
    .step-indicator.completed {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-color: #10b981;
        color: white;
    }
    
    .room-summary {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border: 1px solid #e2e8f0;
        border-radius: 16px;
    }
</style>

<!-- Header with Breadcrumb -->
<div class="gradient-bg py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-slate-600 mb-8">
            <a href="/" class="hover:text-blue-600 transition-colors text-sm">
                <i class="fas fa-home mr-1"></i>Trang chủ
            </a>
            <i class="fas fa-chevron-right text-xs text-slate-400"></i>
            <a href="/phong" class="hover:text-blue-600 transition-colors text-sm">Phòng</a>
            <i class="fas fa-chevron-right text-xs text-slate-400"></i>
            <?php if ($phong): ?>
                <a href="/phong/<?= $phong->ma_phong ?>" class="hover:text-blue-600 transition-colors text-sm">
                    <?= htmlspecialchars($phong->ten_phong) ?>
                </a>
                <i class="fas fa-chevron-right text-xs text-slate-400"></i>
            <?php endif; ?>
            <span class="text-slate-800 font-medium text-sm">Đặt phòng</span>
        </nav>

        <!-- Progress Steps -->
        <div class="flex items-center justify-center space-x-8 mb-8">
            <div class="flex items-center">
                <div class="step-indicator completed w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm">
                    <i class="fas fa-check"></i>
                </div>
                <span class="ml-3 text-sm font-medium text-slate-700">Chọn phòng</span>
            </div>
            <div class="w-16 h-0.5 bg-slate-300"></div>
            <div class="flex items-center">
                <div class="step-indicator active w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm">
                    2
                </div>
                <span class="ml-3 text-sm font-medium text-slate-700">Thông tin đặt phòng</span>
            </div>
            <div class="w-16 h-0.5 bg-slate-300"></div>
            <div class="flex items-center">
                <div class="step-indicator w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm">
                    3
                </div>
                <span class="ml-3 text-sm font-medium text-slate-400">Xác nhận</span>
            </div>
        </div>

        <!-- Page Title -->
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">
                Hoàn tất đặt phòng
            </h1>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed">
                Điền thông tin để hoàn tất việc đặt phòng tại Ocean Pearl Hotel
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Flash Messages -->
        <?php if (flash_get('success')): ?>
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-8 flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                <div><?= flash_get('success') ?></div>
            </div>
        <?php endif; ?>

        <?php if (flash_get('error')): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl mb-8 flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                <div><?= flash_get('error') ?></div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Booking Form -->
            <div class="lg:col-span-2">
                <div class="booking-card rounded-3xl overflow-hidden">
                    <!-- Form Header -->
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 px-8 py-6">
                        <h2 class="text-2xl font-bold text-slate-800 flex items-center">
                            <i class="fas fa-edit text-blue-500 mr-3"></i>
                            Thông tin đặt phòng
                        </h2>
                        <p class="text-slate-600 mt-2">Vui lòng điền đầy đủ thông tin để hoàn tất đặt phòng</p>
                    </div>

                    <form method="POST" action="/booking/process" class="p-8 space-y-8" id="bookingForm">
                        <?php if ($phong): ?>
                            <input type="hidden" name="phong_id" value="<?= $phong->ma_phong ?>">
                        <?php endif; ?>
                        
                        <!-- Customer Information -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center border-b border-slate-200 pb-3">
                                <i class="fas fa-user text-blue-500 mr-2"></i>
                                Thông tin khách hàng
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="ho_ten" class="block text-sm font-semibold text-slate-700 mb-3">
                                        Họ và tên <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="ho_ten" 
                                           name="ho_ten" 
                                           required
                                           class="form-input w-full px-4 py-3"
                                           placeholder="Nhập họ và tên"
                                           value="<?= htmlspecialchars(old('ho_ten') ?? '') ?>">
                                </div>

                                <div>
                                    <label for="so_dien_thoai" class="block text-sm font-semibold text-slate-700 mb-3">
                                        Số điện thoại <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" 
                                           id="so_dien_thoai" 
                                           name="so_dien_thoai" 
                                           required
                                           class="form-input w-full px-4 py-3"
                                           placeholder="Nhập số điện thoại"
                                           value="<?= htmlspecialchars(old('so_dien_thoai') ?? '') ?>">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-3">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           required
                                           class="form-input w-full px-4 py-3"
                                           placeholder="Nhập địa chỉ email"
                                           value="<?= htmlspecialchars(old('email') ?? '') ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Booking Details -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center border-b border-slate-200 pb-3">
                                <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                Chi tiết đặt phòng
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="ngay_nhan_phong" class="block text-sm font-semibold text-slate-700 mb-3">
                                        <i class="fas fa-calendar-plus mr-2 text-blue-500"></i>
                                        Thời gian nhận phòng <span class="text-red-500">*</span>
                                    </label>
                                    <input type="datetime-local" 
                                           id="ngay_nhan_phong" 
                                           name="ngay_nhan_phong" 
                                           required
                                           class="form-input w-full px-4 py-3"
                                           min="<?= date('Y-m-d\TH:i') ?>"
                                           value="<?= htmlspecialchars(old('ngay_nhan_phong') ?? ($bookingData['ngay_nhan_phong'] ?? '')) ?>">
                                </div>

                                <div>
                                    <label for="ngay_tra_phong" class="block text-sm font-semibold text-slate-700 mb-3">
                                        <i class="fas fa-calendar-minus mr-2 text-blue-500"></i>
                                        Thời gian trả phòng <span class="text-red-500">*</span>
                                    </label>
                                    <input type="datetime-local" 
                                           id="ngay_tra_phong" 
                                           name="ngay_tra_phong" 
                                           required
                                           class="form-input w-full px-4 py-3"
                                           value="<?= htmlspecialchars(old('ngay_tra_phong') ?? ($bookingData['ngay_tra_phong'] ?? '')) ?>">
                                </div>

                                <div>
                                    <label for="so_nguoi" class="block text-sm font-semibold text-slate-700 mb-3">
                                        <i class="fas fa-users mr-2 text-blue-500"></i>
                                        Số khách <span class="text-red-500">*</span>
                                    </label>
                                    <select id="so_nguoi" 
                                            name="so_nguoi" 
                                            required
                                            class="form-input w-full px-4 py-3">
                                        <?php 
                                        $maxGuests = $phong ? ($phong->suc_chua ?? 4) : 4;
                                        $selectedGuests = old('so_nguoi') ?? ($bookingData['so_nguoi'] ?? 1);
                                        for ($i = 1; $i <= $maxGuests; $i++): 
                                        ?>
                                            <option value="<?= $i ?>" <?= $i == $selectedGuests ? 'selected' : '' ?>>
                                                <?= $i ?> khách
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div>
                                    <label for="ma_phong" class="block text-sm font-semibold text-slate-700 mb-3">
                                        <i class="fas fa-bed mr-2 text-blue-500"></i>
                                        Chọn phòng <span class="text-red-500">*</span>
                                    </label>
                                    <select id="ma_phong" 
                                            name="ma_phong" 
                                            required
                                            class="form-input w-full px-4 py-3">
                                        <?php if ($phong): ?>
                                            <option value="<?= $phong->ma_phong ?>" selected>
                                                <?= htmlspecialchars($phong->ten_phong) ?> - <?= number_format($phong->gia) ?>₫/giờ
                                            </option>
                                        <?php else: ?>
                                            <option value="">Chọn phòng</option>
                                            <?php if (isset($phongs) && $phongs): ?>
                                                <?php foreach ($phongs as $room): ?>
                                                    <option value="<?= $room->ma_phong ?>" <?= old('ma_phong') == $room->ma_phong ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($room->ten_phong) ?> - <?= number_format($room->gia) ?>₫/giờ
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Special Requests -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-slate-800 flex items-center border-b border-slate-200 pb-3">
                                <i class="fas fa-comment-alt text-blue-500 mr-2"></i>
                                Yêu cầu đặc biệt
                            </h3>
                            
                            <div>
                                <label for="ghi_chu" class="block text-sm font-semibold text-slate-700 mb-3">
                                    Ghi chú (không bắt buộc)
                                </label>
                                <textarea id="ghi_chu" 
                                          name="ghi_chu" 
                                          rows="4"
                                          class="form-input w-full px-4 py-3"
                                          placeholder="Nhập yêu cầu đặc biệt của bạn (giường đôi, tầng cao, view biển...)"><?= htmlspecialchars(old('ghi_chu') ?? '') ?></textarea>
                            </div>
                        </div>

                        <!-- Terms and Submit -->
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <input type="checkbox" 
                                       id="agree_terms" 
                                       name="agree_terms" 
                                       required
                                       class="mt-1 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                <label for="agree_terms" class="ml-3 text-sm text-slate-600">
                                    Tôi đồng ý với <a href="/terms" class="text-blue-600 hover:underline">điều khoản và điều kiện</a> 
                                    của Ocean Pearl Hotel <span class="text-red-500">*</span>
                                </label>
                            </div>

                            <button type="submit" 
                                    class="btn-primary w-full text-white py-4 rounded-xl font-semibold text-lg transition-all transform hover:scale-105">
                                <i class="fas fa-credit-card mr-2"></i>
                                Xác nhận đặt phòng
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Booking Summary -->
            <div class="lg:col-span-1">
                <div class="booking-card rounded-3xl p-8 sticky top-8">
                    <h3 class="text-xl font-bold text-slate-800 mb-6">
                        <i class="fas fa-receipt text-blue-500 mr-2"></i>
                        Tóm tắt đặt phòng
                    </h3>

                    <?php if ($phong): ?>
                        <!-- Room Info -->
                        <div class="room-summary p-6 mb-6">
                            <div class="flex items-start space-x-4">
                                <img src="<?= htmlspecialchars($phong->hinh_anh ?? '/assets/images/default-room.jpg') ?>" 
                                     alt="<?= htmlspecialchars($phong->ten_phong) ?>"
                                     class="w-20 h-20 object-cover rounded-xl">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-slate-800 mb-1">
                                        <?= htmlspecialchars($phong->ten_phong) ?>
                                    </h4>
                                    <p class="text-sm text-slate-600 mb-2">
                                        <?= htmlspecialchars($phong->loai_phong ?? 'Standard Room') ?>
                                    </p>
                                    <div class="text-lg font-bold text-blue-600">
                                        <?= number_format($phong->gia) ?>₫/giờ
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Price Breakdown -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-slate-800">Chi tiết giá</h4>
                        
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-600">Giá phòng/giờ:</span>
                                <span class="font-semibold" id="room-rate">
                                    <?= $phong ? number_format($phong->gia) . '₫' : '0₫' ?>
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-600">Thời gian thuê:</span>
                                <span class="font-semibold" id="rental-duration">-</span>
                            </div>
                            <div class="border-t border-slate-200 pt-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-slate-800">Tổng tiền:</span>
                                    <span class="text-xl font-bold text-blue-600" id="total-amount">0₫</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Info -->
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 mt-6">
                        <div class="flex items-start">
                            <i class="fas fa-shield-check text-green-500 mt-1 mr-3"></i>
                            <div>
                                <h5 class="font-semibold text-green-800 mb-1">Đặt phòng an toàn</h5>
                                <p class="text-sm text-green-700">
                                    • Miễn phí hủy phòng trong 24h<br>
                                    • Thanh toán bảo mật 100%<br>
                                    • Hỗ trợ khách hàng 24/7
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="mt-6 pt-6 border-t border-slate-200">
                        <h4 class="font-semibold text-slate-800 mb-4">
                            <i class="fas fa-headset text-blue-500 mr-2"></i>
                            Cần hỗ trợ?
                        </h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center text-slate-600">
                                <i class="fas fa-phone text-blue-500 mr-3 w-4"></i>
                                <span>Hotline: +84 123 456 789</span>
                            </div>
                            <div class="flex items-center text-slate-600">
                                <i class="fas fa-envelope text-blue-500 mr-3 w-4"></i>
                                <span>booking@oceanpearl.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkinInput = document.getElementById('ngay_nhan_phong');
    const checkoutInput = document.getElementById('ngay_tra_phong');
    const roomSelect = document.getElementById('ma_phong');
    const roomRateEl = document.getElementById('room-rate');
    const rentalDurationEl = document.getElementById('rental-duration');
    const totalAmountEl = document.getElementById('total-amount');
    
    // Set minimum time to current time
    const now = new Date();
    const currentDateTime = new Date(now.getTime() - now.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
    checkinInput.min = currentDateTime;
    
    // Room rates (this should come from server)
    const roomRates = {
        <?php if (isset($phongs) && $phongs): ?>
            <?php foreach ($phongs as $room): ?>
                '<?= $room->ma_phong ?>': <?= $room->gia ?>,
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if ($phong): ?>
            '<?= $phong->ma_phong ?>': <?= $phong->gia ?>
        <?php endif; ?>
    };
    
    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN').format(amount) + '₫';
    }
    
    function calculatePrice() {
        const checkin = new Date(checkinInput.value);
        const checkout = new Date(checkoutInput.value);
        const selectedRoom = roomSelect.value;
        
        if (checkinInput.value && checkoutInput.value && checkout > checkin && selectedRoom) {
            const diffMs = checkout - checkin;
            const hours = Math.ceil(diffMs / (1000 * 60 * 60));
            const minHours = Math.max(hours, 2); // Minimum 2 hours
            
            const rate = roomRates[selectedRoom] || 0;
            roomRateEl.textContent = formatCurrency(rate);
            rentalDurationEl.textContent = minHours + ' giờ';
            
            const total = minHours * rate;
            totalAmountEl.textContent = formatCurrency(total);
            
            return true;
        } else {
            rentalDurationEl.textContent = '-';
            totalAmountEl.textContent = '0₫';
            return false;
        }
    }
    
    // Update minimum checkout time when checkin changes
    checkinInput.addEventListener('change', function() {
        if (this.value) {
            const minCheckout = new Date(this.value);
            minCheckout.setHours(minCheckout.getHours() + 2);
            const minCheckoutStr = new Date(minCheckout.getTime() - minCheckout.getTimezoneOffset() * 60000)
                                   .toISOString().slice(0, 16);
            checkoutInput.min = minCheckoutStr;
            
            // Auto-set checkout if not set
            if (!checkoutInput.value) {
                checkoutInput.value = minCheckoutStr;
            }
        }
        calculatePrice();
    });
    
    checkoutInput.addEventListener('change', calculatePrice);
    roomSelect.addEventListener('change', calculatePrice);
    
    // Initial calculation
    calculatePrice();
    
    // Form validation
    const form = document.getElementById('bookingForm');
    form.addEventListener('submit', function(e) {
        if (!calculatePrice()) {
            e.preventDefault();
            alert('Vui lòng chọn thời gian nhận và trả phòng hợp lệ!');
            return false;
        }
        
        const checkin = new Date(checkinInput.value);
        const checkout = new Date(checkoutInput.value);
        const now = new Date();
        
        if (checkin < now) {
            e.preventDefault();
            alert('Thời gian nhận phòng phải sau thời điểm hiện tại!');
            return false;
        }
        
        if (checkout <= checkin) {
            e.preventDefault();
            alert('Thời gian trả phòng phải sau thời gian nhận phòng!');
            return false;
        }
        
        // Show loading
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Đang xử lý...';
            submitBtn.disabled = true;
        }
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
