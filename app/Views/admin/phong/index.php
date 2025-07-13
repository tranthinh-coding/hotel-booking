<?php
$title = 'Quản lý Phòng - Ocean Pearl Hotel Admin';
$pageTitle = 'Quản lý Phòng';
ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <div class="flex justify-between items-center">
        <nav class="text-sm text-gray-500">
            <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">Quản lý Phòng</span>
        </nav>
        <a href="/admin/phong/create"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Thêm phòng
        </a>
    </div>

    <!-- Thông báo -->
    <?php if (isset($_GET['success'])): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>
                    <?php
                    switch ($_GET['success']) {
                        case 'created':
                            echo 'Tạo phòng thành công!';
                            break;
                        case 'updated':
                            echo 'Cập nhật phòng thành công!';
                            break;
                        case 'deleted':
                            echo 'Xóa phòng thành công!';
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
                        case 'notfound':
                            echo 'Phòng không tồn tại!';
                            break;
                        default:
                            echo 'Có lỗi xảy ra!';
                    }
                    ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <!-- Header với nút thêm mới -->

    <!-- Thống kê nhanh -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-bed text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Tổng phòng</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['total'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Phòng trống</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['available'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-friends text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Đang bảo trì</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['occupied'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-tools text-red-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Bảo trì</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $stats['maintenance'] ?? 0 ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bộ lọc -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tìm kiếm</label>
                <input type="text" name="search" placeholder="Tên phòng, số phòng..."
                    value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Loại phòng</label>
                <select name="loai_phong"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Tất cả</option>
                    <?php if (!empty($loaiPhongs)): ?>
                        <?php foreach ($loaiPhongs as $loai): ?>
                            <option value="<?= $loai->ma_loai_phong ?>" <?= ($_GET['loai_phong'] ?? '') == $loai->ma_loai_phong ? 'selected' : '' ?>>
                                <?= htmlspecialchars($loai->ten) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                <select name="trang_thai"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Tất cả</option>
                    <?php
                    $trangThaiList = \HotelBooking\Enums\TrangThaiPhong::all();
                    foreach ($trangThaiList as $status): ?>
                        <option value="<?= $status ?>" <?= ($_GET['trang_thai'] ?? '') === $status ? 'selected' : '' ?>>
                            <?= \HotelBooking\Enums\TrangThaiPhong::getLabel($status) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sắp xếp</label>
                <select name="sort"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="ten_phong" <?= ($_GET['sort'] ?? '') === 'ten_phong' ? 'selected' : '' ?>>Tên phòng
                    </option>
                    <option value="gia" <?= ($_GET['sort'] ?? '') === 'gia' ? 'selected' : '' ?>>Giá phòng</option>
                    <option value="ma_phong" <?= ($_GET['sort'] ?? '') === 'ma_phong' ? 'selected' : '' ?>>Mã phòng
                    </option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit"
                    class="w-full bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                    <i class="fas fa-search mr-2"></i>Lọc
                </button>
            </div>
        </form>
    </div>

    <!-- Danh sách phòng -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php if (!empty($phongs)): ?>
            <?php foreach ($phongs as $phong): ?>
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Hình ảnh phòng -->
                    <div class="relative h-48 bg-gray-200">
                        <?php
                        $mainImage = null;
                        if (method_exists($phong, 'getMainImageUrl')) {
                            $mainImage = $phong->getMainImageUrl();
                        }
                        ?>
                        <?php if ($mainImage): ?>
                            <img src="<?= htmlspecialchars($mainImage) ?>" alt="<?= htmlspecialchars($phong->ten_phong) ?>"
                                class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-bed text-gray-400 text-4xl"></i>
                            </div>
                        <?php endif; ?>

                        <!-- Badge trạng thái -->
                        <?php
                        $statusColors = [
                            \HotelBooking\Enums\TrangThaiPhong::CON_TRONG => 'bg-green-500',
                            \HotelBooking\Enums\TrangThaiPhong::DANG_DON_DEP => 'bg-blue-500',
                            \HotelBooking\Enums\TrangThaiPhong::BAO_TRI => 'bg-red-500'
                        ];
                        $statusColor = $statusColors[$phong->trang_thai] ?? 'bg-gray-500';
                        ?>
                        <div class="absolute top-3 left-3">
                            <span class="px-2 py-1 text-xs font-semibold text-white rounded-full <?= $statusColor ?>">
                                <?= \HotelBooking\Enums\TrangThaiPhong::getLabel($phong->trang_thai) ?>
                            </span>
                        </div>

                        <!-- Menu dropdown -->
                        <div class="absolute top-3 right-3">
                            <div class="relative group">
                                <button class="p-2 bg-white rounded-full shadow-sm hover:bg-gray-50">
                                    <i class="fas fa-ellipsis-v text-gray-600"></i>
                                </button>
                                <div
                                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-10">
                                    <a href="/admin/phong/<?= $phong->ma_phong ?>"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <i class="fas fa-eye mr-2"></i>Xem chi tiết
                                    </a>
                                    <a href="/admin/phong/<?= $phong->ma_phong ?>/edit"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <i class="fas fa-edit mr-2"></i>Chỉnh sửa
                                    </a>
                                    <button onclick="changeRoomStatus(<?= $phong->ma_phong ?>)"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <i class="fas fa-sync mr-2"></i>Đổi trạng thái
                                    </button>
                                    <hr class="my-1">
                                    <button onclick="confirmDelete(<?= $phong->ma_phong ?>)"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <i class="fas fa-trash mr-2"></i>Xóa phòng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thông tin phòng -->
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($phong->ten_phong) ?></h3>
                            <span class="text-sm text-gray-500">#<?= $phong->ma_phong ?></span>
                        </div>

                        <?php if (isset($phong->loai_phong_ten)): ?>
                            <p class="text-sm text-gray-600 mb-2"><?= htmlspecialchars($phong->loai_phong_ten) ?></p>
                        <?php endif; ?>

                        <p class="text-gray-600 text-sm mb-3 line-clamp-2"><?= htmlspecialchars($phong->mo_ta) ?></p>

                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-blue-600">
                                <?= number_format($phong->gia) ?> VNĐ
                            </span>
                            <div class="flex space-x-2">
                                <a href="/admin/phong/<?= $phong->ma_phong ?>"
                                    class="text-gray-400 hover:text-blue-600 transition-colors">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/admin/phong/<?= $phong->ma_phong ?>/edit"
                                    class="text-gray-400 hover:text-green-600 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="confirmDelete(<?= $phong->ma_phong ?>)"
                                    class="text-gray-400 hover:text-red-600 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center py-12">
                <i class="fas fa-bed text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Chưa có phòng nào</h3>
                <p class="text-gray-500 mb-4">Hãy thêm phòng đầu tiên cho khách sạn của bạn</p>
                <a href="/admin/phong/create"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Thêm phòng
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal đổi trạng thái -->
<div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h3 class="text-lg font-semibold mb-4">Đổi trạng thái phòng</h3>
            <form id="statusForm" method="POST">
                <input type="hidden" name="ma_phong" id="statusRoomId">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái mới</label>
                    <select name="trang_thai" id="newStatus"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <?php
                        $trangThaiList = \HotelBooking\Enums\TrangThaiPhong::all();
                        foreach ($trangThaiList as $status): ?>
                            <option value="<?= $status ?>">
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
    function changeRoomStatus(roomId) {
        document.getElementById('statusRoomId').value = roomId;
        document.getElementById('statusForm').action = '/admin/phong/' + roomId + '/update-status';
        document.getElementById('statusModal').classList.remove('hidden');
    }

    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
    }

    function confirmDelete(roomId) {
        if (confirm('Bạn có chắc chắn muốn xóa phòng này?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/phong/' + roomId + '/delete';
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../../layouts/admin.php';
?>