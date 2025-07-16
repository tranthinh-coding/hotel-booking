<?php
$title = 'Sửa Tin tức - Ocean Pearl Hotel Admin';
$pageTitle = 'Sửa Tin tức';
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
                <a href="/admin/tin-tuc" class="hover:text-gray-700">Tin tức</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Sửa "<?= htmlspecialchars($tinTuc->tieu_de ?? '') ?>"</span>
            </nav>
        </div>
        <div>
            <a href="/admin/tin-tuc/show?id=<?= $tinTuc->ma_tin_tuc ?>"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Quay lại
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Chỉnh sửa Tin tức</h3>
                    <p class="text-sm text-gray-500 mt-1">Cập nhật thông tin bài viết</p>
                </div>
                
                <div class="p-6">
                    <form method="POST" action="/admin/tin-tuc/update" enctype="multipart/form-data" class="space-y-6">
                        <input type="hidden" name="id" value="<?= $tinTuc->ma_tin_tuc ?>">
                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760"> <!-- 10MB -->

                        <div>
                            <label for="tieu_de" class="block text-sm font-medium text-gray-700 mb-2">
                                Tiêu đề <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="tieu_de" 
                                   name="tieu_de" 
                                   value="<?= htmlspecialchars($tinTuc->tieu_de ?? '') ?>"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="Nhập tiêu đề tin tức..." 
                                   required>
                            <p class="mt-1 text-sm text-gray-500">Tiêu đề hấp dẫn sẽ thu hút độc giả</p>
                        </div>

                        <div>
                            <label for="noi_dung" class="block text-sm font-medium text-gray-700 mb-2">
                                Nội dung <span class="text-red-500">*</span>
                            </label>
                            <textarea id="noi_dung" 
                                      name="noi_dung" 
                                      rows="12" 
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                      placeholder="Viết nội dung chi tiết của tin tức..."
                                      required><?= htmlspecialchars($tinTuc->noi_dung ?? '') ?></textarea>
                            <p class="mt-1 text-sm text-gray-500">Nội dung chi tiết và đầy đủ thông tin</p>
                        </div>

                        <!-- Hình ảnh hiện tại -->
                        <?php if (isNotEmpty($tinTuc->anh_dai_dien)): ?>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Hình ảnh hiện tại
                                </label>
                                <div class="relative inline-block">
                                    <?php
                                    $currentImageUrl = getFileUrl($tinTuc->anh_dai_dien);
                                    ?>
                                    <?php if ($currentImageUrl): ?>
                                        <img src="<?= htmlspecialchars($currentImageUrl) ?>" 
                                             alt="<?= htmlspecialchars($tinTuc->tieu_de ?? '') ?>"
                                             class="w-64 h-40 object-cover rounded-lg border border-gray-200">
                                        <div class="absolute top-1 right-1">
                                            <button type="button" 
                                                    onclick="removeCurrentImage()"
                                                    class="bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors"
                                                    title="Xóa ảnh hiện tại">
                                                <i class="fas fa-times text-xs"></i>
                                            </button>
                                        </div>
                                    <?php else: ?>
                                        <div class="w-64 h-40 bg-gray-200 rounded-lg border border-gray-300 flex items-center justify-center">
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
                                <?= isNotEmpty($tinTuc->anh_dai_dien) ? 'Thay đổi hình ảnh' : 'Hình ảnh đại diện' ?>
                            </label>
                            <div class="flex items-center justify-center w-full">
                                <label for="anh_dai_dien" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors" id="upload-area">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                        <p class="mb-2 text-sm text-gray-500">
                                            <span class="font-semibold">Click để chọn ảnh mới</span> hoặc kéo thả
                                        </p>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF, WebP (tối đa 10MB)</p>
                                    </div>
                                    <!-- Preview image will be shown here -->
                                    <div id="image-preview" class="hidden w-full h-full">
                                        <img id="preview-img" src="" alt="Preview" class="w-full h-full object-contain rounded-lg">
                                    </div>
                                    <input id="anh_dai_dien" name="anh_dai_dien" type="file" class="hidden" accept="image/*" onchange="previewImage(this)">
                                </label>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                <?= isNotEmpty($tinTuc->anh_dai_dien) ? 'Chọn ảnh mới để thay thế ảnh hiện tại' : 'Chọn ảnh đại diện cho tin tức này' ?>
                            </p>
                        </div>

                        <div>
                            <label for="trang_thai" class="block text-sm font-medium text-gray-700 mb-2">
                                Trạng thái <span class="text-red-500">*</span>
                            </label>
                            <select id="trang_thai" 
                                    name="trang_thai" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                <option value="draft" <?= ($tinTuc->trang_thai ?? '') === 'draft' ? 'selected' : '' ?>>Bản nháp</option>
                                <option value="published" <?= ($tinTuc->trang_thai ?? '') === 'published' ? 'selected' : '' ?>>Xuất bản</option>
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Chọn trạng thái của bài viết</p>
                        </div>

                        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="/admin/tin-tuc/show?id=<?= $tinTuc->ma_tin_tuc ?>" 
                               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>Quay lại
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>Cập nhật tin tức
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
                            <h4 id="preview-title" class="text-lg font-semibold text-gray-900 line-clamp-2"><?= htmlspecialchars($tinTuc->tieu_de ?? '') ?></h4>
                            <div class="flex items-center space-x-2 text-sm text-gray-500 mt-2">
                                <i class="fas fa-calendar"></i>
                                <span><?= date('d/m/Y', strtotime($tinTuc->ngay_dang ?? 'now')) ?></span>
                                <span id="preview-status" class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">
                                    <?= ($tinTuc->trang_thai ?? '') === 'published' ? 'Xuất bản' : 'Bản nháp' ?>
                                </span>
                            </div>
                        </div>
                        
                        <div id="preview-image-container" class="w-full h-40 bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                            <?php if (isNotEmpty($tinTuc->anh_dai_dien)): ?>
                                <?php $imageUrl = getFileUrl($tinTuc->anh_dai_dien); ?>
                                <?php if ($imageUrl): ?>
                                    <img id="preview-img-current" src="<?= htmlspecialchars($imageUrl) ?>" class="w-full h-full object-cover rounded-lg" />
                                <?php else: ?>
                                    <p class="text-gray-500 text-sm">Ảnh không tồn tại</p>
                                <?php endif; ?>
                            <?php else: ?>
                                <p class="text-gray-500 text-sm">Chưa có hình ảnh</p>
                            <?php endif; ?>
                            <img id="preview-img" class="w-full h-full object-cover rounded-lg hidden" />
                        </div>
                        
                        <div>
                            <p id="preview-content" class="text-gray-600 text-sm line-clamp-4"><?= htmlspecialchars(mb_substr($tinTuc->noi_dung ?? '', 0, 200, 'UTF-8')) . (mb_strlen($tinTuc->noi_dung ?? '', 'UTF-8') > 200 ? '...' : '') ?></p>
                        </div>
                        
                        <div class="text-xs text-gray-500 pt-2 border-t">
                            <p><i class="fas fa-info-circle mr-1"></i>Preview sẽ cập nhật khi bạn nhập thông tin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Image preview function
