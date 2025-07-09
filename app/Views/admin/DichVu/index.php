<?php
$title = 'Quản lý Dịch vụ - Ocean Pearl Hotel Admin';
$pageTitle = 'Quản lý Dịch vụ';
ob_start();
?>

<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <nav class="text-sm text-gray-500">
                <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Dịch vụ</span>
            </nav>
        </div>
        <div>
            <a href="/admin/dich-vu/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Thêm dịch vụ
            </a>
        </div>
    </div>

    <!-- Services Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($dichVus)): ?>
            <?php foreach ($dichVus as $dichVu): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300">
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-concierge-bell text-6xl text-white opacity-80"></i>
                    </div>
                    
                    <div class="p-6">
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                <?= htmlspecialchars($dichVu->ten_dich_vu ?? $dichVu['ten_dich_vu']) ?>
                            </h3>
                            <p class="text-gray-600">
                                Mã dịch vụ: <span class="font-medium"><?= htmlspecialchars($dichVu->ma_dich_vu ?? $dichVu['ma_dich_vu']) ?></span>
                            </p>
                        </div>

                        <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600">
                                    <?= number_format($dichVu->gia ?? $dichVu['gia'], 0, ',', '.') ?>₫
                                </div>
                                <div class="text-sm text-gray-500">Giá dịch vụ</div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <a href="/admin/dich-vu/edit/<?= $dichVu->ma_dich_vu ?? $dichVu['ma_dich_vu'] ?>" 
                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    <i class="fas fa-edit mr-1"></i>Sửa
                                </a>
                                <button onclick="deleteService('<?= $dichVu->ma_dich_vu ?? $dichVu['ma_dich_vu'] ?>')" 
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
                    <i class="fas fa-concierge-bell text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Chưa có dịch vụ nào</h3>
                    <p class="text-gray-500 mb-6">Hãy thêm dịch vụ đầu tiên để bắt đầu</p>
                    <a href="/admin/dich-vu/create" 
                       class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Thêm dịch vụ
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function deleteService(id) {
    if (confirm('Bạn có chắc chắn muốn xóa dịch vụ này?')) {
        fetch(`/admin/dich-vu/delete/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            } else {
                alert('Có lỗi xảy ra khi xóa dịch vụ');
            }
        })
        .catch(error => {
            alert('Có lỗi xảy ra khi xóa dịch vụ');
        });
    }
}
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Tìm kiếm dịch vụ..." id="searchInput">
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="categoryFilter">
                        <option value="">Tất cả danh mục</option>
                        <option value="ansung">Ăn uống</option>
                        <option value="giaitat">Giải trí</option>
                        <option value="thetao">Thể thao</option>
                        <option value="spa">Spa & Wellness</option>
                        <option value="khac">Khác</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="statusFilter">
                        <option value="">Tất cả trạng thái</option>
                        <option value="active">Hoạt động</option>
                        <option value="inactive">Tạm dừng</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" id="priceFilter">
                        <option value="">Tất cả giá</option>
                        <option value="free">Miễn phí</option>
                        <option value="paid">Có phí</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/007bff/ffffff?text=Restaurant" 
                             class="card-img-top" alt="Restaurant Service">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Nhà hàng cao cấp</h5>
                            <p class="card-text">Thưởng thức các món ăn tinh tế từ đầu bếp 5 sao với view tuyệt đẹp hướng biển.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold">500,000 VNĐ/người</span>
                                    <span class="badge bg-success">Hoạt động</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-primary">Ăn uống</span>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> 6:00 - 23:00
                                    </small>
                                </div>
                                <div class="btn-group w-100" role="group">
                                    <a href="/admin/dichvu/show/1" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/dichvu/edit/1" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteService(1)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/28a745/ffffff?text=Spa" 
                             class="card-img-top" alt="Spa Service">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Spa & Massage</h5>
                            <p class="card-text">Dịch vụ spa thư giãn với các liệu pháp massage truyền thống và hiện đại.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold">800,000 VNĐ/90 phút</span>
                                    <span class="badge bg-success">Hoạt động</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-info">Spa & Wellness</span>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> 9:00 - 21:00
                                    </small>
                                </div>
                                <div class="btn-group w-100" role="group">
                                    <a href="/admin/dichvu/show/2" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/dichvu/edit/2" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteService(2)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/ffc107/ffffff?text=Pool" 
                             class="card-img-top" alt="Pool Service">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Hồ bơi vô cực</h5>
                            <p class="card-text">Hồ bơi ngoài trời với view 360 độ, mở cửa 24/7 cho khách lưu trú.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold">Miễn phí</span>
                                    <span class="badge bg-success">Hoạt động</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-warning text-dark">Thể thao</span>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> 24/7
                                    </small>
                                </div>
                                <div class="btn-group w-100" role="group">
                                    <a href="/admin/dichvu/show/3" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/dichvu/edit/3" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteService(3)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/6f42c1/ffffff?text=Gym" 
                             class="card-img-top" alt="Gym Service">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Phòng gym hiện đại</h5>
                            <p class="card-text">Phòng tập gym với trang thiết bị hiện đại và huấn luyện viên cá nhân.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold">200,000 VNĐ/ngày</span>
                                    <span class="badge bg-warning text-dark">Tạm dừng</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-warning text-dark">Thể thao</span>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> 6:00 - 22:00
                                    </small>
                                </div>
                                <div class="btn-group w-100" role="group">
                                    <a href="/admin/dichvu/show/4" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/dichvu/edit/4" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteService(4)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/e83e8c/ffffff?text=Transfer" 
                             class="card-img-top" alt="Transfer Service">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Đưa đón sân bay</h5>
                            <p class="card-text">Dịch vụ đưa đón sân bay 24/7 với xe sang trọng và tài xế chuyên nghiệp.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold">1,000,000 VNĐ/chuyến</span>
                                    <span class="badge bg-success">Hoạt động</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-secondary">Khác</span>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> 24/7
                                    </small>
                                </div>
                                <div class="btn-group w-100" role="group">
                                    <a href="/admin/dichvu/show/5" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/dichvu/edit/5" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteService(5)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/20c997/ffffff?text=Karaoke" 
                             class="card-img-top" alt="Karaoke Service">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Karaoke VIP</h5>
                            <p class="card-text">Phòng karaoke VIP với âm thanh chất lượng cao và hệ thống đèn hiện đại.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold">300,000 VNĐ/giờ</span>
                                    <span class="badge bg-success">Hoạt động</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-success">Giải trí</span>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> 19:00 - 02:00
                                    </small>
                                </div>
                                <div class="btn-group w-100" role="group">
                                    <a href="/admin/dichvu/show/6" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/dichvu/edit/6" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteService(6)">
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
function deleteService(id) {
    if (confirm('Bạn có chắc chắn muốn xóa dịch vụ này?')) {
        // Ajax delete request here
        console.log('Deleting service with ID: ' + id);
    }
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    // Implement search logic
});

document.getElementById('categoryFilter').addEventListener('change', function() {
    // Implement category filter logic
});

document.getElementById('statusFilter').addEventListener('change', function() {
    // Implement status filter logic
});

document.getElementById('priceFilter').addEventListener('change', function() {
    // Implement price filter logic
});
</script>
