<?php $title = 'Tạo danh mục mới'; ?>
<?php include_once __DIR__ . '/../layouts/app.php'; ?>

<?php ob_start(); ?>

<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm text-slate-600">
            <li><a href="/" class="hover:text-cyan-600 transition-colors">Trang chủ</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="/danh-muc" class="hover:text-cyan-600 transition-colors">Danh mục</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-slate-800 font-medium">Tạo danh mục mới</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800 mb-2">Tạo danh mục mới</h1>
        <p class="text-slate-600">Thêm danh mục sản phẩm/dịch vụ mới vào hệ thống</p>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="xl:col-span-2">
            <form id="createCategoryForm" class="space-y-6">
                <!-- Basic Info Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-cyan-50 to-blue-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Thông tin cơ bản</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="ten_danh_muc" class="block text-sm font-medium text-slate-700 mb-2">
                                    Tên danh mục <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="ten_danh_muc" name="ten_danh_muc" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       placeholder="Nhập tên danh mục"
                                       required>
                            </div>
                            <div>
                                <label for="slug" class="block text-sm font-medium text-slate-700 mb-2">
                                    Slug URL <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="slug" name="slug" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       placeholder="danh-muc-url"
                                       required>
                                <p class="text-xs text-slate-500 mt-1">Tự động tạo từ tên danh mục</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="loai" class="block text-sm font-medium text-slate-700 mb-2">
                                    Loại danh mục <span class="text-red-500">*</span>
                                </label>
                                <select id="loai" name="loai" 
                                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                        required>
                                    <option value="">Chọn loại danh mục</option>
                                    <option value="phong">Phòng</option>
                                    <option value="dich_vu">Dịch vụ</option>
                                    <option value="tien_ich">Tiện ích</option>
                                    <option value="am_thuc">Ẩm thực</option>
                                    <option value="su_kien">Sự kiện</option>
                                    <option value="khac">Khác</option>
                                </select>
                            </div>
                            <div>
                                <label for="danh_muc_cha_id" class="block text-sm font-medium text-slate-700 mb-2">
                                    Danh mục cha
                                </label>
                                <select id="danh_muc_cha_id" name="danh_muc_cha_id" 
                                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all">
                                    <option value="">Không có (Danh mục gốc)</option>
                                    <option value="1">Phòng nghỉ</option>
                                    <option value="2">Dịch vụ spa</option>
                                    <option value="3">Nhà hàng</option>
                                    <option value="4">Tiện ích khách sạn</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="thu_tu" class="block text-sm font-medium text-slate-700 mb-2">
                                    Thứ tự hiển thị
                                </label>
                                <input type="number" id="thu_tu" name="thu_tu" 
                                       value="1" min="1"
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label for="trang_thai" class="block text-sm font-medium text-slate-700 mb-2">
                                    Trạng thái
                                </label>
                                <select id="trang_thai" name="trang_thai" 
                                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all">
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Vô hiệu hóa</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="mo_ta" class="block text-sm font-medium text-slate-700 mb-2">
                                Mô tả danh mục
                            </label>
                            <textarea id="mo_ta" name="mo_ta" rows="4" 
                                      class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent resize-none transition-all"
                                      placeholder="Nhập mô tả chi tiết về danh mục..."></textarea>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-xs text-slate-500">Mô tả sẽ hiển thị trên trang danh mục</span>
                                <span class="text-xs text-slate-500"><span id="desc-count">0</span>/500</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Tối ưu SEO</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="meta_title" class="block text-sm font-medium text-slate-700 mb-2">
                                Meta Title
                            </label>
                            <input type="text" id="meta_title" name="meta_title" 
                                   class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                   placeholder="Tiêu đề SEO cho danh mục">
                            <div class="flex justify-between items-center mt-1">
                                <span class="text-xs text-slate-500">Tối ưu cho công cụ tìm kiếm</span>
                                <span class="text-xs text-slate-500"><span id="title-count">0</span>/60</span>
                            </div>
                        </div>

                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-slate-700 mb-2">
                                Meta Description
                            </label>
                            <textarea id="meta_description" name="meta_description" rows="3" 
                                      class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent resize-none transition-all"
                                      placeholder="Mô tả ngắn gọn về danh mục cho SEO..."></textarea>
                            <div class="flex justify-between items-center mt-1">
                                <span class="text-xs text-slate-500">Hiển thị trên kết quả tìm kiếm</span>
                                <span class="text-xs text-slate-500"><span id="meta-desc-count">0</span>/160</span>
                            </div>
                        </div>

                        <div>
                            <label for="meta_keywords" class="block text-sm font-medium text-slate-700 mb-2">
                                Meta Keywords
                            </label>
                            <input type="text" id="meta_keywords" name="meta_keywords" 
                                   class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                   placeholder="từ khóa, phân cách, bằng dấu phẩy">
                            <p class="text-xs text-slate-500 mt-1">Các từ khóa liên quan, phân cách bằng dấu phẩy</p>
                        </div>
                    </div>
                </div>

                <!-- Image Upload Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-50 to-green-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Hình ảnh danh mục</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">
                                    Hình ảnh đại diện
                                </label>
                                <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:border-cyan-400 transition-colors">
                                    <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="mt-4">
                                        <p class="text-sm text-slate-600">Kéo thả hoặc click để chọn hình</p>
                                        <p class="text-xs text-slate-500">PNG, JPG, GIF tối đa 2MB</p>
                                    </div>
                                    <input type="file" class="hidden" accept="image/*">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">
                                    Banner danh mục
                                </label>
                                <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:border-cyan-400 transition-colors">
                                    <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="mt-4">
                                        <p class="text-sm text-slate-600">Kéo thả hoặc click để chọn banner</p>
                                        <p class="text-xs text-slate-500">PNG, JPG tối đa 5MB (1200x400px)</p>
                                    </div>
                                    <input type="file" class="hidden" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end">
                    <a href="/danh-muc" 
                       class="px-6 py-2 border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors text-center">
                        Hủy bỏ
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-medium rounded-lg hover:from-cyan-600 hover:to-blue-700 transition-all transform hover:scale-105 shadow-lg">
                        Tạo danh mục
                    </button>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Guide -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Hướng dẫn tạo danh mục</h3>
                </div>
                <div class="p-6">
                    <ul class="text-sm text-slate-600 space-y-2">
                        <li class="flex items-start space-x-2">
                            <span class="w-2 h-2 bg-cyan-500 rounded-full mt-2 flex-shrink-0"></span>
                            <span>Tên danh mục nên ngắn gọn và mô tả rõ ràng</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="w-2 h-2 bg-cyan-500 rounded-full mt-2 flex-shrink-0"></span>
                            <span>Slug URL sẽ tự động tạo từ tên danh mục</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="w-2 h-2 bg-cyan-500 rounded-full mt-2 flex-shrink-0"></span>
                            <span>Chọn loại danh mục phù hợp với sản phẩm</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="w-2 h-2 bg-cyan-500 rounded-full mt-2 flex-shrink-0"></span>
                            <span>Thứ tự hiển thị quyết định vị trí trên menu</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="w-2 h-2 bg-cyan-500 rounded-full mt-2 flex-shrink-0"></span>
                            <span>Tối ưu SEO giúp tăng khả năng tìm kiếm</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Category Examples -->
            <div class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl border border-emerald-200 p-6">
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Ví dụ danh mục</h3>
                <div class="space-y-3 text-sm">
                    <div class="bg-white rounded-lg p-3 border border-emerald-200">
                        <h4 class="font-medium text-slate-800">Phòng nghỉ</h4>
                        <p class="text-slate-600 text-xs">Standard, Deluxe, Premium, VIP</p>
                    </div>
                    <div class="bg-white rounded-lg p-3 border border-emerald-200">
                        <h4 class="font-medium text-slate-800">Dịch vụ spa</h4>
                        <p class="text-slate-600 text-xs">Massage, Facial, Body treatment</p>
                    </div>
                    <div class="bg-white rounded-lg p-3 border border-emerald-200">
                        <h4 class="font-medium text-slate-800">Ẩm thực</h4>
                        <p class="text-slate-600 text-xs">Nhà hàng, Café, Room service</p>
                    </div>
                </div>
            </div>

            <!-- Category Stats -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Thống kê hệ thống</h3>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Tổng danh mục</span>
                        <span class="text-lg font-bold text-cyan-600">24</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Hoạt động</span>
                        <span class="text-lg font-bold text-green-600">22</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Vô hiệu hóa</span>
                        <span class="text-lg font-bold text-red-600">2</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Danh mục cha</span>
                        <span class="text-lg font-bold text-purple-600">8</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from category name
    const nameInput = document.getElementById('ten_danh_muc');
    const slugInput = document.getElementById('slug');
    
    function generateSlug(text) {
        return text
            .toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }
    
    nameInput.addEventListener('input', function() {
        const slug = generateSlug(this.value);
        slugInput.value = slug;
    });

    // Auto-generate meta title from category name
    const metaTitleInput = document.getElementById('meta_title');
    nameInput.addEventListener('input', function() {
        if (!metaTitleInput.value) {
            metaTitleInput.value = this.value + ' - Khách sạn cao cấp';
        }
    });

    // Character counters
    const counters = [
        { input: 'mo_ta', counter: 'desc-count', max: 500 },
        { input: 'meta_title', counter: 'title-count', max: 60 },
        { input: 'meta_description', counter: 'meta-desc-count', max: 160 }
    ];
    
    counters.forEach(item => {
        const input = document.getElementById(item.input);
        const counter = document.getElementById(item.counter);
        
        function updateCounter() {
            const count = input.value.length;
            counter.textContent = count;
            counter.parentElement.classList.toggle('text-red-500', count > item.max);
            counter.parentElement.classList.toggle('text-yellow-500', count > item.max * 0.8 && count <= item.max);
        }
        
        input.addEventListener('input', updateCounter);
        updateCounter();
    });

    // File upload preview
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        const dropZone = input.parentElement;
        
        dropZone.addEventListener('click', () => input.click());
        
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-cyan-400', 'bg-cyan-50');
        });
        
        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-cyan-400', 'bg-cyan-50');
        });
        
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-cyan-400', 'bg-cyan-50');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                input.files = files;
                handleFileUpload(files[0], dropZone);
            }
        });
        
        input.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileUpload(e.target.files[0], dropZone);
            }
        });
    });
    
    function handleFileUpload(file, dropZone) {
        const reader = new FileReader();
        reader.onload = function(e) {
            dropZone.innerHTML = `
                <div class="relative">
                    <img src="${e.target.result}" alt="Preview" class="mx-auto h-24 w-auto rounded-lg">
                    <div class="mt-2">
                        <p class="text-sm text-green-600 font-medium">${file.name}</p>
                        <p class="text-xs text-slate-500">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                    </div>
                    <button type="button" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600" onclick="removeFile(this)">×</button>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    }

    // Form validation and submission
    const form = document.getElementById('createCategoryForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Basic validation
        const tenDanhMuc = document.getElementById('ten_danh_muc').value.trim();
        const slug = document.getElementById('slug').value.trim();
        const loai = document.getElementById('loai').value;
        
        if (!tenDanhMuc || !slug || !loai) {
            alert('Vui lòng điền đầy đủ thông tin bắt buộc!');
            return;
        }
        
        // Check slug format
        if (!/^[a-z0-9-]+$/.test(slug)) {
            alert('Slug chỉ được chứa chữ cái thường, số và dấu gạch ngang!');
            return;
        }
        
        // Success animation
        const button = form.querySelector('button[type="submit"]');
        button.innerHTML = '<span class="flex items-center"><svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Đang tạo danh mục...</span>';
        button.disabled = true;
        
        setTimeout(() => {
            alert('Tạo danh mục thành công!');
            window.location.href = '/danh-muc';
        }, 2000);
    });

    // Animation on load
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 200);
    });
});

function removeFile(button) {
    const dropZone = button.closest('.border-dashed').parentElement;
    dropZone.innerHTML = `
        <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:border-cyan-400 transition-colors">
            <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div class="mt-4">
                <p class="text-sm text-slate-600">Kéo thả hoặc click để chọn hình</p>
                <p class="text-xs text-slate-500">PNG, JPG, GIF tối đa 2MB</p>
            </div>
            <input type="file" class="hidden" accept="image/*">
        </div>
    `;
}
</script>

<?php $content = ob_get_clean(); ?>
<?php echo $content; ?>
