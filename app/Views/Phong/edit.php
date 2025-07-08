<?php
$title = 'Chỉnh sửa phòng - Hotel Ocean';
ob_start();
?>

<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                <i class="fas fa-edit text-2xl text-white"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Chỉnh sửa phòng</h1>
                <p class="text-gray-600">Cập nhật thông tin phòng: <?= htmlspecialchars($phong->ten_phong ?? '') ?></p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <form action="/phong/<?= $phong->id ?>" method="POST" enctype="multipart/form-data" class="space-y-8">
            <input type="hidden" name="_method" value="PUT">
            
            <!-- Basic Information -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-info-circle text-orange-600 mr-2"></i>
                    Thông tin cơ bản
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="ten_phong" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-bed mr-1"></i> Tên phòng *
                        </label>
                        <input type="text" 
                               id="ten_phong" 
                               name="ten_phong" 
                               value="<?= htmlspecialchars(old('ten_phong') ?: ($phong->ten_phong ?? '')) ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                               required
                               placeholder="VD: Phòng Deluxe Ocean View">
                    </div>

                    <div>
                        <label for="so_phong" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-door-open mr-1"></i> Số phòng *
                        </label>
                        <input type="text" 
                               id="so_phong" 
                               name="so_phong" 
                               value="<?= htmlspecialchars(old('so_phong') ?: ($phong->so_phong ?? '')) ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                               required
                               placeholder="VD: 101, A201">
                    </div>

                    <div>
                        <label for="loai_phong" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-star mr-1"></i> Loại phòng *
                        </label>
                        <select id="loai_phong" 
                                name="loai_phong" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                                required>
                            <option value="">Chọn loại phòng</option>
                            <option value="standard" <?= (old('loai_phong') ?: ($phong->loai_phong ?? '')) === 'standard' ? 'selected' : '' ?>>Standard</option>
                            <option value="deluxe" <?= (old('loai_phong') ?: ($phong->loai_phong ?? '')) === 'deluxe' ? 'selected' : '' ?>>Deluxe</option>
                            <option value="suite" <?= (old('loai_phong') ?: ($phong->loai_phong ?? '')) === 'suite' ? 'selected' : '' ?>>Suite</option>
                            <option value="presidential" <?= (old('loai_phong') ?: ($phong->loai_phong ?? '')) === 'presidential' ? 'selected' : '' ?>>Presidential</option>
                        </select>
                    </div>

                    <div>
                        <label for="gia_phong" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-money-bill-wave mr-1"></i> Giá phòng/đêm (VNĐ) *
                        </label>
                        <input type="number" 
                               id="gia_phong" 
                               name="gia_phong" 
                               value="<?= htmlspecialchars(old('gia_phong') ?: ($phong->gia_phong ?? '')) ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                               required
                               min="0"
                               step="1000"
                               placeholder="VD: 1500000">
                    </div>
                </div>
            </div>

            <!-- Room Details -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-list-alt text-orange-600 mr-2"></i>
                    Chi tiết phòng
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="suc_chua" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-users mr-1"></i> Sức chứa (người) *
                        </label>
                        <select id="suc_chua" 
                                name="suc_chua" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                                required>
                            <option value="">Chọn sức chứa</option>
                            <?php for ($i = 1; $i <= 8; $i++): ?>
                                <option value="<?= $i ?>" <?= (old('suc_chua') ?: ($phong->suc_chua ?? '')) == $i ? 'selected' : '' ?>><?= $i ?> người</option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div>
                        <label for="dien_tich" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-expand-arrows-alt mr-1"></i> Diện tích (m²)
                        </label>
                        <input type="number" 
                               id="dien_tich" 
                               name="dien_tich" 
                               value="<?= htmlspecialchars(old('dien_tich') ?: ($phong->dien_tich ?? '')) ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                               min="10"
                               max="200"
                               placeholder="VD: 35">
                    </div>

                    <div>
                        <label for="view_phong" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-eye mr-1"></i> View phòng
                        </label>
                        <select id="view_phong" 
                                name="view_phong" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all">
                            <option value="">Chọn view</option>
                            <option value="city" <?= (old('view_phong') ?: ($phong->view_phong ?? '')) === 'city' ? 'selected' : '' ?>>City View</option>
                            <option value="ocean" <?= (old('view_phong') ?: ($phong->view_phong ?? '')) === 'ocean' ? 'selected' : '' ?>>Ocean View</option>
                            <option value="garden" <?= (old('view_phong') ?: ($phong->view_phong ?? '')) === 'garden' ? 'selected' : '' ?>>Garden View</option>
                            <option value="pool" <?= (old('view_phong') ?: ($phong->view_phong ?? '')) === 'pool' ? 'selected' : '' ?>>Pool View</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Status and Category -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-cog text-orange-600 mr-2"></i>
                    Trạng thái và phân loại
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="trang_thai" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-toggle-on mr-1"></i> Trạng thái *
                        </label>
                        <select id="trang_thai" 
                                name="trang_thai" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                                required>
                            <option value="available" <?= (old('trang_thai') ?: ($phong->trang_thai ?? '')) === 'available' ? 'selected' : '' ?>>Có sẵn</option>
                            <option value="occupied" <?= (old('trang_thai') ?: ($phong->trang_thai ?? '')) === 'occupied' ? 'selected' : '' ?>>Đã đặt</option>
                            <option value="maintenance" <?= (old('trang_thai') ?: ($phong->trang_thai ?? '')) === 'maintenance' ? 'selected' : '' ?>>Bảo trì</option>
                            <option value="out_of_order" <?= (old('trang_thai') ?: ($phong->trang_thai ?? '')) === 'out_of_order' ? 'selected' : '' ?>>Ngưng hoạt động</option>
                        </select>
                    </div>

                    <div>
                        <label for="danh_muc_id" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tags mr-1"></i> Danh mục
                        </label>
                        <select id="danh_muc_id" 
                                name="danh_muc_id" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all">
                            <option value="">Chọn danh mục</option>
                            <?php if (!empty($danhMucs)): ?>
                                <?php foreach ($danhMucs as $danhMuc): ?>
                                    <option value="<?= $danhMuc->id ?>" <?= (old('danh_muc_id') ?: ($phong->danh_muc_id ?? '')) == $danhMuc->id ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($danhMuc->ten_danh_muc) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Description and Image -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-file-alt text-orange-600 mr-2"></i>
                    Mô tả và hình ảnh
                </h3>
                
                <div class="space-y-6">
                    <div>
                        <label for="mo_ta" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-1"></i> Mô tả phòng
                        </label>
                        <textarea id="mo_ta" 
                                  name="mo_ta" 
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                                  placeholder="Mô tả chi tiết về phòng, tiện nghi, không gian..."><?= htmlspecialchars(old('mo_ta') ?: ($phong->mo_ta ?? '')) ?></textarea>
                    </div>

                    <!-- Current Image -->
                    <?php if (!empty($phong->hinh_anh)): ?>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-image mr-1"></i> Hình ảnh hiện tại
                            </label>
                            <div class="flex items-center space-x-4">
                                <img src="<?= htmlspecialchars($phong->hinh_anh) ?>" 
                                     alt="<?= htmlspecialchars($phong->ten_phong) ?>"
                                     class="w-32 h-24 object-cover rounded-lg border border-gray-200">
                                <div class="text-sm text-gray-600">
                                    <p>Hình ảnh đang sử dụng</p>
                                    <p class="text-xs">Chọn file mới để thay đổi</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div>
                        <label for="hinh_anh" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-upload mr-1"></i> Cập nhật hình ảnh
                        </label>
                        <input type="file" 
                               id="hinh_anh" 
                               name="hinh_anh" 
                               accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all">
                        <p class="text-sm text-gray-500 mt-2">Hỗ trợ: JPG, PNG, GIF. Tối đa 5MB. Để trống nếu không muốn thay đổi.</p>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-8 border-t border-gray-200">
                <a href="/phong" 
                   class="text-gray-600 hover:text-gray-800 font-medium transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Quay lại danh sách
                </a>
                
                <div class="space-x-4">
                    <a href="/phong/<?= $phong->id ?>" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 font-medium transition-colors">
                        <i class="fas fa-eye mr-2"></i>
                        Xem chi tiết
                    </a>
                    <button type="submit" 
                            class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-8 py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg">
                        <i class="fas fa-save mr-2"></i>
                        Cập nhật phòng
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Price formatting
document.getElementById('gia_phong').addEventListener('input', function() {
    let value = this.value.replace(/[^\d]/g, '');
    if (value) {
        this.value = parseInt(value).toLocaleString('vi-VN');
    }
});

// Image preview
document.getElementById('hinh_anh').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Update current image preview
            const currentImg = document.querySelector('img[alt="<?= htmlspecialchars($phong->ten_phong ?? '') ?>"]');
            if (currentImg) {
                currentImg.src = e.target.result;
            }
        };
        reader.readAsDataURL(file);
    }
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const giaPhong = document.getElementById('gia_phong').value;
    if (giaPhong && parseInt(giaPhong.replace(/[^\d]/g, '')) < 100000) {
        e.preventDefault();
        alert('Giá phòng phải ít nhất 100,000 VNĐ');
        return false;
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
