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
                    <form action="/admin/tin-tuc" method="POST" enctype="multipart/form-data" class="space-y-6">
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
            <div class="mt-6 bg-green-50 rounded-xl border border-green-200">
                <div class="px-6 py-4">
                    <h4 class="text-sm font-semibold text-green-900 mb-3">
                        <i class="fas fa-lightbulb mr-2"></i>Mẹo viết bài
                    </h4>
                    <div class="space-y-2 text-sm text-green-800">
                        <div class="flex items-start space-x-2">
                            <span class="text-green-500">•</span>
                            <span>Tiêu đề nên ngắn gọn, hấp dẫn</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span class="text-green-500">•</span>
                            <span>Nội dung rõ ràng, dễ hiểu</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span class="text-green-500">•</span>
                            <span>Hình ảnh chất lượng cao, phù hợp</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span class="text-green-500">•</span>
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

<div class="container-fluid px-4">
    <h1 class="mt-4">Tạo Tin tức mới</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/admin/tintuc">Tin tức</a></li>
        <li class="breadcrumb-item active">Tạo mới</li>
    </ol>

    <form action="/admin/tin-tuc" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Nội dung Tin tức</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="tieu_de" class="form-label">Tiêu đề *</label>
                            <input type="text" class="form-control" id="tieu_de" name="tieu_de" 
                                   placeholder="Nhập tiêu đề tin tức..." required>
                        </div>

                        <div class="mb-3">
                            <label for="tom_tat" class="form-label">Tóm tắt</label>
                            <textarea class="form-control" id="tom_tat" name="tom_tat" rows="3" 
                                      placeholder="Tóm tắt ngắn gọn về nội dung tin tức..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="noi_dung" class="form-label">Nội dung *</label>
                            <textarea class="form-control" id="noi_dung" name="noi_dung" rows="15" 
                                      placeholder="Viết nội dung chi tiết của tin tức..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="hinh_anh" class="form-label">Hình ảnh đại diện</label>
                            <input type="file" class="form-control" id="hinh_anh" name="hinh_anh" accept="image/*">
                            <div class="form-text">Chọn hình ảnh đại diện cho tin tức (JPG, PNG, GIF)</div>
                        </div>

                        <div class="mb-3">
                            <label for="hinh_anh_phu" class="form-label">Hình ảnh phụ</label>
                            <input type="file" class="form-control" id="hinh_anh_phu" name="hinh_anh_phu[]" multiple accept="image/*">
                            <div class="form-text">Chọn nhiều hình ảnh để chèn vào nội dung tin tức</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Thông tin xuất bản</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="danh_muc" class="form-label">Danh mục *</label>
                            <select class="form-select" id="danh_muc" name="danh_muc" required>
                                <option value="">-- Chọn danh mục --</option>
                                <option value="khuyenmai">Khuyến mãi</option>
                                <option value="sukien">Sự kiện</option>
                                <option value="tintong">Tin tổng hợp</option>
                                <option value="huongdan">Hướng dẫn</option>
                                <option value="review">Đánh giá</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="trang_thai" class="form-label">Trạng thái</label>
                            <select class="form-select" id="trang_thai" name="trang_thai">
                                <option value="draft">Bản nháp</option>
                                <option value="published">Xuất bản ngay</option>
                                <option value="scheduled">Lên lịch xuất bản</option>
                            </select>
                        </div>

                        <div class="mb-3" id="scheduled_date_group" style="display: none;">
                            <label for="ngay_xuat_ban" class="form-label">Ngày xuất bản</label>
                            <input type="datetime-local" class="form-control" id="ngay_xuat_ban" name="ngay_xuat_ban">
                        </div>

                        <div class="mb-3">
                            <label for="tac_gia" class="form-label">Tác giả</label>
                            <input type="text" class="form-control" id="tac_gia" name="tac_gia" 
                                   value="Admin" placeholder="Tên tác giả">
                        </div>

                        <div class="mb-3">
                            <label for="tu_khoa" class="form-label">Từ khóa (SEO)</label>
                            <input type="text" class="form-control" id="tu_khoa" name="tu_khoa" 
                                   placeholder="khuyến mãi, khách sạn, du lịch">
                            <div class="form-text">Phân cách bằng dấu phẩy</div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="noi_bat" name="noi_bat" value="1">
                                <label class="form-check-label" for="noi_bat">
                                    Tin nổi bật
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cho_phep_binh_luan" name="cho_phep_binh_luan" value="1" checked>
                                <label class="form-check-label" for="cho_phep_binh_luan">
                                    Cho phép bình luận
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Preview</h5>
                    </div>
                    <div class="card-body">
                        <div id="preview-card">
                            <h6 id="preview-title">Tiêu đề tin tức</h6>
                            <small class="text-muted">
                                <i class="fas fa-user"></i> <span id="preview-author">Admin</span> |
                                <i class="fas fa-calendar"></i> <span id="preview-date"><?= date('d/m/Y') ?></span>
                            </small>
                            <p id="preview-summary" class="mt-2">Tóm tắt sẽ hiển thị ở đây...</p>
                            <span id="preview-category" class="badge bg-secondary">Chưa chọn danh mục</span>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Lưu tin tức
                            </button>
                            <button type="button" class="btn btn-info" onclick="previewNews()">
                                <i class="fas fa-eye"></i> Xem trước
                            </button>
                            <a href="/admin/tintuc" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Show/hide scheduled date
