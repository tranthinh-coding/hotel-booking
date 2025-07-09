<?php
$title = 'Quản lý Loại phòng - Ocean Pearl Hotel Admin';
$pageTitle = 'Quản lý Loại phòng';
ob_start();
?>

<div class="space-y-6">
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
            <a href="/admin/loai-phong/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Thêm loại phòng
            </a>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <input type="text" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="Tìm kiếm loại phòng..." 
                       id="searchInput">
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        id="statusFilter">
                    <option value="">Tất cả trạng thái</option>
                    <option value="active">Hoạt động</option>
                    <option value="inactive">Không hoạt động</option>
                </select>
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        id="priceFilter">
                    <option value="">Tất cả giá</option>
                    <option value="under_1m">Dưới 1 triệu</option>
                    <option value="1m_to_2m">1-2 triệu</option>
                    <option value="over_2m">Trên 2 triệu</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Room Types Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($loaiPhongs)): ?>
            <?php foreach ($loaiPhongs as $loaiPhong): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300">
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-bed text-6xl text-white opacity-80"></i>
                    </div>
                    
                    <div class="p-6">
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                <?= htmlspecialchars($loaiPhong->ten ?? $loaiPhong['ten']) ?>
                            </h3>
                            <p class="text-gray-600">
                                Mã loại: <span class="font-medium"><?= htmlspecialchars($loaiPhong->ma_loai_phong ?? $loaiPhong['ma_loai_phong']) ?></span>
                            </p>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <a href="/admin/loai-phong/edit/<?= $loaiPhong->ma_loai_phong ?? $loaiPhong['ma_loai_phong'] ?>" 
                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    <i class="fas fa-edit mr-1"></i>Sửa
                                </a>
                                <button onclick="deleteRoomType('<?= $loaiPhong->ma_loai_phong ?? $loaiPhong['ma_loai_phong'] ?>')" 
                                        class="text-red-600 hover:text-red-800 text-sm font-medium">
                                    <i class="fas fa-trash mr-1"></i>Xóa
                                </button>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Hoạt động
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full">
                <div class="text-center py-12 bg-white rounded-xl border border-gray-200">
                    <i class="fas fa-bed text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Chưa có loại phòng nào</h3>
                    <p class="text-gray-500 mb-6">Hãy thêm loại phòng đầu tiên để bắt đầu</p>
                    <a href="/admin/loai-phong/create" 
                       class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Thêm loại phòng
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function deleteRoomType(id) {
    if (confirm('Bạn có chắc chắn muốn xóa loại phòng này?')) {
        fetch(`/admin/loai-phong/delete/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            } else {
                alert('Có lỗi xảy ra khi xóa loại phòng');
            }
        })
        .catch(error => {
            alert('Có lỗi xảy ra khi xóa loại phòng');
        });
    }
}

// Search functionality
document.getElementById('searchInput')?.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const roomCards = document.querySelectorAll('.grid > div:not(.col-span-full)');
    
    roomCards.forEach(card => {
        const roomName = card.querySelector('h3').textContent.toLowerCase();
        const roomCode = card.querySelector('span.font-medium').textContent.toLowerCase();
        
        if (roomName.includes(searchTerm) || roomCode.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold fs-5">800,000 VNĐ/đêm</span>
                                    <span class="badge bg-success">Hoạt động</span>
                                </div>
                                <small class="text-muted">Diện tích: 25m² | Sức chứa: 2 người</small>
                                <div class="mt-2">
                                    <a href="/admin/loaiphong/show/1" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/loaiphong/edit/1" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteRoomType(1)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/28a745/ffffff?text=Deluxe+Room" 
                             class="card-img-top" alt="Deluxe Room">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Phòng Deluxe</h5>
                            <p class="card-text">Phòng cao cấp với view đẹp và không gian rộng rãi, thiết kế hiện đại và sang trọng.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold fs-5">1,500,000 VNĐ/đêm</span>
                                    <span class="badge bg-success">Hoạt động</span>
                                </div>
                                <small class="text-muted">Diện tích: 35m² | Sức chứa: 3 người</small>
                                <div class="mt-2">
                                    <a href="/admin/loaiphong/show/2" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/loaiphong/edit/2" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteRoomType(2)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/dc3545/ffffff?text=Suite+Room" 
                             class="card-img-top" alt="Suite Room">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Phòng Suite</h5>
                            <p class="card-text">Phòng hạng sang với không gian sống riêng biệt, phòng tắm đôi và ban công view thành phố.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold fs-5">2,500,000 VNĐ/đêm</span>
                                    <span class="badge bg-success">Hoạt động</span>
                                </div>
                                <small class="text-muted">Diện tích: 50m² | Sức chứa: 4 người</small>
                                <div class="mt-2">
                                    <a href="/admin/loaiphong/show/3" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/loaiphong/edit/3" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteRoomType(3)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <span class="page-link">Trước</span>
                    </li>
                    <li class="page-item active">
                        <span class="page-link">1</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Sau</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script>
function deleteRoomType(id) {
    if (confirm('Bạn có chắc chắn muốn xóa loại phòng này? Hành động này không thể hoàn tác.')) {
        // Ajax delete request here
        console.log('Deleting room type with ID: ' + id);
    }
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    // Implement search logic
});

document.getElementById('statusFilter').addEventListener('change', function() {
    // Implement status filter logic
});

document.getElementById('priceFilter').addEventListener('change', function() {
    // Implement price filter logic
});
</script>
