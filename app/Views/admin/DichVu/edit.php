<?php
$title = 'Sửa Dịch vụ - Ocean Pearl Hotel Admin';
$pageTitle = 'Sửa Dịch vụ';
ob_start();
?>

<div class="space-y-6">
    <!-- Error Messages -->
    <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">
                        <?= htmlspecialchars(urldecode($_GET['error'])) ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <nav class="text-sm text-gray-500">
                <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
                <span class="mx-2">/</span>
                <a href="/admin/dich-vu" class="hover:text-gray-700">Dịch vụ</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Sửa "<?= htmlspecialchars($dichVu->ten_dich_vu ?? '') ?>"</span>
            </nav>
        </div>
        <div>
            <a href="/admin/dich-vu"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Quay lại
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6">
            <form method="POST" action="/admin/dich-vu/update" enctype="multipart/form-data" class="space-y-6">
                <input type="hidden" name="id" value="<?= $dichVu->ma_dich_vu ?>">
                <input type="hidden" name="MAX_FILE_SIZE" value="5242880"> <!-- 5MB -->

                <!-- Tên dịch vụ -->
                <div>
                    <label for="ten_dich_vu" class="block text-sm font-medium text-gray-700 mb-2">
                        Tên dịch vụ <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="ten_dich_vu" 
                           name="ten_dich_vu" 
                           value="<?= htmlspecialchars($dichVu->ten_dich_vu ?? '') ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Nhập tên dịch vụ..."
                           required>
                </div>

                <!-- Giá dịch vụ -->
                <div>
                    <label for="gia" class="block text-sm font-medium text-gray-700 mb-2">
                        Giá dịch vụ (VNĐ) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" 
                               id="gia" 
                               name="gia" 
                               value="<?= $dichVu->gia ?? 0 ?>"
                               class="w-full pl-4 pr-16 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="0"
                               min="0"
                               required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 text-sm">VNĐ</span>
                        </div>
                    </div>
                </div>

                <!-- Trạng thái -->
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
                        $currentStatus = $dichVu->trang_thai ?? \HotelBooking\Enums\TrangThaiDichVu::HOAT_DONG;
                        foreach ($trangThaiList as $status): ?>
                            <option value="<?= $status ?>" <?= $status === $currentStatus ? 'selected' : '' ?>>
                                <?= \HotelBooking\Enums\TrangThaiDichVu::getLabel($status) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Hình ảnh hiện tại -->
                <?php if (isNotEmpty($dichVu->hinh_anh)): ?>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Hình ảnh hiện tại
                        </label>
                        <div class="relative inline-block">
                            <?php
                            $currentImageUrl = getFileUrl($dichVu->hinh_anh);
                            ?>
                            <?php if ($currentImageUrl): ?>
                                <img src="<?= htmlspecialchars($currentImageUrl) ?>" 
                                     alt="<?= htmlspecialchars($dichVu->ten_dich_vu ?? '') ?>"
                                     class="w-48 h-32 object-cover rounded-lg border border-gray-200">
                                <div class="absolute top-1 right-1">
                                    <button type="button" 
                                            onclick="removeCurrentImage()"
                                            class="bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors"
                                            title="Xóa ảnh hiện tại">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
                            <?php else: ?>
                                <div class="w-48 h-32 bg-gray-200 rounded-lg border border-gray-300 flex items-center justify-center">
                                    <span class="text-gray-500 text-sm">Ảnh không tồn tại</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <input type="hidden" id="remove_current_image" name="remove_current_image" value="0">
                    </div>
                <?php endif; ?>

                <!-- Upload ảnh mới -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <?= isNotEmpty($dichVu->hinh_anh) ? 'Thay đổi hình ảnh' : 'Hình ảnh dịch vụ' ?>
                    </label>
                    <div class="flex items-center justify-center w-full">
                        <label for="hinh_anh" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors" id="upload-area">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-placeholder">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                <p class="mb-2 text-sm text-gray-500">
                                    <span class="font-semibold">Click để chọn ảnh mới</span> hoặc kéo thả
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
                        <?= isNotEmpty($dichVu->hinh_anh) ? 'Chọn ảnh mới để thay thế ảnh hiện tại' : 'Chọn ảnh đại diện cho dịch vụ này' ?>
                    </p>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="/admin/dich-vu/show?id=<?= $dichVu->ma_dich_vu ?>"
                        class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                        Hủy
                    </a>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Cập nhật dịch vụ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Image preview function
function previewImage(input) {
    const placeholder = document.getElementById('upload-placeholder');
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            placeholder.classList.add('hidden');
            preview.classList.remove('hidden');
        };
        
        reader.readAsDataURL(input.files[0]);
    } else {
        // Reset to placeholder
        placeholder.classList.remove('hidden');
        preview.classList.add('hidden');
        previewImg.src = '';
    }
}

function removeCurrentImage() {
    if (confirm('Bạn có chắc chắn muốn xóa ảnh hiện tại?')) {
        document.getElementById('remove_current_image').value = '1';
        
        // Ẩn ảnh hiện tại
        const currentImageContainer = event.target.closest('div').parentElement;
        currentImageContainer.style.display = 'none';
        
        // Cập nhật label
        const newImageLabel = document.querySelector('label[class*="block text-sm font-medium text-gray-700 mb-2"]');
        if (newImageLabel) {
            newImageLabel.textContent = 'Hình ảnh dịch vụ';
        }
        
        // Cập nhật thông báo
        const infoText = document.querySelector('.fa-info-circle').parentElement;
        infoText.innerHTML = '<i class="fas fa-info-circle mr-1"></i>Chọn ảnh đại diện cho dịch vụ này';
    }
}

// Drag and drop functionality
const uploadArea = document.getElementById('upload-area');
const fileInput = document.getElementById('hinh_anh');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    uploadArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    uploadArea.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    uploadArea.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    uploadArea.classList.add('border-blue-500', 'bg-blue-50');
}

function unhighlight(e) {
    uploadArea.classList.remove('border-blue-500', 'bg-blue-50');
}

uploadArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    
    if (files.length > 0) {
        fileInput.files = files;
        previewImage(fileInput);
    }
}

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const tenInput = document.getElementById('ten_dich_vu');
    const giaInput = document.getElementById('gia');
    
    if (!tenInput.value.trim()) {
        e.preventDefault();
        tenInput.focus();
        alert('Vui lòng nhập tên dịch vụ');
        return false;
    }
    
    if (!giaInput.value || giaInput.value < 0) {
        e.preventDefault();
        giaInput.focus();
        alert('Vui lòng nhập giá dịch vụ hợp lệ');
        return false;
    }
});

// Format price input
document.getElementById('gia').addEventListener('input', function() {
    let value = this.value.replace(/[^0-9]/g, '');
    this.value = value;
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
