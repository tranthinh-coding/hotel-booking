<?php
$title = 'Quản lý Tin tức - Ocean Pearl Hotel Admin';
$pageTitle = 'Quản lý Tin tức';
ob_start();
?>

<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <nav class="text-sm text-gray-500">
                <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Tin tức</span>
            </nav>
        </div>
        <div>
            <a href="/admin/tin-tuc/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Thêm tin tức
            </a>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <input type="text" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="Tìm kiếm tin tức..." 
                       id="searchInput">
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        id="statusFilter">
                    <option value="">Tất cả trạng thái</option>
                    <option value="published">Đã xuất bản</option>
                    <option value="draft">Bản nháp</option>
                    <option value="archived">Lưu trữ</option>
                </select>
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        id="categoryFilter">
                    <option value="">Tất cả danh mục</option>
                    <option value="news">Tin tức</option>
                    <option value="events">Sự kiện</option>
                    <option value="promotion">Khuyến mãi</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Tổng tin tức</p>
                    <p class="text-2xl font-bold text-gray-900"><?= count($tinTucs ?? []) ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Đã xuất bản</p>
                    <p class="text-2xl font-bold text-green-600">0</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Bản nháp</p>
                    <p class="text-2xl font-bold text-orange-600">0</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-edit text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Lượt xem hôm nay</p>
                    <p class="text-2xl font-bold text-purple-600">0</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-eye text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- News Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($tinTucs)): ?>
            <?php foreach ($tinTucs as $tinTuc): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300">
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-newspaper text-6xl text-white opacity-80"></i>
                    </div>
                    
                    <div class="p-6">
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2 line-clamp-2">
                                <?= htmlspecialchars($tinTuc->tieu_de ?? $tinTuc['tieu_de']) ?>
                            </h3>
                            <p class="text-gray-600 text-sm line-clamp-3">
                                <?= htmlspecialchars(substr($tinTuc->noi_dung ?? $tinTuc['noi_dung'] ?? '', 0, 100)) ?>...
                            </p>
                        </div>

                        <div class="mb-4">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <i class="fas fa-calendar mr-2"></i>
                                <?= date('d/m/Y', strtotime($tinTuc->ngay_tao ?? $tinTuc['ngay_tao'] ?? 'now')) ?>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-user mr-2"></i>
                                <?= htmlspecialchars($tinTuc->tac_gia ?? $tinTuc['tac_gia'] ?? 'Admin') ?>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <a href="/admin/tin-tuc/edit/<?= $tinTuc->ma_tin_tuc ?? $tinTuc['ma_tin_tuc'] ?>" 
                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    <i class="fas fa-edit mr-1"></i>Sửa
                                </a>
                                <button onclick="deleteNews('<?= $tinTuc->ma_tin_tuc ?? $tinTuc['ma_tin_tuc'] ?>')" 
                                        class="text-red-600 hover:text-red-800 text-sm font-medium">
                                    <i class="fas fa-trash mr-1"></i>Xóa
                                </button>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Đã xuất bản
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full">
                <div class="text-center py-12 bg-white rounded-xl border border-gray-200">
                    <i class="fas fa-newspaper text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Chưa có tin tức nào</h3>
                    <p class="text-gray-500 mb-6">Hãy thêm tin tức đầu tiên để bắt đầu</p>
                    <a href="/admin/tin-tuc/create" 
                       class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Thêm tin tức
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
function deleteNews(id) {
    if (confirm('Bạn có chắc chắn muốn xóa tin tức này?')) {
        fetch(`/admin/tin-tuc/delete/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            } else {
                alert('Có lỗi xảy ra khi xóa tin tức');
            }
        })
        .catch(error => {
            alert('Có lỗi xảy ra khi xóa tin tức');
        });
    }
}

// Search functionality
document.getElementById('searchInput')?.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const newsCards = document.querySelectorAll('.grid > div:not(.col-span-full)');
    
    newsCards.forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        const content = card.querySelector('p').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || content.includes(searchTerm)) {
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
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Tìm kiếm tin tức..." id="searchInput">
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="statusFilter">
                        <option value="">Tất cả trạng thái</option>
                        <option value="published">Đã xuất bản</option>
                        <option value="draft">Bản nháp</option>
                        <option value="archived">Lưu trữ</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="categoryFilter">
                        <option value="">Tất cả danh mục</option>
                        <option value="khuyenmai">Khuyến mãi</option>
                        <option value="sukien">Sự kiện</option>
                        <option value="tintong">Tin tổng hợp</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" id="dateFilter">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th width="60">ID</th>
                            <th width="100">Hình ảnh</th>
                            <th>Tiêu đề</th>
                            <th width="120">Danh mục</th>
                            <th width="100">Tác giả</th>
                            <th width="120">Ngày tạo</th>
                            <th width="100">Trạng thái</th>
                            <th width="100">Lượt xem</th>
                            <th width="150">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1</td>
                            <td>
                                <img src="https://via.placeholder.com/80x60/007bff/ffffff?text=News" 
                                     class="img-thumbnail" alt="News thumbnail">
                            </td>
                            <td>
                                <h6 class="mb-1">Khuyến mãi đặc biệt tháng 12</h6>
                                <small class="text-muted">Giảm giá lên đến 50% cho tất cả loại phòng trong tháng 12...</small>
                            </td>
                            <td><span class="badge bg-info">Khuyến mãi</span></td>
                            <td>Admin</td>
                            <td>15/12/2024</td>
                            <td><span class="badge bg-success">Đã xuất bản</span></td>
                            <td class="text-center">1,245</td>
                            <td>
                                <a href="/admin/tintuc/show/1" class="btn btn-info btn-sm" title="Xem">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/admin/tintuc/edit/1" class="btn btn-warning btn-sm" title="Sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="deleteNews(1)" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#2</td>
                            <td>
                                <img src="https://via.placeholder.com/80x60/28a745/ffffff?text=Event" 
                                     class="img-thumbnail" alt="Event thumbnail">
                            </td>
                            <td>
                                <h6 class="mb-1">Sự kiện khai trương chi nhánh mới</h6>
                                <small class="text-muted">Chúng tôi vui mừng thông báo khai trương chi nhánh mới tại Hà Nội...</small>
                            </td>
                            <td><span class="badge bg-warning text-dark">Sự kiện</span></td>
                            <td>Manager</td>
                            <td>12/12/2024</td>
                            <td><span class="badge bg-secondary">Bản nháp</span></td>
                            <td class="text-center">0</td>
                            <td>
                                <a href="/admin/tintuc/show/2" class="btn btn-info btn-sm" title="Xem">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/admin/tintuc/edit/2" class="btn btn-warning btn-sm" title="Sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="deleteNews(2)" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#3</td>
                            <td>
                                <img src="https://via.placeholder.com/80x60/dc3545/ffffff?text=Review" 
                                     class="img-thumbnail" alt="Review thumbnail">
                            </td>
                            <td>
                                <h6 class="mb-1">Đánh giá từ khách hàng VIP</h6>
                                <small class="text-muted">Những phản hồi tích cực từ khách hàng thân thiết của chúng tôi...</small>
                            </td>
                            <td><span class="badge bg-primary">Tin tổng hợp</span></td>
                            <td>Editor</td>
                            <td>10/12/2024</td>
                            <td><span class="badge bg-success">Đã xuất bản</span></td>
                            <td class="text-center">856</td>
                            <td>
                                <a href="/admin/tintuc/show/3" class="btn btn-info btn-sm" title="Xem">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/admin/tintuc/edit/3" class="btn btn-warning btn-sm" title="Sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="deleteNews(3)" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Sau</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-white-75 small">Tổng tin tức</div>
                            <div class="text-lg fw-bold">45</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-newspaper fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-white-75 small">Đã xuất bản</div>
                            <div class="text-lg fw-bold">38</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-white-75 small">Bản nháp</div>
                            <div class="text-lg fw-bold">7</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-edit fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-white-75 small">Lượt xem hôm nay</div>
                            <div class="text-lg fw-bold">2,547</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-eye fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deleteNews(id) {
    if (confirm('Bạn có chắc chắn muốn xóa tin tức này?')) {
        // Ajax delete request here
        console.log('Deleting news with ID: ' + id);
    }
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    // Implement search logic
});

document.getElementById('statusFilter').addEventListener('change', function() {
    // Implement status filter logic
});

document.getElementById('categoryFilter').addEventListener('change', function() {
    // Implement category filter logic
});

document.getElementById('dateFilter').addEventListener('change', function() {
    // Implement date filter logic
});
</script>
