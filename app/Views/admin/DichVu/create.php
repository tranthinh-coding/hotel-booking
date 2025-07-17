<?php
$title = 'Tạo Dịch vụ mới - Ocean Pearl Hotel Admin';
$pageTitle = 'Tạo Dịch vụ mới';
ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500">
        <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
        <span class="mx-2">/</span>
        <a href="/admin/dich-vu" class="hover:text-gray-700">Dịch vụ</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">Tạo mới</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Thông tin Dịch vụ</h3>
                    <p class="text-sm text-gray-500 mt-1">Nhập thông tin cơ bản cho dịch vụ mới</p>
                </div>
                
                <div class="p-6">
                    <form action="/admin/dich-vu/store" method="POST" enctype="multipart/form-data" class="space-y-6">
                        <input type="hidden" name="MAX_FILE_SIZE" value="5242880"> <!-- 5MB -->
                        <div>
                            <label for="ten_dich_vu" class="block text-sm font-medium text-gray-700 mb-2">
                                Tên dịch vụ <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="ten_dich_vu" 
                                   name="ten_dich_vu" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="VD: Nhà hàng cao cấp, Spa & Massage, Phòng gym..." 
                                   required>
                            <p class="mt-1 text-sm text-gray-500">Tên dịch vụ sẽ hiển thị trên website</p>
                        </div>

                        <div>
                            <label for="gia" class="block text-sm font-medium text-gray-700 mb-2">
                                Giá dịch vụ (VNĐ) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" 
                                       id="gia" 
                                       name="gia" 
                                       class="w-full pl-4 pr-16 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                       placeholder="0" 
                                       min="0"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">VNĐ</span>
                                </div>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Nhập 0 nếu dịch vụ miễn phí</p>
                        </div>

                        <div>
                            <label for="trang_thai" class="block text-sm font-medium text-gray-700 mb-2">
                                Trạng thái <span class="text-red-500">*</span>
                            </label>
                            <select id="trang_thai" 
                                    name="trang_thai"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                <?php
                                $trangThaiList = \HotelBooking\Enums\TrangThaiDichVu::all();
                                foreach ($trangThaiList as $status): ?>
                                    <option value="<?= $status ?>" <?= $status === \HotelBooking\Enums\TrangThaiDichVu::HOAT_DONG ? 'selected' : '' ?>>
                                        <?= \HotelBooking\Enums\TrangThaiDichVu::getLabel($status) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Chọn trạng thái hoạt động của dịch vụ</p>
                        </div>

                        <!-- Hình ảnh -->
                        <div>
                            <label for="hinh_anh" class="block text-sm font-medium text-gray-700 mb-2">
                                Hình ảnh dịch vụ
                            </label>
                            <div class="flex items-center justify-center w-full">
                                <label for="hinh_anh" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                        <p class="mb-2 text-sm text-gray-500">
                                            <span class="font-semibold">Click để chọn ảnh</span> hoặc kéo thả
                                        </p>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF, WebP (tối đa 5MB)</p>
                                    </div>
                                    <!-- Preview image will be shown here -->
                                    <div id="image-preview" class="hidden w-full h-full">
                                        <img id="preview-img" src="" alt="Preview" class="w-full h-full object-contain rounded-lg">
                                    </div>
                                    <input id="hinh_anh" name="hinh_anh" type="file" class="hidden" accept="image/*" onchange="previewImage(this)">
                                </label>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Chọn ảnh đại diện cho dịch vụ này (không bắt buộc)
                            </p>
                        </div>

                        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="/admin/dich-vu" 
                               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>Quay lại
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>Tạo dịch vụ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Preview -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 sticky top-4">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-eye mr-2 text-blue-600"></i>Xem trước
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <h4 id="preview-ten" class="text-lg font-semibold text-gray-900">Tên dịch vụ</h4>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="text-2xl font-bold text-blue-600" id="preview-gia">0</span>
                                <span class="text-gray-500">VNĐ</span>
                            </div>
                            <span id="preview-trang-thai" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Hoạt động
                            </span>
                        </div>
                        <!-- Ảnh xem trước -->
                        <div id="preview-img-box-wrap" class="w-full flex justify-center py-2">
                            <img id="preview-img-box" src="" alt="Preview" class="max-h-40 rounded-lg hidden object-contain border border-gray-200 bg-white">
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-2 text-sm text-gray-600">
                                <i class="fas fa-info-circle"></i>
                                <span>Dịch vụ sẽ hiển thị trong danh sách dịch vụ của khách sạn</span>
                            </div>
                        </div>
                        <div class="text-xs text-gray-500 pt-2 border-t">
                            <p><i class="fas fa-info-circle mr-1"></i>Preview sẽ cập nhật khi bạn nhập thông tin</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Helper Info -->
            <div class="mt-6 bg-gray-50 rounded-xl border border-gray-200">
                <div class="px-6 py-4">
                    <h4 class="text-sm font-semibold text-gray-900 mb-3">
                        <i class="fas fa-lightbulb mr-2"></i>Gợi ý
                    </h4>
                    <div class="space-y-2 text-sm text-gray-600">
                        <div class="flex items-start space-x-2">
                            <span class="text-gray-400">•</span>
                            <span>Tên dịch vụ nên ngắn gọn và dễ hiểu</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span class="text-gray-400">•</span>
                            <span>Giá dịch vụ có thể được cập nhật sau</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span class="text-gray-400">•</span>
                            <span>Dịch vụ miễn phí có thể đặt giá = 0</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span class="text-gray-400">•</span>
                            <span>Hình ảnh giúp khách hàng dễ dàng nhận biết dịch vụ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Live preview functions
function updatePreview() {
    const ten = document.getElementById('ten_dich_vu').value || 'Tên dịch vụ';
    const gia = document.getElementById('gia').value || '0';
    
    document.getElementById('preview-ten').textContent = ten;
    document.getElementById('preview-gia').textContent = Number(gia).toLocaleString('vi-VN');
}

// Format number input
function formatNumber(input) {
    let value = input.value.replace(/[^\d]/g, '');
    input.value = value;
    updatePreview();
}

// Add event listeners
document.getElementById('ten_dich_vu').addEventListener('input', updatePreview);
document.getElementById('gia').addEventListener('input', function() {
    formatNumber(this);
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const ten = document.getElementById('ten_dich_vu').value.trim();
    const gia = document.getElementById('gia').value.trim();
    
    if (!ten) {
        e.preventDefault();
        alert('Vui lòng nhập tên dịch vụ!');
        document.getElementById('ten_dich_vu').focus();
        return;
    }
    
    if (!gia || gia < 0) {
        e.preventDefault();
        alert('Vui lòng nhập giá dịch vụ hợp lệ!');
        document.getElementById('gia').focus();
        return;
    }
    
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Đang tạo...';
    submitBtn.disabled = true;
    
    // Re-enable if form submission fails
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 5000);
});

// Initialize preview
updatePreview();

// Preview image when file selected
function previewImage(input) {
    const previewDiv = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const placeholder = document.getElementById('upload-placeholder');
    const previewImgBox = document.getElementById('preview-img-box');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewDiv.classList.remove('hidden');
            placeholder.classList.add('hidden');
            // Hiển thị ảnh ở box preview
            previewImgBox.src = e.target.result;
            previewImgBox.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        previewDiv.classList.add('hidden');
        placeholder.classList.remove('hidden');
        previewImg.src = '';
        // Ẩn ảnh ở box preview
        previewImgBox.src = '';
        previewImgBox.classList.add('hidden');
    }
}
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
