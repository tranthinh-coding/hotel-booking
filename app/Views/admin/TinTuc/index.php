<?php include_once '../layouts/admin.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Quản lý Tin tức</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Tin tức</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-newspaper me-1"></i>
            Danh sách Tin tức
            <div class="float-end">
                <a href="/admin/tintuc/create" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Thêm tin tức
                </a>
            </div>
        </div>
        <div class="card-body">
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
