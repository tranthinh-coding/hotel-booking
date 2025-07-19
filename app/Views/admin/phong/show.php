<?php
$title = 'Chi tiết Phòng - Ocean Pearl Hotel Admin';
$pageTitle = 'Chi tiết Phòng';
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
            <span class="text-gray-900">Chi tiết</span>
        </nav>
        <div class="flex space-x-3">
            <a href="/admin/phong/edit?id=<?= $phong->ma_phong ?>"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class="fas fa-edit mr-2"></i>
                Chỉnh sửa
            </a>
            <a href="/admin/phong"
                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Quay lại
            </a>
        </div>
    </div>

    <!-- Thông báo -->
    <?php if (isset($_GET['success'])): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>
                    <?php
                    switch ($_GET['success']) {
                        case 'images_added':
                            $message = $_GET['message'] ?? 'Thêm nhiều hình ảnh thành công!';
                            echo htmlspecialchars($message);
                            break;
                        case 'image_added':
                            echo 'Thêm hình ảnh thành công!';
                            break;
                        case 'image_deleted':
                            echo 'Xóa hình ảnh thành công!';
                            break;
                        case 'updated':
                            echo 'Cập nhật thông tin phòng thành công!';
                            break;
                        default:
                            echo 'Thao tác thành công!';
                    }
                    ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <span>
                    <?php
                    switch ($_GET['error']) {
                        case 'upload_failed':
                            $message = $_GET['message'] ?? 'Upload hình ảnh thất bại!';
                            echo htmlspecialchars($message);
                            break;
                        case 'invalid_file':
                            echo 'File không hợp lệ! Chỉ chấp nhận ảnh JPG, PNG, GIF, WebP.';
                            break;
                        case 'add_image_failed':
                            echo 'Thêm hình ảnh thất bại! Vui lòng thử lại.';
                            break;
                        case 'image_not_found':
                            echo 'Không tìm thấy hình ảnh!';
                            break;
                        case 'delete_image_failed':
                            echo 'Xóa hình ảnh thất bại! Vui lòng thử lại.';
                            break;
                        case 'missing_image_id':
                            echo 'Thiếu thông tin hình ảnh!';
                            break;
                        default:
                            echo 'Có lỗi xảy ra!';
                    }
                    ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <!-- Thông tin cơ bản -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-100">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-900"><?= htmlspecialchars($phong->ten_phong) ?></h2>
                <div class="flex items-center space-x-4">
                    <span class="text-lg font-bold text-blue-600">
                        <?= number_format($phong->gia) ?> VNĐ
                    </span>
                    <?php
                    $statusColors = [
                        \HotelBooking\Enums\TrangThaiPhong::CON_TRONG => 'bg-green-100 text-green-800',
                        \HotelBooking\Enums\TrangThaiPhong::DANG_DON_DEP => 'bg-blue-100 text-blue-800',
                        \HotelBooking\Enums\TrangThaiPhong::BAO_TRI => 'bg-red-100 text-red-800'
                    ];
                    $statusColor = $statusColors[$phong->trang_thai] ?? 'bg-gray-100 text-gray-800';
                    ?>
                    <span class="px-3 py-1 text-sm font-medium rounded-full <?= $statusColor ?>">
                        <?= \HotelBooking\Enums\TrangThaiPhong::getLabel($phong->trang_thai) ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Thông tin chi tiết -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Thông tin chi tiết</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Mã phòng:</span>
                            <span class="font-medium text-gray-900">#<?= $phong->ma_phong ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tên phòng:</span>
                            <span class="font-medium text-gray-900"><?= htmlspecialchars($phong->ten_phong) ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Loại phòng:</span>
                            <span class="font-medium text-gray-900">
                                <?= $loaiPhong ? htmlspecialchars($loaiPhong->ten) : 'Chưa phân loại' ?>
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Giá phòng:</span>
                            <span class="font-medium text-gray-900"><?= number_format($phong->gia) ?> VNĐ</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Trạng thái:</span>
                            <span class="font-medium text-gray-900">
                                <?= \HotelBooking\Enums\TrangThaiPhong::getLabel($phong->trang_thai) ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div>
                    <img src="<?= htmlspecialchars($phong->anh_bia) ?>" alt="Ảnh bìa phòng"
                        class="w-full h-48 object-cover" />
                </div>

                <!-- Mô tả -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Mô tả phòng</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-700 leading-relaxed">
                            <?= htmlspecialchars($phong->mo_ta ?: 'Chưa có mô tả cho phòng này.') ?>
                        </p>
                    </div>
                </div>

                <!-- Tiện nghi phòng -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tiện nghi</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-wifi text-blue-500 mr-3"></i>
                            WiFi miễn phí
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-snowflake text-blue-500 mr-3"></i>
                            Điều hòa không khí
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-tv text-blue-500 mr-3"></i>
                            Smart TV
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-bath text-blue-500 mr-3"></i>
                            Phòng tắm riêng
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-bed text-blue-500 mr-3"></i>
                            Giường đôi
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-coffee text-blue-500 mr-3"></i>
                            Minibar
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hình ảnh phòng -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Hình ảnh phòng</h3>
                <?php if (!isEmpty($hinhAnhs)): ?>
                    <div class="grid grid-cols-2 gap-4">
                        <?php foreach ($hinhAnhs as $index => $hinhAnh): ?>
                            <div class="relative group">
                                <img src="<?= htmlspecialchars($hinhAnh->getImageUrl()) ?>" alt="Hình ảnh phòng"
                                    class="w-full h-32 object-cover rounded-lg"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-32 bg-gray-200 rounded-lg flex items-center justify-center"
                                    style="display: none;">
                                    <i class="fas fa-image text-gray-400 text-2xl"></i>
                                </div>
                                <!-- Overlay with actions -->
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                    <div class="flex space-x-2">
                                        <button onclick="viewImage('<?= htmlspecialchars($hinhAnh->getImageUrl()) ?>')"
                                            class="text-white hover:text-blue-300 p-2 bg-blue-600 rounded-lg">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                        <button
                                            onclick="confirmDeleteImage(<?= $hinhAnh->ma_hinh_anh ?>, '<?= htmlspecialchars($hinhAnh->anh) ?>')"
                                            class="text-white hover:text-red-300 p-2 bg-red-600 rounded-lg">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-image text-4xl mb-3"></i>
                        <p>Chưa có hình ảnh cho phòng này</p>
                    </div>
                <?php endif; ?>

                <!-- Nút thêm ảnh -->
                <div class="mt-4">
                    <button onclick="openAddImageModal()"
                        class="w-full border-2 border-dashed border-gray-300 rounded-lg p-4 text-gray-500 hover:border-blue-500 hover:text-blue-500 transition-colors">
                        <i class="fas fa-plus text-2xl mb-2"></i>
                        <p>Thêm hình ảnh</p>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Thao tác nhanh -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Thao tác nhanh</h3>
        <div class="flex flex-wrap gap-3">
            <button onclick="changeRoomStatus(<?= $phong->ma_phong ?>)"
                class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors inline-flex items-center">
                <i class="fas fa-sync mr-2"></i>
                Đổi trạng thái
            </button>
            <a href="/admin/phong/edit?id=<?= $phong->ma_phong ?>"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors inline-flex items-center">
                <i class="fas fa-edit mr-2"></i>
                Chỉnh sửa thông tin
            </a>
            <?php if ($phong->trang_thai === \HotelBooking\Enums\TrangThaiPhong::NGUNG_HOAT_DONG): ?>
                <button onclick="confirmReactivate(<?= $phong->ma_phong ?>)"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors inline-flex items-center">
                    <i class="fas fa-power-off mr-2"></i>
                    Kích hoạt lại
                </button>
            <?php else: ?>
                <button onclick="confirmDeactivate(<?= $phong->ma_phong ?>)"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors inline-flex items-center">
                    <i class="fas fa-power-off mr-2"></i>
                    Ngừng hoạt động
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal xem ảnh -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center">
    <div class="relative max-w-4xl max-h-full p-4">
        <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain">
        <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

