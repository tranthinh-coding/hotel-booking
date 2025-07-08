<?php
$title = 'Liên hệ - Hotel Ocean';
ob_start();
?>

<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Liên hệ với chúng tôi</h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Đội ngũ tư vấn chuyên nghiệp của Hotel Ocean luôn sẵn sàng hỗ trợ bạn 24/7. 
            Hãy liên hệ để được tư vấn và đặt phòng tốt nhất.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Contact Form -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                <i class="fas fa-envelope text-ocean-600 mr-2"></i>
                Gửi tin nhắn cho chúng tôi
            </h2>

            <form action="/contact" method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="ho_ten" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-1"></i> Họ và tên *
                        </label>
                        <input type="text" 
                               id="ho_ten" 
                               name="ho_ten" 
                               value="<?= htmlspecialchars(old('ho_ten') ?? '') ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all"
                               required
                               placeholder="Nhập họ và tên của bạn">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-1"></i> Email *
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="<?= htmlspecialchars(old('email') ?? '') ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all"
                               required
                               placeholder="Nhập địa chỉ email">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="so_dien_thoai" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-phone mr-1"></i> Số điện thoại
                        </label>
                        <input type="tel" 
                               id="so_dien_thoai" 
                               name="so_dien_thoai" 
                               value="<?= htmlspecialchars(old('so_dien_thoai') ?? '') ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all"
                               placeholder="Nhập số điện thoại">
                    </div>

                    <div>
                        <label for="chu_de" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tag mr-1"></i> Chủ đề *
                        </label>
                        <select id="chu_de" 
                                name="chu_de" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all"
                                required>
                            <option value="">Chọn chủ đề</option>
                            <option value="dat_phong" <?= old('chu_de') === 'dat_phong' ? 'selected' : '' ?>>Đặt phòng</option>
                            <option value="dich_vu" <?= old('chu_de') === 'dich_vu' ? 'selected' : '' ?>>Dịch vụ</option>
                            <option value="khieu_nai" <?= old('chu_de') === 'khieu_nai' ? 'selected' : '' ?>>Khiếu nại</option>
                            <option value="gop_y" <?= old('chu_de') === 'gop_y' ? 'selected' : '' ?>>Góp ý</option>
                            <option value="su_kien" <?= old('chu_de') === 'su_kien' ? 'selected' : '' ?>>Tổ chức sự kiện</option>
                            <option value="khac" <?= old('chu_de') === 'khac' ? 'selected' : '' ?>>Khác</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="noi_dung" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-comment mr-1"></i> Nội dung tin nhắn *
                    </label>
                    <textarea id="noi_dung" 
                              name="noi_dung" 
                              rows="6"
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all"
                              required
                              placeholder="Nhập nội dung tin nhắn của bạn. Hãy mô tả chi tiết để chúng tôi có thể hỗ trợ bạn tốt nhất..."><?= htmlspecialchars(old('noi_dung') ?? '') ?></textarea>
                </div>

                <!-- Privacy Checkbox -->
                <div class="flex items-start">
                    <input type="checkbox" 
                           id="dong_y_xu_ly" 
                           name="dong_y_xu_ly" 
                           value="1" 
                           class="mt-1 rounded border-gray-300 text-ocean-500 focus:ring-ocean-500"
                           required>
                    <label for="dong_y_xu_ly" class="ml-2 text-sm text-gray-600">
                        Tôi đồng ý để Hotel Ocean xử lý thông tin cá nhân của tôi để phản hồi yêu cầu này theo 
                        <a href="/privacy-policy" class="text-ocean-600 hover:text-ocean-700 underline">Chính sách bảo mật</a> *
                    </label>
                </div>

                <button type="submit" 
                        class="w-full bg-gradient-to-r from-ocean-600 to-seafoam-600 hover:from-ocean-700 hover:to-seafoam-700 text-white py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Gửi tin nhắn
                </button>
            </form>
        </div>

        <!-- Contact Information -->
        <div class="space-y-8">
            <!-- Contact Details -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-info-circle text-ocean-600 mr-2"></i>
                    Thông tin liên hệ
                </h2>

                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-ocean-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-ocean-600 text-lg"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 mb-1">Địa chỉ</h3>
                            <p class="text-gray-600">
                                123 Đường Trần Phú, Phường Lộc Thọ<br>
                                Thành phố Nha Trang, Khánh Hòa<br>
                                Việt Nam
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-green-600 text-lg"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 mb-1">Điện thoại</h3>
                            <p class="text-gray-600">
                                <a href="tel:+84123456789" class="hover:text-ocean-600">Hotline: (+84) 123 456 789</a><br>
                                <a href="tel:+84987654321" class="hover:text-ocean-600">Đặt phòng: (+84) 987 654 321</a>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-blue-600 text-lg"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 mb-1">Email</h3>
                            <p class="text-gray-600">
                                <a href="mailto:info@hotelocean.com" class="hover:text-ocean-600">info@hotelocean.com</a><br>
                                <a href="mailto:booking@hotelocean.com" class="hover:text-ocean-600">booking@hotelocean.com</a>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-purple-600 text-lg"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800 mb-1">Giờ làm việc</h3>
                            <p class="text-gray-600">
                                Lễ tân: 24/7<br>
                                Văn phòng: 8:00 - 22:00<br>
                                Nhà hàng: 6:00 - 23:00
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-share-alt text-ocean-600 mr-2"></i>
                    Kết nối với chúng tôi
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="#" class="flex items-center p-3 bg-blue-50 rounded-xl hover:bg-blue-100 transition-colors">
                        <i class="fab fa-facebook-f text-blue-600 text-xl mr-3"></i>
                        <span class="text-gray-700">Facebook</span>
                    </a>
                    <a href="#" class="flex items-center p-3 bg-pink-50 rounded-xl hover:bg-pink-100 transition-colors">
                        <i class="fab fa-instagram text-pink-600 text-xl mr-3"></i>
                        <span class="text-gray-700">Instagram</span>
                    </a>
                    <a href="#" class="flex items-center p-3 bg-red-50 rounded-xl hover:bg-red-100 transition-colors">
                        <i class="fab fa-youtube text-red-600 text-xl mr-3"></i>
                        <span class="text-gray-700">YouTube</span>
                    </a>
                    <a href="#" class="flex items-center p-3 bg-green-50 rounded-xl hover:bg-green-100 transition-colors">
                        <i class="fab fa-tripadvisor text-green-600 text-xl mr-3"></i>
                        <span class="text-gray-700">TripAdvisor</span>
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-gradient-to-r from-ocean-600 to-seafoam-600 rounded-2xl p-8 text-white">
                <h3 class="text-xl font-semibold mb-6">
                    <i class="fas fa-bolt mr-2"></i>
                    Hành động nhanh
                </h3>
                <div class="space-y-4">
                    <a href="/phong" class="block w-full bg-white bg-opacity-20 hover:bg-opacity-30 rounded-xl p-4 transition-all">
                        <i class="fas fa-bed mr-3"></i>
                        Đặt phòng trực tuyến
                    </a>
                    <a href="tel:+84123456789" class="block w-full bg-white bg-opacity-20 hover:bg-opacity-30 rounded-xl p-4 transition-all">
                        <i class="fas fa-phone mr-3"></i>
                        Gọi ngay hotline
                    </a>
                    <a href="/dich-vu" class="block w-full bg-white bg-opacity-20 hover:bg-opacity-30 rounded-xl p-4 transition-all">
                        <i class="fas fa-concierge-bell mr-3"></i>
                        Xem dịch vụ
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="mt-12">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="p-8 border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-800">
                    <i class="fas fa-map text-ocean-600 mr-2"></i>
                    Vị trí khách sạn
                </h2>
                <p class="text-gray-600 mt-2">
                    Hotel Ocean tọa lạc tại vị trí đắc địa ngay trung tâm thành phố Nha Trang, 
                    chỉ cách bãi biển 50m và sân bay quốc tế Cam Ranh 30km.
                </p>
            </div>
            <div class="h-96 bg-gray-200 flex items-center justify-center">
                <!-- Placeholder for map -->
                <div class="text-center text-gray-500">
                    <i class="fas fa-map text-4xl mb-4"></i>
                    <p>Bản đồ sẽ được tích hợp tại đây</p>
                    <p class="text-sm">(Google Maps hoặc OpenStreetMap)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="mt-12">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Câu hỏi thường gặp</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="font-semibold text-gray-800 mb-3">
                    <i class="fas fa-question-circle text-ocean-600 mr-2"></i>
                    Làm thế nào để đặt phòng?
                </h3>
                <p class="text-gray-600">
                    Bạn có thể đặt phòng trực tuyến trên website, gọi hotline hoặc đến trực tiếp khách sạn. 
                    Chúng tôi chấp nhận thanh toán bằng tiền mặt, thẻ tín dụng và chuyển khoản.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="font-semibold text-gray-800 mb-3">
                    <i class="fas fa-question-circle text-ocean-600 mr-2"></i>
                    Chính sách hủy phòng như thế nào?
                </h3>
                <p class="text-gray-600">
                    Bạn có thể hủy phòng miễn phí trước 24 giờ. Hủy muộn hơn sẽ bị tính phí 1 đêm. 
                    Trong peak season, chính sách có thể khác nhau.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="font-semibold text-gray-800 mb-3">
                    <i class="fas fa-question-circle text-ocean-600 mr-2"></i>
                    Có dịch vụ đưa đón sân bay không?
                </h3>
                <p class="text-gray-600">
                    Có, chúng tôi cung cấp dịch vụ đưa đón sân bay 24/7. Vui lòng đặt trước ít nhất 2 giờ 
                    để chúng tôi chuẩn bị phương tiện phù hợp.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="font-semibold text-gray-800 mb-3">
                    <i class="fas fa-question-circle text-ocean-600 mr-2"></i>
                    Khách sạn có cho phép thú cưng không?
                </h3>
                <p class="text-gray-600">
                    Chúng tôi cho phép thú cưng ở một số phòng nhất định với phí bổ sung. 
                    Vui lòng thông báo trước khi đặt phòng để được tư vấn.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
