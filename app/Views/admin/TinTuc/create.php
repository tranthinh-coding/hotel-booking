<?php
$title = 'Tạo Tin tức mới - Ocean Pearl Hotel Admin';
$pageTitle = 'Tạo Tin tức mới';
ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500">
        <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
        <span class="mx-2">/</span>
        <a href="/admin/tin-tuc" class="hover:text-gray-700">Tin tức</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">Tạo mới</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Nội dung Tin tức</h3>
                    <p class="text-sm text-gray-500 mt-1">Tạo bài viết mới cho website</p>
                </div>
                
                <div class="p-6">
                    <form action="/admin/tin-tuc/store" method="POST" enctype="multipart/form-data" class="space-y-6">
                        <div>
                            <label for="tieu_de" class="block text-sm font-medium text-gray-700 mb-2">
                                Tiêu đề <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="tieu_de" 
                                   name="tieu_de" 
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
                                      required></textarea>
                            <p class="mt-1 text-sm text-gray-500">Nội dung chi tiết và đầy đủ thông tin</p>
                        </div>

                        <div>
                            <label for="anh_dai_dien" class="block text-sm font-medium text-gray-700 mb-2">
                                Hình ảnh đại diện
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="anh_dai_dien" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                            <span>Tải lên hình ảnh</span>
                                            <input id="anh_dai_dien" name="anh_dai_dien" type="file" class="sr-only" accept="image/*">
                                        </label>
                                        <p class="pl-1">hoặc kéo thả</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF tối đa 10MB</p>
                                </div>
                            </div>
                            
                            <!-- Image Preview -->
                            <div id="image-preview" class="mt-4 hidden">
                                <div class="relative">
                                    <img id="preview-image" class="w-full h-64 object-cover rounded-lg border border-gray-200" />
                                    <button type="button" onclick="removeImage()" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="trang_thai" class="block text-sm font-medium text-gray-700 mb-2">
                                Trạng thái
                            </label>
                            <select id="trang_thai" 
                                    name="trang_thai" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="draft">Bản nháp</option>
                                <option value="published" selected>Xuất bản ngay</option>
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Chọn trạng thái của bài viết</p>
                        </div>

                        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="/admin/tin-tuc" 
                               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>Quay lại
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>Lưu tin tức
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
                            <h4 id="preview-title" class="text-lg font-semibold text-gray-900 line-clamp-2">Tiêu đề tin tức</h4>
                            <div class="flex items-center space-x-2 text-sm text-gray-500 mt-2">
                                <i class="fas fa-calendar"></i>
                                <span><?= date('d/m/Y') ?></span>
                                <span id="preview-status" class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Xuất bản</span>
                            </div>
                        </div>
                        
                        <div id="preview-image-container" class="w-full h-40 bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                            <p class="text-gray-500 text-sm">Chưa có hình ảnh</p>
                            <img id="preview-img" class="w-full h-full object-cover rounded-lg hidden" />
                        </div>
                        
                        <div>
                            <p id="preview-content" class="text-gray-600 text-sm line-clamp-4">Nội dung sẽ hiển thị ở đây...</p>
                        </div>
                        
                        <div class="text-xs text-gray-500 pt-2 border-t">
                            <p><i class="fas fa-info-circle mr-1"></i>Preview sẽ cập nhật khi bạn nhập thông tin</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Writing Tips -->
            <div class="mt-6 bg-gray-50 rounded-xl border border-gray-200">
                <div class="px-6 py-4">
                    <h4 class="text-sm font-semibold text-gray-600 mb-3">
                        <i class="fas fa-lightbulb mr-2 text-gray-400"></i>Mẹo viết bài
                    </h4>
                    <div class="space-y-2 text-sm text-gray-500">
                        <div class="flex items-start space-x-2">
                            <span class="text-gray-400">•</span>
                            <span>Tiêu đề nên ngắn gọn, hấp dẫn</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span class="text-gray-400">•</span>
                            <span>Nội dung rõ ràng, dễ hiểu</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span class="text-gray-400">•</span>
                            <span>Hình ảnh chất lượng cao, phù hợp</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span class="text-gray-400">•</span>
                            <span>Kiểm tra chính tả trước khi xuất bản</span>
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
    const title = document.getElementById('tieu_de').value || 'Tiêu đề tin tức';
    const content = document.getElementById('noi_dung').value || 'Nội dung sẽ hiển thị ở đây...';
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

// Image preview
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview-img');
    const placeholder = document.querySelector('#preview-image-container p');
    const previewContainer = document.getElementById('image-preview');
    const mainPreview = document.getElementById('preview-image');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Main preview
            mainPreview.src = e.target.result;
            previewContainer.classList.remove('hidden');
            
            // Side preview
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
}

// Remove image
function removeImage() {
    document.getElementById('anh_dai_dien').value = '';
    document.getElementById('image-preview').classList.add('hidden');
    document.getElementById('preview-img').classList.add('hidden');
    document.querySelector('#preview-image-container p').style.display = 'block';
}

// Add event listeners
document.getElementById('tieu_de').addEventListener('input', updatePreview);
document.getElementById('noi_dung').addEventListener('input', updatePreview);
document.getElementById('trang_thai').addEventListener('change', updatePreview);
document.getElementById('anh_dai_dien').addEventListener('change', previewImage);

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
    
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Đang lưu...';
    submitBtn.disabled = true;
    
    // Re-enable if form submission fails
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 5000);
});

// Drag and drop functionality for image
const dropZone = document.querySelector('input[type="file"]').closest('.border-dashed');
dropZone.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.classList.add('border-blue-500', 'bg-blue-50');
});

dropZone.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.classList.remove('border-blue-500', 'bg-blue-50');
});

dropZone.addEventListener('drop', function(e) {
    e.preventDefault();
    this.classList.remove('border-blue-500', 'bg-blue-50');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        document.getElementById('anh_dai_dien').files = files;
        previewImage({ target: { files: files } });
    }
});

// Initialize preview
updatePreview();
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
