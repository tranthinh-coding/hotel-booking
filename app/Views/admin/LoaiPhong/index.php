<?php
$title = 'Quản lý Loại phòng - Ocean Pearl Hotel Admin';
$pageTitle = 'Quản lý Loại phòng';
ob_start();
?>

<div class="space-y-6">
    <!-- Success/Error Messages -->
    <?php if (isset($_GET['success'])): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">
                        <?php
                        switch ($_GET['success']) {
                            case 'created':
                                echo 'Loại phòng đã được thêm thành công!';
                                break;
                            case 'updated':
                                echo 'Loại phòng đã được cập nhật thành công!';
                                break;
                            case 'deactivated':
                                echo 'Loại phòng đã được ngừng hoạt động thành công!';
                                break;
                            case 'reactivated':
                                echo 'Loại phòng đã được kích hoạt lại thành công!';
                                break;
                            default:
                                echo 'Thao tác thành công!';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">
                        <?php
                        switch ($_GET['error']) {
                            case 'notfound':
                                echo 'Loại phòng không tìm thấy!';
                                break;
                            case 'hasrooms':
                                echo 'Không thể ngừng hoạt động loại phòng này vì vẫn còn phòng đang hoạt động!';
                                break;
                            case 'deactivate_failed':
                                echo 'Có lỗi xảy ra khi ngừng hoạt động loại phòng!';
                                break;
                            default:
                                echo 'Có lỗi xảy ra, vui lòng thử lại!';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <nav class="text-sm text-gray-500">
                <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Loại phòng</span>
            </nav>
        </div>
        <div>
            <a href="/admin/loai-phong/create"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Thêm loại phòng
            </a>
        </div>
    </div>

    <!-- Thống kê tổng quan -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-layer-group text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Tổng loại phòng</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['total'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Đang hoạt động</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['active'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-power-off text-red-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Ngừng hoạt động</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['inactive'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-bed text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Tổng phòng</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['total_rooms'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Chưa có phòng</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['empty_types'] ?? 0 ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
        <form method="GET" action="/admin/loai-phong" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Tìm kiếm loại phòng..." id="searchInput">
            </div>
            <div>
                <select name="status"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    id="statusFilter">
                    <option value="">Tất cả trạng thái</option>
                    <option value="active" <?= ($_GET['status'] ?? '') === 'active' ? 'selected' : '' ?>>Hoạt động</option>
                    <option value="inactive" <?= ($_GET['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Không hoạt
                        động</option>
                </select>
            </div>
            <div>
                <select name="price"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    id="priceFilter">
                    <option value="">Tất cả giá</option>
                    <option value="under_1m" <?= ($_GET['price'] ?? '') === 'under_1m' ? 'selected' : '' ?>>Dưới 1 triệu
                    </option>
                    <option value="1m_to_2m" <?= ($_GET['price'] ?? '') === '1m_to_2m' ? 'selected' : '' ?>>1-2 triệu
                    </option>
                    <option value="over_2m" <?= ($_GET['price'] ?? '') === 'over_2m' ? 'selected' : '' ?>>Trên 2 triệu
                    </option>
                </select>
            </div>
            <div class="flex space-x-2">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                    <i class="fas fa-search mr-2"></i>
                    Tìm kiếm
                </button>
                <a href="/admin/loai-phong"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors inline-flex items-center">
                    <i class="fas fa-times mr-2"></i>
                    Xóa bộ lọc
                </a>
            </div>
        </form>
    </div>

    <!-- Room Types Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="roomTypesGrid">
        <?php if (isNotEmpty($loaiPhongs)): ?>
            <?php foreach ($loaiPhongs as $loaiPhong): ?>
                <?php if ($loaiPhong && is_object($loaiPhong)): ?>
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 room-card">
                        <div class="h-48 bg-gray-100 overflow-hidden relative">
                            <?php 
                            $imageUrl = $loaiPhong->hinh_anh; // Controller đã xử lý URL rồi
                            ?>
                            
                            <?php if (isNotEmpty($imageUrl)): ?>
                                <img src="<?= htmlspecialchars($imageUrl) ?>"
                                    alt="<?= htmlspecialchars($loaiPhong->ten ?? 'Loại phòng') ?>"
                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-300 room-image"
                                    data-room-id="<?= $loaiPhong->ma_loai_phong ?>"
                                    onload="this.classList.remove('image-loading'); this.parentElement.querySelector('.loading-placeholder')?.remove();"
                                    onerror="showImageError(this, '<?= htmlspecialchars($loaiPhong->ten ?? 'Loại phòng') ?>')">
                                <!-- Loading placeholder -->
                                <div class="loading-placeholder absolute inset-0 bg-gray-200 animate-pulse flex items-center justify-center">
                                    <i class="fas fa-spinner fa-spin text-gray-400 text-2xl"></i>
                                </div>
                            <?php else: ?>
                                <div class="h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-bed text-6xl text-white opacity-80 mb-2"></i>
                                        <p class="text-white text-sm opacity-70">Chưa có ảnh</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="p-6">
                            <div class="mb-4">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                    <?= htmlspecialchars($loaiPhong->ten ?? 'Chưa có tên') ?>
                                </h3>
                                <p class="text-gray-600 mb-1">
                                    Mã loại: <span
                                        class="font-medium"><?= htmlspecialchars($loaiPhong->ma_loai_phong ?? 'N/A') ?></span>
                                </p>
                                <?php if (isNotEmpty($loaiPhong->mo_ta)): ?>
                                    <p class="text-gray-500 text-sm line-clamp-2 mb-2">
                                        <?= htmlspecialchars(mb_substr($loaiPhong->mo_ta, 0, 100, 'UTF-8')) ?>
                                        <?= mb_strlen($loaiPhong->mo_ta, 'UTF-8') > 100 ? '...' : '' ?>
                                    </p>
                                <?php endif; ?>
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-door-open mr-1"></i>
                                    <span><?= is_object($loaiPhong) && method_exists($loaiPhong, 'countPhongs') ? $loaiPhong->countPhongs() : 0 ?>
                                        phòng</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <div class="flex space-x-2">
                                    <a href="/admin/loai-phong/show?id=<?= $loaiPhong->ma_loai_phong ?? '' ?>"
                                        class="text-green-600 hover:text-green-800 text-sm font-medium">
                                        <i class="fas fa-eye mr-1"></i>Xem
                                    </a>
                                    <a href="/admin/loai-phong/edit?id=<?= $loaiPhong->ma_loai_phong ?? '' ?>"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        <i class="fas fa-edit mr-1"></i>Sửa
                                    </a>
                                    <?php if (($loaiPhong->trang_thai ?? 'hoat_dong') === 'hoat_dong'): ?>
                                        <button onclick="deactivateRoomType('<?= $loaiPhong->ma_loai_phong ?? '' ?>')"
                                            class="text-red-600 hover:text-red-800 text-sm font-medium">
                                            <i class="fas fa-power-off mr-1"></i>Ngừng hoạt động
                                        </button>
                                    <?php else: ?>
                                        <button onclick="reactivateRoomType('<?= $loaiPhong->ma_loai_phong ?? '' ?>')"
                                            class="text-green-600 hover:text-green-800 text-sm font-medium">
                                            <i class="fas fa-power-off mr-1"></i>Kích hoạt lại
                                        </button>
                                    <?php endif; ?>
                                </div>
                                <?php 
                                $trangThai = $loaiPhong->trang_thai ?? 'hoat_dong';
                                $statusColor = $trangThai === 'hoat_dong' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                                $statusLabel = $trangThai === 'hoat_dong' ? 'Hoạt động' : 'Ngừng hoạt động';
                                ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusColor ?>">
                                    <?= $statusLabel ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full" id="emptyState">
                <div class="text-center py-12 bg-white rounded-xl border border-gray-200">
                    <i class="fas fa-bed text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                        <?php if (isNotEmpty($_GET['search'])): ?>
                            Không tìm thấy loại phòng nào
                        <?php else: ?>
                            Chưa có loại phòng nào
                        <?php endif; ?>
                    </h3>
                    <p class="text-gray-500 mb-6">
                        <?php if (isNotEmpty($_GET['search'])): ?>
                            Thử tìm kiếm với từ khóa khác hoặc <a href="/admin/loai-phong"
                                class="text-blue-600 hover:underline">xem tất cả</a>
                        <?php else: ?>
                            Hãy thêm loại phòng đầu tiên để bắt đầu
                        <?php endif; ?>
                    </p>
                    <?php if (empty($_GET['search'])): ?>
                        <a href="/admin/loai-phong/create"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            Thêm loại phòng
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function deactivateRoomType(id) {
        if (confirm('🔴 Bạn có chắc chắn muốn ngừng hoạt động loại phòng này?\n\nLoại phòng sẽ được đánh dấu là "Ngừng hoạt động" và:\n• Không thể tạo phòng mới với loại này\n• Vẫn giữ nguyên tất cả dữ liệu\n• Có thể kích hoạt lại bất cứ lúc nào')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/loai-phong/deactivate';

            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'id';
            idInput.value = id;
            form.appendChild(idInput);

            document.body.appendChild(form);
            form.submit();
        }
    }

    function reactivateRoomType(id) {
        if (confirm('🟢 Bạn có chắc chắn muốn kích hoạt lại loại phòng này?\n\nLoại phòng sẽ được đánh dấu là "Hoạt động" và có thể được sử dụng trở lại.')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/loai-phong/reactivate';

            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'id';
            idInput.value = id;
            form.appendChild(idInput);

            document.body.appendChild(form);
            form.submit();
        }
    }

    // Xử lý lỗi ảnh
    function showImageError(imgElement, roomName) {
        const errorHTML = `
            <div class="h-full bg-gradient-to-br from-red-100 to-orange-100 flex items-center justify-center border-2 border-dashed border-red-300">
                <div class="text-center p-4">
                    <i class="fas fa-exclamation-triangle text-3xl text-red-400 mb-2"></i>
                    <p class="text-red-600 text-sm font-medium">Không thể tải ảnh</p>
                    <p class="text-red-500 text-xs mt-1">${roomName}</p>
                    <button onclick="retryLoadImage(this)" class="mt-2 text-xs bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 transition-colors">
                        <i class="fas fa-redo mr-1"></i>Thử lại
                    </button>
                </div>
            </div>
        `;
        imgElement.parentElement.innerHTML = errorHTML;
    }

    // Thử tải lại ảnh
    function retryLoadImage(button) {
        const container = button.closest('.h-48');
        const roomCard = button.closest('.room-card');
        const roomId = roomCard?.querySelector('[data-room-id]')?.getAttribute('data-room-id');
        
        if (roomId) {
            // Reload trang để thử lại
            window.location.reload();
        }
    }

    // Xử lý lazy loading cho ảnh
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('.room-image');
        
        // Intersection Observer cho lazy loading
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.classList.add('image-loading');
                        observer.unobserve(img);
                    }
                });
            });

            images.forEach(img => {
                imageObserver.observe(img);
            });
        }

        // Thêm tooltip cho ảnh
        images.forEach(img => {
            img.setAttribute('title', 'Click để xem ảnh chi tiết');
            img.style.cursor = 'pointer';
            
            img.addEventListener('click', function() {
                openImageModal(this.src, this.alt);
            });
        });
    });

    // Modal xem ảnh chi tiết
    function openImageModal(src, alt) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50';
        modal.innerHTML = `
            <div class="relative max-w-4xl max-h-full p-4">
                <button onclick="this.parentElement.parentElement.remove()" 
                        class="absolute top-2 right-2 text-white bg-black bg-opacity-50 rounded-full w-8 h-8 flex items-center justify-center hover:bg-opacity-75 transition-all">
                    <i class="fas fa-times"></i>
                </button>
                <img src="${src}" alt="${alt}" class="max-w-full max-h-full rounded-lg shadow-2xl">
                <p class="text-white text-center mt-2 text-sm">${alt}</p>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        // Đóng modal khi click vào nền
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.remove();
            }
        });

        // Đóng modal bằng ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                modal.remove();
            }
        }, { once: true });
    }

    // Search functionality - Real-time search
    document.getElementById('searchInput')?.addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase();
        const roomCards = document.querySelectorAll('#roomTypesGrid .room-card');
        const emptyState = document.getElementById('emptyState');

        // Nếu search term rỗng, hiển thị tất cả và ẩn empty state tùy chỉnh
        if (searchTerm === '') {
            roomCards.forEach(card => {
                card.style.display = 'block';
            });

            // Xóa thông báo tìm kiếm nếu có
            const noResultsDiv = document.getElementById('no-search-results');
            if (noResultsDiv) {
                noResultsDiv.remove();
            }

            // Hiển thị lại empty state gốc nếu không có cards
            if (emptyState && roomCards.length === 0) {
                emptyState.style.display = 'block';
            }
            return;
        }

        // Ẩn empty state gốc khi đang tìm kiếm
        if (emptyState) {
            emptyState.style.display = 'none';
        }

        let hasVisibleCards = false;

        // Lọc các cards
        roomCards.forEach(card => {
            const roomName = card.querySelector('h3')?.textContent.toLowerCase() || '';
            const roomCode = card.querySelector('span.font-medium')?.textContent.toLowerCase() || '';

            if (roomName.includes(searchTerm) || roomCode.includes(searchTerm)) {
                card.style.display = 'block';
                hasVisibleCards = true;
            } else {
                card.style.display = 'none';
            }
        });

        // Hiển thị/ẩn thông báo không tìm thấy kết quả
        const noResultsDiv = document.getElementById('no-search-results');

        if (!hasVisibleCards && searchTerm !== '') {
            if (!noResultsDiv) {
                const gridContainer = document.getElementById('roomTypesGrid');
                const noResults = document.createElement('div');
                noResults.id = 'no-search-results';
                noResults.className = 'col-span-full text-center py-8 text-gray-500';
                noResults.innerHTML = `
                <div class="bg-white rounded-xl border border-gray-200 p-8">
                    <i class="fas fa-search text-4xl mb-4 text-gray-400"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Không tìm thấy loại phòng nào</h3>
                    <p class="text-gray-500">Không có loại phòng nào phù hợp với từ khóa "<strong>${searchTerm}</strong>"</p>
                </div>
            `;
                gridContainer.appendChild(noResults);
            } else {
                // Cập nhật từ khóa tìm kiếm
                const searchKeyword = noResultsDiv.querySelector('strong');
                if (searchKeyword) {
                    searchKeyword.textContent = searchTerm;
                }
            }
        } else if (noResultsDiv) {
            noResultsDiv.remove();
        }
    });

    // Form submit on Enter key
    document.getElementById('searchInput')?.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            this.closest('form').submit();
        }
    });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .search-highlight {
        background-color: #fef3c7;
        padding: 0 2px;
        border-radius: 2px;
    }

    /* Custom hover effects for cards */
    .room-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Loading state for images */
    .image-loading {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }

    .loading-placeholder {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        0% {
            background-position: 200% 0;
        }
        100% {
            background-position: -200% 0;
        }
    }

    /* Image container styles */
    .room-image {
        transition: all 0.3s ease;
    }

    .room-image:hover {
        filter: brightness(1.1);
    }

    /* Error state styles */
    .image-error {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border: 2px dashed #f87171;
    }

    /* Modal styles */
    .image-modal {
        backdrop-filter: blur(4px);
        animation: fadeIn 0.2s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Responsive image adjustments */
    @media (max-width: 768px) {
        .h-48 {
            height: 12rem;
        }
    }

    @media (max-width: 640px) {
        .h-48 {
            height: 10rem;
        }
    }

    /* No image state styles */
    .no-image-placeholder {
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        position: relative;
        overflow: hidden;
    }

    .no-image-placeholder::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
        animation: shine 3s infinite;
    }

    @keyframes shine {
        0% {
            transform: translateX(-100%) translateY(-100%) rotate(45deg);
        }
        100% {
            transform: translateX(100%) translateY(100%) rotate(45deg);
        }
    }

    /* Tooltip styles */
    [title] {
        position: relative;
    }

    /* Custom scrollbar for modal if needed */
    .modal-content::-webkit-scrollbar {
        width: 8px;
    }

    .modal-content::-webkit-scrollbar-track {
        background: rgba(0,0,0,0.1);
        border-radius: 4px;
    }

    .modal-content::-webkit-scrollbar-thumb {
        background: rgba(0,0,0,0.3);
        border-radius: 4px;
    }

    .modal-content::-webkit-scrollbar-thumb:hover {
        background: rgba(0,0,0,0.5);
    }
</style>