// Form character counter
const noiDungTextarea = document.getElementById('noi_dung');
if (noiDungTextarea) {
    noiDungTextarea.addEventListener('input', function() {
        const length = this.value.length;
        const maxLength = 1000;
        
        // You can add a character counter here if needed
        if (length > maxLength) {
            this.value = this.value.substring(0, maxLength);
        }
    });
}

// Phone number formatting
const phoneInput = document.getElementById('so_dien_thoai');
if (phoneInput) {
    phoneInput.addEventListener('input', function() {
        // Remove non-numeric characters except + and spaces
        let value = this.value.replace(/[^\d+\s]/g, '');
        this.value = value;
    });
}

// Auto-resize textarea
function autoResize(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
}

noiDungTextarea.addEventListener('input', function() {
    autoResize(this);
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const noiDung = document.getElementById('noi_dung').value;
    if (noiDung.length < 10) {
        e.preventDefault();
        alert('Nội dung tin nhắn phải có ít nhất 10 ký tự');
        document.getElementById('noi_dung').focus();
        return false;
    }
    
    const dongY = document.getElementById('dong_y_xu_ly').checked;
    if (!dongY) {
        e.preventDefault();
        alert('Vui lòng đồng ý với việc xử lý thông tin cá nhân');
        return false;
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
