<?php
$title = 'Chỉnh sửa Phòng - Ocean Pearl Hotel Admin';
$pageTitle = 'Chỉnh sửa Phòng';
ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <div class="flex justify-between items-center">
        <nav class="text-sm text-gray-500">
            <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="/admin/phong" class="hover:text-gray-700">Quản lý Phòng</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">Chỉnh sửa</span>
        </nav>
        <a href="/admin/phong/show?id=<?= $phong->ma_phong ?>"
           class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            Quay lại
        </a>
    </div>

    <!-- Form chỉnh sửa -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-xl font-semibold text-gray-900">Chỉnh sửa phòng: <?= htmlspecialchars($phong->ten_phong) ?></h2>
        </div>

        <form method="POST" action="/admin/phong/update" class="p-6 space-y-6" enctype="multipart/form-data">
            <!-- Hidden ID field -->
            <input type="hidden" name="id" value="<?= $phong->ma_phong ?>">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Thông tin cơ bản -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900">Thông tin cơ bản</h3>
                    
                    <!-- Tên phòng -->
                    <div>
                        <label for="ten_phong" class="block text-sm font-medium text-gray-700 mb-2">
                            Tên phòng <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="ten_phong" 
                               name="ten_phong" 
                               value="<?= htmlspecialchars($phong->ten_phong) ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>

                    <!-- Loại phòng -->
                    <div>
                        <label for="ma_loai_phong" class="block text-sm font-medium text-gray-700 mb-2">
                            Loại phòng <span class="text-red-500">*</span>
                        </label>
                        <select id="ma_loai_phong" 
                                name="ma_loai_phong"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                            <option value="">Chọn loại phòng</option>
                            <?php if (!empty($loaiPhongs)): ?>
                                <?php foreach ($loaiPhongs as $loai): ?>
                                    <option value="<?= $loai->ma_loai_phong ?>" 
                                            <?= $loai->ma_loai_phong == $phong->ma_loai_phong ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($loai->ten_loai_phong) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Giá phòng -->
                    <div>
                        <label for="gia" class="block text-sm font-medium text-gray-700 mb-2">
                            Giá phòng (VNĐ) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               id="gia" 
                               name="gia" 
                               value="<?= $phong->gia ?>"
                               min="0"
                               step="1000"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>

                    <!-- Trạng thái -->
                    <div>
                        <label for="trang_thai" class="block text-sm font-medium text-gray-700 mb-2">
                            Trạng thái <span class="text-red-500">*</span>
                        </label>
                        <select id="trang_thai" 
                                name="trang_thai"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                            <?php
                            $trangThaiList = \HotelBooking\Enums\TrangThaiPhong::all();
                            foreach ($trangThaiList as $status): ?>
                                <option value="<?= $status ?>" <?= $status === $phong->trang_thai ? 'selected' : '' ?>>
                                    <?= \HotelBooking\Enums\TrangThaiPhong::getLabel($status) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Mô tả và hình ảnh -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900">Mô tả và hình ảnh</h3>
                    
                    <!-- Mô tả -->
                    <div>
                        <label for="mo_ta" class="block text-sm font-medium text-gray-700 mb-2">
                            Mô tả phòng
                        </label>
                        <textarea id="mo_ta" 
                                  name="mo_ta" 
                                  rows="6"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Nhập mô tả chi tiết về phòng..."><?= htmlspecialchars($phong->mo_ta ?: '') ?></textarea>
                    </div>

                    <!-- Hình ảnh hiện tại -->
                    <?php if (!empty($phong->hinh_anh)): ?>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Hình ảnh hiện tại</label>
                        <div class="grid grid-cols-3 gap-3">
                            <div class="relative">
                                <img src="<?= htmlspecialchars($phong->hinh_anh) ?>" 
                                     alt="Hình ảnh phòng hiện tại" 
                                     class="w-full h-24 object-cover rounded-lg">
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Upload hình ảnh mới -->
                    <div>
                        <label for="hinh_anh" class="block text-sm font-medium text-gray-700 mb-2">
                            Cập nhật hình ảnh
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6">
                            <div class="text-center">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3"></i>
                                <div class="text-gray-600 mb-2">
                                    <label for="hinh_anh" class="cursor-pointer text-blue-600 hover:text-blue-500">
                                        Chọn file
                                    </label>
                                    hoặc kéo thả vào đây
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF tối đa 10MB</p>
                            </div>
                            <input type="file" 
                                   id="hinh_anh" 
                                   name="hinh_anh" 
                                   accept="image/*"
                                   class="hidden"
                                   onchange="previewImage(this)">
                        </div>
                        <div id="preview" class="mt-3 hidden">
                            <img id="preview-img" src="" alt="Preview" class="w-32 h-24 object-cover rounded-lg">
                        </div>
                    </div>

                    <!-- Tiện nghi phòng -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Tiện nghi phòng</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="flex items-center">
                                <input type="checkbox" name="tien_nghi[]" value="wifi" checked 
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">WiFi miễn phí</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="tien_nghi[]" value="dieu_hoa" checked 
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Điều hòa</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="tien_nghi[]" value="smart_tv" checked 
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Smart TV</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="tien_nghi[]" value="phong_tam" checked 
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Phòng tắm riêng</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="tien_nghi[]" value="giuong_doi" checked 
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Giường đôi</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="tien_nghi[]" value="minibar" 
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Minibar</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-100">
                <a href="/admin/phong/<?= $phong->ma_phong ?>"
                   class="px-6 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    Hủy
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Cập nhật phòng
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('preview').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Drag and drop functionality
const dropZone = document.querySelector('.border-dashed');
const fileInput = document.getElementById('hinh_anh');

dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('border-blue-500', 'bg-blue-50');
});

dropZone.addEventListener('dragleave', (e) => {
    e.preventDefault();
    dropZone.classList.remove('border-blue-500', 'bg-blue-50');
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('border-blue-500', 'bg-blue-50');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        fileInput.files = files;
        previewImage(fileInput);
    }
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const tenPhong = document.getElementById('ten_phong').value.trim();
    const gia = document.getElementById('gia').value;
    const maLoaiPhong = document.getElementById('ma_loai_phong').value;
    
    if (!tenPhong) {
        alert('Vui lòng nhập tên phòng');
        e.preventDefault();
        return;
    }
    
    if (!gia || gia <= 0) {
        alert('Vui lòng nhập giá phòng hợp lệ');
        e.preventDefault();
        return;
    }
    
    if (!maLoaiPhong) {
        alert('Vui lòng chọn loại phòng');
        e.preventDefault();
        return;
    }
});

// Format number input
document.getElementById('gia').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    e.target.value = value;
});
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../../layouts/admin.php';
?>
