<?php
$title = 'Đặt phòng - Ocean Pearl Hotel';
ob_start();
?>

<!-- Hero Section -->
<div class="relative h-96 bg-gradient-to-r from-blue-400 via-blue-500 to-cyan-500 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"waves\" width=\"100\" height=\"100\" patternUnits=\"userSpaceOnUse\"><path d=\"M0,50 Q25,30 50,50 T100,50 V100 H0 Z\" fill=\"rgba(255,255,255,0.1)\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23waves)\"/></svg>');">
        </div>
    </div>

    <div class="relative h-full flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="fade-in-up text-center">
                <!-- Breadcrumb -->
                <nav class="flex items-center justify-center space-x-2 text-blue-100 mb-8">
                    <a href="/" class="hover:text-white transition-colors">
                        <i class="fas fa-home mr-1"></i>Trang chủ
                    </a>
                    <i class="fas fa-chevron-right text-xs"></i>
                    <span class="text-white font-medium">Đặt phòng</span>
                </nav>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 text-shadow">
                    Đặt phòng khách sạn
                </h1>
                <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                    Trải nghiệm nghỉ dưỡng đẳng cấp tại Ocean Pearl Hotel với dịch vụ 5 sao
                </p>
            </div>
        </div>
    </div>

    <!-- Enhanced Wave decoration -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1200 120" class="w-full h-16 fill-current text-white">
            <path d="M0,60 C150,120 300,0 450,60 C600,120 750,0 900,60 C1050,120 1200,0 1200,60 V120 H0 V60Z"></path>
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
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <!-- Form Header -->
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 px-8 py-6 border-b border-gray-100">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-calendar-check text-blue-500 mr-3"></i>
                            Thông tin đặt phòng
                        </h2>
                        <p class="text-gray-600 mt-2">Vui lòng điền đầy đủ thông tin để hoàn tất đặt phòng</p>
                    </div>

                    <form method="POST" action="/dat-phong" class="p-8 space-y-8" id="bookingForm">
                        <!-- Customer Information -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center border-b border-gray-200 pb-3">
                                <i class="fas fa-user text-blue-500 mr-2"></i>
                                Thông tin khách hàng
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="ho_ten" class="block text-sm font-medium text-gray-700">
                                        Họ và tên <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="ho_ten" 
                                           name="ho_ten" 
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-400"
                                           placeholder="Nhập họ và tên">
                                </div>

                                <div class="space-y-2">
                                    <label for="so_dien_thoai" class="block text-sm font-medium text-gray-700">
                                        Số điện thoại <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" 
                                           id="so_dien_thoai" 
                                           name="so_dien_thoai" 
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-400"
                                           placeholder="Nhập số điện thoại">
                                </div>

                                <div class="space-y-2 md:col-span-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-400"
                                           placeholder="Nhập địa chỉ email">
                                </div>
                            </div>
                        </div>

                        <!-- Room Selection -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center border-b border-gray-200 pb-3">
                                <i class="fas fa-bed text-blue-500 mr-2"></i>
                                Chọn phòng
                            </h3>
                            
                            <div class="space-y-2">
                                <label for="ma_phong" class="block text-sm font-medium text-gray-700">
                                    Phòng <span class="text-red-500">*</span>
                                </label>
                                <select name="ma_phong" id="ma_phong" required 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-400">
                                    <option value="">Chọn phòng</option>
                                    <?php if (isNotEmpty($loaiPhongs)): ?>
                                        <?php foreach ($loaiPhongs as $loaiPhong): ?>
                                            <optgroup label="<?= safe_htmlspecialchars($loaiPhong->ten) ?>">
                                                <?php 
                                                // Lấy các phòng thuộc loại phòng này
                                                $phongs = \HotelBooking\Models\Phong::where('ma_loai_phong', $loaiPhong->ma_loai_phong)->get();
                                                foreach ($phongs as $phongItem): 
                                                ?>
                                                    <option value="<?= $phongItem->ma_phong ?>" 
                                                            data-price="<?= $phongItem->gia ?>"
                                                            data-room-type="<?= safe_htmlspecialchars($loaiPhong->ten) ?>"
                                                            <?= (isset($phong) && $phong->ma_phong == $phongItem->ma_phong) ? 'selected' : '' ?>>
                                                        <?= safe_htmlspecialchars($phongItem->ten_phong) ?> - 
                                                        <?= number_format($phongItem->gia) ?>₫/giờ
                                                    </option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Check-in/out Time -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center border-b border-gray-200 pb-3">
                                <i class="fas fa-clock text-blue-500 mr-2"></i>
                                Thời gian
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="ngay_nhan_phong" class="block text-sm font-medium text-gray-700">
                                        Thời gian nhận phòng <span class="text-red-500">*</span>
                                    </label>
                                    <input type="datetime-local" 
                                           id="ngay_nhan_phong" 
                                           name="ngay_nhan_phong" 
                                           required
                                           min="<?= date('Y-m-d\TH:i') ?>"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-400">
                                </div>

                                <div class="space-y-2">
                                    <label for="ngay_tra_phong" class="block text-sm font-medium text-gray-700">
                                        Thời gian trả phòng <span class="text-red-500">*</span>
                                    </label>
                                    <input type="datetime-local" 
                                           id="ngay_tra_phong" 
                                           name="ngay_tra_phong" 
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-400">
                                </div>
                            </div>
                        </div>

                        <!-- Guest Count -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center border-b border-gray-200 pb-3">
                                <i class="fas fa-users text-blue-500 mr-2"></i>
                                Số lượng khách
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="so_luong_nguoi_lon" class="block text-sm font-medium text-gray-700">
                                        Số người lớn <span class="text-red-500">*</span>
                                    </label>
                                    <select name="so_luong_nguoi_lon" id="so_luong_nguoi_lon" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-400">
                                        <option value="">Chọn số người lớn</option>
                                        <?php for ($i = 1; $i <= 10; $i++): ?>
                                            <option value="<?= $i ?>"><?= $i ?> người</option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="space-y-2">
                                    <label for="so_luong_tre_em" class="block text-sm font-medium text-gray-700">
                                        Số trẻ em
                                    </label>
                                    <select name="so_luong_tre_em" id="so_luong_tre_em"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-400">
                                        <option value="0">0 trẻ em</option>
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <option value="<?= $i ?>"><?= $i ?> trẻ em</option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Special Requests -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center border-b border-gray-200 pb-3">
                                <i class="fas fa-comment text-blue-500 mr-2"></i>
                                Yêu cầu đặc biệt
                            </h3>
                            
                            <div class="space-y-2">
                                <textarea name="ghi_chu" id="ghi_chu" rows="4" 
                                          placeholder="Nhập yêu cầu đặc biệt của bạn..."
                                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-400"></textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6 border-t border-gray-200">
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold py-4 px-8 rounded-xl hover:from-blue-700 hover:to-cyan-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-[1.02] transition-all duration-200 shadow-lg">
                                <i class="fas fa-calendar-check mr-2"></i>
                                Xác nhận đặt phòng
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Booking Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="space-y-8">
                    <!-- Booking Summary -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden sticky top-8">
                        <div class="bg-gradient-to-r from-blue-50 to-cyan-50 px-6 py-4 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <i class="fas fa-receipt text-blue-500 mr-2"></i>
                                Tóm tắt đặt phòng
                            </h3>
                        </div>
                        
                        <div class="p-6 space-y-4">
                            <div class="space-y-3">
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600">Phòng:</span>
                                    <span id="room-type-display" class="text-gray-900 font-medium text-right">Chưa chọn</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Thời gian:</span>
                                    <div class="text-right">
                                        <div id="datetime-display" class="text-gray-900 font-medium">-</div>
                                        <div id="hours-display" class="text-sm text-gray-500">-</div>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Giá phòng/giờ:</span>
                                    <span id="price-per-hour" class="text-gray-900 font-medium">-</span>
                                </div>
                            </div>
                            
                            <hr class="border-gray-200">
                            
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-800">Tổng tiền:</span>
                                <span id="total-amount" class="text-xl font-bold text-blue-600">0₫</span>
                            </div>
                            
                            <div class="mt-4 p-4 bg-blue-50 rounded-xl">
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                                    <div class="text-sm text-blue-700">
                                        <p class="font-medium">Lưu ý:</p>
                                        <p>Giá phòng được tính theo giờ. Thời gian tối thiểu là 2 giờ.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Selected Room Info -->
                    <?php if (isset($phong)): ?>
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 px-6 py-4 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-bed text-blue-500 mr-2"></i>
                                    Phòng đã chọn
                                </h3>
                            </div>
                            
                            <div class="p-6">
                                <div class="space-y-4">
                                    <div>
                                        <h4 class="font-semibold text-gray-900"><?= safe_htmlspecialchars($phong->ten_phong) ?></h4>
                                        <p class="text-gray-600"><?= safe_htmlspecialchars($phong->loai_phong_ten ?? 'Loại phòng') ?></p>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Giá:</span>
                                        <span class="text-lg font-bold text-blue-600"><?= number_format($phong->gia) ?>₫/giờ</span>
                                    </div>
                                    
                                    <?php if (isNotEmpty($phong->mo_ta)): ?>
                                        <div>
                                            <h5 class="font-medium text-gray-800 mb-2">Mô tả:</h5>
                                            <p class="text-gray-600 text-sm"><?= safe_htmlspecialchars($phong->mo_ta) ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
                        <div class="text-center">
                            <?php if (isNotEmpty($phong->hinh_anh)): ?>
                                <img src="<?= safe_htmlspecialchars($phong->hinh_anh) ?>" 
                                        alt="<?= safe_htmlspecialchars($phong->ten_phong) ?>"


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
    const checkinDateTime = document.getElementById('ngay_nhan_phong');
    const checkoutDateTime = document.getElementById('ngay_tra_phong');
    
    function updateBookingSummary() {
        const selectedOption = roomSelect.selectedOptions[0];
        const checkin = new Date(checkinDateTime.value);
        const checkout = new Date(checkoutDateTime.value);
        
        // Update room type display
        if (selectedOption && selectedOption.value) {
            const roomName = selectedOption.textContent.split(' - ')[0];
            const roomPrice = parseInt(selectedOption.getAttribute('data-price'));
            
            document.getElementById('room-type-display').textContent = roomName;
            document.getElementById('price-per-hour').textContent = 
                new Intl.NumberFormat('vi-VN').format(roomPrice) + '₫/giờ';
                
            // Calculate hours and total
            if (checkinDateTime.value && checkoutDateTime.value && checkout > checkin) {
                const hours = Math.ceil((checkout - checkin) / (1000 * 60 * 60));
                const minHours = Math.max(hours, 2); // Minimum 2 hours
                
                document.getElementById('datetime-display').innerHTML = 
                    `${formatDateTime(checkin)}<br>đến ${formatDateTime(checkout)}`;
                document.getElementById('hours-display').textContent = minHours + ' giờ';
                
                const total = minHours * roomPrice;
                document.getElementById('total-amount').textContent = 
                    new Intl.NumberFormat('vi-VN').format(total) + '₫';
            } else {
                document.getElementById('datetime-display').textContent = '-';
                document.getElementById('hours-display').textContent = '-';
                document.getElementById('total-amount').textContent = '0₫';
            }
        } else {
            document.getElementById('room-type-display').textContent = 'Chưa chọn';
            document.getElementById('price-per-hour').textContent = '-';
            document.getElementById('datetime-display').textContent = '-';
            document.getElementById('hours-display').textContent = '-';
            document.getElementById('total-amount').textContent = '0₫';
        }
    }
    
    function formatDateTime(date) {
        return date.toLocaleDateString('vi-VN', {
            day: '2-digit',
            month: '2-digit', 
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }
    
    // Set minimum datetime to current time
    function setMinDateTime() {
        const now = new Date();
        const minDateTime = new Date(now.getTime() - now.getTimezoneOffset() * 60000)
                            .toISOString().slice(0, 16);
        checkinDateTime.min = minDateTime;
    }
    
    // Event listeners
    roomSelect.addEventListener('change', updateBookingSummary);
    checkinDateTime.addEventListener('change', function() {
        // Set minimum checkout datetime to 2 hours after checkin
        if (this.value) {
            const minCheckout = new Date(this.value);
            minCheckout.setHours(minCheckout.getHours() + 2);
            const minCheckoutStr = new Date(minCheckout.getTime() - minCheckout.getTimezoneOffset() * 60000)
                                   .toISOString().slice(0, 16);
            checkoutDateTime.min = minCheckoutStr;
        }
        updateBookingSummary();
    });
    checkoutDateTime.addEventListener('change', updateBookingSummary);
    
    // Initialize
    setMinDateTime();
    updateBookingSummary();
    
    // Form validation
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        const checkin = new Date(checkinDateTime.value);
        const checkout = new Date(checkoutDateTime.value);
        
        if (checkout <= checkin) {
            e.preventDefault();
            alert('Thời gian trả phòng phải sau thời gian nhận phòng');
            return;
        }
        
        const hours = (checkout - checkin) / (1000 * 60 * 60);
        if (hours < 2) {
            e.preventDefault();
            alert('Thời gian thuê phòng tối thiểu là 2 giờ');
            return;
        }
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