<!-- Modal thêm ảnh -->
<div id="addImageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-lg w-full p-6">
            <h3 class="text-lg font-semibold mb-4">Thêm hình ảnh phòng</h3>
            <form id="addImageForm" method="POST" action="/admin/phong/add-image" enctype="multipart/form-data">
                <input type="hidden" name="ma_phong" value="<?= $phong->ma_phong ?>">

                <!-- Upload Area -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Chọn hình ảnh</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="images"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-placeholder">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                <p class="mb-2 text-sm text-gray-500">
                                    <span class="font-semibold">Click để chọn ảnh</span> hoặc kéo thả
                                </p>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF, WebP (tối đa 5MB mỗi file)</p>
                                <p class="text-xs text-blue-500 mt-1">✨ Có thể chọn nhiều ảnh cùng lúc</p>
                            </div>
                            <!-- Preview images will be shown here -->
                            <div id="image-preview" class="hidden w-full h-full p-4">
                                <div class="grid grid-cols-2 gap-2 max-h-48 overflow-y-auto" id="preview-grid">
                                    <!-- Preview images will be inserted here -->
                                </div>
                                <div class="mt-2 flex justify-between items-center">
                                    <p class="text-sm text-gray-600">
                                        <span id="image-count">0</span> ảnh đã chọn
                                    </p>
                                    <button type="button" onclick="clearAllImages()"
                                        class="text-sm text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash mr-1"></i>Xóa tất cả
                                    </button>
                                </div>
                            </div>
                            <input type="file" id="images" name="images[]" accept="image/*" multiple class="hidden"
                                onchange="previewImages(this)">
                        </label>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        Chọn nhiều ảnh bằng cách giữ Ctrl (Windows) hoặc Cmd (Mac) khi click
                    </p>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeAddImageModal()"
                        class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Hủy
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-upload mr-2"></i>Thêm ảnh
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal đổi trạng thái -->
<div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h3 class="text-lg font-semibold mb-4">Đổi trạng thái phòng</h3>
            <form id="statusForm" method="POST">
                <input type="hidden" name="ma_phong" value="<?= $phong->ma_phong ?>">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái mới</label>
                    <select name="trang_thai"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <?php
                        $trangThaiList = \HotelBooking\Enums\TrangThaiPhong::all();
                        foreach ($trangThaiList as $status): ?>
                            <option value="<?= $status ?>" <?= $status === $phong->trang_thai ? 'selected' : '' ?>>
                                <?= \HotelBooking\Enums\TrangThaiPhong::getLabel($status) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeStatusModal()"
                        class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Hủy
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function viewImage(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    function openAddImageModal() {
        document.getElementById('addImageModal').classList.remove('hidden');
        // Reset form
        document.getElementById('addImageForm').reset();
        clearImagePreview();
    }

    function closeAddImageModal() {
        document.getElementById('addImageModal').classList.add('hidden');

        // reset form
        document.getElementById('addImageForm').reset();
        clearImagePreview();
    }

    // Xem trước hình ảnh
    function previewImages(input) {
        const files = input.files;
        const previewDiv = document.getElementById('image-preview');
        const placeholderDiv = document.getElementById('upload-placeholder');
        const previewGrid = document.getElementById('preview-grid');
        const imageCount = document.getElementById('image-count');

        if (files.length === 0) {
            clearImagePreview();
            return;
        }

        previewDiv.classList.remove('hidden');
        placeholderDiv.classList.add('hidden');

        previewGrid.innerHTML = '';

        imageCount.textContent = files.length;

        Array.from(files).forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imageDiv = document.createElement('div');
                    imageDiv.className = 'relative group';
                    imageDiv.innerHTML = `
                    <img src="${e.target.result}" alt="Preview ${index + 1}" 
                         class="w-full h-20 object-cover rounded border">
                    <button type="button" onclick="removeImagePreview(${index})" 
                            class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs hover:bg-red-600 opacity-0 group-hover:opacity-100 transition-opacity">
                        ×
                    </button>
                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-1 rounded-b">
                        ${file.name.substring(0, 15)}${file.name.length > 15 ? '...' : ''}
                    </div>
                `;
                    previewGrid.appendChild(imageDiv);
                };
                reader.readAsDataURL(file);
            }
        });
    }

    function clearImagePreview() {
        const previewDiv = document.getElementById('image-preview');
        const placeholderDiv = document.getElementById('upload-placeholder');
        const previewGrid = document.getElementById('preview-grid');
        const imageCount = document.getElementById('image-count');

        previewDiv.classList.add('hidden');
        placeholderDiv.classList.remove('hidden');
        previewGrid.innerHTML = '';
        imageCount.textContent = '0';
    }

    function clearAllImages() {
        document.getElementById('images').value = '';
        clearImagePreview();
    }

    function removeImagePreview(index) {
        clearAllImages();
    }

    function confirmDeleteImage(imageId, filename) {
        if (confirm('🗑️ Bạn có chắc chắn muốn xóa hình ảnh này?\n\nHành động này không thể hoàn tác!')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/phong/delete-image';

            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'image_id';
            idInput.value = imageId;
            form.appendChild(idInput);

            const roomInput = document.createElement('input');
            roomInput.type = 'hidden';
            roomInput.name = 'ma_phong';
            roomInput.value = <?= $phong->ma_phong ?>;
            form.appendChild(roomInput);

            document.body.appendChild(form);
            form.submit();
        }
    }

    function changeRoomStatus(roomId) {
        document.getElementById('statusForm').action = '/admin/phong/update-status';
        const idInput = document.getElementById('statusRoomId') || document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id';
        idInput.id = 'statusRoomId';
        idInput.value = roomId;
        if (!document.getElementById('statusRoomId')) {
            document.getElementById('statusForm').appendChild(idInput);
        }
        document.getElementById('statusModal').classList.remove('hidden');
    }

    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
    }

    function confirmDeactivate(roomId) {
        if (confirm('🔴 Bạn có chắc chắn muốn ngừng hoạt động phòng này?\n\nPhòng sẽ được đánh dấu là "Ngừng hoạt động" và:\n• Không thể đặt phòng mới\n• Vẫn giữ nguyên tất cả dữ liệu\n• Có thể kích hoạt lại bất cứ lúc nào')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/phong/deactivate';

            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'id';
            idInput.value = roomId;
            form.appendChild(idInput);

            document.body.appendChild(form);
            form.submit();
        }
    }

    function confirmReactivate(roomId) {
        if (confirm('🟢 Bạn có chắc chắn muốn kích hoạt lại phòng này?\n\nPhòng sẽ được đánh dấu là "Còn trống" và có thể được đặt phòng trở lại.')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/phong/reactivate';

            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'id';
            idInput.value = roomId;
            form.appendChild(idInput);

            document.body.appendChild(form);
            form.submit();
        }
    }

    document.getElementById('imageModal').addEventListener('click', function (e) {
        if (e.target === this) {
            closeImageModal();
        }
    });

    document.getElementById('addImageModal').addEventListener('click', function (e) {
        if (e.target === this) {
            closeAddImageModal();
        }
    });

    document.getElementById('statusModal').addEventListener('click', function (e) {
        if (e.target === this) {
            closeStatusModal();
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const uploadArea = document.querySelector('label[for="images"]');
        const fileInput = document.getElementById('images');

        // Xử lý kéo thả file vào khu vực upload ảnh
        if (uploadArea && fileInput) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, unhighlight, false);
            });

            uploadArea.addEventListener('drop', handleDrop, false);

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            function highlight(e) {
                uploadArea.classList.add('bg-blue-50', 'border-blue-300');
            }

            function unhighlight(e) {
                uploadArea.classList.remove('bg-blue-50', 'border-blue-300');
            }

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                fileInput.files = files;
                previewImages(fileInput);
            }
        }
    });
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../../layouts/admin.php';
?>