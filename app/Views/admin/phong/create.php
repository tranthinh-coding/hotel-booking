<?php
$title = 'Tạo Phòng Mới - Ocean Pearl Hotel Admin';
$pageTitle = 'Tạo Phòng Mới';
ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500">
        <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
        <span class="mx-2">/</span>
        <a href="/admin/phong" class="hover:text-gray-700">Phòng</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">Tạo mới</span>
    </nav>

    <!-- Thông báo lỗi -->
    <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <span>
                    <?php 
                    switch($_GET['error']) {
                        case 'validation':
                            echo urldecode($_GET['message'] ?? 'Dữ liệu không hợp lệ');
                            break;
                        case 'duplicate':
                            echo 'Tên phòng đã tồn tại';
                            break;
                        default:
                            echo urldecode($_GET['error']);
                    }
                    ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Thông tin Phòng</h3>
                    <p class="text-sm text-gray-500 mt-1">Nhập thông tin cơ bản cho phòng mới</p>
                </div>

                <div class="p-6">
                    <form action="/admin/phong/store" method="POST" enctype="multipart/form-data" class="space-y-6">
                        
                        <!-- Tên phòng -->
                        <div>
                            <label for="ten_phong" class="block text-sm font-medium text-gray-700 mb-2">
                                Tên phòng <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="ten_phong" 
                                name="ten_phong" 
                                required
                                value="<?= htmlspecialchars(get('ten_phong', '')) ?>"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="VD: P101, Deluxe Room 201..."
                                oninput="updatePreview()"
                            >
                            <p class="mt-1 text-sm text-gray-500">Tên phòng sẽ hiển thị trên website</p>
                        </div>

                        <!-- Loại phòng -->
                        <div>
                            <label for="ma_loai_phong" class="block text-sm font-medium text-gray-700 mb-2">
                                Loại phòng <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="ma_loai_phong" 
                                name="ma_loai_phong" 
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                onchange="updatePreview()"
                            >
                                <option value="">-- Chọn loại phòng --</option>
                                <?php foreach($loaiPhongs as $loaiPhong): ?>
                                    <option value="<?= $loaiPhong->ma_loai_phong ?>" <?= get('ma_loai_phong') == $loaiPhong->ma_loai_phong ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($loaiPhong->ten) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Chọn loại phòng phù hợp</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Giá phòng -->
                            <div>
                                <label for="gia" class="block text-sm font-medium text-gray-700 mb-2">
                                    Giá phòng (VNĐ/đêm) <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="number" 
                                    id="gia" 
                                    name="gia" 
                                    min="0"
                                    required
                                    value="<?= htmlspecialchars(get('gia', '')) ?>"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="500000"
                                    oninput="updatePreview()"
                                >
                                <p class="mt-1 text-sm text-gray-500">Giá phòng cho một đêm</p>
                            </div>

                            <!-- Trạng thái phòng -->
                            <div>
                                <label for="trang_thai" class="block text-sm font-medium text-gray-700 mb-2">
                                    Trạng thái phòng
                                </label>
                                <select 
                                    id="trang_thai" 
                                    name="trang_thai" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    onchange="updatePreview()"
                                >
                                    <?php 
                                    $trangThaiList = \HotelBooking\Enums\TrangThaiPhong::all();
                                    $selectedStatus = get('trang_thai', \HotelBooking\Enums\TrangThaiPhong::CON_TRONG);
                                    ?>
                                    <?php foreach($trangThaiList as $status): ?>
                                        <option value="<?= $status ?>" <?= $selectedStatus == $status ? 'selected' : '' ?>>
                                            <?= \HotelBooking\Enums\TrangThaiPhong::getLabel($status) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="mt-1 text-sm text-gray-500">Trạng thái hiện tại của phòng</p>
                            </div>
                        </div>

                        <!-- Mô tả -->
                        <div>
                            <label for="mo_ta" class="block text-sm font-medium text-gray-700 mb-2">
                                Mô tả phòng
                            </label>
                            <textarea 
                                id="mo_ta" 
                                name="mo_ta" 
                                rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Mô tả chi tiết về phòng, tiện nghi, view..."
                                oninput="updatePreview()"
                            ><?= htmlspecialchars(get('mo_ta', '')) ?></textarea>
                            <p class="mt-1 text-sm text-gray-500">Mô tả sẽ giúp khách hàng hiểu rõ hơn về phòng</p>
                        </div>

                        <!-- Hình ảnh phòng -->
                        <div>
                            <label for="hinh_anh" class="block text-sm font-medium text-gray-700 mb-2">
                                Hình ảnh phòng
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="hinh_anh" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Tải lên nhiều hình ảnh</span>
                                            <input 
                                                id="hinh_anh" 
                                                name="hinh_anh[]" 
                                                type="file" 
                                                accept="image/*"
                                                multiple
                                                class="sr-only"
                                                onchange="previewImages(this)"
                                            >
                                        </label>
                                        <p class="pl-1">hoặc kéo thả</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF tối đa 10MB mỗi file. Có thể chọn nhiều ảnh.</p>
                                </div>
                            </div>

                            <!-- Images Preview Grid -->
                            <div id="images-preview" class="mt-4 hidden">
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4" id="preview-grid">
                                    <!-- Preview images will be inserted here -->
                                </div>
                                <div class="mt-2 flex justify-between items-center">
                                    <p class="text-sm text-gray-600">
                                        <span id="image-count">0</span> ảnh đã chọn
                                    </p>
                                    <button type="button" onclick="clearAllImages()" class="text-sm text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash mr-1"></i>Xóa tất cả
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="/admin/phong" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>Quay lại
                            </a>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>Tạo phòng
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
                            <h4 id="preview-ten" class="text-lg font-semibold text-gray-900">Tên phòng</h4>
                            <p id="preview-loai" class="text-sm text-gray-500">Loại phòng</p>
                        </div>

                        <div id="preview-hinh-anh" class="w-full h-32 bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                            <p class="text-gray-500 text-sm">Chưa có hình ảnh</p>
                            <img id="preview-img" class="w-full h-full object-cover rounded-lg hidden" />
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Giá phòng:</span>
                                <span id="preview-gia" class="text-sm font-medium text-blue-600">0 VNĐ</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Trạng thái:</span>
                                <span id="preview-tranghai" class="text-sm px-2 py-1 rounded-full bg-green-100 text-green-800">Còn trống</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Số ảnh:</span>
                                <span id="preview-images-count" class="text-sm font-medium">0 ảnh</span>
                            </div>
                        </div>

                        <div>
                            <p id="preview-mota" class="text-gray-600 text-sm">Mô tả sẽ hiển thị ở đây...</p>
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
let selectedImages = [];

