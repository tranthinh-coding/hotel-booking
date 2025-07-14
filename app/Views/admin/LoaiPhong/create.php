<?php
$title = 'Tạo Loại phòng mới - Ocean Pearl Hotel Admin';
$pageTitle = 'Tạo Loại phòng mới';
ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500">
        <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
        <span class="mx-2">/</span>
        <a href="/admin/loai-phong" class="hover:text-gray-700">Loại phòng</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">Tạo mới</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Thông tin Loại phòng</h3>
                    <p class="text-sm text-gray-500 mt-1">Nhập thông tin cơ bản cho loại phòng mới</p>
                </div>

                <div class="p-6">
                    <form action="/admin/loai-phong/store" method="POST" enctype="multipart/form-data" class="space-y-6">
                        <input type="hidden" name="MAX_FILE_SIZE" value="5242880"> <!-- 5MB -->
                        <div>
                            <label for="ten" class="block text-sm font-medium text-gray-700 mb-2">
                                Tên loại phòng <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="ten" name="ten"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="VD: Phòng Standard, Deluxe, Suite..." required>
                            <p class="mt-1 text-sm text-gray-500">Tên loại phòng sẽ hiển thị trên website</p>
                        </div>

                        <div>
                            <label for="mo_ta" class="block text-sm font-medium text-gray-700 mb-2">
                                Mô tả
                            </label>
                            <textarea id="mo_ta" name="mo_ta" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Mô tả chi tiết về loại phòng này, các đặc điểm nổi bật..."></textarea>
                            <p class="mt-1 text-sm text-gray-500">Mô tả sẽ giúp khách hàng hiểu rõ hơn về loại phòng</p>
                        </div>

                        <div>
                            <label for="trang_thai" class="block text-sm font-medium text-gray-700 mb-2">
                                Trạng thái <span class="text-red-500">*</span>
                            </label>
                            <select id="trang_thai" name="trang_thai"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                                <option value="<?= \HotelBooking\Enums\TrangThaiLoaiPhong::HOAT_DONG ?>" selected>
                                    <?= \HotelBooking\Enums\TrangThaiLoaiPhong::getLabel(\HotelBooking\Enums\TrangThaiLoaiPhong::HOAT_DONG) ?>
                                </option>
                                <option value="<?= \HotelBooking\Enums\TrangThaiLoaiPhong::NGUNG_HOAT_DONG ?>">
                                    <?= \HotelBooking\Enums\TrangThaiLoaiPhong::getLabel(\HotelBooking\Enums\TrangThaiLoaiPhong::NGUNG_HOAT_DONG) ?>
                                </option>
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Chọn trạng thái ban đầu cho loại phòng</p>
                        </div>

                        <div>
                            <label for="hinh_anh" class="block text-sm font-medium text-gray-700 mb-2">
                                Hình ảnh đại diện
                            </label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="hinh_anh"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Tải lên hình ảnh</span>
                                            <input id="hinh_anh" name="hinh_anh" type="file" class="sr-only"
                                                accept="image/*">
                                        </label>
                                        <p class="pl-1">hoặc kéo thả</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF tối đa 10MB</p>
                                </div>
                            </div>

                            <!-- Image Preview -->
                            <div id="image-preview" class="mt-4 hidden">
                                <div class="relative">
                                    <img id="preview-image"
                                        class="w-full h-48 object-cover rounded-lg border border-gray-200" />
                                    <button type="button" onclick="removeImage()"
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="/admin/loai-phong"
                                class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>Quay lại
                            </a>
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>Tạo loại phòng
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
                            <h4 id="preview-ten" class="text-lg font-semibold text-gray-900">Tên loại phòng</h4>
                        </div>

                        <div id="preview-hinh-anh"
                            class="w-full h-32 bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                            <p class="text-gray-500 text-sm">Chưa có hình ảnh</p>
                            <img id="preview-img" class="w-full h-full object-cover rounded-lg hidden" />
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
    // Live preview functions
    function updatePreview() {
        const ten = document.getElementById('ten').value || 'Tên loại phòng';
        const moTa = document.getElementById('mo_ta').value || 'Mô tả sẽ hiển thị ở đây...';

        document.getElementById('preview-ten').textContent = ten;
        document.getElementById('preview-mota').textContent = moTa;
    }

    // Image preview
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview-img');
        const placeholder = document.querySelector('#preview-hinh-anh p');
        const previewContainer = document.getElementById('image-preview');
        const mainPreview = document.getElementById('preview-image');

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
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
        document.getElementById('hinh_anh').value = '';
        document.getElementById('image-preview').classList.add('hidden');
        document.getElementById('preview-img').classList.add('hidden');
        document.querySelector('#preview-hinh-anh p').style.display = 'block';
    }

    // Add event listeners
    document.getElementById('ten').addEventListener('input', updatePreview);
    document.getElementById('mo_ta').addEventListener('input', updatePreview);
    document.getElementById('hinh_anh').addEventListener('change', previewImage);

    // Form validation
    document.querySelector('form').addEventListener('submit', function (e) {
        const ten = document.getElementById('ten').value.trim();

        if (!ten) {
            e.preventDefault();
            alert('Vui lòng nhập tên loại phòng!');
            document.getElementById('ten').focus();
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

    // Drag and drop functionality
    const dropZone = document.querySelector('input[type="file"]').closest('.border-dashed');
    dropZone.addEventListener('dragover', function (e) {
        e.preventDefault();
        this.classList.add('border-blue-500', 'bg-blue-50');
    });

    dropZone.addEventListener('dragleave', function (e) {
        e.preventDefault();
        this.classList.remove('border-blue-500', 'bg-blue-50');
    });

    dropZone.addEventListener('drop', function (e) {
        e.preventDefault();
        this.classList.remove('border-blue-500', 'bg-blue-50');

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            document.getElementById('hinh_anh').files = files;
            previewImage({ target: { files: files } });
        }
    });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>