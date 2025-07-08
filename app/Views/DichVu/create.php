<?php
$title = 'Thêm dịch vụ mới - Hotel Ocean';
ob_start();
?>

<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-seafoam-500 to-ocean-500 rounded-full flex items-center justify-center">
                <i class="fas fa-plus text-2xl text-white"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Thêm dịch vụ mới</h1>
                <p class="text-gray-600">Tạo dịch vụ mới trong hệ thống khách sạn</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <form action="/dich-vu" method="POST" enctype="multipart/form-data" class="space-y-8">
            <!-- Basic Information -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-info-circle text-seafoam-600 mr-2"></i>
                    Thông tin cơ bản
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="ten_dich_vu" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-concierge-bell mr-1"></i> Tên dịch vụ *
                        </label>
                        <input type="text" 
                               id="ten_dich_vu" 
                               name="ten_dich_vu" 
                               value="<?= htmlspecialchars(old('ten_dich_vu') ?? '') ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent transition-all"
                               required
                               placeholder="VD: Massage thư giãn, Spa cao cấp">
                    </div>

                    <div>
                        <label for="loai_dich_vu" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tags mr-1"></i> Loại dịch vụ *
                        </label>
                        <select id="loai_dich_vu" 
                                name="loai_dich_vu" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent transition-all"
                                required>
                            <option value="">Chọn loại dịch vụ</option>
                            <option value="spa" <?= old('loai_dich_vu') === 'spa' ? 'selected' : '' ?>>Spa & Wellness</option>
                            <option value="restaurant" <?= old('loai_dich_vu') === 'restaurant' ? 'selected' : '' ?>>Nhà hàng</option>
                            <option value="entertainment" <?= old('loai_dich_vu') === 'entertainment' ? 'selected' : '' ?>>Giải trí</option>
                            <option value="transport" <?= old('loai_dich_vu') === 'transport' ? 'selected' : '' ?>>Vận chuyển</option>
                            <option value="laundry" <?= old('loai_dich_vu') === 'laundry' ? 'selected' : '' ?>>Giặt ủi</option>
                            <option value="business" <?= old('loai_dich_vu') === 'business' ? 'selected' : '' ?>>Dịch vụ doanh nghiệp</option>
                            <option value="other" <?= old('loai_dich_vu') === 'other' ? 'selected' : '' ?>>Khác</option>
                        </select>
                    </div>

                    <div>
                        <label for="gia_dich_vu" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-money-bill-wave mr-1"></i> Giá dịch vụ (VNĐ) *
                        </label>
                        <input type="number" 
                               id="gia_dich_vu" 
                               name="gia_dich_vu" 
                               value="<?= htmlspecialchars(old('gia_dich_vu') ?? '') ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent transition-all"
                               required
                               min="0"
                               step="1000"
                               placeholder="VD: 500000">
                    </div>

                    <div>
                        <label for="thoi_gian" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-clock mr-1"></i> Thời gian (phút)
                        </label>
                        <input type="number" 
                               id="thoi_gian" 
                               name="thoi_gian" 
                               value="<?= htmlspecialchars(old('thoi_gian') ?? '') ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent transition-all"
                               min="5"
                               max="480"
                               placeholder="VD: 60">
                    </div>
                </div>
            </div>

            <!-- Service Details -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-list-alt text-seafoam-600 mr-2"></i>
                    Chi tiết dịch vụ
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="dia_diem" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt mr-1"></i> Địa điểm
                        </label>
                        <input type="text" 
                               id="dia_diem" 
                               name="dia_diem" 
                               value="<?= htmlspecialchars(old('dia_diem') ?? '') ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent transition-all"
                               placeholder="VD: Tầng 5, Spa center">
                    </div>

                    <div>
                        <label for="suc_chua" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-users mr-1"></i> Sức chứa
                        </label>
                        <input type="number" 
                               id="suc_chua" 
                               name="suc_chua" 
                               value="<?= htmlspecialchars(old('suc_chua') ?? '') ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent transition-all"
                               min="1"
                               max="100"
                               placeholder="VD: 10">
                    </div>

                    <div>
                        <label for="trang_thai" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-toggle-on mr-1"></i> Trạng thái *
                        </label>
                        <select id="trang_thai" 
                                name="trang_thai" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent transition-all"
                                required>
                            <option value="active" <?= old('trang_thai') === 'active' ? 'selected' : '' ?>>Hoạt động</option>
                            <option value="inactive" <?= old('trang_thai') === 'inactive' ? 'selected' : '' ?>>Tạm dừng</option>
                            <option value="maintenance" <?= old('trang_thai') === 'maintenance' ? 'selected' : '' ?>>Bảo trì</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Operating Hours -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-clock text-seafoam-600 mr-2"></i>
                    Giờ hoạt động
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="gio_mo" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-clock mr-1"></i> Giờ mở
                        </label>
                        <input type="time" 
                               id="gio_mo" 
                               name="gio_mo" 
                               value="<?= htmlspecialchars(old('gio_mo') ?? '08:00') ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent transition-all">
                    </div>

                    <div>
                        <label for="gio_dong" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-clock mr-1"></i> Giờ đóng
                        </label>
                        <input type="time" 
                               id="gio_dong" 
                               name="gio_dong" 
                               value="<?= htmlspecialchars(old('gio_dong') ?? '22:00') ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent transition-all">
                    </div>
                </div>
            </div>

            <!-- Description and Image -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-file-alt text-seafoam-600 mr-2"></i>
                    Mô tả và hình ảnh
                </h3>
                
                <div class="space-y-6">
                    <div>
                        <label for="mo_ta" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-1"></i> Mô tả dịch vụ
                        </label>
                        <textarea id="mo_ta" 
                                  name="mo_ta" 
                                  rows="5"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent transition-all"
                                  placeholder="Mô tả chi tiết về dịch vụ, quy trình, lợi ích..."><?= htmlspecialchars(old('mo_ta') ?? '') ?></textarea>
                    </div>

                    <div>
                        <label for="hinh_anh" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-image mr-1"></i> Hình ảnh dịch vụ
                        </label>
                        <input type="file" 
                               id="hinh_anh" 
                               name="hinh_anh" 
                               accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent transition-all">
                        <p class="text-sm text-gray-500 mt-2">Hỗ trợ: JPG, PNG, GIF. Tối đa 5MB.</p>
                    </div>
                </div>
            </div>

            <!-- Additional Settings -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-cogs text-seafoam-600 mr-2"></i>
                    Cài đặt bổ sung
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="yeu_cau_dat_truoc" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar-check mr-1"></i> Yêu cầu đặt trước
                        </label>
                        <select id="yeu_cau_dat_truoc" 
                                name="yeu_cau_dat_truoc" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent transition-all">
                            <option value="0" <?= old('yeu_cau_dat_truoc') === '0' ? 'selected' : '' ?>>Không bắt buộc</option>
                            <option value="1" <?= old('yeu_cau_dat_truoc') === '1' ? 'selected' : '' ?>>Đặt trước 1 giờ</option>
                            <option value="2" <?= old('yeu_cau_dat_truoc') === '2' ? 'selected' : '' ?>>Đặt trước 2 giờ</option>
                            <option value="4" <?= old('yeu_cau_dat_truoc') === '4' ? 'selected' : '' ?>>Đặt trước 4 giờ</option>
                            <option value="24" <?= old('yeu_cau_dat_truoc') === '24' ? 'selected' : '' ?>>Đặt trước 1 ngày</option>
                        </select>
                    </div>

                    <div>
                        <label for="huy_truoc" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-times-circle mr-1"></i> Có thể hủy trước (giờ)
                        </label>
                        <input type="number" 
                               id="huy_truoc" 
                               name="huy_truoc" 
                               value="<?= htmlspecialchars(old('huy_truoc') ?? '2') ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-seafoam-500 focus:border-transparent transition-all"
                               min="0"
                               max="72"
                               placeholder="VD: 2">
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-8 border-t border-gray-200">
                <a href="/dich-vu" 
                   class="text-gray-600 hover:text-gray-800 font-medium transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Quay lại danh sách
                </a>
                
                <div class="space-x-4">
                    <button type="reset" 
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 font-medium transition-colors">
                        <i class="fas fa-undo mr-2"></i>
                        Đặt lại
                    </button>
                    <button type="submit" 
                            class="bg-gradient-to-r from-seafoam-600 to-ocean-600 hover:from-seafoam-700 hover:to-ocean-700 text-white px-8 py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg">
                        <i class="fas fa-save mr-2"></i>
                        Thêm dịch vụ
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Price formatting
document.getElementById('gia_dich_vu').addEventListener('input', function() {
    let value = this.value.replace(/[^\d]/g, '');
    if (value) {
        this.value = parseInt(value).toLocaleString('vi-VN');
    }
});

// Time validation
document.getElementById('gio_dong').addEventListener('change', function() {
    const openTime = document.getElementById('gio_mo').value;
    const closeTime = this.value;
    
    if (openTime && closeTime && closeTime <= openTime) {
        alert('Giờ đóng phải sau giờ mở');
        this.value = '';
    }
});

// Image preview
document.getElementById('hinh_anh').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Add preview functionality here if needed
        };
        reader.readAsDataURL(file);
    }
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const giaDichVu = document.getElementById('gia_dich_vu').value;
    if (giaDichVu && parseInt(giaDichVu.replace(/[^\d]/g, '')) < 10000) {
        e.preventDefault();
        alert('Giá dịch vụ phải ít nhất 10,000 VNĐ');
        return false;
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