// Live preview functions
function updatePreview() {
    const tenPhong = document.getElementById('ten_phong').value || 'Tên phòng';
    const moTa = document.getElementById('mo_ta').value || 'Mô tả sẽ hiển thị ở đây...';
    const gia = document.getElementById('gia').value || '0';
    
    // Get selected loai phong
    const loaiPhongSelect = document.getElementById('ma_loai_phong');
    const loaiPhong = loaiPhongSelect.options[loaiPhongSelect.selectedIndex].text || 'Loại phòng';
    
    // Get selected trang thai
    const trangThaiSelect = document.getElementById('trang_thai');
    const trangThai = trangThaiSelect.options[trangThaiSelect.selectedIndex].text || 'Còn trống';

    document.getElementById('preview-ten').textContent = tenPhong;
    document.getElementById('preview-loai').textContent = loaiPhong === '-- Chọn loại phòng --' ? 'Loại phòng' : loaiPhong;
    document.getElementById('preview-mota').textContent = moTa;
    document.getElementById('preview-gia').textContent = new Intl.NumberFormat('vi-VN').format(gia) + ' VNĐ';
    document.getElementById('preview-images-count').textContent = selectedImages.length + ' ảnh';
    
    // Update status badge
    const statusElement = document.getElementById('preview-tranghai');
    statusElement.textContent = trangThai;
    
    // Update status color
    statusElement.className = 'text-sm px-2 py-1 rounded-full ';
    if (trangThai.includes('Còn trống')) {
        statusElement.className += 'bg-green-100 text-green-800';
    } else if (trangThai.includes('Bảo trì')) {
        statusElement.className += 'bg-yellow-100 text-yellow-800';
    } else if (trangThai.includes('Đang dọn dẹp')) {
        statusElement.className += 'bg-blue-100 text-blue-800';
    } else {
        statusElement.className += 'bg-gray-100 text-gray-800';
    }
}