function previewImage(input) {
    const placeholder = document.getElementById('upload-placeholder');
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const previewImgCurrent = document.getElementById('preview-img-current');
    const previewContainer = document.getElementById('preview-image-container');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            placeholder.classList.add('hidden');
            preview.classList.remove('hidden');
            
            // Update sidebar preview
            if (previewImgCurrent) previewImgCurrent.style.display = 'none';
            const sidebarPreview = document.getElementById('preview-img');
            if (sidebarPreview) {
                sidebarPreview.src = e.target.result;
                sidebarPreview.classList.remove('hidden');
            }
            const placeholderText = previewContainer.querySelector('p');
            if (placeholderText) placeholderText.style.display = 'none';
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
            newImageLabel.textContent = 'Hình ảnh đại diện';
        }
        
        // Cập nhật thông báo
        const infoText = document.querySelector('.fa-info-circle').parentElement;
        infoText.innerHTML = '<i class="fas fa-info-circle mr-1"></i>Chọn ảnh đại diện cho tin tức này';
        
        // Update sidebar preview
        const sidebarPreview = document.getElementById('preview-img-current');
        if (sidebarPreview) sidebarPreview.style.display = 'none';
        const placeholderText = document.querySelector('#preview-image-container p');
        if (placeholderText) {
            placeholderText.textContent = 'Chưa có hình ảnh';
            placeholderText.style.display = 'block';
        }
    }
}

// Live preview functions
function updatePreview() {
    const title = document.getElementById('tieu_de').value || '<?= htmlspecialchars($tinTuc->tieu_de ?? '') ?>';
    const content = document.getElementById('noi_dung').value || '<?= htmlspecialchars($tinTuc->noi_dung ?? '') ?>';
    const status = document.getElementById('trang_thai').value;
    
    document.getElementById('preview-title').textContent = title;
    document.getElementById('preview-content').textContent = content.substring(0, 200) + (content.length > 200 ? '...' : '');
    
    // Update status badge
    const statusElement = document.getElementById('preview-status');
    if (status === 'draft') {
        statusElement.textContent = 'Bản nháp';
        statusElement.className = 'px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full';
    } else {
        statusElement.textContent = 'Xuất bản';
        statusElement.className = 'px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full';
    }
}

// Drag and drop functionality
const uploadArea = document.getElementById('upload-area');
const fileInput = document.getElementById('anh_dai_dien');

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

// Add event listeners
document.getElementById('tieu_de').addEventListener('input', updatePreview);
document.getElementById('noi_dung').addEventListener('input', updatePreview);
document.getElementById('trang_thai').addEventListener('change', updatePreview);

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const title = document.getElementById('tieu_de').value.trim();
    const content = document.getElementById('noi_dung').value.trim();
    
    if (!title) {
        e.preventDefault();
        alert('Vui lòng nhập tiêu đề tin tức!');
        document.getElementById('tieu_de').focus();
        return;
    }
    
    if (!content) {
        e.preventDefault();
        alert('Vui lòng nhập nội dung tin tức!');
        document.getElementById('noi_dung').focus();
        return;
    }
});
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-4 {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