document.getElementById('trang_thai').addEventListener('change', function() {
    const scheduledGroup = document.getElementById('scheduled_date_group');
    if (this.value === 'scheduled') {
        scheduledGroup.style.display = 'block';
        document.getElementById('ngay_xuat_ban').required = true;
    } else {
        scheduledGroup.style.display = 'none';
        document.getElementById('ngay_xuat_ban').required = false;
    }
});

// Live preview
function updatePreview() {
    const title = document.getElementById('tieu_de').value || 'Tiêu đề tin tức';
    const summary = document.getElementById('tom_tat').value || 'Tóm tắt sẽ hiển thị ở đây...';
    const author = document.getElementById('tac_gia').value || 'Admin';
    const category = document.getElementById('danh_muc').value;
    
    document.getElementById('preview-title').textContent = title;
    document.getElementById('preview-summary').textContent = summary;
    document.getElementById('preview-author').textContent = author;
    
    const categoryNames = {
        'khuyenmai': 'Khuyến mãi',
        'sukien': 'Sự kiện',
        'tintong': 'Tin tổng hợp',
        'huongdan': 'Hướng dẫn',
        'review': 'Đánh giá'
    };
    
    const categoryBadge = document.getElementById('preview-category');
    if (category) {
        categoryBadge.textContent = categoryNames[category];
        categoryBadge.className = 'badge bg-primary';
    } else {
        categoryBadge.textContent = 'Chưa chọn danh mục';
        categoryBadge.className = 'badge bg-secondary';
    }
}

document.getElementById('tieu_de').addEventListener('input', updatePreview);
document.getElementById('tom_tat').addEventListener('input', updatePreview);
document.getElementById('tac_gia').addEventListener('input', updatePreview);
document.getElementById('danh_muc').addEventListener('change', updatePreview);

function previewNews() {
    const title = document.getElementById('tieu_de').value;
    const content = document.getElementById('noi_dung').value;
    
    if (!title || !content) {
        alert('Vui lòng nhập tiêu đề và nội dung để xem trước!');
        return;
    }
    
    // Open preview in new window
    const previewWindow = window.open('', '_blank', 'width=800,height=600');
    previewWindow.document.write(`
        <html>
            <head>
                <title>Preview: ${title}</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
            </head>
            <body>
                <div class="container mt-4">
                    <h1>${title}</h1>
                    <div class="mt-3" style="white-space: pre-wrap;">${content}</div>
                </div>
            </body>
        </html>
    `);
}

// Simple content editor enhancement
document.getElementById('noi_dung').addEventListener('keydown', function(e) {
    if (e.key === 'Tab') {
        e.preventDefault();
        const start = this.selectionStart;
        const end = this.selectionEnd;
        this.value = this.value.substring(0, start) + '\t' + this.value.substring(end);
        this.selectionStart = this.selectionEnd = start + 1;
    }
});
</script>