// Multiple images preview
function previewImages(input) {
    const files = Array.from(input.files);
    const previewContainer = document.getElementById('images-preview');
    const previewGrid = document.getElementById('preview-grid');
    const imageCount = document.getElementById('image-count');
    const sidePreviewImg = document.getElementById('preview-img');
    const sidePreviewContainer = document.getElementById('preview-hinh-anh');
    
    // Clear previous previews
    previewGrid.innerHTML = '';
    selectedImages = [];
    
    if (files.length > 0) {
        previewContainer.classList.remove('hidden');
        
        files.forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                selectedImages.push(file);
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageDiv = document.createElement('div');
                    imageDiv.className = 'relative group';
                    imageDiv.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg border border-gray-200" />
                        <button type="button" onclick="removeImageAtIndex(${index})" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors opacity-0 group-hover:opacity-100">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        ${index === 0 ? '<div class="absolute bottom-1 left-1 bg-blue-500 text-white text-xs px-2 py-1 rounded">Ảnh chính</div>' : ''}
                    `;
                    previewGrid.appendChild(imageDiv);
                    
                    // Set first image as side preview
                    if (index === 0) {
                        sidePreviewImg.src = e.target.result;
                        sidePreviewImg.classList.remove('hidden');
                        sidePreviewContainer.querySelector('p').style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            }
        });
        
        imageCount.textContent = selectedImages.length;
        updatePreview();
    } else {
        previewContainer.classList.add('hidden');
        sidePreviewImg.classList.add('hidden');
        sidePreviewContainer.querySelector('p').style.display = 'block';
    }
}

function removeImageAtIndex(index) {
    selectedImages.splice(index, 1);
    
    // Create new FileList
    const dt = new DataTransfer();
    selectedImages.forEach(file => dt.items.add(file));
    document.getElementById('hinh_anh').files = dt.files;
    
    // Re-render preview
    if (selectedImages.length > 0) {
        // Trigger preview update
        previewImages({ files: selectedImages });
    } else {
        clearAllImages();
    }
}

function clearAllImages() {
    const input = document.getElementById('hinh_anh');
    const previewContainer = document.getElementById('images-preview');
    const sidePreviewImg = document.getElementById('preview-img');
    const sidePreviewContainer = document.getElementById('preview-hinh-anh');
    
    input.value = '';
    selectedImages = [];
    previewContainer.classList.add('hidden');
    
    // Reset side preview
    sidePreviewImg.classList.add('hidden');
    sidePreviewContainer.querySelector('p').style.display = 'block';
    
    updatePreview();
}

// Initialize preview on page load
document.addEventListener('DOMContentLoaded', function() {
    updatePreview();
});

// Validation form
document.querySelector('form').addEventListener('submit', function(e) {
    const tenPhong = document.getElementById('ten_phong').value.trim();
    const maLoaiPhong = document.getElementById('ma_loai_phong').value;
    
    if (!tenPhong) {
        alert('Vui lòng nhập tên phòng');
        e.preventDefault();
        return;
    }
    
    if (!maLoaiPhong) {
        alert('Vui lòng chọn loại phòng');
        e.preventDefault();
        return;
    }
});
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../../layouts/admin.php';
?>
